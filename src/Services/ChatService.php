<?php

namespace Omarelnaghy\LaravelAICopilot\Services;

use Omarelnaghy\LaravelAICopilot\Contracts\DriverContract;

class ChatService
{
    public function __construct(protected DriverContract $driver)
    {
    }

    public function send(string $message, array $options = []): string
    {
        return $this->driver->chat($message, $options);
    }
}


