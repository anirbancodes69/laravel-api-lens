<?php 

namespace ApiLens\Core;

class Event
{
    public string $endpoint;
    public string $method;
    public int $status;
    public float $duration;
    public int $timestamp;

    public function __construct(
        string $endpoint,
        string $method,
        int $status,
        float $duration,
    ) {
        $this->endpoint = $endpoint;
        $this->method = $method;
        $this->status = $status;
        $this->duration = $duration;
        $this->timestamp = time();
    }

    public function toArray(): array
    {
        return [
            'endpoint' => $this->endpoint,
            'method' => $this->method,
            'status' => $this->status,
            'duration' => $this->duration,
            'timestamp' => $this->timestamp,
        ];
    }
}