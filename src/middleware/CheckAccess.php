<?php

namespace App\Http\Middleware;

use Closure;
use Selfreliance\Adminamazing\AdminController;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url = explode('/', \Route::current()->getPrefix());
        $prefix = (is_null(@$url[1])) ? (is_null($url[0])) ? null : $url[0] : $url[1];
        $get_user = \Auth::User();
        if(!is_null($get_user)){
            $response = \DB::table('roles')->whereRaw('json_contains(accessible_pages, \'["'.$prefix.'"]\')')->get();
            if(count($response) > 0){
                $good = false;
                foreach($response as $role){
                    if($get_user->isRole($role->slug)){
                        $good = true;
                        $menu = \DB::table('admin__menu')->orderBy('sort', 'asc')->get();
                        $pages = $role->accessible_pages;
                        $result = AdminController::makeMenu($menu, json_decode($pages), 1);
                        \View::share('menu', $result);
                        break;
                    }
                    if(!$good) return abort(404);
                }
            }else return abort(404);
        }else if(!is_null($prefix)) return abort(404);
        return $next($request);
    }
}