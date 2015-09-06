<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/***************************************************************************************************
 * ▂ ▃ ▅ ▆ █ Frontend  █ ▆ ▅ ▃ ▂
 ***************************************************************************************************/

/***************************************************************************************************
 * Authentication
 ***************************************************************************************************/
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/',['as'=>'home','uses'=> 'HomeController@index']);
Route::get('/home',['uses'=> 'HomeController@index']);

/***************************************************************************************************
 * Localization
 ***************************************************************************************************/
Route::get('/lang/{lang}', ['uses' => 'LanguageController@changeLocale']);


Route::group(['prefix' => 'frontend'], function () {

    Route::get('/', function () {

        return view('frontend.modules.book.index');
    });

    /***************************************************************************************************
     * Index ( Main Page ) BookController
     ***************************************************************************************************/

});

/***************************************************************************************************
 * ▂ ▃ ▅ ▆ █ Backend  █ ▆ ▅ ▃ ▂
 ***************************************************************************************************/
/*
 * Active Middleware to check the user is active or not
 * CollectData Middleware to gather all information about the Authenticated user and all his permissions for the Backend
 * CollectData will create cache that will last for One Minute
 * */
Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'active','collectData']], function () {


    /***************************************************************************************************
     * Dashboard Module
     ***************************************************************************************************/
    Route::get('/', ['as'=>'backend','uses'=>'Backend\DashboardController@index']);
    Route::get('/home', ['as' => 'home', 'uses' => 'Backend\DashboardController@index']);
    Route::get('/dashbaord', 'Backend\DashboardController@index');


    // Middleware RolePermissionRouteAccess
    Route::group(['middleware' => 'access:Users'], function () {
        /***************************************************************************************************
         * User Module
         ***************************************************************************************************/
        Route::resource('users', 'Backend\UsersController');
        Route::post('users/active/{id}/{status}', 'Backend\UsersController@postChangeActiveStatus');

    });

    Route::group(['middleware' => 'access:Roles'], function () {
        /***************************************************************************************************
         * Role Module
         ***************************************************************************************************/
        Route::resource('roles', 'Backend\RolesController');
    });

    Route::group(['middleware' => 'access:Permissions'], function () {
        /***************************************************************************************************
         * Permission Module
         ***************************************************************************************************/
        Route::resource('permissions', 'Backend\PermissionsController');

    });

});


/***************************************************************************************************
 * ▂ ▃ ▅ ▆ █ API  █ ▆ ▅ ▃ ▂
 ***************************************************************************************************/

Route::group(['prefix' => 'api'], function () {
    Route::get('/', function () {
        return 'this is the api route';
    });
});
