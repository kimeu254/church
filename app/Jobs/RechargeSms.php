<?php

namespace App\Jobs;

use App\Church;
use App\Events\SmsEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RechargeSms implements ShouldQueue
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
        $churches = Church::with('sms_units')->get();

        foreach ($churches as $church) {

            $units = $church->sms_units->units;

            if ($units < env('MIN_SMS_BALANCE_NOTIFICATION')) {

                $message = 'Hello, your SMS Balance is below ' . env('MIN_SMS_BALANCE_NOTIFICATION') . '. Please recharge to continue sending SMSs from your account.';

                event(new SmsEvent($church->phone_number, $message));

            }
        }
    }
}
