<?php

namespace App\Http\Controllers\Backend;

use App\Core\AbstractController;
use App\Jobs\CreateCustomizedPreview;
use App\Src\Book\Chapter\ChapterRepository;
use App\Src\Book\Chapter\Preview;
use App\Src\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests;

class PreviewsController extends AbstractController
{

    public $chapterRepository;
    public $userRepository;
    public $preview;

    public function __construct(ChapterRepository $chapterRepository, Preview $preview, UserRepository $userRepository)
    {

        $this->chapterRepository = $chapterRepository;
        $this->userRepository = $userRepository;
        $this->preview = $preview;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($chapterId)
    {
        $this->getPageTitle('preview.index');

        $previews = $this->preview->where(['chapter_id' => $chapterId])->with('chapter', 'book', 'users',
            'author')->get();


        return view('backend.modules.book.chapter.preview.index', compact('previews', 'chapterId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($chapterId)
    {
        $this->getPageTitle('preview.create');

        $chapter = $this->chapterRepository->model->where('id', $chapterId)->with('book')->first();
        /*
         * get all users without admin , editors and the author id of the book itself
         * */
        $authorId = $chapter->book->author_id;

        $total_pages = $chapter->total_pages;

        \Session::put('chapter_total_pages', $total_pages);

        $bookId = $chapter->book_id;

        $users = $this->userRepository->allUsersWithoutAdminsAndEditors($chapter->book->author_id);

        $usersList = $users->pluck('name', 'id');

        return view('backend.modules.book.chapter.preview._create_preview_form',
            compact('chapterId', 'authorId', 'total_pages', 'usersList', 'bookId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreatePreview $request)
    {
        $users = $request->get('usersList');

        $requestFiltered = $request->except(['_token', 'method', 'usersList']);

        $previewCreated = $this->preview->create($requestFiltered);

        if (!$previewCreated) {

            return redirect()->back()->with(['error' => trans('messages.error.error_preview_not_created')]);
        }

        foreach ($users as $userId) {

            $previewCreated->users()->attach($userId);
        }

        return redirect()->back()->with(['success' => 'success-preview-created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($chapterId, $preview_start, $preview_end)
    {
        $chapter = $this->chapterRepository->model->where(['id' => $chapterId])->first();

        if ($chapter) {

            $outPut = $this->dispatch(new CreateCustomizedPreview($chapter, $preview_start, $preview_end));

            $fileOutput = file_get_contents($outPut);

            return Response::make($fileOutput, 200, [

                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; ' . $chapter->url,

            ]);

        }

        return redirect()->back()->with(['error' => trans('word.no-file')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$previewDeleted = $this->preview->deleteNewCustomizedPreview($id);

        if ($previewDeleted) {

            return redirect()->back()->with(['success' => 'success-preview-deleted']);

        }

        return redirect()->back()->with(['error' => trans('word.error-preview-not-deleted')]);*/
    }

    public function removePreviewfromAuthorList($previewId)
    {

        $deletePreview = $this->preview->deleteNewCustomizedPreview($previewId);

        if ($deletePreview) {

            return redirect()->back()->with(['success' => 'messages.success.preview_deleted']);

        }

        return redirect()->back()->with(['error' => 'messages.error.preview_deleted']);

    }

    public function getPdf($chapterId, $preview_start, $preview_end)
    {
        $chapter = $this->chapterRepository->model->where(['id' => $chapterId])->first();

        if ($chapter) {

            $outPut = $this->dispatch(new CreateCustomizedPreview($chapter, $preview_start, $preview_end));

            $fileOutput = file_get_contents($outPut);

            return Response::make($fileOutput, 200, [

                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; ' . $chapter->url,

            ]);

        }

        return redirect()->back()->with(['error' => trans('word.no-file')]);
    }
}
