<?php

namespace ApiLens\Core\Transport;

use ApiLens\Core\Event;
use Illuminate\Support\Facades\DB;

use function Illuminate\Support\now;

class DatabaseTransport implements TransportInterface
{
    public function send(Event $event): void
    {
        DB::table('api_lens_events')->insert([
            'endpoint' => $event->endpoint,
            'method' => $event->method,
            'status' => $event->status,
            'duration' => $event->duration,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}