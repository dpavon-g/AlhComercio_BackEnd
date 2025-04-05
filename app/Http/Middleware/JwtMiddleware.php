<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
{
    public function handle($request, \Closure $next)
    {
        $excluded = ['api/login', 'api/register'];

        if (in_array($request->path(), $excluded)) {
            return $next($request);
        }

        try {
            $user = \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Token not valid'], 401);
        }

        return $next($request);
    }
}