<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FeedEngineEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $fileName;

    public $chunks;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($fileName , $chunks = [])
    {
        $this->fileName  = $fileName;
        $this->chunks   = $chunks;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
