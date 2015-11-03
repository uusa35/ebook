<?php

namespace App\Src\Book;

use App\Core\AbstractModel;

class BookMeta extends AbstractModel
{
    //
    protected $table = 'book_metas';

    public $fillable = ['book_id', 'total_pages', 'price'];

}
