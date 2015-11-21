<?php

namespace App\Src\User\Blocked;

use App\Core\PrimaryModel;
use App\Core\UserTrait;

class Blocked extends PrimaryModel
{
    protected $table = 'user_blocks';
    protected $fillable = ['user_id','blocked_id'];

    use UserTrait;

    /*
     * each follower is a user bring all data of each follower
     *
     * */
    public function user() {
        return $this->belongsTo('App\Src\User\User','user_id');
    }
}
