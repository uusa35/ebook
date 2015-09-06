<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 9/2/15
 * Time: 9:33 PM
 */



Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push(trans('word.general.dashboard'), action('Backend\DashboardController@index'));
});

Breadcrumbs::register('users', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('word.general.users'), action('Backend\UsersController@index'));
});


Breadcrumbs::register('user_edit', function($breadcrumbs)
{
    $breadcrumbs->parent('users');
    $breadcrumbs->push(trans('word.general.user_edit'), action('Backend\UsersController@edit'));
});

Breadcrumbs::register('permissions', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('word.general.permissions'), action('Backend\PermissionsController@index'));
});

Breadcrumbs::register('permission_create', function($breadcrumbs)
{
    $breadcrumbs->parent('permissions');
    $breadcrumbs->push(trans('word.general.permission_create'), action('Backend\PermissionsController@create'));
});

Breadcrumbs::register('permission_edit', function($breadcrumbs)
{
    $breadcrumbs->parent('permissions');
    $breadcrumbs->push(trans('word.general.permission_edit'), action('Backend\PermissionsController@edit'));
});

Breadcrumbs::register('roles', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('word.general.roles'), action('Backend\RolesController@index'));
});

Breadcrumbs::register('role_create', function($breadcrumbs)
{
    $breadcrumbs->parent('roles');
    $breadcrumbs->push(trans('word.general.role_create'), action('Backend\RolesController@create'));
});


Breadcrumbs::register('role_edit', function($breadcrumbs)
{
    $breadcrumbs->parent('roles');
    $breadcrumbs->push(trans('word.general.role_edit'), action('Backend\RolesController@edit'));
});

