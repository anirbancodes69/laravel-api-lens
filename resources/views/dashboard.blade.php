<!DOCTYPE html>
<html>
<head>
    <title>ApiLens Dashboard</title>
    <style>
        body {
            font-family: Inter, Arial, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .cards {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .card {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .card h3 {
            margin: 0;
            font-size: 14px;
            color: #64748b;
        }

        .card p {
            font-size: 24px;
            margin: 5px 0 0;
            font-weight: bold;
        }

        .filters {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        input, select {
            padding: 8px;
            margin-right: 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        button {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            background: #6366f1;
            color: white;
            cursor: pointer;
        }

        table {
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            background: #f1f5f9;
            padding: 12px;
            font-size: 14px;
        }

        td {
            padding: 12px;
            border-top: 1px solid #eee;
        }

        tr:hover {
            background: #f9fafb;
        }

        .status-200 { color: green; font-weight: bold; }
        .status-400, .status-500 { color: red; font-weight: bold; }

       .pagination {
    display: flex;
    justify-content: flex-end; /* 🔥 change this */
    gap: 6px;
    list-style: none;
    padding: 0;
}

.pagination li a,
.pagination li span {
    padding: 6px 10px;
    border-radius: 6px;
    border: 1px solid #ddd;
    text-decoration: none;
    color: #333;
}

.pagination li.active span {
    background: #6366f1;
    color: white;
    border-color: #6366f1;
}

.pagination li a:hover {
    background: #f1f5f9;
}

.pagination li.disabled span {
    color: #bbb;
    border: 1px solid #eee;
    cursor: not-allowed;
}
    </style>
</head>

<body>

<div class="container">

    <h1>🚀 ApiLens Dashboard</h1>

    <!-- Metrics -->
    <div class="cards">
        <div class="card">
            <h3>Total Requests</h3>
            <p>{{ $total }}</p>
        </div>

        <div class="card">
            <h3>Errors</h3>
            <p style="color:red">{{ $errors }}</p>
        </div>

        <div class="card">
            <h3>Avg Response</h3>
            <p>{{ round($avgTime, 2) }} ms</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters">
        <form method="GET">
            <input type="hidden" name="token" value="{{ request('token') }}">

            <input type="text" name="endpoint" placeholder="Endpoint"
                   value="{{ request('endpoint') }}">

            <select name="status">
                <option value="">All Status</option>
                <option value="200" {{ request('status')=='200'?'selected':'' }}>200</option>
                <option value="404" {{ request('status')=='404'?'selected':'' }}>404</option>
                <option value="500" {{ request('status')=='500'?'selected':'' }}>500</option>
            </select>

            <button type="submit">Filter</button>
        </form>
    </div>

    <div id="main-table">
    {{-- main events table --}}


    <!-- Logs Table -->
    <table>
        <thead>
            <tr>
                <th>Endpoint</th>
                <th>Method</th>
                <th>Status</th>
                <th>Duration</th>
                <th>Time</th>
            </tr>
        </thead>

        <tbody>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->endpoint }}</td>
                <td>{{ $event->method }}</td>
                <td class="status-{{ $event->status }}">
                    {{ $event->status }}
                </td>
                <td>{{ round($event->duration, 2) }} ms</td>
                <td>{{ $event->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
<div style="margin-top:10px;">
   @include('apilens::components.pagination', [
    'paginator' => $events,
    'anchor' => 'main-table'
])
</div>

</div>

<div id="slow-table">
    {{-- slow endpoints --}}

    <!-- Slow Endpoints -->
<h2 style="margin-top:30px;">🐢 Slow Endpoints</h2>

<table>
    <thead>
        <tr>
            <th>Endpoint</th>
            <th>Avg Time</th>
        </tr>
    </thead>

    <tbody>
    @foreach($slowEndpoints as $item)
        <tr>
            <td>{{ $item->endpoint }}</td>
            <td style="color:orange; font-weight:bold;">
                {{ round($item->avg_time, 2) }} ms
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div style="margin-top:10px;">
   @include('apilens::components.pagination', [
    'paginator' => $slowEndpoints,
    'anchor' => 'slow-table'
])
</div>
</div>

<div id="top-table">
    {{-- top endpoints --}}


    <!-- Top Endpoints -->
<h2 style="margin-top:30px;">🔥 Top Endpoints</h2>

<table>
    <thead>
        <tr>
            <th>Endpoint</th>
            <th>Hits</th>
        </tr>
    </thead>

    <tbody>
    @foreach($topEndpoints as $item)
        <tr>
            <td>{{ $item->endpoint }}</td>
            <td>{{ $item->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div style="margin-top:10px;">
   @include('apilens::components.pagination', [
    'paginator' => $topEndpoints,
    'anchor' => 'top-table'
])
</div>
</div>

</div>

</body>
</html>