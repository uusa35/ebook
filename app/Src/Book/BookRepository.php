<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 5/31/15
 * Time: 9:14 PM
 */
namespace App\Src\Book;


use App\Core\AbstractRepository;
use App\Src\Book\Chapter\ChapterRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


/**
 * App\Src\Book\BookRepository
 *
 */
class BookRepository extends AbstractRepository
{
    public $chapterRepository;

    use BookHelpers;

    public function __construct(Book $book, ChapterRepository $chapterRepository)
    {
        $this->model = $book;
        $this->chapterRepository = $chapterRepository;
    }


    /**
     * get the recentest books for the index
     * @return mixed
     */
    public function getRecentBooks()
    {
        return $this->model->with('users', 'meta')
            ->where('active', '=', '1')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))->from('chapters')->whereRaw('chapters.book_id = books.id')->where('chapters.status',
                    '=', 'published');
            })
            ->orderBy('books.created_at', 'desc')
            ->limit(4)
            ->get();
    }

    public function getAllBooks()
    {
        return $this->model->with('users', 'meta')
            ->where('active', '=', '1')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))->from('chapters')->whereRaw('chapters.book_id = books.id')->where('chapters.status',
                    '=', 'published');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    }


    public function getAllBooksForCategory($categoryId)
    {
        return $this->model->with('users', 'meta')
            ->where(['active' => '1', 'field_category_id' => $categoryId])
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))->from('chapters')->whereRaw('chapters.book_id = books.id')->where('chapters.status',
                    '=', 'published');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    }

    /**
     * One To Many Relation
     * a user has many  books
     * a book belongs to one user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getAuthor()
    {
        return $this->model->author();
    }

    /**
     * @return mixed
     * return All books that has a Draft Status
     */
    public function draftedBooks($id = '')
    {
        return $this->model->where(['status' => 'draft', 'user_id' => $id]);
    }

    /**
     * @return mixed
     * return All books that has a Published Status
     */
    public function publishedBooks()
    {
        return $this->model->where('status', 'published');
    }

    public function increaseBookViewById($bookId)
    {
        $this->model->where('id', '=', $bookId)->increment('views');

    }

    public function increaseBookViewByUrl($bookUrl)
    {

        $this->model->where('url', '=', $bookUrl)->increment('views');

    }

    public function SearchBooks($searchItem)
    {
        return $this->model
            // no results for drafts -- only for published
            ->orWhere('description', 'like', '%' . $searchItem . '%')
            ->orWhere('serial', 'like', '%' . $searchItem . '%')
            ->orWhere('title', 'like', '%' . $searchItem . '%')
            ->with('meta')
            ->with([
                'chapters' => function ($query) use ($searchItem) {
                    $query->orWhere('title', 'like', '%' . $searchItem . '%');
                    $query->orWhere('body', 'like', '%' . $searchItem . '%');
                }
            ])
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))->from('chapters')->whereRaw('chapters.book_id = books.id')->where('chapters.status',
                    '=', 'published');
            })
            ->where('active', '=', '1')
            ->paginate(10);
    }


    /**
     * Admin Zone
     * @return return all books that has been ordered
     */
    public function getAllBookOrders()
    {
        return $this->model->users_orders()->with('meta')->get();
    }

    /**
     *
     * @param int $paginate
     * @return most favorite books from all users
     */
    public function getMostFavorited($paginate = 4)
    {
        $favorites = $this->model->mostFavorites($paginate);
        return $favorites;
    }

    public function getCustomizedPreviews($userId = '', $paginate = '10')
    {

        return $this->model->customizedPreviews($userId, $paginate);

    }

    public function ShowNewCustomizedPreviewForAdmin($bookId, $authorId)
    {

        return $this->model
            ->selectRaw('books.*')
            ->selectRaw('book_previews.*')
            ->join('book_previews', 'book_previews.book_id', '=', 'books.id')
            ->where('book_previews.author_id', '=', $authorId)
            ->where('books.id', $bookId)
            ->where('books.user_id', $authorId)
            ->first();

    }

    public function ShowNewCustomizedPreviewForUsers($bookId, $authorId)
    {

        return $this->model
            ->selectRaw('books.*')
            ->selectRaw('book_previews.*')
            ->join('book_previews', 'book_previews.book_id', '=', 'books.id')
            ->where('book_previews.author_id', '=', $authorId)
            ->where('books.id', $bookId)
            ->where('books.user_id', $authorId)
            ->where('book_previews.user_id', Session::get('auth.id'))
            ->first();

    }

    public function deleteNewCustomizedPreview($bookId, $authorId)
    {

        return DB::table('book_previews')->where(['book_id' => $bookId, 'author_id' => $authorId])->delete();

    }

    public function getReportsAbuse($paginate = 10)
    {

        /*return DB::table('book_report')

            ->join('books','books.id','=','book_report.book_id')
            ->select('books.*')
            ->join('users','users.id','=','book_report.id')
            ->select('users.*','books.*')
            ->groupBy('book_id')// responsible to get the sum of books returned
            ->orderBy('book_report.created_at', 'DESC')
            ->paginate($paginate);*/

        return $this->model
            ->selectRaw('books.*')
            ->selectRaw('book_report.*')
            ->selectRaw('users.*')
            ->join('book_report', 'book_report.book_id', '=', 'books.id')
            ->leftjoin('users', 'book_report.user_id', '=', 'users.id')
            ->orderBy('book_report.created_at', 'DESC')
            ->with('author')
            ->paginate($paginate);

    }

    public function changeActivationBook($bookId, $userId, $activeStatus)
    {

        $book = $this->model->where(['id' => $bookId, 'author_id' => $userId])->first();

        $activeStatus = ($activeStatus === '1') ? 0 : 1;

        $book->update(['active' => $activeStatus]);

        $book->save();

    }


}