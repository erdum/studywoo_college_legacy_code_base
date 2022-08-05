<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PersonalAccessToken;

use App\Models\Admins;

class VerifyWebRouteWithCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (isset($request->cookie()['access_token'])) {
            
            $token = PersonalAccessToken::findToken($request->cookie()['access_token']);
            
            if ($token) {
                
                $user = Admins::find($token->tokenable_id);
                $request->setUserResolver(function () use ($user) {
                    return $user;
                });
                return $next($request);
            }
            
        } else {
            return redirect('/login');
        }
    }
}
