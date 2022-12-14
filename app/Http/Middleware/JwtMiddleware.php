<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use JWTAuth;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json([
                    'meta' => [
                        'success' => false,
                        'message' => 'Token is Invalid'
                    ],
                    'data' => null
                ], 400);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json([
                    'meta' => [
                        'success' => false,
                        'message' => 'Token is Expired'
                    ],
                    'data' => null
                ], 400);
            }else{
                return response()->json([
                    'meta' => [
                        'success' => false,
                        'message' => 'Authorization Token not found'
                    ],
                    'data' => null
                ], 400);
            }
        }
        return $next($request);
    }
}
