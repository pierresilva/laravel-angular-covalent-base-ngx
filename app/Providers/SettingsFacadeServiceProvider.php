<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SettingsFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \App::bind('settings', function() {
            return new \App\Settings\SettingsFacade;
        });
    }
}
