<?php namespace App\Listeners;

use App\Events\BookPublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Knp\Snappy\Pdf;

class CreatePdf implements ShouldQueue
{

    private $pdf;



    private $uploadPath;

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {

        $this->pdf = new Pdf(base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'));
        $this->uploadPath = base_path('storage/app/pdfs/');
    }

    /**
     * Handle the event.
     *
     * @param  BookPublished $event
     * @return void
     */
    public function handle(BookPublished $event)
    {
        // to enforce the app to use UTF-8 for arabic content

        // create PDF
        //dd($this->uploadPath . $event->book->url);




        $body = $this->cleanBody($event->book->body);


        $body = '<div style="border: 1px dotted #d7d7d7 !important;">'. $body .'</div>';

        $this->pdf->setOption('encoding', 'UTF-8');

        $this->pdf->generateFromHtml($body, $this->uploadPath . $event->book->url,['encoding'=>'UTF-8','images'=> true,'enable-external-links' => true]);

        return true;
    }


    public function cleanBody ($body) {

        $bodyContent = str_replace('../../..', public_path(), $body);
        $bodyContent = str_replace('../../../../#', '#', $body);

        return $bodyContent;
    }

}
