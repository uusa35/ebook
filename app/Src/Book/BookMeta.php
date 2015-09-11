<?php

namespace App\Src\Book;

use App\Core\AbstractModel;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Src\Book\BookMeta
 *
 */
class BookMeta extends AbstractModel
{
    //
    protected $table = 'book_metas';

    public $fillable = ['book_id', 'total_pages', 'price'];

}
