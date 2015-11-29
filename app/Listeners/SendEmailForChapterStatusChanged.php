<?php

namespace App\Listeners;

use App\Core\PrimaryEmailService;
use App\Events\ChapterStatusChanged;
use App\Src\User\UserRepository;
use \Illuminate\Support\Facades\Request;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailForChapterStatusChanged implements ShouldQueue
{
    public $userRepository;

    use PrimaryEmailService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle the event.
     *
     * @param  ChapterStatusChanged $event
     * @return void
     */
    public function handle(ChapterStatusChanged $event)
    {
        $book = $event->chapter->book;

        if (Request::user()->isAuthor() && $event->status == 'drafted') {

            $data = [
                'chapter_title' => $event->chapter->title,
                'chapter_id' => $event->chapter->id,
                'book_title' => $book->title,
                'book_id' => $book->id
            ];

            $this->sendEmailForDraftedChapter($data, $book);

        } elseif ((Request::user()->isAdmin() || Request::user()->isEditor()) && $event->status == 'published') {

            $emailsFollowersList = $this->userRepository->allFollowersForUser($book->author_id)->pluck('email')->toArray();

            $data = [
                'chapter_title' => $event->chapter->title,
                'chapter_id' => $event->chapter->id,
                'book_title' => $book->title,
                'book_id' => $book->id
            ];

            $this->sendEmailForPublishedChapter($data, $book, $emailsFollowersList);

        }
    }
}
