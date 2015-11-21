<?php namespace App\Http\Controllers;

use App\Core\PrimaryController;
use App\Http\Requests;
use App\Src\Book\BookRepository;
use App\Src\Book\Chapter\ChapterRepository;
use App\Src\Favorite\FavoriteRepository;
use App\Src\Like\LikeRepository;
use App\Src\Purchase\PurchaseRepository;
use App\Src\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BookController extends PrimaryController
{


    protected $bookRepository;
    protected $favoriteRepository;
    protected $userRepository;
    protected $purchaseRepository;
    protected $chapterRepository;
    protected $likeRepository;
    protected $authUser;

    public function __construct(
        BookRepository $bookRepository,
        FavoriteRepository $favoriteRepository,
        UserRepository $userRepository,
        PurchaseRepository $purchaseRepository,

        ChapterRepository $chapterRepository,
        LikeRepository $likeRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->favoriteRepository = $favoriteRepository;
        $this->userRepository = $userRepository;
        $this->chapterRepository = $chapterRepository;
        $this->purchaseRepository = $purchaseRepository;
        $this->likeRepository = $likeRepository;
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

        $recentBooks = $this->bookRepository->getRecentBooks();


        // get 4 published and most favorite books for index
        $mostFavoriteBooks = $this->bookRepository->getMostFavorited(4);

        //dd($userFavorites);

        $mostLikedBooks = $this->bookRepository->getMostLiked(4);

        return view('frontend.modules.book.index', compact('recentBooks', 'mostFavoriteBooks', 'mostLikedBooks'));
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

        $book = $this->bookRepository->model->where(['id' => $id])->with('author', 'author.following')->first();

        //$followers = $book->author->following;

        //$followersList = $followers->Lists('id', 'user_id')->toArray();

        $blockedUsersofAuthor = $book->author->blocked->Lists('blocked_id','blocked_id')->toArray();

        if (!is_null($book)) {

            $book->update([
                'views' => $book->views + 1
            ]);

            $total_pages = $this->chapterRepository->totalPagesForChapter($book->id);

            return view('frontend.modules.book.show', compact('book', 'total_pages','blockedUsersofAuthor'));

        }

        /*redirec if the book is not published with a not published message*/
        return redirect('/')->with(['error' => 'messages.error.book_not_active']);

    }

    /**
     * @param Request $request
     * @return search function responsible to search all books title , descriptions and even content of each book
     */
    public function getShowSearchResults(Requests\searchRequest $request)
    {

        $searchedItem = trim($request->get('search'));



        if ($searchedItem) {

            $searchResults = $this->bookRepository->SearchBooks($searchedItem);

            if (!is_null($searchResults)) {

                return view('frontend.modules.book.all', ['allBooks' => $searchResults]);

            } else {

                return redirect()->back()->with(['error' => trans('word.no-results')]);

            }
        }

        return redirect()->to('/')->with(['error' => trans('word.no-results')]);


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
