<?php

namespace App\Providers;

use App\Core\PoliciesCollection;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

      /*  $gate->define('index', function ($user,$module) use ($policy) {

            return $policy->index($module);

        });

        // book_create
        $gate->define('create', function ($user, $permission) use ($policy) {

            return $policy->create($permission);

        });*/


        // all permission
        $gate->define('authorizeAccess', function ($user,$ownerId) use ($policy) {

            return $policy->authorizeAccess($ownerId);

        });

        // book_change
        $gate->define('authorizeOwnership', function ($user, $module) use ($policy) {

            return $policy->authorizeOwnership($module);

        });

        /*// book_delete
        $gate->define('delete', function ($user, $permission) use ($policy) {

            return $policy->delete($permission);

        });*/


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
        $gate->define('authorizeAccess', function ($user, $permission) use ($policy) {

            return $policy->authorizeAccess($permission);

        });

    }
}