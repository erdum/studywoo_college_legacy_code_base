<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PersonalAccessToken;

class VerifyFromCookie
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
        $smart_client = true;
        
        if (!$request->bearerToken()){
            if (PersonalAccessToken::findToken($request->cookie('access_token'))) {
                $request->headers->set('Authorization', 'Bearer ' . $request->cookie('access_token'));
            } else {
                $smart_client = false;
            }
        }
        
        $request->smart_client = $smart_client;
        
        return $next($request);
    }
}
