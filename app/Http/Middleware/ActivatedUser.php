<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActivatedUser
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
        abort_unless(!$request->user()->hasRole('admin', 'appraiser', 'disburser'), 403);
        return $next($request);
    }
}
