<?php

namespace App\Http\Middleware;

use Closure;
use DB;

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
            $role = $user->getRole($user->role_id);
            if(!is_null($role)){
                $pages = json_decode($role->accessible_pages);
                if(in_array($prefix, $pages)){
                    $menu = DB::table('admin__menu')->orderBy('sort', 'asc')->get();
                    $result = makeMenu($menu, $pages, 1);
                    \View::share('menu', $result);
                }else return abort(404);
            }else return abort(404);
        }else return abort(404);
        return $next($request);
    }
}
