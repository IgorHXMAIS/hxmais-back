<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

use App\Http\Models\Representative;

class VerifyJwtRepresentative extends BaseMiddleware
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
        if(!$user = Auth::guard('representative')->user()) {
            return response()->json([
                'error' => true,
                'message' => 'unauthorized representative'
            ], 404);
        }

        if(Representative::where('email', '=', $user->email)->first()) {
            return $next($request);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'invalid token'
            ], 400);
        }
    }
}
