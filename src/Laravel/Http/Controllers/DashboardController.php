<?php

namespace ApiLens\Laravel\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function index()
    {
        $request = request();

        // Base query
        $query = DB::table('api_lens_events');

        // Filters
        if ($request->filled('endpoint')) {
            $query->where('endpoint', 'like', '%'.$request->endpoint.'%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Logs (latest 50)
        $events = $query->orderByDesc('id')->paginate(5)->withQueryString();

        // Metrics (unfiltered - global)
        $total = DB::table('api_lens_events')->count();

        $errors = DB::table('api_lens_events')
            ->where('status', '>=', 400)
            ->count();

        $avgTime = DB::table('api_lens_events')->avg('duration');

        $topEndpoints = DB::table('api_lens_events')
            ->select('endpoint', DB::raw('count(*) as total'))
            ->groupBy('endpoint')
            ->orderByDesc('total')
            ->paginate(5, ['*'], 'top_page')->withQueryString();

        $slowEndpoints = DB::table('api_lens_events')
            ->select('endpoint', DB::raw('avg(duration) as avg_time'))
            ->groupBy('endpoint')
            ->orderByDesc('avg_time')
            ->paginate(5, ['*'], 'slow_page')->withQueryString();

        return view('apilens::dashboard', compact(
            'total',
            'errors',
            'avgTime',
            'topEndpoints',
            'slowEndpoints',
            'events'
        ));
    }
}