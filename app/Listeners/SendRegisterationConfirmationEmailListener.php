<?php

namespace App\Listeners;

use App\Events\SendRegisterationConfirmationEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendRegisterationConfirmationEmailListener
{


    /**
     * Handle the event.
     *
     * @param  SendRegisterationConfirmationEmail $event
     * @return void
     */
    public function handle(SendRegisterationConfirmationEmail $event)
    {
        $user = $event->user;
        $email = $user->email;

        Mail::later(1, 'emails.confirm', ['data' => ['id' => $user->id]], function ($message) use ($email) {
            $message->from(\Cache::get('contactusInfo')->email, ' | 7orof.com');
            $message->subject('7orof.com | Email Confirmation');
            $message->priority('high');
            $message->to($email);
        });
    }
}
