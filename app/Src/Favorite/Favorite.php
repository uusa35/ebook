<?php

namespace App\Src\Favorite;

use App\Core\AbstractModel;


/**
 * App\Src\Favorite\Favorite
 *
 */
class Favorite extends AbstractModel
{
    //
    protected $table = "book_user";

    protected $fillable = ['book_id', 'user_id'];

    public $timestamps = false;

}
