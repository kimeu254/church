<?php

namespace App\Jobs;

use App\Events\SmsEvent;
use App\Message;
use App\Transformers\Messages\MessageTransformer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SendMessages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $time = Carbon::now();

        $messages = Message::with('recipients')->where('send_at', '<', $time)->get();

        foreach ($messages as $message) {

            foreach ($message->recipients as $user) {

                $text = app(MessageTransformer::class)->transform($user, $message->message_content);

                event(new SmsEvent($user->phone_number, $text, $message->id, $user->id, $message->church_id));

            }

        }
    }
}
