<?php

namespace App\Http\Middleware;

use App\Admin;
use App\Helpers;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
/**
 * Handle an incoming request.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Closure  $next
 * @param  string|null  $guard
 * @return mixed
 */
public function handle($request, Closure $next, $guard = 'admin')
{

    if (!Auth::guard($guard)->check()) {

        return redirect('admin/login');
    }
    return $next($request);
//    $permission_data = Helpers::getAllPermission();
//    $currentAction = \Route::currentRouteAction();
//    list($controller, $method) = explode('@', $currentAction);
//    $controller = preg_replace('/.*\\\/', '', $controller);
//    $method = preg_replace('/.*\\\/', '', $method);
//    $new_controller = Helpers::checkContollerName($controller);
//    $new_method = Helpers::checkMethodName($method);
//    $role_data =  Helpers::checkSubAdminExistRole($new_controller,$new_method);
//  //  dd($role_data);
//    if($role_data == 1){
//        return $next($request);
//    }else{
//          return redirect('admin/access-denied');
//    }





    }
}  