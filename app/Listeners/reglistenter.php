<?php

namespace App\Listeners;

use App\Events\regevent;
use App\Mail\SendEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
class reglistenter
{
    /**
     * Create the event listener.
     */
    public function __construct(regevent $event)
    {
        $data = [
            'name'=>$event->name,
            'email'=>$event->email,
            "code"=>$event->verification_code
        ];
         Mail::to($event->email)->send( new SendEmail($data));
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
    }
}
