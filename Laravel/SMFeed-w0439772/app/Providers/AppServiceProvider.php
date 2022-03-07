<?php

namespace App\Providers;

use App\Theme;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        //force links to be https in production
        if (App::environment('production')){
            URL::forceScheme('https');
        }

        //get list of themes to send to app.blade.php
        //view composer
        //view:share
        $themes=Theme::all();
        View::share('themeList',$themes);

    }
}
