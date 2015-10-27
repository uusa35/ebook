<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

abstract class Request extends FormRequest
{

    public function checkAccessForEachPermission($permission) {

        $role = Cache::get('role.'.Auth::id());

        $array = (Cache::get('Abilities.'.$role.'.'.Auth::id()));

        if (in_array($permission, $array, true)) {

            return true;
        }

        return false;
    }
}
