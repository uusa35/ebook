<?php

namespace App\Http\Controllers\Backend;

use App\Core\AbstractController;
use App\Http\Requests;
use App\Http\Requests\CreateBook;
use App\Http\Requests\UpdateBook;
use App\Jobs\CreateBookCover;
use App\Jobs\CreateCustomizedPreview;
use App\Src\Book\BookHelpers;
use App\Src\Book\BookRepository;
use App\Src\Book\Chapter\ChapterRepository;
use App\Src\Category\Field\FieldCategory;
use App\Src\Category\Lang\LangCategory;
use App\Src\Favorite\FavoriteRepository;
use App\Src\Purchase\PurchaseRepository;
use App\Src\Role\RoleRepository;
use App\Src\User\UserRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


/**
 * Class AdminBookController
 * @package App\Http\Controllers\Admin
 */
class BooksController extends AbstractController
{

    public $gate;
    public $bookRepository;
    public $userRepository;
    public $roleRepository;
    public $fieldCategory;
    public $langCategory;
    public $favoriteRepository;
    public $chapterRepository;
    use BookHelpers;


    /**
     * @param BookRepository $book
     * @param fieldCategory $fieldCategory
     * @param PurchaseRepository $purchaseRepository
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(
        BookRepository $book,
        FieldCategory $fieldCategory,
        LangCategory $langCategory,
        FavoriteRepository $favoriteRepository,
        UserRepository $userRepository,
        RoleRepository $roleRepository,
        ChapterRepository $chapterRepository
    ) {

        //$this->middleware('EditorLimitAccess',['only'=>'edit','update']);
        //$this->middleware('AuthorLimitAccess',['except'=>'getActivationChangeStatus']);

        $this->bookRepository = $book;
        $this->fieldCategory = $fieldCategory;
        $this->langCategory = $langCategory;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->chapterRepository = $chapterRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $this->getPageTitle('book.index');

        if ($this->isAdmin() || $this->isEditor()) {

            $books = $this->bookRepository->model
                ->with('meta', 'author', 'chapters')
                ->orderBy('created_at', 'desc')
                ->get();

            $booksReported = $this->bookRepository->getReportsAbuse();

            $booksFavorited = $this->bookRepository->getMostFavorited(10);

        } elseif ($this->isAuthor()) {

            $books = $this->bookRepository->model
                ->where(['author_id' => Auth::id()])
                ->with('meta', 'author')
                ->orderBy('created_at', 'desc')
                ->get();

            $booksReported = [];

            $booksFavorited = $this->bookRepository->getUserFavorites(Auth::id());
        }

        if ($books) {

            return view('backend.modules.book.index',
                compact('books', 'booksReported', 'booksFavorited'));
        }

        return redirect()->back()->with(['error' => trans('messages.info.no_books_found')]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $this->getPageTitle('book.create');

        if (Gate::check('create')) {

            $fieldsCategories = $this->fieldCategory->all();

            $langsCategories = $this->langCategory->all();

            $getLang = App()->getLocale();

            $fieldsCategories = $fieldsCategories->lists('name_' . $getLang, 'id');

            $langsCategories = $langsCategories->lists('name_' . $getLang, 'id');

            return view('backend.modules.book.create',
                ['fieldsCategories' => $fieldsCategories, 'langsCategories' => $langsCategories]);
        }

        return redirect()->action('Backend\BooksController@index')->with(['error' => 'messages.error.book_create']);


    }

    /**
     * Store a newly created resource in storage.
     *  CreateBook Request Checks for the Rules of Create Book Form
     * @param CreateBook $request
     * @return Response
     */
    public function store(CreateBook $request)
    {

        // create a book record

        $book = $this->bookRepository->model->create($request->except('_token', 'cover'));

        if ($book) {

            $active = ($request->get('active')) ? 1 : 0;
            // create serial and update the book
            $serial = $this->createBookSerial($request->user()->id, $book->id);

            $book->meta()->create([
                'book_id' => $book->id,
                'total_chapters' => 0,
                'total_pages' => 0
            ]);

            $book->update(['serial' => $serial, 'active' => $active]);

            $book->save();

            // create a cover
            $this->CreateBookCover($request, $book);

            return redirect()->action('Backend\BooksController@index')->with(['success' => trans('word.messages.success.book_created')]);
        }

        return redirect()->back()->with(['error' => trans('word.messages.error.book_not_created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $this->getPageTitle('book.show');

        $book = $this->bookRepository->model->where('id', '=', $id)->with('meta')->first();

        \Session::put('book_id', $id);

        $allChapters = $this->chapterRepository->model->where(['book_id' => $id])->get();

        $publishedChapters = $this->chapterRepository->model->where(['book_id' => $id, 'status' => 'published'])->get();

        $pendingChapters = $this->chapterRepository->model->where(['book_id' => $id, 'status' => 'pending'])->get();

        $draftedChapters = $this->chapterRepository->model->where(['book_id' => $id, 'status' => 'drafted'])->get();

        $declinedChapters = $this->chapterRepository->model->where(['book_id' => $id, 'status' => 'declined'])->get();

        return view('backend.modules.book.show',
            compact('book', 'allChapters', 'publishedChapters', 'draftedChapters', 'pendingChapters',
                'declinedChapters'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $this->getPageTitle('book.edit');

        $fieldsCategories = $this->fieldCategory->all();

        $langsCategories = $this->langCategory->all();

        $getLang = App()->getLocale();

        $fieldsCategories = $fieldsCategories->lists('name_' . $getLang, 'id');

        $langsCategories = $langsCategories->lists('name_' . $getLang, 'id');

        $book = $this->bookRepository->model->where('id', '=', $id)->with('meta')->first();

        if (Gate::check('edit', $book->author_id)) {

            return view('backend.modules.book.edit',
                ['book' => $book, 'fieldsCategories' => $fieldsCategories, 'langsCategories' => $langsCategories]);
        }

        return redirect()->to('/')->with(['error' => 'messages.error.not_authenticated']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditBook $request
     * @return Response * check if new covers
     * check if new covers
     * get all data in the request
     * create new covers if added
     * create new pdf file
     * get the url of the new file and add to the request
     */
    public function update(UpdateBook $request, $id)
    {
        $book = $this->bookRepository->getById($id);

        if ($request->file('cover')) {

            $this->CreateBookCover($request, $book);

        }

        if (is_null($request->get('active'))) {

            $request->merge(['active' => 0]);
        } else {
            $request->merge(['active' => 1]);
        }

        $book->update($request->except(['cover']));

        if ($book) {
            return redirect()->action('Backend\BooksController@index')->with('success',
                trans('messages.success.book_edit'));
        }

        return redirect()->action('Backend\BooksController@index')->with('error', trans('messages.error.book_edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $book = $this->bookRepository->model->where(['id' => $id])->first();

        if (Gate::check('delete', $book->author_id)) {

            if ($book->delete()) {

                $book->meta()->delete();

                return redirect()->back()->with('success', trans('word.success-delete'));
            }

            return redirect()->back()->with('error', trans('word.error-delete'));
        }


    }


    public function getUpdateBookStatus($bookId, $status)
    {
        $book = $this->bookRepository->getById($bookId)->update([
            'status' => $status
        ]);

        if ($book) {

            return redirect()->back()->with(['success' => trans('word.success-status-updated')]);
        }

        return redirect()->back()->with(['error' => 'word.error-status-updated']);
    }

    public function removeReportAbuse($bookId)
    {

        $deletedReportAbuse = DB::table('book_report')->where(['book_id' => $bookId])->delete();

        if ($deletedReportAbuse) {

            return redirect()->back()->with(['success' => trans('word.success-report-removed')]);

        }
        return redirect()->back()->with(['error' => 'word.error-report-removed']);
    }


    public function getChangeActivationBook($bookId, $userId, $activeStatus)
    {

        /*
         * Admin and Editor can activate/deactivate a book
         * */
        if ($this->isAdmin() || $this->isEditor()) {

            $this->bookRepository->changeActivationBook($bookId, $userId, $activeStatus);

            return redirect()->back()->with(['success' => 'messages.success.book_activation']);

        }

        return redirect()->back()->with(['error' => 'messages.error.not_authorized']);

    }


    /**
     * @param $userId
     * @param $bookId
     * create new favorite for a book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getCreateNewFavoriteList($userId, $bookId)
    {

        $checkFavorite = $this->favoriteRepository->model->where(['book_id' => $bookId, 'user_id' => $userId])->first();

        if (is_null($checkFavorite)) {

            $favorited = $this->favoriteRepository->model->create([
                'book_id' => $bookId,
                'user_id' => $userId
            ]);

            if ($favorited) {
                return redirect()->back()->with(['success' => trans('word.success-book-favorites')]);
            }

        }

        return redirect()->back()->with(['error' => trans('word.error-book-favorites')]);
    }

    /**
     * @param $userId
     * @param $bookId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getRemoveBookFromUserFavoriteList($userId, $bookId)
    {


        $favoriteDelete = DB::table('book_user')->where(['user_id' => $userId, 'book_id' => $bookId])->delete();

        if ($favoriteDelete) {

            return redirect()->back()->with(['success', trans('general.success-favorite-remove')]);
            
        }

        return redirect()->back()->with(['error', trans('general.error-favorite-remove')]);

    }


}


/*
public function getAcceptOrder($buyerId, $bookId, $buyerEmail, $stage)
{

    if ($order = $this->purchaseRepository->model->where(['user_id' => $buyerId, 'book_id' => $bookId])->update([
        'stage' => $stage
    ])
    ) {
        // create an email to notify the buyer that his order stage has been changed
        // from us to buyeremail .. this book with the title bla bla has been accepted by adminstration ..
        // we will contact u soon on your mobile number plesae get ready for payment and fulfil your order.

        $book = $this->bookRepository->getById($bookId)->with('meta')->first();

        $buyerUserName = Auth::user()->name;

        $buyerMobile = Auth::user()->mobile;

        $this->NotifyChangeStageOrder([
            'stage' => $stage,
            'email' => $buyerEmail,
            'book' => $book,
            'username' => $buyerUserName,
            'mobile' => $buyerMobile
        ]);

        return redirect()->back()->with(['success' => trans('success.order')]);
    }

    return redirect()->back()->with(['error' => trans('error.order')]);
}


public function getDeleteOrder($buyerId, $bookId)
{
    if ($this->purchaseRepository->deleteOrder($buyerId, $bookId)) {

        return redirect()->back()->with(['success' => trans('success.delete-order')]);
    }
}


public function getCreateNewCustomizedPreview($bookId, $autherId, $total_pages)
{

    $isFree = $this->bookRepository->model->where('id', $bookId)->first()->free;

    if ($isFree != 1) {

        $users = $this->userRepository->getAllUsersWithoutAdmins($autherId);

        $usersList = $users->pluck('name_' . App::getlocale(), 'id');

        return view('backend.modules.book._create_preview_form',
            compact('bookId', 'autherId', 'total_pages', 'usersList'));
    }

    return redirect()->back()->with(['error' => trans('word.error-preview-not-created')]);


}


public function postCreateNewCustomizedPreview(Requests\CreateNewCustomizedPreviewRequest $request)
{

    $users = $request->input('usersList');

    foreach ($users as $userId) {

        $request->merge(['user_id' => $userId]);

        if (!$this->userRepository->CreateNewCustomizedPreview($request->all())) {

            return redirect()->back()->with(['error' => trans('word.error-preview-not-created')]);
        }
    }

    return redirect()->back()->with(['success' => 'success-preview-created']);
}

public function getDeleteNewCustomizedPreview($bookId, $authorId)
{
    $previewDeleted = $this->bookRepository->deleteNewCustomizedPreview($bookId, $authorId);

    if ($previewDeleted) {

        return redirect()->back()->with(['success' => 'success-preview-deleted']);

    }

    return redirect()->back()->with(['error' => trans('word.error-preview-not-deleted')]);
}

public function getShowNewCustomizedPreviewForAdmin($bookId, $authorId)
{

    $book = $this->bookRepository->ShowNewCustomizedPreviewForAdmin($bookId, $authorId);

    return $this->dispatch(new CreateCustomizedPreview($book));
}

public function getShowNewCustomizedPreviewForUsers($bookId, $authorId)
{

    $book = $this->bookRepository->ShowNewCustomizedPreviewForUsers($bookId, $authorId);

    return $this->dispatch(new CreateCustomizedPreview($book));
}*/

