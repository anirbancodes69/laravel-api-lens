<!DOCTYPE html>
<html>
<head>
    <title>ApiLens Dashboard</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .card { display: inline-block; padding: 20px; margin: 10px; background: #f5f5f5; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        input, select { padding: 6px; margin-right: 10px; }
        button { padding: 6px 12px; }
    </style>
</head>
<body>

<h1>🚀 ApiLens Dashboard</h1>

<!-- Metrics -->
<div class="card">Total Requests: {{ $total }}</div>
<div class="card">Errors: {{ $errors }}</div>
<div class="card">Avg Response: {{ round($avgTime, 2) }} ms</div>

<!-- Filters -->
<h2>🔍 Filters</h2>

<form method="GET" style="margin-bottom:20px;">
    <input type="hidden" name="token" value="{{ request('token') }}">

    <input type="text" name="endpoint" placeholder="Endpoint"
           value="{{ request('endpoint') }}" />

    <select name="status">
        <option value="">All Status</option>
        <option value="200" {{ request('status')=='200'?'selected':'' }}>200</option>
        <option value="404" {{ request('status')=='404'?'selected':'' }}>404</option>
        <option value="500" {{ request('status')=='500'?'selected':'' }}>500</option>
    </select>

    <button type="submit">Filter</button>
</form>

<!-- Logs -->
<h2>📄 Logs</h2>
<table>
    <tr>
        <th>Endpoint</th>
        <th>Method</th>
        <th>Status</th>
        <th>Duration</th>
        <th>Time</th>
    </tr>

    @foreach($events as $event)
        <tr>
            <td>{{ $event->endpoint }}</td>
            <td>{{ $event->method }}</td>
            <td>{{ $event->status }}</td>
            <td>{{ round($event->duration, 2) }} ms</td>
            <td>{{ $event->created_at }}</td>
        </tr>
    @endforeach
</table>

<!-- Top Endpoints -->
<h2>🔥 Top Endpoints</h2>
<table>
    <tr><th>Endpoint</th><th>Hits</th></tr>
    @foreach($topEndpoints as $item)
        <tr>
            <td>{{ $item->endpoint }}</td>
            <td>{{ $item->total }}</td>
        </tr>
    @endforeach
</table>

<!-- Slow Endpoints -->
<h2>🐢 Slow Endpoints</h2>
<table>
    <tr><th>Endpoint</th><th>Avg Time (ms)</th></tr>
    @foreach($slowEndpoints as $item)
        <tr>
            <td>{{ $item->endpoint }}</td>
            <td>{{ round($item->avg_time, 2) }}</td>
        </tr>
    @endforeach
</table>

</body>
</html>