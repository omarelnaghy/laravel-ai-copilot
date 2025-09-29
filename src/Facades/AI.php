<?php

namespace Omarelnaghy\LaravelAICopilot\Facades;

use Illuminate\Support\Facades\Facade;
use Omarelnaghy\LaravelAICopilot\Support\AIManager;

/**
 * @method static string chat(string $message, array $options = [])
 * @method static string summarize(string $text, array $options = [])
 * @method static string generate(string $prompt, array $options = [])
 * @method static array embed(string $text, array $options = [])
 * @method static mixed search(string|array $query, array $options = [])
 * @method static string translate(string $text, string|array $to, array $options = [])
 * @see AIManager
 */
class AI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ai';
    }
}


