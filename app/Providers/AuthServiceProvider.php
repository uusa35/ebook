<?php

namespace App\Providers;

use App\Core\PoliciesCollection;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Session;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);


        $policy = new PoliciesCollection();

        $gate->define('index', function ($user, $module) use ($policy) {

            return $policy->index($module);

        });

        // book_create
        $gate->define('create', function ($user, $permission) use ($policy) {

            return $policy->create($permission);

        });


        // book_edit
        $gate->define('edit', function ($user, $element) use ($policy) {

            return $policy->edit($element);

        });

        // book_change
        $gate->define('change', function ($user, $element) use ($policy) {

            return $policy->change($element);

        });

        // book_delete
        $gate->define('delete', function ($user, $element) use ($policy) {

            return $policy->delete($user, $element);

        });


        // Admin
        $gate->define('isAdmin', function () use ($policy) {

            return $policy->isAdmin();

        });


        // book_delete
        $gate->define('isEditor', function () use ($policy) {

            return $policy->isEditor();

        });

        // book_delete
        $gate->define('isAuthor', function () use ($policy) {

            return $policy->isAuthor();

        });

        // Check for abstracted permission
        $gate->define('checkAssignedPermission', function ($user, $permission) use ($policy) {

            return $policy->checkAssignedPermission($permission);

        });


    }
}