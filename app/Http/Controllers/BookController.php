<?php namespace App\Http\Controllers;

use App\Core\AbstractController;
use App\Http\Requests;
use App\Jobs\CreateBookPreview;
use App\Jobs\CreateChapterPreview;
use App\Src\Advertisement\Advertisement;
use App\Src\Book\BookRepository;
use App\Src\Book\Chapter\ChapterRepository;
use App\Src\Favorite\FavoriteRepository;
use App\Src\Purchase\PurchaseRepository;
use App\Src\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class BookController extends AbstractController
{


    public $bookRepository;
    public $favoriteRepository;
    public $userRepository;
    public $purchaseRepository;
    public $chapterRepository;
    public $ad;
    public $authUser;
    public $book;

    public function __construct(
        BookRepository $book,
        FavoriteRepository $favoriteRepository,
        UserRepository $userRepository,
        PurchaseRepository $purchaseRepository,
        Advertisement $ad,
        ChapterRepository $chapterRepository
    ) {
        $this->bookRepository = $book;
        $this->favoriteRepository = $favoriteRepository;
        $this->userRepository = $userRepository;
        $this->chapterRepository = $chapterRepository;
        $this->purchaseRepository = $purchaseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $paginate = 4;
        // get 4 published books for index

        /*$recentBooks = $this->bookRepository->model->with('users','meta')
            ->where('active', '=', '1')
            ->join('chapters','chapters.book_id','=','books.id')
            ->orderBy('books.created_at', 'desc')
            ->limit(4)
            ->get();*/

        $recentBooks = $this->bookRepository->getRecentBooks();

        // get 4 published and most favorite books for index
        $mostFavoriteBooks = $this->bookRepository->getMostFavorited(4);


        return view('frontend.modules.book.index', compact('recentBooks', 'mostFavoriteBooks'));
    }

    public function getAllBooks()
    {
        // get 4 published books for index
        $allBooks = $this->bookRepository->getAllBooks();


        return view('frontend.modules.book.all', compact('allBooks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        // get all books by book ID
        $book = $this->bookRepository->model
            ->with(['author', 'meta', 'users'])
            ->with([
                'chapters' => function ($query) {
                    $query->where('chapters.status', '=', 'published');
                }
            ])
            ->find($id);

        $book->update([
            'views' => $book->views + 1
        ]);

        $users = $this->userRepository->model->where('id', '=', '1')->get();

        $usersList = $users->lists('name', 'id');

        $total_pages = $this->chapterRepository->totalPagesForChapter($book->id);

        /*redirec if the book is not published with a not published message*/

        if ($book->active != '1') {

            return redirect('/')->with(['error' => 'messages.error.book_not_active']);
        }

        return view('frontend.modules.book.show', compact('book', 'total_pages', 'usersList'));
    }

    /**
     * @param Request $request
     * @return search function responsible to search all books title , descriptions and even content of each book
     */
    public function getShowSearchResults(Request $request)
    {

        $searchResults = $this->bookRepository->SearchBooks($request->input('search'));

        if (count($searchResults) > 0) {

            return view('frontend.modules.book.all', ['allBooks' => $searchResults]);

        } else {

            return redirect()->back()->with(['error' => trans('word.no-results')]);

        }
    }

    /**
     * @param $bookUrl
     * @return full link of the free book
     */
    /*public function getFreePdfFile($bookId, $bookUrl)
    {

        $book = $this->bookRepository->model->where(['url' => $bookUrl, 'id' => $bookId])->first();

        if ($book) {

            // every request on preview .. View will be increased
            $this->bookRepository->increaseBookViewById($book->id);

            //$link = storage_path('app/pdfs/') . $bookUrl;

            $this->dispatchAndShowPreviews($bookUrl, $book->title_en, $book->title_ar, $book->free);

        }

        return redirect()->back()->with(['error' => trans('word.no-file')]);
    }*/


    /**
     * @param $bookUrl
     * @return creating on the fly a link with 10 pages of a pdf file of a book
     */
   /* public function getFirstTenPagesForPaidBooks($bookId, $bookUrl)
    {
        $book = $this->bookRepository->model->where(['url' => $bookUrl, 'id' => $bookId])->first();

        // every request on preview .. View will be increaseds
        $this->bookRepository->increaseBookViewByUrl($bookUrl);

        $this->dispatchAndShowPreviews($bookUrl, $book->title_en, $book->title_ar, $book->free);

    }*/


    /**
     * @param $bookId
     * @param $authId
     * @return \Illuminate\Http\RedirectResponse
     */
   /* public function getCreateNewOrder($bookId, $authId)
    {

        if ($this->purchaseRepository->checkOrderExists($bookId, $authId)) {

            return redirect()->back()->with(['error' => trans('word.error-order-repeated')]);
        }

        if ($this->purchaseRepository->createNewOrder($bookId, $authId)) {

            return redirect()->back()->with(['success' => trans('word.success-order-created')]);

        }

        return redirect()->back()->with(['error' => trans('word.error-order-created')]);

    }*/

    /**
     * Dispatch Job for createBookPreview + returning the response of the output to create PDF Preview for free and 10 pages of the paid
     * @param $bookUrl
     * @param $title_en
     * @param $title_ar
     * @param $free
     * @return mixed
     */
    /*function dispatchAndShowPreviews($bookUrl, $title_en, $title_ar, $free)
    {

        $outPut = $this->dispatch(new CreateChapterPreview($bookUrl, $title_en, $title_ar, $free));

        $fileOutput = file_get_contents($outPut);

        return Response::make($fileOutput, 200, [

            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; ' . $bookUrl,

        ]);
    }*/


}
