<?php

namespace App\Src\Newsletter;

use App\Core\PrimaryModel;


class Newsletter extends PrimaryModel
{

    protected $table = 'newsletter';

    protected $fillable = ['name', 'email'];


}