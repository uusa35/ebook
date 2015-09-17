<?php

namespace App\Events;

use App\Events\Event;
use App\Http\Requests\Request;
use App\Src\Book\Chapter\Chapter;
use App\Src\Book\Chapter\ChapterRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CreateChapter extends Event
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
        $this->chapter = $chapter;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    /*public function broadcastOn()
    {
        return [];
    }*/
}
