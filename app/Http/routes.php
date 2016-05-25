<?php

/***************************************************************************************************
 * ▂ ▃ ▅ ▆ █ Frontend  █ ▆ ▅ ▃ ▂
 ***************************************************************************************************/

/***************************************************************************************************
 * FACEBOOK Authentication
 ***************************************************************************************************/
Route::get('/auth/facebook', 'Auth\AuthController@redirectToFacebookProvider');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderFacebookCallback');
/***************************************************************************************************
 * GITHUB Authentication
 ***************************************************************************************************/
Route::get('auth/github', 'Auth\AuthController@redirectToGithubProvider');
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderGithubCallback');
/***************************************************************************************************
 * TWITTER Authentication
 ***************************************************************************************************/
/*Route::get('auth/twitter', 'Auth\AuthController@redirectToTwitterProvider');
Route::get('auth/twitter/callback', 'Auth\AuthController@handleProviderTwitterCallback');*/
/***************************************************************************************************
 * GOOGLE Authentication
 ***************************************************************************************************/
Route::get('auth/google', 'Auth\AuthController@redirectToGoogleProvider');
Route::get('auth/google/callback', 'Auth\AuthController@handleProviderGoogleCallback');

/***************************************************************************************************
 * Default Authentication
 ***************************************************************************************************/

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


get('register/confirm/{token}', 'RegistrationController@confirmEmail');

Route::get('/', ['as' => 'home', 'uses' => 'BookController@index']);
Route::get('/home', ['uses' => 'BookController@index']);

/***************************************************************************************************
 * Localization
 ***************************************************************************************************/
Route::get('/lang/{lang}', ['uses' => 'LanguageController@changeLocale']);

/***************************************************************************************************
 * newsletter
 ***************************************************************************************************/
Route::post('newsletter',['uses' => 'HomeController@postNewsLetter']);

/***************************************************************************************************
 * Search
 ***************************************************************************************************/
Route::post('search', ['uses' => 'BookController@getShowSearchResults']);
/***************************************************************************************************
 * Chapters to be available without registeration
 ***************************************************************************************************/
Route::get('/books/chapters/pdf/{chapterId}/{chapterUrl}', [
    'as' => 'backend.books.chapters.pdf.preview',
    'uses' => 'Backend\ChaptersController@getPdfFile'
]);



Route::group(['prefix' => 'frontend'], function () {


    Route::get('contactus', ['uses' => 'HomeController@getContactus']);
    Route::post('contactus', 'HomeController@sendContactUs');

    /***************************************************************************************************
     * Index ( Main Page ) BookController
     ***************************************************************************************************/
    Route::get('/', ['uses' => 'BookController@index']);
    Route::get('books', ['uses' => 'BookController@getAllBooks']);

    /***************************************************************************************************
     * Index ( Main Page ) BookController
     ***************************************************************************************************/
    Route::resource('book', 'BookController', ['only' => ['index', 'show']]);
    Route::get('books/recentest',['uses' => 'BookController@getRecentestBooksPage']);
    Route::get('books/mostfavorited',['uses' => 'BookController@getMostFavoritedBooksPage']);
    Route::get('books/mostliked',['uses' => 'BookController@getMostLikedBooksPage']);



    /***************************************************************************************************
     * Categories
     ***************************************************************************************************/
    Route::resource('categories', 'CategoryController', ['only' => 'show']);

    /***************************************************************************************************
     *                                          User
     *
     ***************************************************************************************************/
    Route::get('/conditions', ['uses' => 'HomeController@getConditions']);
    Route::resource('user', 'UserController', ['only' => 'show']);

    /*
     * follow user
     * */
    Route::get('/follow/{userId}/{followerId}', ['middleware' => 'auth', 'uses' => 'UserController@followUser']);
    /*
     * unfollow user
     * */
    Route::get('/unfollow/{userId}/{followerId}', ['middleware' => 'auth', 'uses' => 'UserController@unFollowUser']);

    /*
     * Block User
     * */
    Route::get('/block/{userId}', ['middleware' => 'auth', 'uses' => 'UserController@blockUser']);

    /*
     * Unblock User
     * */
    Route::get('/unblock/{blockedId}', ['middleware' => 'auth', 'uses' => 'UserController@unBlockUser']);


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
 * Remaining parts :
 * 1- Followers Module
 * 2- a user can send messages only for his followers ??!!!!! (got to make sure of such point)
 * 3- only followers can comment on a book for a user.
 * 4- for a user .. only followers he can control authentication for commenting on his own books.
 *
 * */
Route::group(['prefix' => 'backend', 'middleware' => ['auth','collectData']], function () {

    /***************************************************************************************************
     * Dashboard Module
     ***************************************************************************************************/
    Route::get('/', ['as' => 'backend', 'uses' => 'Backend\DashboardController@index']);
    Route::get('/home', ['as' => 'home', 'uses' => 'Backend\DashboardController@index']);
    Route::get('/dashbaord', 'Backend\DashboardController@index');

    /***************************************************************************************************
     * translation Module
     ***************************************************************************************************/
    //Route::get('/translations', 'Backend\DashboardController@index');


    // Middleware RolePermissionRouteAccess
    //Route::group(['middleware' => 'auth'], function () {
        /***************************************************************************************************
         * User Module
         ***************************************************************************************************/
        Route::resource('users', 'Backend\UsersController');
        Route::get('/followers',['uses' => 'Backend\UsersController@showFollowingMe']);

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
         *                                          newspaper
         *
         ***************************************************************************************************/
        Route::resource('newsletter', 'Backend\NewsletterController',['only' =>['index','destroy','create','store']]);

        /***************************************************************************************************
         *                                          Sliders
         *
         ***************************************************************************************************/
        Route::resource('sliders', 'Backend\SlidersController');

        /***************************************************************************************************
         *                                          Categories
         *
         ***************************************************************************************************/


        Route::group(['prefix' => 'categories'], function () {

            Route::get('/', ['as' => 'backend.categories.index', 'uses' => 'Backend\FieldCategoriesController@index']);

            Route::resource('fields', 'Backend\FieldCategoriesController', ['except' => 'delete']);

            Route::resource('langs', 'Backend\LangCategoriesController', ['except' => 'delete']);
        });


        /***************************************************************************************************
         *                                          Messages
         *
         ***************************************************************************************************/
        Route::resource('messages', 'Backend\MessagesController');

   // });


    Route::post('users/active/{id}/{status}', 'Backend\UsersController@postChangeActiveStatus');


    // change book activation status
    Route::get('/activation/{bookId}/{userId}/{activeStatus}', 'Backend\BooksController@getChangeActivationBook');

    // change status of the chapter
    Route::get('/books/chapters/status/{chapterId}/{status}', [
        'as' => 'backend.books.chapters.status',
        'uses' => 'Backend\ChaptersController@getUpdateChapterStatus'
    ]);


    /***************************************************************************************************
     *                                          Book Previews
     *
     ***************************************************************************************************/

//        Route::resource('previews','Backend\PreviewsController');

    // get the pdf of a preview
    /*Route::get('/books/chapters/pdf/{chapterId}/{chapterUrl}', [
        'as' => 'backend.books.chapters.pdf.preview',
        'uses' => 'Backend\ChaptersController@getPdfFile'
    ]);*/


    Route::get('/book/chapters/pdf/preview/customized/{chapterId}', [

        'uses' => 'Backend\PreviewsController@index',
        'as' => 'backend.preview.index'
    ]);

    Route::get('/book/chapters/pdf/preview/customized/create/{chapterId}',
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


    Route::get('/book/pdf/preview/delete/customized/{previewId}',
        [
            'uses' => 'Backend\PreviewsController@removePreviewfromAuthorList',
            'as' => 'backend.preview.delete'
        ]);


    /***************************************************************************************************
     *                                          Favorite & Likes
     *
     ***************************************************************************************************/
    Route::get('/favorite/{userId}/{bookId}', ['uses' => 'Backend\BooksController@getCreateNewFavoriteList']);

    Route::get('/favorite/remove/{userId}/{bookId}',
        ['uses' => 'Backend\BooksController@getRemoveBookFromUserFavoriteList']);

    Route::get('/favorites', ['uses' => 'Backend\BooksController@index']);
    Route::get('/most favorites', ['uses' => 'Backend\BooksController@index']);

    // Likes
    Route::get('/like/{userId}/{bookId}', ['uses' => 'Backend\BooksController@getCreateLikeBook']);


    //Route::get('/orders/remove/{user}/{book}', ['uses' => 'BookController@getRemoveBookFromUserOrderList']);

    /***************************************************************************************************
     *                                          Report
     *
     ***************************************************************************************************/
    Route::get('/report/{userId}/{bookId}', ['uses' => 'Backend\BooksController@getCreateNewReportAbuse']);
    Route::get('/report/{userId}/{bookId}', ['uses' => 'Backend\BooksController@getCreateNewReportAbuse']);


    /***************************************************************************************************
     *                                          Messages
     *
     ***************************************************************************************************/
    Route::get('/messages/cancel/{threadId}/', [
        'uses' => 'Backend\MessagesController@cancel'
    ]);


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


/***************************************************************************************************
 * ▂ ▃ ▅ ▆ █ API  █ ▆ ▅ ▃ ▂
 ***************************************************************************************************/

Route::group(['prefix' => 'api'], function () {

});
