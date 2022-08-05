<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AdminAuthMiddleware
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

        $emailVerify = false; // site config

        if (Auth::check()) {
            if ($emailVerify && auth()->user()->email_verified_at)
                return $next($request);
            else if (!$emailVerify)
                return $next($request);
            else
                return redirect()->route('admin.auth.getVerifyMessage');
        }
        return redirect()->route('admin.auth.login');
    }
}
