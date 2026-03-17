<?php

namespace ApiLens\Core\Transport;

use ApiLens\Core\Event;

class LogTransport implements TransportInterface
{
    public function send(Event $event): void
    {
        file_put_contents(
            storage_path('logs/api-lens.log'),
            json_encode($event->toArray()) . PHP_EOL,
            FILE_APPEND
        );
    }
}