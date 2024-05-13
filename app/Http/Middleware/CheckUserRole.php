<?php
namespace App\Http\Middleware;
use App\User;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{

    public function handle($request, Closure $next, ...$role)
    {

        $aUser = Auth::guard()->user();
        // echo "<pre>"; print_r($aUser);
        // print_r($role);
        // die;
        if(isset($aUser) && $role && in_array($aUser['user_type'], $role))
        {
            return $next($request);
        }
        return redirect()->guest('login');

    }
}
