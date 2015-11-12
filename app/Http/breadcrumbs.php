<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 9/2/15
 * Time: 9:33 PM
 */


Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push(trans('general.dashboard'), action('Backend\DashboardController@index'));
});

/*
 * contactus
 * */
Breadcrumbs::register('contactus', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.contactus'), action('Backend\ContactUsController@edit'));
});

Breadcrumbs::register('newsletter', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.newsletter'), action('Backend\NewsletterController@index'));
});

/*
 *
 * users
 * */

Breadcrumbs::register('users', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.users'), action('Backend\UsersController@index'));
});


Breadcrumbs::register('user_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push(trans('general.user_edit'), action('Backend\UsersController@edit'));
});

Breadcrumbs::register('user_create', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push(trans('general.user_create'), action('Backend\UsersController@edit'));
});

Breadcrumbs::register('condition_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push(trans('general.condition_edit'), action('Backend\UsersController@getEditConditions'));
});

/*
 * permissions
 * */

Breadcrumbs::register('permissions', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.permissions'), action('Backend\PermissionsController@index'));
});

Breadcrumbs::register('permission_create', function ($breadcrumbs) {
    $breadcrumbs->parent('permissions');
    $breadcrumbs->push(trans('general.permission_create'), action('Backend\PermissionsController@create'));
});

Breadcrumbs::register('permission_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('permissions');
    $breadcrumbs->push(trans('general.permission_edit'), action('Backend\PermissionsController@edit'));
});


/*
 * roles
 * */
Breadcrumbs::register('roles', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.roles'), action('Backend\RolesController@index'));
});

Breadcrumbs::register('role_create', function ($breadcrumbs) {
    $breadcrumbs->parent('roles');
    $breadcrumbs->push(trans('general.role_create'), action('Backend\RolesController@create'));
});


Breadcrumbs::register('role_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('roles');
    $breadcrumbs->push(trans('general.role_edit'), action('Backend\RolesController@edit'));
});

/*
 * books
 * */
Breadcrumbs::register('books', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.books'), action('Backend\BooksController@index'));
});

Breadcrumbs::register('book_create', function ($breadcrumbs) {
    $breadcrumbs->parent('books');
    $breadcrumbs->push(trans('general.create'), action('Backend\BooksController@create'));
});
Breadcrumbs::register('book_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('books');
    $breadcrumbs->push(trans('general.book_edit'), action('Backend\BooksController@edit'));
});

Breadcrumbs::register('book_show', function ($breadcrumbs) {
    $breadcrumbs->parent('books');
    $breadcrumbs->push(trans('general.book_show'), action('Backend\BooksController@show'));
});

Breadcrumbs::register('book_chapter', function ($breadcrumbs) {
    $breadcrumbs->parent('books');
    $breadcrumbs->push(trans('general.book_chapter'), action('Backend\BooksController@show'));
});


    /*
 * chapters
 * */

Breadcrumbs::register('chapter_create', function ($breadcrumbs) {
    $breadcrumbs->parent('books');
    $breadcrumbs->push(trans('general.create'), action('Backend\PreviewsController@create'));
});
Breadcrumbs::register('chapter_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('books');
    $breadcrumbs->push(trans('general.chapter_edit'), action('Backend\ChaptersController@edit'));
});

Breadcrumbs::register('chapter_show', function ($breadcrumbs) {
    $breadcrumbs->parent('chapters');
    $breadcrumbs->push(trans('general.chapter_show'), action('Backend\ChaptersController@show'));
});

Breadcrumbs::register('chapter_preview', function ($breadcrumbs) {
    $breadcrumbs->parent('books');
    $breadcrumbs->push(trans('general.chapter_preview'), action('Backend\PreviewsController@index'));
});

Breadcrumbs::register('preview_create', function ($breadcrumbs) {
    $breadcrumbs->parent('books');
    $breadcrumbs->push(trans('general.preview_create'), action('Backend\PreviewsController@index'));
});

/*
 * ads
 * */
Breadcrumbs::register('ads', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.ads'), action('Backend\AdsController@index'));
});

Breadcrumbs::register('ad_create', function ($breadcrumbs) {
    $breadcrumbs->parent('ads');
    $breadcrumbs->push(trans('general.ad_create'), action('Backend\AdsController@create'));
});
Breadcrumbs::register('ad_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('ads');
    $breadcrumbs->push(trans('general.ad_edit'), action('Backend\AdsController@edit'));
});

Breadcrumbs::register('ad_show', function ($breadcrumbs) {
    $breadcrumbs->parent('ads');
    $breadcrumbs->push(trans('general.ad_show'), action('Backend\AdsController@show'));
});


/*
 * messages
 * */
Breadcrumbs::register('messages', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.messages'), action('Backend\MessagesController@index'));
});

Breadcrumbs::register('message_create', function ($breadcrumbs) {
    $breadcrumbs->parent('messages');
    $breadcrumbs->push(trans('general.message_create'), action('Backend\MessagesController@create'));
});

Breadcrumbs::register('message_show', function ($breadcrumbs) {
    $breadcrumbs->parent('messages');
    $breadcrumbs->push(trans('general.message_show'), action('Backend\MessagesController@show'));
});



/*
 * categories
 * */
Breadcrumbs::register('categories', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.categories'), action('Backend\FieldCategoriesController@index'));
});

Breadcrumbs::register('field_category_create', function ($breadcrumbs) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push(trans('general.category_create'), action('Backend\FieldCategoriesController@create'));
});

Breadcrumbs::register('field_category_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push(trans('general.category_edit'), action('Backend\FieldCategoriesController@edit'));
});

Breadcrumbs::register('lang_category_create', function ($breadcrumbs) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push(trans('general.category_create'), action('Backend\LangCategoriesController@create'));
});

Breadcrumbs::register('lang_category_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push(trans('general.category_edit'), action('Backend\LangCategoriesControllerController@show'));
});
