<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
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
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'POST, PUT, DELETE, GET, PATCH, OPTIONS'
        ];
        if ($request->getMethod() === 'OPTIONS' && app()->environment('dev')) {
            return response('', 204)->withHeaders($headers);
        }
        /**
         * @var \Illuminate\Http\Response
         */
        $response = $next($request);
        if (app()->environment('dev')) {
            $response->withHeaders($headers);
        }
        return $response;
    }
}
