<?php

namespace App\Http\Controllers\Backend;

use App\Events\CreateChapter;
use App\Jobs\CreateChapterPreview;
use App\Src\Book\BookRepository;
use App\Src\Book\Chapter\Chapter;
use App\Src\Book\Chapter\ChapterRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChaptersController extends Controller
{

    public $bookRepository;
    public $chapterRepository;

    public function __construct(BookRepository $bookRepository, ChapterRepository $chapterRepository)
    {

        $this->bookRepository = $bookRepository;
        $this->chapterRepository = $chapterRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $bookId = \Request::get('book_id');

        return view('backend.modules.book.chapter.create', compact('bookId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Requests\CreateChapter $request)
    {

        $chapter = $this->chapterRepository->model->create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'book_id' => $request->get('book_id'),
            'url' => rand(1, 9999) . str_random(10) . '.pdf'
        ]);

        if ($chapter) {

            event(new CreateChapter($chapter));

            return redirect()->action('Backend\BooksController@show',
                $request->get('book_id'))->with(['success' => 'messages.success.chapter_create']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $bookId = \Request::get('book_id');

        $chapter = $this->chapterRepository->model->where(['id' => $id])->first();

        if ($chapter) {

            return view('backend.modules.book.chapter.edit', compact('chapter'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Requests\UpdateChapter $request, $id)
    {

        $chapter = $this->chapterRepository->model->where(['id' => $request->id])->first();

        $request->merge([
            'url' => rand(1, 9999) . str_random(10) . '.pdf',
        ]);

        $chapter->update($request->except('_token', '_method'));

        if ($chapter) {

            event(new CreateChapter($chapter));

            return redirect()->action('Backend\BooksController@show',
                $request->book_id)->with(['success' => 'messages.success.chapter_update']);
        }
        dd($chapter);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * @param $bookUrl
     * @return full link of the free book
     */
    public function getPdfFile($chapterId, $chapterUrl)
    {

        $chapter = $this->chapterRepository->model->where(['url' => $chapterUrl, 'id' => $chapterId])->first();

        if ($chapter) {

            // every request on preview .. View will be increased
//            $this->chapterRepository->increaseBookViewById($chapter->id);

            //$link = storage_path('app/pdfs/') . $bookUrl;

            $this->dispatchAndShowPdf($chapter);

        }

        return redirect()->back()->with(['error' => trans('word.no-file')]);
    }

    /**
     * Dispatch Job for createBookPreview + returning the response of the output to create PDF Preview for free and 10 pages of the paid
     * @param $bookUrl
     * @param $title_en
     * @param $title_ar
     * @param $free
     * @return mixed
     */
    function dispatchAndShowPdf(Chapter $chapter)
    {

        $outPut = $this->dispatch(new CreateChapterPreview($chapter));

        $fileOutput = file_get_contents($outPut);

        return Response::make($fileOutput, 200, [

            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; ' . $chapter->url,

        ]);
    }
}
