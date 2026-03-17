<?php

namespace ApiLens\Core\Transport;

use ApiLens\Core\Event;

interface TransportInterface
{
    public function send(Event $event): void;
}