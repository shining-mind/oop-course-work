<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
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
        /**
         * @var \Illuminate\Http\Response
         */
        $response = $next($request);
        if (app()->environment('dev')) {
            $response->header('Access-Control-Allow-Origin', '*');
        }
        return $response;
    }
}
