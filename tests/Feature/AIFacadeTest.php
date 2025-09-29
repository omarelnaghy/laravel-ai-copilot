<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Omarelnaghy\LaravelAICopilot\Facades\AI;

it('can chat via OpenAI driver', function () {
    Config::set('ai.default', 'openai');
    Config::set('ai.providers.openai', [
        'key' => 'test-key',
        'model' => 'gpt-4o-mini',
        'base_url' => 'https://api.openai.com',
    ]);

    Http::fake([
        'https://api.openai.com/*' => Http::response([
            'choices' => [
                ['message' => ['content' => 'Hello from OpenAI']]
            ]
        ], 200),
    ]);

    $reply = AI::chat('Say hello');

    expect($reply)->toBe('Hello from OpenAI');
});

it('can summarize via OpenAI driver', function () {
    Config::set('ai.default', 'openai');
    Config::set('ai.providers.openai', [
        'key' => 'test-key',
        'model' => 'gpt-4o-mini',
        'base_url' => 'https://api.openai.com',
    ]);

    Http::fake([
        'https://api.openai.com/*' => Http::response([
            'choices' => [
                ['message' => ['content' => '• Bullet 1\n• Bullet 2']]
            ]
        ], 200),
    ]);

    $summary = AI::summarize('Long text');

    expect($summary)->toContain('Bullet 1');
});

it('can generate via OpenAI driver', function () {
    Config::set('ai.default', 'openai');
    Config::set('ai.providers.openai', [
        'key' => 'test-key',
        'model' => 'gpt-4o-mini',
        'base_url' => 'https://api.openai.com',
    ]);

    Http::fake([
        'https://api.openai.com/*' => Http::response([
            'choices' => [
                ['message' => ['content' => 'Generated text']]
            ]
        ], 200),
    ]);

    $text = AI::generate('Write something');

    expect($text)->toBe('Generated text');
});


