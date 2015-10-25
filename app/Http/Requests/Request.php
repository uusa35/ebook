<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{

    public function checkAccessForEachPermission($permission) {

        $role = \Cache::get('role');

        $array = (\Cache::get('Abilities.'.$role));

        if (in_array($permission, $array, true)) {

            return true;
        }

        return false;
    }
}
