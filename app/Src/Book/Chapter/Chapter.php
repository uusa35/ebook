<?php

namespace App\Src\Book\Chapter;

use App\Core\PrimaryModel;

class Chapter extends PrimaryModel
{
    protected $guarded = ['id'];

    public function book()
    {
        return $this->belongsTo('App\Src\Book\Book');
    }


    public function  previews()
    {
        return $this->hasMany('App\Src\Book\Chapter\Preview');
    }

    /*
     * customizedPreviews for a chapter
     * */


    public function customizedPreviews($userId, $paginate = '10')
    {

        if (!$userId) {

            return $this
                ->selectRaw('books.*')
                ->with('meta')
                ->join('book_previews', 'books.id', '=', 'book_previews.book_id')
                ->orderBy('book_previews.created_at', 'DESC')
                ->paginate($paginate);
        }

        return $this
            ->selectRaw('chapters.*')
            ->with('meta')
            ->join('chapter_previews', 'chapter.id', '=', 'chapter_previews.book_id')
            ->where('chapter_previews.user_id', '=', $userId)
            ->orderBy('chapter_previews.created_at', 'DESC')
            ->paginate($paginate);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }


}
