<?php

namespace App\Http\Controllers\Backend;

use App\Core\PrimaryController;
use App\Core\PrimaryEmailService;
use App\Events\ChapterStatusChanged;
use App\Events\CreateChapter;
use App\Jobs\CreateChapterPreview;
use App\Src\Book\BookRepository;
use App\Src\Book\Chapter\Chapter;
use App\Src\Book\Chapter\ChapterRepository;
use App\Src\User\Follower\Follower;
use App\Src\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class ChaptersController extends PrimaryController
{

    public $bookRepository;
    public $chapterRepository;
    public $userRepository;
    public $followers;

    use PrimaryEmailService;

    public function __construct(
        BookRepository $bookRepository,
        ChapterRepository $chapterRepository,
        UserRepository $userRepository,
        Follower $followers
    )
    {

        $this->bookRepository = $bookRepository;
        $this->chapterRepository = $chapterRepository;
        $this->userRepository = $userRepository;
        $this->followers = $followers;
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
        $this->getPageTitle('chapter.create');

        $bookId = Input::get('book_id');

        $this->authorize('create', 'chapter_create');

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
        $this->authorize('create', 'chapter_create');

        $chapter = $this->chapterRepository->model->create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'book_id' => $request->get('book_id'),
            'url' => rand(1, 9999) . str_random(10) . '.pdf'
        ]);

        if ($chapter) {

            event(new CreateChapter($chapter));

            return redirect()->action('Backend\BooksController@show',
                $request->get('book_id'))->with(['success' => 'messages.success.created']);
        }

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

        $chapter = $this->chapterRepository->model->with('book')->where(['id' => $id])->first();

        $this->authorize('edit', $chapter->book->author_id);

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

        $chapter = $this->chapterRepository->model->with('book')->where(['id' => $request->id])->first();

        $this->authorize('edit', $chapter->book->author_id);

        $request->merge([
            'url' => rand(1, 9999) . str_random(10) . '.pdf',
        ]);

        $chapter->update($request->except('_token', '_method'));

        if ($chapter) {

            event(new CreateChapter($chapter));

            return redirect()->action('Backend\BooksController@show',
                $request->book_id)->with(['success' => 'messages.success.updated']);
        }

    }


    /**
     * @param $bookUrl
     * @return full link of the free book
     */
    public function getPdfFile($chapterId, $chapterUrl)
    {

        $chapter = $this->chapterRepository->model->where(['url' => $chapterUrl, 'id' => $chapterId])->first();

        if ($chapter) {

            $this->dispatchAndShowPdf($chapter);

        }

        return redirect()->back()->with(['error' => trans('messages.error.error')]);
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

    /**
     * @param $chapterId
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getUpdateChapterStatus($chapterId, $status)
    {
        $chapter = $this->chapterRepository->getWhereId($chapterId);

        $chapterUpdated = $chapter->update([
            'status' => $status
        ]);

        $chapter = $chapter->with('book')->first();

        if ($chapterUpdated) {

            event(new ChapterStatusChanged($chapter, $status));

            return redirect()->back()->with(['success' => trans('messages.success.updated')]);
        }

        return redirect()->back()->with(['error' => 'messages.error.updated']);
    }

    /**
     * @param $bookId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeReportAbuse($bookId)
    {
        $deletedReportAbuse = DB::table('book_report')->where(['book_id' => $bookId])->delete();

        if ($deletedReportAbuse) {

            return redirect()->back()->with(['success' => trans('messages.success.deleted')]);

        }

        return redirect()->back()->with(['error' => 'messages.error.error']);


    }
}
