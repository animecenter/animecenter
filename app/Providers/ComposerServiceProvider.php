<?php

namespace AC\Providers;

use AC\Composers\AppComposer;
use AC\Composers\DashboardComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
            ['app.layouts.main'], AppComposer::class
        );

        view()->composer(
            ['dashboard.layouts.main'], DashboardComposer::class
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
