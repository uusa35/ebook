<?php

namespace App\Jobs;

use App\Src\Book\Chapter\Chapter;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateCustomizedPreview extends Job implements SelfHandling
{
    public $fileName;
    public $pdfPreview;
    public $myTemplate;
    public $chapter;
    public $totalPageNumber;
    public $chapterTitle;
    public $previewStart;
    public $previewEnd;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Chapter $chapter,$previewStart,$previewEnd)
    {
        $this->chapter = $chapter;

        $this->fileName = storage_path('app/pdfs/') . $this->chapter->url;

        $this->pdfPreview = new \FPDI('portrait', 'pt', 'A4');

        $this->totalPageNumber = $this->pdfPreview->setSourceFile($this->fileName);

        $this->previewStart = $previewStart;

        $this->previewEnd = $previewEnd;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        for ($pageNumber = $this->previewStart; $pageNumber <= $this->previewEnd; $pageNumber++) {

            $this->createTemplate($pageNumber);
        }

        return $this->pdfPreview->Output();

    }


    public function CreateTemplate($pageNumber)
    {

        $templateId = $this->pdfPreview->importPage($pageNumber);

        $size = $this->pdfPreview->getTemplateSize($templateId);

        if ($size['w'] > $size['h']) {
            $this->pdfPreview->AddPage('L', array($size['w'], $size['h']));
        } else {
            $this->pdfPreview->AddPage('P', array($size['w'], $size['h']));
        }

        $this->pdfPreview->useTemplate($templateId, 25, 20, 538, 765, true);

        $this->makeHeader();

        $this->makeFooter($pageNumber);
    }

    public function makeHeader()
    {
        //logo
        $this->pdfPreview->Image(public_path('images/logo.png'), 5, 8, 35);
        // Arial bold 15
        $this->pdfPreview->SetFont('Arial', 'B', 12);
        // Move to the right

        $this->pdfPreview->Cell(10);
        // Title

        $this->pdfPreview->Cell(0, 5, ($this->chapter->title), 0, 1, 'C');
        // Line break
        //$this->pdfPreview->Ln(10);


    }

    public function makeFooter($pageNumber)
    {
        // Position at 1.5 cm from bottom
        $this->pdfPreview->SetY(-80);
        // Arial italic 8
        $this->pdfPreview->SetFont('Arial', 'I', 8);
        // Page number
        $this->pdfPreview->Cell(0, 0, 'Pages:' . $pageNumber . '/' . $this->totalPageNumber, 0, 0, 'C');
    }
}
