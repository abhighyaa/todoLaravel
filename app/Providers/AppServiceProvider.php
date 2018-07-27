<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
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
        //Carbon::setLocale(config('app.locale'));
        //
        view()->composer('layouts.sidebar',function($view){
            if (auth()->check())
                $view->with('labels',\App\Label::getLabels());
        });

        view()->composer('layouts.app',function($view){
            if (auth()->check()){
                $count = count(DB::table('notifications')->where('notifiable_id','=',Auth::user()->id)->where('read_at','=',NULL)->get());
       
                //session()->put('notifications', $count);
                $view->with('count',$count);
            }

                
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
