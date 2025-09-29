# Laravel AI Copilot

Plug-and-play unified AI API for Laravel 11. Swap providers (OpenAI, Anthropic, Ollama) with config and call one Facade: `AI::`.

## Installation

```bash
composer require omarelnaghy/laravel-ai-copilot
php artisan vendor:publish --tag=ai-config
```

Set environment variables:

```bash
OPENAI_KEY=sk-...
AI_DRIVER=openai
```

## Usage

```php
use Omarelnaghy\LaravelAICopilot\Facades\AI;

$summary = AI::summarize($article->body);
$reply   = AI::chat('Explain Laravel in 3 sentences');
$seo     = AI::generate("Meta description for: {$product->name}");
```

## Config

See `config/ai.php` for providers and defaults.

## Testing

```bash
composer install
composer test
```

## Roadmap

- Anthropic and Ollama drivers
- Embeddings + Vector search (pgvector, Pinecone, Qdrant)
- Retries, circuit breaker, middleware
- File summarization, image generation, OCR
- Memory, dashboards

License: MIT
