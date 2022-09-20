<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $phone_number, $message, $category,$churchId;

    /**
     * SendSms constructor.
     * @param $phone_number
     * @param $message
     */
    public function __construct($phone_number, $message,$category,$churchId)
    {
        $this->phone_number = $phone_number;
        $this->message = $message;
        $this->category = $category;
        $this->churchId = $churchId;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $smsData = [
            'apikey' => env('SMS_API_KEY') ? env('SMS_API_KEY') : '4939e436f54d70a0f9321c1861339d1c',
            'partnerID' => env('SMS_PARTNER_ID') ? env('SMS_PARTNER_ID') : '665',
            'mobile' => $this->phone_number,
            'shortcode' => env('SMS_SENDER_ID') ? env('SMS_SENDER_ID') : 'SOLUTECH',
            'message' => $this->message,
            'pass_type' => 'plain' //bm5 {base64 encode} or plain
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://quicksms.advantasms.com/api/services/sendsms/");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($smsData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsResponse = curl_exec($ch);
        curl_close($ch);
        $networkId = null;
        $messageId = null;
        $responseCode = null;
        $responseDesc = null;
        if (!empty($smsResponse)) {
            $response = json_decode($smsResponse, TRUE);
            if (isset($response['responses'])) {
                foreach ($response as $responseItem) {
                    if (!empty($responseItem)) {
                        foreach ($responseItem as $smsDetails) {
                            $responseCode = $smsDetails['response-code'];
                            $responseDesc = $smsDetails['response-description'];
                            if ($responseCode == 200) {
                                $networkId = $smsDetails['networkid'];
                                $messageId = $smsDetails['messageid'];
                            }
                        }
                    }
                }
            }
        }

    //     DB::table('tbl_logs')->insert(
    //         ['log_content' => "$this->phone_number,$this->message,$messageId,$churchId,$category,$networkId,,$responseCode,$responseDesc"]
    //     );

    //     DB::table('tbl_sms_log')->insert([
    //         'sent_to' => $this->phone_number,
    //         'message' => $this->message,
    //         'message_id' => $messageId,
    //         'church_id' => $churchId,
    //         'category' => $category,
    //         'network_id' => $networkId,
    //         'response_code' => $responseCode,
    //         'response_desc' => $responseDesc
    //     ]
    // );
    }
}
