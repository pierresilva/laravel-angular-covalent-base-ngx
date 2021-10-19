<?php

namespace App\Providers;

use App\Services\OnTheFly;
use Illuminate\Support\ServiceProvider;

class OnTheFlyProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('onthefly',function(){
            return new OnTheFly();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
