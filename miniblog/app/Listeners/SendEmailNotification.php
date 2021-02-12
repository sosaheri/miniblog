<?php

namespace App\Listeners;

use App\Events\LikedPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\LikePostMail;
use Log;


class SendEmailNotification
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
     * @param  LikedPost  $event
     * @return void
     */
    public function handle(LikedPost $event)
    {
       Log::info("listener", ['event' => $event]);

        Mail::send(new LikePostMail($event));

    }
}
