<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 12/21/15
 * Time: 5:59 PM
 */

Route::group(['prefix' => 'ModulePack', 'namespace' => 'Usama\ModulePack'], function () {

    Route::get('/', ['uses' => 'Http\Controllers\ModuleController@index']);

});