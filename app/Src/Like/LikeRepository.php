<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 6/6/15
 * Time: 10:37 PM
 */

namespace App\Src\Like;

use App\Core\AbstractRepository;


/**
 * App\Src\Favorite\FavoriteRepository
 *
 */
class LikeRepository extends AbstractRepository
{

    public function __construct(Like $like)
    {
        $this->model = $like;
    }

}