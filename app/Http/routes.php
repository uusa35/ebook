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
 * FACEBOOK Authentication
 ***************************************************************************************************/
Route::get('/auth/facebook', 'Auth\AuthController@redirectToFacebookProvider');
Route::get('/callback','Auth\AuthController@handleProviderFacebookCallback');
/***************************************************************************************************
 * GITHUB Authentication
 ***************************************************************************************************/
Route::get('auth/github', 'Auth\AuthController@redirectToGithubProvider');
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderGithubCallback');
/***************************************************************************************************
 * TWITTER Authentication
 ***************************************************************************************************/
Route::get('auth/twitter', 'Auth\AuthController@redirectToTwitterProvider');
Route::get('auth/twitter/callback', 'Auth\AuthController@handleProviderTwitterCallback');
/***************************************************************************************************
 * GOOGLE Authentication
 ***************************************************************************************************/
Route::get('auth/google', 'Auth\AuthController@redirectToGoogleProvider');
Route::get('auth/google/callback', 'Auth\AuthController@handleProviderGoogleCallback');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/', ['as' => 'home', 'uses' => 'BookController@index']);
Route::get('/home', ['uses' => 'BookController@index']);

/***************************************************************************************************
 * Localization
 ***************************************************************************************************/
Route::get('/lang/{lang}', ['uses' => 'LanguageController@changeLocale']);

/***************************************************************************************************
 * Search
 ***************************************************************************************************/
Route::post('search',['uses'=>'BookController@getShowSearchResults']);


Route::group(['prefix' => 'frontend'], function () {

    Route::get('/', ['uses'=>'BookController@index']);
    Route::get('books', ['uses'=>'BookController@getAllBooks']);
    Route::get('contactus', ['uses'=>'HomeController@getContactus']);
    Route::post('contactus','HomeController@sendContactUs');

    /***************************************************************************************************
     * Index ( Main Page ) BookController
     ***************************************************************************************************/


    /***************************************************************************************************
     * Index ( Main Page ) BookController
     ***************************************************************************************************/
    Route::resource('book', 'BookController');

    /***************************************************************************************************
     *                                          User
     *
     ***************************************************************************************************/
    Route::get('/conditions', ['uses' => 'HomeController@getConditions']);


    Route::group(['middleware' => 'auth'], function () {
        /***************************************************************************************************
         *                                          Favorite
         *
         ***************************************************************************************************/
        Route::get('/favorite/{user}/{book}', ['uses' => 'BookController@getCreateNewFavoriteList']);
        Route::get('/favorite/remove/{user}/{book}', ['uses' => 'BookController@getRemoveBookFromUserFavoriteList']);
        Route::get('/orders/remove/{user}/{book}', ['uses' => 'BookController@getRemoveBookFromUserOrderList']);

        /***************************************************************************************************
         *                                          Report
         *
         ***************************************************************************************************/
        Route::get('/report/{user}/{book}', ['uses' => 'BookController@getCreateNewReportAbuse']);

    });


});

/***************************************************************************************************
 * ▂ ▃ ▅ ▆ █ Backend  █ ▆ ▅ ▃ ▂
 ***************************************************************************************************/
/*
 * - Active Middleware :
 * to check the user is active or not
 * - CollectData Middleware :
 * to gather all information about the Authenticated user and all his permissions for the Backend
 * collectData will create cache that will last for One Minute
 * - ModuleAccess Middleware :
 * to check the Module.Users is within the array of cache .. if so it will go to the Users Module and so on
 * - PermissionAccess
 * ::: Roles :::
 * Admin Role : create + edit + delete
 * Editor Role : edit
 * Author : only books Module (create + edit)
 *
 * ::: Permissions ::: (the module itself)
 * Admin : Books Module + Users Module + Roles Module + Permissions Module ... and so on
 *
 * Editor : still Miss
 *
 * **** still one middleware is missing to check if the user has the right to edit his own books and other staff !!!!!
 *
 *
 * */
Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'active', 'collectData']], function () {

    /***************************************************************************************************
     * Dashboard Module
     ***************************************************************************************************/
    Route::get('/', ['as' => 'backend', 'uses' => 'Backend\DashboardController@index']);
    Route::get('/home', ['as' => 'home', 'uses' => 'Backend\DashboardController@index']);
    Route::get('/dashbaord', 'Backend\DashboardController@index');


    // Middleware RolePermissionRouteAccess
    Route::group(['middleware' => 'access'], function () {
        /***************************************************************************************************
         * User Module
         ***************************************************************************************************/
        Route::resource('users', 'Backend\UsersController');
        Route::post('users/active/{id}/{status}', 'Backend\UsersController@postChangeActiveStatus');
        /***************************************************************************************************
         * Role Module
         ***************************************************************************************************/
        Route::resource('roles', 'Backend\RolesController');
        /***************************************************************************************************
         * Permission Module
         ***************************************************************************************************/
        Route::resource('permissions', 'Backend\PermissionsController');
        /***************************************************************************************************
         * Books Module
         ***************************************************************************************************/
        Route::resource('books', 'Backend\BooksController');
        Route::resource('chapters', 'Backend\ChaptersController');
        Route::get('/activation/{bookId}/{userId}/{activeStatus}', 'Backend\BooksController@getChangeActivationBook');
        Route::get('/books/chapters/pdf/{chapterId}/{chapterUrl}',
            ['as' => 'backend.books.chapters.pdf.preview', 'uses' => 'Backend\ChaptersController@getPdfFile']);

        /*
        * Routes to create / post / delete Preview Book for Editor
        * */

//        Route::resource('previews','Backend\PreviewsController');

        Route::get('/book/chapters/pedf/preview/customized/{chapterId}', [

            'uses' => 'Backend\PreviewsController@index',
            'as' => 'backend.preview.index'
        ]);

        Route::get('/book/chapters/pdf/preview/customized/{chapterId}',
            [
                'uses' => 'Backend\PreviewsController@create',
                'as' => 'backend.preview.create'
            ]);

        Route::get('/book/chapters/pdf/preview/customized/{chapterId}/{preview_start}/{preview_end}',
            [
                'uses' => 'Backend\PreviewsController@show',
                'as' => 'backend.preview.show'
            ]);

        Route::post('/book/chapters/pdf/preview/customized',
            [
                'uses' => 'Backend\PreviewsController@store',
                'as' => 'backend.preview.store'
            ]);


        Route::get('/book/pdf/preview/delete/customized/{bookId}/{authorId}',
            [
                'uses' => 'Backend\ChaptersController@getDeleteNewCustomizedPreview'
            ]);


        /***************************************************************************************************
         * Comments Module
         ***************************************************************************************************/
        Route::resource('comments', 'Backend\CommentsController');
        /***************************************************************************************************
         *                                          Ads
         *
         ***************************************************************************************************/
        Route::resource('ads', 'Backend\AdsController');
        /***************************************************************************************************
         *                                          Categories
         *
         ***************************************************************************************************/


        Route::group(['prefix' => 'categories'], function () {

            Route::get('/', 'Backend\FieldCategoriesController@index');

            Route::resource('fields', 'Backend\FieldCategoriesController', ['except' => 'delete']);

            Route::resource('langs', 'Backend\LangCategoriesController', ['except' => 'delete']);
        });


        /***************************************************************************************************
         *                                          Messages
         *
         ***************************************************************************************************/
        Route::resource('messages', 'Backend\MessagesController');
        //Route::group(['prefix' => 'backend'], function () {
        /*Route::get('/', function () {
            return 'working';
        });*/
        // Route::get('/', ['as' => 'messages.index', 'uses' => 'Backend\MessagesController@index']);
        //Route::get('create', ['as' => 'messages.create', 'uses' => 'Backend\MessagesController@create']);
        //Route::get('{id}/read', ['as' => 'messages.read', 'uses' => 'Backend\MessagesController@read']);
        //Route::get('unread', ['as' => 'messages.unread', 'uses' => 'Backend\MessagesController@unread']);
        //Route::post('/', ['as' => 'messages.store', 'uses' => 'Backend\MessagesController@store']);
        //Route::get('{id}', ['as' => 'messages.show', 'uses' => 'Backend\MessagesController@show']);
        //Route::put('{id}', ['as' => 'messages.update', 'uses' => 'Backend\MessagesController@update']);
        //});

        /***************************************************************************************************
         * Contact Us
         ***************************************************************************************************/
        //Route::get('contactus',['as' => 'contactus.index','uses' => 'Backend\ContactUsController@edit']);
        Route::get('contactus', ['as' => 'backend.contactus.index', 'uses' => 'Backend\ContactUsController@edit']);
        Route::post('contactus', 'Backend\ContactUsController@update');
        Route::get('conditions', 'Backend\UsersController@getEditConditions');
        Route::post('conditions', 'Backend\UsersController@postEditConditions');

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
