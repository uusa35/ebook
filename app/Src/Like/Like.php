<?php

namespace App\Src\Like;

use App\Core\AbstractModel;


/**
 * App\Src\Favorite\Favorite
 *
 */
class Like extends AbstractModel
{
    //
    protected $table = "book_likes";

    protected $fillable = ['book_id', 'user_id'];


}
