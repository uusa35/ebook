<?php

namespace App\Src\Book\Chapter;

use App\Core\AbstractModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Preview extends AbstractModel
{
    protected $table = 'chapter_previews';

    protected $fillable = ['chapter_id', 'book_id', 'author_id', 'preview_start', 'preview_end', 'total_pages'];


    public function chapter()
    {
        return $this->belongsTo('App\Src\Book\Chapter\Chapter');
    }


    /*
     * the foriegn key within the table of the model itself
     * */
    public function users()
    {
        return $this->belongsToMany('App\Src\User\User', 'preview_user', 'preview_id', 'user_id');
    }

    public function allPreviewsForUser()
    {
        /*$query = $this->select('chapter_previews.*')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))->from('preview_user')->whereRaw('chapter_previews.id = preview_user.preview_id')->where('preview_user.user_id','=', Auth::id());
            })
            ->join('chapters','chapters.id','=','chapter_previews.chapter_id')
            ->join('books','books.id','=','chapter_previews.book_id')
            ->orWhere('preview_user.user_id','=',Auth::id())
            ->with(['book','author','chapter','users'])
            ->groupBy('chapter_previews.book_id')// responsible to get the sum of books returned
            ->orderBy('book_id', 'DESC')->get();*/
        return DB::table('preview_user')
            ->where('preview_user.user_id', '=', Auth::id())
            ->join('users', 'users.id', '=', 'preview_user.user_id')
            ->join('chapter_previews', 'chapter_previews.id', '=', 'preview_user.preview_id')
            ->join('chapters', 'chapters.id', '=', 'chapter_previews.chapter_id')
            ->join('books', 'books.id', '=', 'chapter_previews.book_id')
            ->get();

    }


    /*
     *
     * */
    public function author()
    {
        return $this->hasOne('App\Src\User\User', 'id', 'author_id');
    }

    public function book()
    {
        return $this->belongsTo('App\Src\Book\Book', 'book_id');
    }


    public function CreateNewCustomizedPreview($request)
    {

        $checkIfCreated = count(\DB::table('chapter_previews')->select('*')->where([
            'chapter_id' => $request['chapter_id'],
            'author_id' => $request['author_id'],
            'preview_start' => $request['preview_start'],
            'preview_end' => $request['preview_end'],
        ])->get());
        // if there is no such preview
        if ($checkIfCreated < 1) {
            // create new preview
            return \DB::table('chapter_previews')->insert([
                'chapter_id' => $request['chapter_id'],
                'book_id' => $request['book_id'],
                'author_id' => $request['author_id'],
                'preview_start' => $request['preview_start'],
                'preview_end' => $request['preview_end'],
                'total_pages' => $request['total_pages']
            ]);
        }

        return false;
    }

    public function deleteNewCustomizedPreview($previewId)
    {
        return DB::table('preview_user')->where(['user_id' => Auth::id(), 'preview_id' => $previewId])->delete();
    }

}
