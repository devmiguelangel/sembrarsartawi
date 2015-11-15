<?php

namespace Sibas\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // validate alphabetical chars & spaces only
        Validator::extend('alpha_space', function($attribute, $value, $parameters, $validator) {
            //return preg_match('/^([a-zA-Z ])+$/i', $value);
            return preg_match('/^[\pL\pM ]+$/u', $value);
        });

        // validate alphabetical chars, numbers & spaces only
        Validator::extend('alpha_num_space', function($attribute, $value, $parameters, $validator) {
            return preg_match('/^([a-zA-Z0-9 ])+$/i', $value);
        });

        // validate alphabetical chars, dashes & spaces only
        Validator::extend('alpha_dash_space', function($attribute, $value, $parameters, $validator) {
            return preg_match('/^[\pL\pM\pN _-]+$/u', $value);
        });

        // validate full alphabetical chars, dashes & spaces only
        Validator::extend('ands_full', function($attribute, $value, $parameters, $validator) {
            return preg_match('/^[\pL\pM\pN #._-]+$/u', $value);
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
