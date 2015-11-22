<?php

namespace App\Http\Controllers\Backend;

use App\Core\PrimaryController;
use App\Http\Requests;
use App\Http\Requests\CreateBook;
use App\Http\Requests\UpdateBook;
use App\Jobs\CreateBookCover;
use App\Src\Book\BookHelpers;
use App\Src\Book\BookRepository;
use App\Src\Book\Chapter\ChapterRepository;
use App\Src\Book\Chapter\Preview;
use App\Src\Category\Field\FieldCategory;
use App\Src\Category\Lang\LangCategory;
use App\Src\Favorite\FavoriteRepository;
use App\Src\Like\LikeRepository;
use App\Src\Purchase\PurchaseRepository;
use App\Src\Role\RoleRepository;
use App\Src\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


/**
 * Class AdminBookControllerU
 * @package App\Http\Controllers\Admin
 */
class BooksController extends PrimaryController
{

    protected $gate;
    protected $bookRepository;
    protected $userRepository;
    protected $roleRepository;
    protected $fieldCategory;
    protected $langCategory;
    protected $favoriteRepository;
    protected $chapterRepository;
    protected $likeRepository;
    protected $preview;
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
        ChapterRepository $chapterRepository,
        Preview $preview,
        LikeRepository $likeRepository
    )
    {

        //$this->middleware('EditorLimitAccess',['only'=>'edit','update']);
        //$this->middleware('AuthorLimitAccess',['except'=>'getActivationChangeStatus']);

        $this->bookRepository = $book;
        $this->fieldCategory = $fieldCategory;
        $this->langCategory = $langCategory;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->chapterRepository = $chapterRepository;
        $this->preview = $preview;
        $this->favoriteRepository = $favoriteRepository;
        $this->likeRepository = $likeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $this->getPageTitle('book.index');

        $this->authorize('index', Session::get('module'));

        if ($this->isAdmin() || $this->isEditor()) {

            $books = $this->bookRepository->model
                ->with('meta', 'author', 'chapters')
                ->orderBy('created_at', 'ASC')
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

            $booksPreviews = $this->preview->allPreviewsForUser();

            $booksFavorited = $this->bookRepository->getUserFavorites(Auth::id());

        }

        if ($books) {

            return view('backend.modules.book.index',
                compact('books', 'booksReported', 'booksFavorited', 'booksPreviews'));
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

        $this->authorize('create', 'book_create');


        $fieldsCategories = $this->fieldCategory->all();

        $langsCategories = $this->langCategory->limit(2);

        $getLang = App()->getLocale();

        $fieldsCategories = $fieldsCategories->lists('name_' . $getLang, 'id');

        $langsCategories = $langsCategories->lists('name_' . $getLang, 'id');

        return view('backend.modules.book.create',
            ['fieldsCategories' => $fieldsCategories, 'langsCategories' => $langsCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *  CreateBook Request Checks for the Rules of Create Book Form
     * @param CreateBook $request
     * @return Response
     */
    public function store(CreateBook $request)
    {

        $this->getPageTitle('book.create');
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

            return redirect()->action('Backend\ChaptersController@create', ['book_id' => $book->id])->with(['success' => trans('messages.success.created')]);
        }

        return redirect()->back()->with(['error' => trans('messages.error.created')]);
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

        $book = $this->bookRepository->model->where('id', '=', $id)->with(['meta', 'chapters'])->first();

        $this->authorize('change', $book->author_id);

        Session::put('book_id', $id);

        $allChapters = $book->chapters;

        $publishedChapters = $book->chapters->where('status', 'published');
        $draftedChapters = $book->chapters->where('status', 'drafted');
        $pendingChapters = $book->chapters->where('status', 'pending');
        $declinedChapters = $book->chapters->where('status', 'declined');


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
        $book = $this->bookRepository->model->where('id', '=', $id)->with('meta')->first();

        $this->authorize('edit', $book->author_id);

        $this->getPageTitle('book.edit');

        $fieldsCategories = $this->fieldCategory->all();

        $langsCategories = $this->langCategory->all();

        $getLang = App()->getLocale();

        $fieldsCategories = $fieldsCategories->lists('name_' . $getLang, 'id');

        $langsCategories = $langsCategories->lists('name_' . $getLang, 'id');


        return view('backend.modules.book.edit',
            ['book' => $book, 'fieldsCategories' => $fieldsCategories, 'langsCategories' => $langsCategories]);


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

        $this->authorize('edit', $book->author_id);

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
            return redirect()->action('Backend\BooksController@index')->with('success', trans('messages.success.edited'));
        }

        return redirect()->action('Backend\BooksController@index')->with('error', trans('messages.error.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $book = $this->bookRepository->model->findOrFail(['id' => $id]);

        $this->authorize('delete', $book->author_id);

        if ($book->delete()) {

            if ($book->meta()) {

                $book->meta()->delete();

            }

            return redirect()->back()->with('success', trans('messages.success.deleted'));

        }

        return redirect()->back()->with('error', trans('messages.error.deleted'));


    }


    public function getUpdateBookStatus($bookId, $status)
    {
        $book = $this->bookRepository->getById($bookId);

        $this->authorize('change', $book->author_id);

        $book->update([
            'status' => $status
        ]);


        if ($book) {

            return redirect()->back()->with(['success' => trans('messages.success.updated')]);
        }

        return redirect()->back()->with(['error' => 'messages.error.updated']);
    }

    public function removeReportAbuse($bookId)
    {

        $deletedReportAbuse = DB::table('book_report')->where(['book_id' => $bookId])->delete();

        if ($deletedReportAbuse) {

            return redirect()->back()->with(['success' => trans('messages.success.deleted')]);

        }
        return redirect()->back()->with(['error' => 'messages.error.deleted']);
    }


    public function getChangeActivationBook($bookId, $userId, $activeStatus)
    {

        /*
         * Admin and Editor can activate/deactivate a book
         * */
        if ($this->isAdmin() || $this->isEditor()) {

            $this->bookRepository->changeActivationBook($bookId, $userId, $activeStatus);

            return redirect()->back()->with(['success' => 'messages.success.activated']);

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
        $checkFavorite = $this->favoriteRepository->model->where(['user_id' => $userId, 'book_id' => $bookId])->first();

        if (is_null($checkFavorite)) {

            $favorited = $this->favoriteRepository->model->create([
                'book_id' => $bookId,
                'user_id' => $userId
            ]);

            if ($favorited) {
                return redirect()->back()->with(['success' => trans('messages.success.created')]);
            }

        }

        return redirect()->back()->with(['error' => trans('messages.error.created')]);
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

            return redirect()->back()->with(['success', trans('general.success.deleted')]);

        }

        return redirect()->back()->with(['error', trans('general.error.deleted')]);

    }


    /**
     * @param $userId
     * @param $bookId
     * create new favorite for a book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getCreateLikeBook($userId, $bookId)
    {

        $checkLike = $this->likeRepository->model->where(['user_id' => $userId, 'book_id' => $bookId])->first();

        if (is_null($checkLike)) {

            $liked = $this->likeRepository->model->create([
                'book_id' => $bookId,
                'user_id' => $userId
            ]);

            if ($liked) {

                return redirect()->back()->with(['success' => trans('messages.success.edited')]);

            }

        }

        return redirect()->back()->with(['error' => trans('messages.error.edited')]);
    }

    /**
     * add report abuse within the admin interfrace
     * @return string
     */
    public function getCreateNewReportAbuse($userId, $bookId)
    {

        $checkReportAbuse = DB::table('book_report')->where(['book_id' => $bookId, 'user_id' => $userId])->first();

        if (is_null($checkReportAbuse)) {

            $reportAbuse = DB::table('book_report')->insert([
                'book_id' => $bookId,
                'user_id' => $userId,
                'created_at' => Carbon::now(),
            ]);

            if ($reportAbuse) {

                return redirect()->action('Backend\MessagesController@create')->with([
                    'success' => trans('messages.success.edited'),
                    'book_id' => $bookId
                ]);
            }

        }

        return redirect()->back()->with(['error' => trans('messages.error.edited')]);
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

    return redirect()->back()->with(['error' => trans('messages.error.preview-not-created')]);


}


public function postCreateNewCustomizedPreview(Requests\CreateNewCustomizedPreviewRequest $request)
{

    $users = $request->input('usersList');

    foreach ($users as $userId) {

        $request->merge(['user_id' => $userId]);

        if (!$this->userRepository->CreateNewCustomizedPreview($request->all())) {

            return redirect()->back()->with(['error' => trans('messages.error.preview-not-created')]);
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

    return redirect()->back()->with(['error' => trans('messages.error.preview-not-deleted')]);
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

