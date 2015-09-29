<?php

namespace App\Src\Book\Chapter;

use Illuminate\Database\Eloquent\Model;

class Preview extends Model
{
    protected $table = 'chapter_previews';

    protected $fillable = ['chapter_id','book_id','author_id','preview_start','preview_end','total_pages'];


    public function chapter()
    {
        return $this->belongsTo('App\Src\Book\Chapter\Chapter');
    }


    /*
     * the foriegn key within the table of the model itself
     * */
    public function users()
    {
        return $this->belongsToMany('App\Src\User\User','preview_user','preview_id','user_id');
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

}
