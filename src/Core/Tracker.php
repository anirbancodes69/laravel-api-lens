<?php

namespace ApiLens\Core;

use ApiLens\Core\Transport\LogTransport;
use ApiLens\Core\Transport\TransportInterface;

class Tracker
{
    protected TransportInterface $transport;

    public function __construct(? TransportInterface $transport = null)
    {
        $this->transport = $transport ?? new LogTransport();
    }

    public function track(Event $event): void
    {
            $this->transport->send($event);
    }
}