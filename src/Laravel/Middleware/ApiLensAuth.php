<?php

namespace ApiLens\Laravel\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiLensAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->query('token');

        if ($token !== config('apilens.token')) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}