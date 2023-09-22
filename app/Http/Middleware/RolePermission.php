<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
//        $route_name = $request->route()->getName();
//        dd($route_name);
        $role_id = Auth::user()->role_id;
        $route_name = $request->route()->getName();
        $permissions =DB::select( DB::raw("SELECT * FROM role_permissions WHERE role_id = :role_id AND permission_url = :permission_url"), array(
            'role_id' => $role_id,
            'permission_url' => $route_name,
        ));
//        dd($permissions);
        if(!Auth::check()){
            redirect()->route('login');
        }elseif(Auth::check() && $permissions){
            return $next($request);
        }
        else{
//            return abort(500);
            return response()->view('access_restricted');
        }
    }
}
