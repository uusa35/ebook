<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 9/2/15
 * Time: 9:33 PM
 */



Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push(trans('general.dashboard'), action('Backend\DashboardController@index'));
});

/*
 *
 * users
 * */

Breadcrumbs::register('users', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.users'), action('Backend\UsersController@index'));
});


Breadcrumbs::register('user_edit', function($breadcrumbs)
{
    $breadcrumbs->parent('users');
    $breadcrumbs->push(trans('general.user_edit'), action('Backend\UsersController@edit'));
});

Breadcrumbs::register('user_create', function($breadcrumbs)
{
    $breadcrumbs->parent('users');
    $breadcrumbs->push(trans('general.user_create'), action('Backend\UsersController@edit'));
});

/*
 * permissions
 * */

Breadcrumbs::register('permissions', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.permissions'), action('Backend\PermissionsController@index'));
});

Breadcrumbs::register('permission_create', function($breadcrumbs)
{
    $breadcrumbs->parent('permissions');
    $breadcrumbs->push(trans('general.permission_create'), action('Backend\PermissionsController@create'));
});

Breadcrumbs::register('permission_edit', function($breadcrumbs)
{
    $breadcrumbs->parent('permissions');
    $breadcrumbs->push(trans('general.permission_edit'), action('Backend\PermissionsController@edit'));
});


/*
 * roles
 * */
Breadcrumbs::register('roles', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.roles'), action('Backend\RolesController@index'));
});

Breadcrumbs::register('role_create', function($breadcrumbs)
{
    $breadcrumbs->parent('roles');
    $breadcrumbs->push(trans('general.role_create'), action('Backend\RolesController@create'));
});


Breadcrumbs::register('role_edit', function($breadcrumbs)
{
    $breadcrumbs->parent('roles');
    $breadcrumbs->push(trans('general.role_edit'), action('Backend\RolesController@edit'));
});

/*
 * books
 * */
Breadcrumbs::register('books', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.books'), action('Backend\BooksController@index'));
});

Breadcrumbs::register('book_create', function($breadcrumbs)
{
    $breadcrumbs->parent('books');
    $breadcrumbs->push(trans('general.create'), action('Backend\BooksController@create'));
});
Breadcrumbs::register('book_edit', function($breadcrumbs)
{
    $breadcrumbs->parent('books');
    $breadcrumbs->push(trans('general.book_edit'), action('Backend\BooksController@edit'));
});

Breadcrumbs::register('book_chapter', function($breadcrumbs)
{
    $breadcrumbs->parent('books');
    $breadcrumbs->push(trans('general.book_chapter'), action('Backend\BooksController@show'));
});

/*
 * ads
 * */
Breadcrumbs::register('ads', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('general.ads'), action('Backend\AdsController@index'));
});

Breadcrumbs::register('book_create', function($breadcrumbs)
{
    $breadcrumbs->parent('ads');
    $breadcrumbs->push(trans('general.ad_create'), action('Backend\AdsController@create'));
});
Breadcrumbs::register('book_edit', function($breadcrumbs)
{
    $breadcrumbs->parent('ads');
    $breadcrumbs->push(trans('general.ad_edit'), action('Backend\AdsController@edit'));
});

Breadcrumbs::register('book_chapter', function($breadcrumbs)
{
    $breadcrumbs->parent('ads');
    $breadcrumbs->push(trans('general.ad_show'), action('Backend\AdsController@show'));
});

