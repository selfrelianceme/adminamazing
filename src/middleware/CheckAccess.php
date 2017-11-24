<?php

namespace App\Http\Middleware;

use Closure;
//

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
        if(\Auth::check() && \Auth::user()->role_id != -1)
        {
            if(\Auth::User()->checkRole(\Route::current()->getPrefix(), true))
            {
                $menu = \DB::table('admin__menu')->orderBy('sort', 'asc')->get();
                $role = \Auth::User()->getRole();
                $result = \Menu::make($menu, $role->accessible_pages, 1);
                \View::share('menu', $result);
            }
            else
            {
                return abort(404);
            }
        }
        else 
        {
            return abort(404);
        }
        return $next($request);
    }
}
