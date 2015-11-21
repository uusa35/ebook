<?php

namespace App\Src\Book;

use App\Core\PrimaryModel;

class BookMeta extends PrimaryModel
{
    //
    protected $table = 'book_metas';

    public $fillable = ['book_id', 'total_pages', 'price'];

}
