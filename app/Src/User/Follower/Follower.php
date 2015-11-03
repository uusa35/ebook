<?php

namespace App\Src\User\Follower;

use App\Core\AbstractModel;


class Follower extends AbstractModel
{
    protected  $table = 'user_followers';
    protected $fillable = ['user_id','follower_id'];


}
