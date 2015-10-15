<?php

namespace App\Providers;

use App\Src\Category\Field\FieldCategory;
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

        if (is_null(\Cache::get('fieldsCategories')) && is_null(\Cache::get('contactusInfo')) && is_null(\Cache::get('conditions'))) {

            if (\Schema::hasTable('contactus') && \Schema::hasTable('fields_categories') && \Schema::hasTable('ads') && \Schema::hasTable('conditions')) {

                $fieldsCategories = new FieldCategory();
                $fieldsCategories = $fieldsCategories->all();
                $contactusInfo = DB::table('contactus')->first();
                $allAds = DB::table('ads')->limit(2)->get();
                $conditions = DB::table('conditions')->first();


                if (!is_null($contactusInfo) && !is_null($fieldsCategories) && !is_null($allAds) && !is_null($conditions)) {
                    \Cache::put('contactusInfo', $contactusInfo, 20);
                    \Cache::put('fieldsCategories', $fieldsCategories, 20);
                    \Cache::put('allAds', $allAds, 20);
                    \Cache::put('conditions', $conditions, 20);

                    view()->share([
                        'contactusInfo' => \Cache::get('contactusInfo'),
                        'allAds' => \Cache::get('allAds'),
                        'fieldsCategories' => \Cache::get('fieldsCategories'),
                        'conditions' => \Cache::get('conditions')
                    ]);
                }
            }
        } else {
            view()->share([
                'contactusInfo' => \Cache::get('contactusInfo'),
                'allAds' => \Cache::get('allAds'),
                'fieldsCategories' => \Cache::get('fieldsCategories'),
                'conditions' => \Cache::get('conditions')
            ]);
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
