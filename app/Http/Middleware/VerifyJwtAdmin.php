<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

use App\Http\Models\Admin;

class VerifyJwtAdmin extends BaseMiddleware
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
        if(!$user = Auth::guard('admin')->user()) {
            return response()->json([
                'error' => true,
                'message' => 'unauthorized admin'
            ], 404);
        }

        return $next($request);
    }
}
