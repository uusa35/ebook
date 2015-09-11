<?php

namespace App\Src\Contactus;

use App\Core\AbstractModel;
use Illuminate\Support\Facades\Cache;


/**
 * App\Src\Contactus\Contactus
 *
 */
class Contactus extends AbstractModel
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

