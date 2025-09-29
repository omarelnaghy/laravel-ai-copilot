<?php

namespace Omarelnaghy\LaravelAICopilot\Services;

use Omarelnaghy\LaravelAICopilot\Contracts\DriverContract;

class GenerationService
{
    public function __construct(protected DriverContract $driver)
    {
    }

    public function generate(string $prompt, array $options = []): string
    {
        return $this->driver->generate($prompt, $options);
    }
}


