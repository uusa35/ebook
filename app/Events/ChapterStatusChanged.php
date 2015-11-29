<?php

namespace App\Events;

use App\Events\Event;
use App\Src\Book\Chapter\Chapter;
use Illuminate\Queue\SerializesModels;

class ChapterStatusChanged extends Event
{

    public $chapter;
    public $status;

    use SerializesModels;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Chapter $chapter, $status)
    {
        $this->chapter = $chapter;
        $this->status = $status;
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
