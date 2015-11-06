<?php

namespace App\Src\User\Follower;

use App\Core\AbstractModel;
use App\Core\UserTrait;


class Follower extends AbstractModel
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
