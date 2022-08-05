<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogMiddleware
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
        dispatch(function () use ($request) {
            Log::info("From " . url()->previous() . " to " . url()->current() . "   with  " . json_encode($request->all()));
            Log::info($request->userAgent());
            Log::info($request->ip());
            Log::info($request->ajax() . " ?? is ajax ??");
            Log::info("\n\n\n");
        })->afterResponse();
        return $next($request);
    }
}