<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 9/10/15
 * Time: 6:24 PM
 */

namespace App\Src\Book\Chapter;


use App\Core\PrimaryRepository;

class ChapterRepository extends PrimaryRepository
{

    public function __construct(Chapter $chapter)
    {
        $this->model = $chapter;
    }


    public function totalPagesForChapter($bookId) {

        return $this->model->where(['book_id' => $bookId,'status' => 'published'])->sum('total_pages');

    }


}