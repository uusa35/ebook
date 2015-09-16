<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChapterCreated extends Event
{
    use SerializesModels;
    public $chapter;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Chapter $chapter)
    {
        //
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
