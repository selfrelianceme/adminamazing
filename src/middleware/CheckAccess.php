<?php

namespace Selfreliance\adminamazing\middleware;

use Closure;

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
        	$role = \Auth::user()->checkRole(\Route::current()->getPrefix(), true);
            if($role)
            {
                $menu = \DB::table('admin__menu')->orderBy('sort', 'asc')->get();
                $result = \Menu::make($menu, $role, 1);
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