<?php

namespace Selfreliance\Adminamazing;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
// use File;
// use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;

class AdminAmazingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    // private $dirResult = array();

    // public function scandir_recursive($dir) {
    //     $dir = rtrim($dir, DIRECTORY_SEPARATOR);
    //     $result = array();
    //     foreach (scandir($dir) as $node) {
    //         if ($node !== '.' and $node !== '..') {
    //             if($node == "description.json") {
    //                 array_push($this->dirResult, $dir."/".$node);
    //             }
    //             if (is_dir($dir . DIRECTORY_SEPARATOR . $node)) {
    //                 $this->scandir_recursive($dir . DIRECTORY_SEPARATOR . $node, $result);
    //             } else {
    //                 $result[$node][] = $dir . DIRECTORY_SEPARATOR . $node;
    //             }
    //         }
    //     }
    // }

    public static function createTree(&$list, $parent){
        $tree = array();
        foreach ($parent as $k=>$l){
            if(isset($list[$l->id])){
                $l->children = self::createTree($list, $list[$l->id]);
            }
            $tree[] = $l;
        }
        return $tree;
    }

    public static function getTree($category, $role){
        $check = (\Request::route()->getPrefix() == $category->package) ? 'active' : NULL;
        $menu = '<li><a class="has-arrow '.$check.'" href="'.url($category->package).'" aria-expanded="false">'.$category->title; 
        if(isset($category->children)){
            $menu .= '<ul aria-expanded="false" class="collapse">'. self::showTree($category->children, $role) .'</ul>';
        }
        $menu .= '</li></a>';
        return $menu;
    }

    public static function showTree($data, $role){
        $string = '';
        // $strDir = realpath(__DIR__ . '/../..');
        // $this->scandir_recursive($strDir);
        // $decodeArrayJson = array();
        // foreach ($this->dirResult as $result) {
        //     array_push($decodeArrayJson, json_decode(File::get($result)));
        // }


        /*
            Оптимизированный вариант будет в понедельник
        */
        $available = \DB::table('admin__sections')->where('name', $role)->value('privilegion');

        if(!is_null($available)){
            foreach($data as $item){
                if(!empty($item->package)){
                    if(in_array($item->package, json_decode($available))) 
                    {
                        $string .= self::getTree($item, $role);
                    }
                }
            }
        }
        return View::share('menu', $string);
    }

    public function boot()
    {
        // Роуты
        include __DIR__.'/routes.php';

        $this->app->make('Selfreliance\Adminamazing\AdminController');
        // Загружаем view в глабвльную видимость
        $this->loadViewsFrom(__DIR__.'/views', 'adminamazing');

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
