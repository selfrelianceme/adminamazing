<?php

namespace Selfreliance\Adminamazing;

use Illuminate\Support\ServiceProvider;

class AdminAmazingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        include __DIR__.'/routes.php';
        $this->app->make('Selfreliance\Adminamazing\AdminController');
        $this->loadViewsFrom(__DIR__.'/views', 'adminamazing');
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/adminamazing'),
        ], 'public');
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
