<?php

namespace App\Src\Like;

use App\Core\PrimaryModel;


/**
 * App\Src\Favorite\Favorite
 *
 */
class Like extends PrimaryModel
{
    //
    protected $table = "book_likes";

    protected $fillable = ['book_id', 'user_id'];


}
