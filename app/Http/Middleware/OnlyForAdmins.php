<?php

namespace App\Http\Middleware;

use JWTAuth;
use Closure;

class OnlyForAdmins
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
        if(!$this->isAdmin()){
            return response()->json(['error' => 'not_authorized_only_admins'], 401);
        }

        return $next($request);
    }

    private function isAdmin()
    {
        $user = JWTAuth::user();
        return ( $user ? ( $user->admin==1 ) : false );
    }
}
