<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 12/21/15
 * Time: 2:02 PM
 */

namespace Usama\ModulePack;


use Illuminate\Support\Facades\Config;

class ModulePack
{

    public static function ModulePackTest () {
         trans('ModulePack::general.test');
        return view('ModulePack::test');
        return Config::get('ModulePack.test');
        return 'this modulepack test function';
    }

}