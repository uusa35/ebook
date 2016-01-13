<?php namespace App\Listeners;

use App\Events\BookPublished;
use App\Events\CreateChapter;
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
    public function handle(CreateChapter $event)
    {

        // to enforce the app to use UTF-8 for arabic content

        // create PDF
        /*
         * concolusion :
         * for pdf the imag link must be relivant to the server which means /home/vagrant/www/public/images ...
         * for editing the tinymac form link must be relative to public only '/images/....
         *
         * */
        $bodyForPdf = $this->cleanBody($event->chapter->body);
        //$bodyForPdf = ($event->chapter->body);

        //dd($bodyForPdf);



        $bodyForPdf = '<div style="border: 1px dotted #d7d7d7 !important;">' . $bodyForPdf . '</div>';

//        dd($bodyForPdf);

        $this->pdf->setOption('encoding', 'UTF-8');

        $this->pdf->generateFromHtml($bodyForPdf, $this->uploadPath . $event->chapter->url, ['encoding' => 'UTF-8', 'images' => true, 'enable-external-links' => true], true);

        /*
         * save the body content in the DB
         * */

        $event->chapter->update(['body' => $this->cleanBodyForEditing($event->chapter->body)]);

        $event->chapter->save();

    }

    /**
     * @param $body
     * @return mixed
     * it removes all images dots with public folder of the server in order to create the PDF
     */
    public function cleanBody($body)
    {

        //$bodyContent = str_replace('../../../images/', public_path('images/'), $body);
        //$bodyContent = str_replace('../../images/', public_path('images/'), $bodyContent);
        $bodyContent = str_replace('/images', public_path('images'), $body);

        return $bodyContent;
    }


    /**
     * @param $body
     * @return mixed
     * * it removes all images dots with public folder of the server in order to show images within the edit form and store it in the DB
     */
    public function cleanBodyForEditing($body)
    {

        $bodyContent = str_replace('../../../images/', '/images/', $body);
        $bodyContent = str_replace('../../images/', '/images/', $bodyContent);

        return $bodyContent;
    }

}
