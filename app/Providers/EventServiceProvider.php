<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Auth;
use Session;
use DB;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        // Event::listen('auth.login', function()
        // {
        //     $user = Auth::user()->id;
        //     $count = count(DB::table('notifications')->where('notifiable_id','=','1')->get());
        //     Session::set('notifications', $count);
        // });
        // //
    }
}
