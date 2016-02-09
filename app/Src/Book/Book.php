<?php namespace App\Src\Book;

use App\Core\PrimaryModel;
use App\Core\LocaleTrait;
use Illuminate\Support\Facades\DB;

/**
 * App\Src\Book\Book
 *
 * @property-read \App\Src\User\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Src\User\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Src\User\User[] $users_reports
 * @property-read \App\Src\Book\BookMeta $meta
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Src\User\User[] $users_orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Src\Favorite\Favorite[] $favorites
 */
class Book extends PrimaryModel
{
    //
    use LocaleTrait;

    protected $guarded = ['id'];

    protected $localeStrings = [];

    /**
     * one to Many Relation
     * a user has many books
     * a book belongs to one user
     * get the author of the book
     * Table : Book
     */
    public function author()
    {
        return $this->belongsTo('App\Src\User\User', 'author_id');
    }

    /**
     * Many To Many Relation - Favorite Relation
     * a user has many  books
     * a book belongs to many users
     * ALL USERS THAT FAVORITE THIS BOOK
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Table : book_user : Favorite Relation
     */
    public function usersFavorites()
    {
        return $this->belongsToMany('App\Src\User\User', 'book_user');
    }

    public function user_favorites() {
        return $this->hasMany('App\Src\Favorite\Favorite');
    }

    public function usersLikes()
    {
        return $this->belongsToMany('App\Src\User\User', 'book_likes');
    }

    public function users_reports()
    {

        return $this->belongsToMany('App\Src\User\User', 'book_report');
    }

    public function meta()
    {
        return $this->hasOne('App\Src\Book\BookMeta');
    }

    public function chapters()
    {
        return $this->hasMany('App\Src\Book\Chapter\Chapter');
    }

    public function comments()
    {
        return $this->hasMany(\Config::get('CommentPack.model'));
    }

    /**
     * Many To Many Relation - Order Relation
     * a user has many books
     * a book belongs to many users
     * Table : purchases
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users_orders()
    {
        // this book belongs to many users where forign id is user_id and
        return $this->belongsToMany('App\Src\User\User', 'purchases');
    }

    public function favorites()
    {
        return $this->hasMany('App\Src\Favorite\Favorite', 'book_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Src\Like\Like', 'book_id');
    }

    public function mostFavorites($paginate = 8)
    {
        return $this
            ->selectRaw('books.*, count(*) as book_count')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))->from('chapters')
                      ->whereRaw('chapters.book_id = books.id')
                      ->where('chapters.status', '=', 'published');
            })
            ->with('meta', 'author', 'usersFavorites', 'chapters')
            ->join('book_user', 'books.id', '=', 'book_user.book_id')
            ->where('books.active', '1')
            ->groupBy('book_id')// responsible to get the sum of books returned
            ->orderBy('book_count', 'DESC')
            ->paginate($paginate);
    }

    /**
     * this function is responsible to fetch all books that has been favorited by a user to show in the control panel
     * @return mixed
     */
    public function FavoritedBooksListForUser() {
        return $this->selectRaw('books.*')
            ->join('book_user','book_user.book_id', '=', 'books.id')
            ->where('book_user.user_id',\Auth::id())
            ->orderBy('books.created_at')
            ->get();
    }


    public function mostLiked($paginate = 8)
    {
        return $this
            ->selectRaw('books.*, count(*) as book_count')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))->from('chapters')->whereRaw('chapters.book_id = books.id')->where('chapters.status', '=', 'published');
            })
            ->with('meta', 'author', 'usersFavorites', 'chapters')
            ->join('book_likes', 'books.id', '=', 'book_likes.book_id')
            ->where('books.active', '1')
            ->groupBy('book_id')// responsible to get the sum of books returned
            ->orderBy('book_count', 'DESC')
            ->paginate($paginate);
    }


}
