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

        if (is_null(Cache::get('fieldsCategories'))
            && is_null(Cache::get('contactusInfo'))
            && is_null(Cache::get('conditions'))
            && is_null(Cache::get('sliders'))
        ) {

            if (\Schema::hasTable('contactus')
                && \Schema::hasTable('fields_categories')
                && \Schema::hasTable('ads')
                && \Schema::hasTable('conditions')
                && \Schema::hasTable('sliders')
            ) {

                $fieldsCategories = new FieldCategory();
                $fieldsCategories = $fieldsCategories->all();
                $contactusInfo = DB::table('contactus')->first();
                $allAds = DB::table('ads')->limit(2)->get();
                $conditions = DB::table('conditions')->first();
                $sliders = DB::table('sliders')->get();


                if (!is_null($contactusInfo)
                    && !is_null($fieldsCategories)
                    && !is_null($allAds)
                    && !is_null($conditions)
                    && !is_null($sliders)
                ) {
                    Cache::forever('contactusInfo', $contactusInfo);
                    Cache::forever('fieldsCategories', $fieldsCategories);
                    Cache::forever('allAds', $allAds);
                    Cache::forever('conditions', $conditions);
                    Cache::forever('sliders', $sliders);

                    view()->share([
                        'contactusInfo' => Cache::get('contactusInfo'),
                        'allAds' => Cache::get('allAds'),
                        'fieldsCategories' => Cache::get('fieldsCategories'),
                        'conditions' => Cache::get('conditions'),
                        'sliders' => Cache::get('sliders')
                    ]);
                }
            }
        } else {
            view()->share([
                'contactusInfo' => Cache::get('contactusInfo'),
                'allAds' => Cache::get('allAds'),
                'fieldsCategories' => Cache::get('fieldsCategories'),
                'conditions' => Cache::get('conditions'),
                'sliders' => Cache::get('sliders')
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
