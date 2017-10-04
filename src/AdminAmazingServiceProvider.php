<?php

namespace Selfreliance\Adminamazing;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use File;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;

class AdminAmazingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    private $dirResult = array();

    public function scandir_recursive($dir) {
        $dir = rtrim($dir, DIRECTORY_SEPARATOR);
        $result = array();
        foreach (scandir($dir) as $node) {
            if ($node !== '.' and $node !== '..') {
                if($node == "description.json" || $node == "description1.json") {
                    array_push($this->dirResult, $dir."/".$node);
                }
                if (is_dir($dir . DIRECTORY_SEPARATOR . $node)) {
                    $this->scandir_recursive($dir . DIRECTORY_SEPARATOR . $node, $result);
                } else {
                    $result[$node][] = $dir . DIRECTORY_SEPARATOR . $node;
                }
            }
        }

    }





    public function menuShare()
    {

		$strDir = realpath(__DIR__ . '/../..');
        $this->scandir_recursive($strDir);
        $decodeArrayJson = array();
        foreach ($this->dirResult as $result) {
            array_push($decodeArrayJson, json_decode(File::get($result)));
        }
        //dd($decodeArrayJson);
        View::share('decodeArrayJson',$decodeArrayJson);
    }


    public function boot()
    {
        // Роуты
        include __DIR__.'/routes.php';

        $this->app->make('Selfreliance\Adminamazing\AdminController');
        // Загружаем view в глабвльную видимость
        $this->loadViewsFrom(__DIR__.'/views', 'adminamazing');

        $this->menuShare();

        // Стили, скрипты, необходимо поместить в папку паблик
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/adminamazing'),
        ], 'assets');

        $this->publishes([
            __DIR__.'/configs/adminamazing.php' => config_path('adminamazing.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/migrations/' => base_path('/database/migrations'),
        ], 'migrations');        

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
