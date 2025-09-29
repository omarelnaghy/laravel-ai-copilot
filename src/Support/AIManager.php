<?php

namespace Omarelnaghy\LaravelAICopilot\Support;

use InvalidArgumentException;
use Omarelnaghy\LaravelAICopilot\Contracts\DriverContract;
use Omarelnaghy\LaravelAICopilot\Drivers\OpenAI;

class AIManager
{
    /** @var array<string,mixed> */
    protected array $config;

    protected ?DriverContract $driver = null;

    /** @param array<string,mixed> $config */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function driver(?string $name = null): DriverContract
    {
        if ($this->driver && $name === null) {
            return $this->driver;
        }

        $name = $name ?? ($this->config['default'] ?? 'openai');

        $providers = $this->config['providers'] ?? [];
        $providerConfig = $providers[$name] ?? null;

        if ($providerConfig === null) {
            throw new InvalidArgumentException("AI provider '{$name}' is not configured.");
        }

        switch ($name) {
            case 'openai':
                $this->driver = new OpenAI($providerConfig);
                break;
            default:
                throw new InvalidArgumentException("AI provider '{$name}' is not supported.");
        }

        return $this->driver;
    }

    public function chat(string $message, array $options = []): string
    {
        return $this->driver()->chat($message, $options);
    }

    public function summarize(string $text, array $options = []): string
    {
        return $this->driver()->summarize($text, $options);
    }

    public function generate(string $prompt, array $options = []): string
    {
        return $this->driver()->generate($prompt, $options);
    }

    /** @return array<float> */
    public function embed(string $text, array $options = []): array
    {
        return $this->driver()->embed($text, $options);
    }

    public function search(string|array $query, array $options = []): mixed
    {
        // Placeholder for Phase 2 (pgvector, Pinecone, Qdrant)
        return null;
    }

    public function translate(string $text, string|array $to, array $options = []): string
    {
        // Placeholder for Phase 2/3
        return $text;
    }
}


