<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 12/22/15
 * Time: 8:00 AM
 */

Route::group(['prefix' => 'comments', 'namespace' => 'Usama\CommentPack'], function () {

    Route::get('/', ['uses' => 'Http\Controllers\Frontend\CommentPackController@index']);

});