<?php

use Omarelnaghy\LaravelAICopilot\Facades\AI;

// Example snippets to try inside a Laravel app tinker/artisan context

$summary = AI::summarize('Laravel is a web application framework with expressive, elegant syntax...');
echo $summary."\n";

$reply = AI::chat('Explain Laravel in 3 sentences');
echo $reply."\n";

$seo = AI::generate('Meta description for: Laravel AI Copilot package');
echo $seo."\n";


