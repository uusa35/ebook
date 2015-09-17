<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Src\Book\Book;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateCustomizedPreview extends Job implements SelfHandling
{
    public $book;

    /**
     * Create a new job instance.
     *
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;

        $this->fileName = storage_path('app/pdfs/') . $book->url;

        $this->pdfPreview = new \FPDI();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /*
        * Steps to split a pdf
        * */

        $this->pdfPreview->setSourceFile($this->fileName);

        // check the total pages of each book

        // if preview is in free mode then
        /*
         * free books
         * */
        for ($i = $this->book->preview_start; $i <= $this->book->preview_end; $i++) {

            $this->pdfPreview->AddPage();

            $this->pdfPreview->useTemplate($this->pdfPreview->importPage($i));

        }

        return $this->pdfPreview->Output();
    }
}
