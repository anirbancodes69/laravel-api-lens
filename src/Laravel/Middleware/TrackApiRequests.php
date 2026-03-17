<?php

namespace ApiLens\Laravel\Middleware;

use Closure;
use Illuminate\Http\Request;
use ApiLens\Core\Event;

class TrackApiRequests
{
    public function handle(Request $request, \Closure $next)
    {
        $start = microtime(true);

        $response = $next($request);

        $duration = microtime(true) - $start;

        $event = new Event(
            $request->path(),
            $request->method(),
            $response->getStatusCode(),
            $duration
        );

        $tracker = app(\ApiLens\Core\Tracker::class);
        $tracker->track($event);

        return $response;
    }
}