<?php

namespace Omarelnaghy\LaravelAICopilot\Contracts;

interface DriverContract
{
    /**
     * Send a chat message and return the model response.
     */
    public function chat(string $message, array $options = []): string;

    /**
     * Summarize the given text.
     */
    public function summarize(string $text, array $options = []): string;

    /**
     * Generate text for a given prompt.
     */
    public function generate(string $prompt, array $options = []): string;

    /**
     * Create an embedding vector for the given text.
     *
     * @return array<float>
     */
    public function embed(string $text, array $options = []): array;
}


