<?php

namespace AC\Providers;

use AC\Http\ViewComposers\AppComposer;
use AC\Http\ViewComposers\ErrorComposer;
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
        // Using class based composers...
        view()->composer(
            '*', AppComposer::class,
            'errors/404', ErrorComposer::class
        );
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
