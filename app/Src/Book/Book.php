<?php namespace App\Src\Book;

use App\Core\AbstractModel;
use App\Core\LocaleTrait;

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
class Book extends AbstractModel
{
    //
    use LocaleTrait;

    protected $guarded = ['id'];

    protected $localeStrings = ['title', 'cover', 'description'];

    /**
     * one to Many Relation
     * a user has many books
     * a book belongs to one user
     * get the author of the book
     * Table : Book
     */
    public function user()
    {
        return $this->belongsTo('App\Src\User\User', 'user_id');
    }

    /**
     * Many To Many Relation - Favorite Relation
     * a user has many  books
     * a book belongs to many users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Table : book_user : Favorite Relation
     */
    public function users()
    {
        return $this->belongsToMany('App\Src\User\User', 'book_user');
    }

    public function users_reports() {

        return $this->belongsToMany('App\Src\User\User', 'book_report');
    }

    public function meta()
    {
        return $this->hasOne('App\Src\Book\BookMeta');
    }

    public function chapters() {
        return $this->hasMany('App\Src\Book\Chapter\Chapter');
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

    public function mostFavorites($paginate)
    {
        return $this
            ->selectRaw('books.*, count(*) as book_count')
            ->with('meta')
            ->join('book_user', 'books.id', '=', 'book_user.book_id')
            ->where('books.status','published')
            ->groupBy('book_id')// responsible to get the sum of books returned
            ->orderBy('book_count', 'DESC')
            ->paginate($paginate);
    }

    public function customizedPreviews($userId, $paginate = '10')
    {

        if (!$userId) {

            return $this
                ->selectRaw('books.*')
                ->with('meta')
                ->join('book_previews', 'books.id', '=', 'book_previews.book_id')
                ->orderBy('book_previews.created_at', 'DESC')
                ->paginate($paginate);
        }

        return $this
            ->selectRaw('books.*')
            ->with('meta')
            ->join('book_previews', 'books.id', '=', 'book_previews.book_id')
            ->where('book_previews.user_id', '=', $userId)
            ->orderBy('book_previews.created_at', 'DESC')
            ->paginate($paginate);
    }

}
