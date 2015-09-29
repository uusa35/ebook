<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        if (\Schema::hasTable('contactus') && \Schema::hasTable('fieldsCategories') && \Schema::hasTable('ads') && \Schema::hasTable('conditions')) {

            $contactusInfo = \DB::table('contactus')->first();
            $fieldsCategories = \DB::table('fields_categories')->get();
            $allAds = \DB::table('ads')->limit(2)->get();
            $conditions = \DB::table('conditions')->first();

            if (!is_null($contactusInfo) && !is_null($fieldsCategories) && !is_null($allAds) && !is_null($conditions)) {
                \Cache::put('contactusInfo', $contactusInfo, 20);
                \Cache::put('fieldsCategories', $fieldsCategories, 20);
                \Cache::put('allAds', $allAds, 20);
                \Cache::put('conditions', $conditions, 20);

                view()->share([
                    'contactusInfo' => \Cache::get('contactUsInfo'),
                    'allAds' => \Cache::get('allAds'),
                    'fieldsCategories' => \Cache::get('fieldsCategories'),
                    'conditions' => \Cache::get('conditions')
                ]);
            }
        }


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
