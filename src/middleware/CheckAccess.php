<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use View;
use Auth;

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
        if($url[0] == 'admin')
        {
            if(Auth::check())
            {
                if(Auth::User()->role_id != -1)
                {
                    $role = Auth::User()->checkRole($prefix, true);
                    if($role)
                    {
                        $menu = DB::table('admin__menu')->orderBy('sort', 'asc')->get();
                        $result = \Menu::make($menu, $role, 1);
                        View::share('menu', $result);
                    }
                    else return abort(404);
                }
                else return abort(404);
            }
            else return abort(404);
        }
        return $next($request);
    }
}
