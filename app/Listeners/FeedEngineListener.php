<?php

namespace App\Listeners;


use App\Events\FeedEngineEvent;
use App\Jobs\FeedEngineJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FeedEngineListener
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
    public function handle(FeedEngineEvent $feedEvent)
    {
        dispatch(new FeedEngineJob($feedEvent));
    }
}
