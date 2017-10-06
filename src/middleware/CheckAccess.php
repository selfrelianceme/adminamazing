<?php

namespace App\Http\Middleware;

use Closure;
use Selfreliance\Adminamazing\AdminAmazingServiceProvider;

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
                    $arr = \DB::table('admin__menu')->get();
                    if(count($arr) > 0)
                    {
                        $new = array();
                        foreach ($arr as $a){
                            $new[$a->parent][] = $a;
                        }
                        $tree = AdminAmazingServiceProvider::createTree($new, $new[0]);
                        AdminAmazingServiceProvider::showTree($tree, $role->name);
                        break;
                    }else return abort(404);
                }
            }
            if(!$good) return abort(404);
        }else return abort(404);
        return $next($request);
    }
}
