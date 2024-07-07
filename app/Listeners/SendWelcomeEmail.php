<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerRegisterationEmail;
use App\Mail\AdminCustomerRegisterationEmail;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
        $user = $event->user;
        
        Mail::to($event->user->email)->send(new CustomerRegisterationEmail($user));
        Mail::to(env("MAIL_BCC_ADDRESS"))->send(new AdminCustomerRegisterationEmail($user));
    }
    
}
