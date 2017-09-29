<?php

namespace App\Http\Middleware;

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
        $prefix = \Route::current()->getPrefix();
        $response = \DB::table('admin__sections')->whereRaw('json_contains(privilegion, \'["'.$prefix.'"]\')')->get();
        $user = \Auth::User();
        if(count($response) > 0 && $user){
            $good = false;
            foreach($response as $role){
                if($user->isRole($role->name))
                {
                    $good = true;
                    break;
                }
            }
            if(!$good) return abort(404);
        }else return abort(404);
        return $next($request);
    }
}
