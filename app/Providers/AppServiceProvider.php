<?php

namespace AC\Providers;

use Barryvdh\Debugbar\ServiceProvider as DebugBarServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;
use Laracasts\Generators\GeneratorsServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() === 'local') {
            $this->app->register(GeneratorsServiceProvider::class);
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(DebugBarServiceProvider::class);
        }

        $this->registerHelpers();
    }

    protected function registerHelpers()
    {
        $helpers = [
            'formhelper' => '\AC\Helpers\FormHelper',
            'arrayhelper' => '\AC\Helpers\ArrayHelper',
        ];

        foreach ($helpers as $alias => $class) {
            $this->app->singleton($alias, function() use ($class) {
                return new $class;
            });

            $this->app->alias($alias, $class);
        }
    }
}
