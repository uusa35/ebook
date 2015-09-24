<?php namespace App\Listeners;


use App\Events\CreateChapter;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Session;
use Knp\Snappy\Pdf;


class CalculateChapterPage implements ShouldQueue
{

    private $uploadPath;

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        $this->uploadPath = base_path('storage/app/pdfs/');
    }

    /**
     * Handle the event.
     *
     * @param  BookPublished $event
     * @return void
     */
    public function handle(CreateChapter $event)
    {
        // create PDF

        $fpdi = new \FPDI();

        // count the book page
        $pageCount = $fpdi->setSourceFile($this->uploadPath.$event->chapter->url);

        // this one is used within the CreatePDF to include it within the template
        Session::put('total_pages',$pageCount);

        // update the database with total page count
        $event->chapter->update(['total_pages' => $pageCount]);
        $event->chapter->save();


    }

}
