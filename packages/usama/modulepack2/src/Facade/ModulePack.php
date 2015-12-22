<?php namespace Usama\ModulePack\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 12/21/15
 * Time: 2:03 PM
 */
class ModulePack extends Facade
{


    protected static function getFacadeAccessor()
    {
        return 'ModulePack';
    }


}