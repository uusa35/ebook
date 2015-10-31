<?php

namespace App\Providers;

use App\Core\AbstractPolicy;
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


        $policy = new AbstractPolicy($perm = '');

        // book_create
        $gate->define('create', function () use ($policy) {

            return $policy->create();

        });


        // book_edit
        $gate->define('edit', function () use ($policy) {

            return $policy->edit();

        });

        // book_change
        $gate->define('change', function () use ($policy) {

            return $policy->change();

        });

        // book_delete
        $gate->define('delete', function () use ($policy) {

            return $policy->delete();

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


    }
}