<?php

namespace App\Src\Contactus;

use App\Core\PrimaryModel;
use Illuminate\Support\Facades\Cache;


/**
 * App\Src\Contactus\Contactus
 *
 */
class Contactus extends PrimaryModel
{
    //
    protected $table = 'contactus';

    function getContactInfo()
    {

        $contactInfo = Cache::remember('contactusInfo', 20, function () {

            return $this->first();
        });

        return $contactInfo;
    }
}

