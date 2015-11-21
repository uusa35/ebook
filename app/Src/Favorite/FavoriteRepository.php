<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 6/6/15
 * Time: 10:37 PM
 */

namespace App\Src\Favorite;

use App\Core\PrimaryRepository;


/**
 * App\Src\Favorite\FavoriteRepository
 *
 */
class FavoriteRepository extends PrimaryRepository
{

    public function __construct(Favorite $favorite)
    {
        $this->model = $favorite;
    }

}