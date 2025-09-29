<?php

namespace Omarelnaghy\LaravelAICopilot\Helpers;

class PromptTemplates
{
    public static function summarizeBullets(): string
    {
        return 'Summarize the following text concisely in 3-5 bullet points:';
    }

    public static function seoMetaDescription(): string
    {
        return 'Write a compelling SEO meta description (150-160 chars):';
    }
}


