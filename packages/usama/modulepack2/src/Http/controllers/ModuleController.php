<?php namespace Usama\ModulePack\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 12/21/15
 * Time: 6:00 PM
 */
class ModuleController extends Controller
{

    public function index() {
        return view('ModulePack::test');
    }
}