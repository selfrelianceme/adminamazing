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
        // Роуты
        include __DIR__.'/routes.php';

        $this->app->make('Selfreliance\Adminamazing\AdminController');
        // Загружаем view в глабвльную видимость
        $this->loadViewsFrom(__DIR__.'/views', 'adminamazing');

        // Стили, скрипты, необходимо поместить в папку паблик
        $this->publishes([
            __DIR__.'/assets/' => public_path('vendor/adminamazing'),
        ], 'assets');

        $this->publishes([
            __DIR__.'/config/adminamazing.php' => config_path('adminamazing.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/middleware/CheckAccess.php' => app_path('Http/Middleware/CheckAccess.php'),
        ], 'middleware');
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
