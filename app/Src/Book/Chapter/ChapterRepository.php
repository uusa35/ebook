<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 9/10/15
 * Time: 6:24 PM
 */

namespace App\Src\Book\Chapter;


use App\Core\AbstractRepository;

class ChapterRepository extends AbstractRepository
{

    public function __construct(Chapter $chapter)
    {
        $this->model = $chapter;
    }

}