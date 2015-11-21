<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 6/6/15
 * Time: 10:37 PM
 */

namespace App\Src\Like;

use App\Core\PrimaryRepository;


/**
 * App\Src\Favorite\FavoriteRepository
 *
 */
class LikeRepository extends PrimaryRepository
{

    public function __construct(Like $like)
    {
        $this->model = $like;
    }

}