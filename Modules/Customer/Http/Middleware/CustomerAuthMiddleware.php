<?php

namespace Modules\Customer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthMiddleware
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


        $check_is_valid = false;
        $requireAuthentication = true;
        if (auth()->guard('customer')->check()) {
            if ($requireAuthentication) {
                if (auth()->guard('customer')->user()->email_verified_at) {
                    $check_is_valid = true;
                }
            } else {
                $check_is_valid = true;
            }
        } else {
            session()->put("url.intended",url()->current());

            // dd(session()->get("url.intended",url()->current()));
            // dd("next route");
            // $this->session->pull('url.intended', $default);
            return redirect()->route("login");
        }

        if ($check_is_valid) {
            return $next($request);
        }
        return redirect()->route("otp");
    }
}
