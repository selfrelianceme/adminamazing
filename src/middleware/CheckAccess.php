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
        $prefix = (!is_null(@$url[1])) ? $url[1] : $url[0];
        $user = \Auth::User();
        if($user && $url[0] == 'admin'){
            $roles = $user->getRoles();
            if(count($roles) > 0){
                $pages = json_decode($roles[0]->accessible_pages);
                if(in_array($prefix, $pages)){
                    $menu = \DB::table('admin__menu')->orderBy('sort', 'asc')->get();
                    $result = AdminController::makeMenu($menu, $pages, 1);
                    \View::share('menu', $result);
                }else return abort(404);
            }else return abort(404);
        }else return abort(404);
        return $next($request);
    }
}