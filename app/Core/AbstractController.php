<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 8/31/15
 * Time: 10:40 AM
 */

namespace App\Core;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AbstractController extends Controller
{

    public $titles;


    public function getPageTitle($title)
    {
        return Session::put('title', $this->titles[$title]);
    }

}