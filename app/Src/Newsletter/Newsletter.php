<?php

namespace App\Src\Newsletter;

use App\Core\AbstractModel;


class Newsletter extends AbstractModel
{

    protected $table = 'newsletter';

    protected $fillable = ['name', 'email'];


}