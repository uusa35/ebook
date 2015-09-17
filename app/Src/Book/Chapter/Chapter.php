<?php

namespace App\Src\Book\Chapter;

use App\Core\AbstractModel;
use Illuminate\Database\Eloquent\Model;

class Chapter extends AbstractModel
{
    protected $guarded = ['id'];

    public function book()
    {
        return $this->belongsTo('App\Src\Book\Book');
    }
}
