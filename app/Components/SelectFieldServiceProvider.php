<?php

namespace Sibas\Components;


use Illuminate\Support\ServiceProvider;

class SelectFieldServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['selectField'] = $this->app->share(function($app) {

        });
    }
}