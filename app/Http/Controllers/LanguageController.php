<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Session;


class LanguageController extends Controller
{

    public function changeLocale($lang)
    {
        Session::put('locale', $lang);

        return redirect()->back();
    }

}
