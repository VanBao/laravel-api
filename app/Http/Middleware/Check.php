<?php

namespace App\Http\Middleware;

use Closure;

class Check
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (setting('is_maintenance') == 'off') {
            return $next($request);
        } else if (setting('is_maintenance') == 'on') {
            return response()->json([
                'status' => false,
                'code' => 30,
                'message' => 'Failed.',
                'data' => []
            ]);
        }
        return $next($request);
    }
}
