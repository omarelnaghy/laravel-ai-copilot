<?php

namespace Omarelnaghy\LaravelAICopilot\Providers;

use Illuminate\Support\ServiceProvider;
use Omarelnaghy\LaravelAICopilot\Support\AIManager;

class AIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/ai.php', 'ai');

        $this->app->singleton(AIManager::class, function ($app) {
            return new AIManager($app['config']['ai'] ?? []);
        });

        $this->app->alias(AIManager::class, 'ai');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/ai.php' => config_path('ai.php'),
        ], 'ai-config');
    }
}


