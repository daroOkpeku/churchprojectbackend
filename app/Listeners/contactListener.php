<?php

namespace App\Listeners;

use App\Events\contactEvent;
use App\Mail\Sendemail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class contactListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(contactEvent $event)
    {




        $data = [
         "fullname"=>  $event->fullname,
         "email"=>$event->email,
         "subject"=> $event->subject,
          "message"=>  $event->message
        ];
       Mail::to('stephenjason41@gmail.com')->send(new Sendemail($data));
    }
}
