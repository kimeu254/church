<?php

namespace App\Listeners;

use App\Events\SmsEvent;
use App\MessageRecipient;
use App\Network;
use App\SmsLog;
use App\SmsRate;
use App\SmsUnit;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSmsNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param SmsEvent $event
     * @return void
     */
    public function handle(SmsEvent $event)
    {
        //

        $rate = 1;

        $phone = $event->phone;

        $message = $event->message;

        $memberId = $event->user_id;

        $churchId = $event->churchId;

        $units = SmsUnit::where('church_id', $churchId)->first();

        if ($units->units < 1) {
            return;
        }

        $churchRate = SmsRate::where('church_id', $churchId)->first();

        if ($churchRate) {
            $rate = $churchRate->rate;
        }

        $url = env('SMS_END_POINT');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        $smsData = array(
            'apikey' => env('SMS_API_KEY'),
            'partnerID' => env('SMS_PARTNER_ID'),
            'mobile' => $phone,
            'shortcode' => env('SMS_SENDER_ID'),
            'message' => $message,
            'pass_type' => 'plain', //bm5 {base64 encode} or plain
        );

        $smsJsonData = json_encode($smsData);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $smsJsonData);

        $smsResponse = curl_exec($curl);

        if (!empty($smsResponse)) {

            $response = json_decode($smsResponse, TRUE);

            if (array_key_exists('responses', $response)) {

                foreach ($response as $responseItem) {

                    if (is_array($responseItem)) {

                        foreach ($responseItem as $smsDetails) {

                            if (array_key_exists('response-code', $smsDetails)) {
                                $responseCode = $smsDetails['response-code'];
                            } else {
                                $responseCode = $smsDetails['respose-code'];
                            }

                            $responseDesc = $smsDetails['response-description'];

                            if ($responseCode == 200) {
                                $networkId = $smsDetails['networkid'];
                                $messageId = $smsDetails['messageid'];

                                $localMessageId = $event->messageId;

                                if (!is_null($localMessageId)) {

                                    $sentMessage = MessageRecipient::where('message_id', $localMessageId)
                                        ->where('member_id', $memberId)
                                        ->first();

                                    $sentMessage->delete();

                                    // also change the units available for the church id...

                                    $units_spent = sizeof(explode("\n", wordwrap($message, 160)));

                                    $cost = $units_spent * $rate;

                                    $available = $units->units - $units_spent;

                                    $units->units = $available;

                                    $units->update();

                                }

                            } else {
                                $networkId = null;
                                $messageId = null;
                            }

                            $network = Network::find($networkId);

                            if (!$network) {
                                if ($networkId == 1) {
                                    $name = 'Safaricom';
                                } else if ($networkId == 2) {
                                    $name = 'Airtel';
                                } else {
                                    $name = 'Telkom';
                                }

                                Network::create([
                                    'name' => $name
                                ]);
                            }

                            SmsLog::insert(
                                [
                                    'sent_to' => $phone,
                                    'message_id' => $messageId,
                                    'church_id' => $churchId,
                                    'message' => $message,
                                    'network_id' => $networkId,
                                    'cost' => $cost,
                                    'sender' => env('SMS_SENDER_ID'),
                                    'response_code' => $responseCode,
                                    'response_desc' => $responseDesc,
                                    'sent_at' => Carbon::now()
                                ]
                            );

                        }
                    }
                }

            }
        }
    }
}