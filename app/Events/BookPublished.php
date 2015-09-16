<?php namespace App\Events;

use App\Events\Event;
use App\Src\Book\Book;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BookPublished extends Event
{
    use SerializesModels;
    /**
     * @var Book
     */
    public $book;

    /**
     * Create a new event instance.
     *
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

}
