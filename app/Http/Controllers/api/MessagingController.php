<?php


namespace App\Http\Controllers\api;


use App\Events\PrepareRecipients;
use App\Http\Controllers\Controller;
use App\Message;
use App\MessageRecipient;
use App\SmsLog;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class MessagingController extends Controller
{


    public function schedule($details)
    {

        $message = $details['message'];

        $send_at = date('Y-m-d H:i:s');

        if ($details['scheduled'] == "yes") {
            $send_at = Carbon::parse($details['date']);
        }

        $template = [];

        $template['message_type'] = 1;
        $template['message_content'] = $message;
        $template['church_id'] = auth()->user()->church_id;
        $template['send_at'] = $send_at;
        $template['added_by'] = auth()->user()->id;
        $template['status'] = true;


        $messageTemplate = Message::create($template);

        event(new PrepareRecipients($messageTemplate, $details));

    }
}