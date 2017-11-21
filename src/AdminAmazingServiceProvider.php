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
        include __DIR__.'/routes.php';
        $this->app->make('Selfreliance\Adminamazing\AdminController');
        $this->loadViewsFrom(
            __DIR__.'/views', 'adminamazing'
        );
        $this->publishes([
            __DIR__.'/assets/' => public_path('vendor/adminamazing')], 'assets'
        );
        $this->publishes([
            __DIR__.'/config/adminamazing.php' => config_path('adminamazing.php')], 'config'
        );
        $this->publishes([
            __DIR__ . '/migrations/' => database_path('migrations')], 'migrations'
        );
        $this->publishes([
            __DIR__.'/middleware/CheckAccess.php' => app_path('Http/Middleware/CheckAccess.php')], 'middleware'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('blocks', function($app){
            $blade = $app['view']
                ->getEngineResolver()
                ->resolve('blade')
                ->getCompiler();

            return new \Selfreliance\Adminamazing\Blocks($blade, $app);
        });
    }
}
