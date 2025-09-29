<?php

namespace Omarelnaghy\LaravelAICopilot\Drivers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Omarelnaghy\LaravelAICopilot\Contracts\DriverContract;

class OpenAI implements DriverContract
{
    /** @var array<string,mixed> */
    protected array $config;

    /** @param array<string,mixed> $config */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function chat(string $message, array $options = []): string
    {
        $model = $options['model'] ?? $this->config['model'] ?? 'gpt-4o-mini';
        $system = $options['system'] ?? 'You are a helpful AI assistant.';
        $messages = [
            ['role' => 'system', 'content' => $system],
            ['role' => 'user', 'content' => $message],
        ];

        $response = $this->request('/v1/chat/completions', [
            'model' => $model,
            'messages' => $messages,
            'temperature' => $options['temperature'] ?? 0.7,
            'max_tokens' => $options['max_tokens'] ?? null,
        ]);

        return Arr::get($response, 'choices.0.message.content', '');
    }

    public function summarize(string $text, array $options = []): string
    {
        $prompt = "Summarize the following text concisely in 3-5 bullet points:";
        $fullPrompt = $prompt."\n\n".$text;

        return $this->generate($fullPrompt, $options);
    }

    public function generate(string $prompt, array $options = []): string
    {
        $model = $options['model'] ?? $this->config['model'] ?? 'gpt-4o-mini';

        $response = $this->request('/v1/chat/completions', [
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => $options['system'] ?? 'You are a helpful AI that writes clear, high-quality text.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => $options['temperature'] ?? 0.7,
            'max_tokens' => $options['max_tokens'] ?? null,
        ]);

        return Arr::get($response, 'choices.0.message.content', '');
    }

    /** @return array<float> */
    public function embed(string $text, array $options = []): array
    {
        $model = $options['embedding_model'] ?? $this->config['embedding_model'] ?? 'text-embedding-3-small';

        $response = $this->request('/v1/embeddings', [
            'model' => $model,
            'input' => $text,
        ]);

        return Arr::get($response, 'data.0.embedding', []);
    }

    /**
     * @param array<string,mixed> $payload
     * @return array<string,mixed>
     */
    protected function request(string $path, array $payload): array
    {
        $baseUrl = rtrim($this->config['base_url'] ?? 'https://api.openai.com', '/');
        $key = $this->config['key'] ?? null;
        $timeout = (int) ($this->config['timeout'] ?? 30);

        $response = Http::withToken($key)
            ->timeout($timeout)
            ->baseUrl($baseUrl)
            ->acceptJson()
            ->asJson()
            ->post($path, $payload);

        $response->throw();

        return $response->json() ?? [];
    }
}


