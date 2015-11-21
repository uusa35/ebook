<?php

namespace App\Src\User\Follower;

use App\Core\PrimaryModel;
use App\Core\UserTrait;


class Follower extends PrimaryModel
{
    protected  $table = 'user_followers';
    protected $fillable = ['user_id','follower_id'];

    use UserTrait;

    /*
     * each follower is a user bring all data of each follower
     *
     * */
    public function user() {
        return $this->belongsTo('App\Src\User\User','follower_id');
    }



}
