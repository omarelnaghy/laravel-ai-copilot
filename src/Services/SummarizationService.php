<?php

namespace Omarelnaghy\LaravelAICopilot\Services;

use Omarelnaghy\LaravelAICopilot\Contracts\DriverContract;

class SummarizationService
{
    public function __construct(protected DriverContract $driver)
    {
    }

    public function summarize(string $text, array $options = []): string
    {
        return $this->driver->summarize($text, $options);
    }
}


