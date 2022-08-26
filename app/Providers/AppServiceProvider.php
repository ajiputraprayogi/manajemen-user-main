<?php

namespace App\Providers;

use App\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(Schema::hasTable('configs')){
            config([
                'configs' => Config::all([
                    'option','value'
                ])
                ->keyBy('option')
                ->transform(function ($setting) {
                     return $setting->value;
                })
                ->toArray()
            ]);
        }
    }
}
