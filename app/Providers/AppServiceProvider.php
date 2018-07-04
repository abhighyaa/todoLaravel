<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Session;
use Auth;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('layouts.sidebar',function($view){
            if (auth()->check())
                $view->with('labels',\App\Label::getLabels());
        });

        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
