<?php

namespace Omarelnaghy\LaravelAICopilot\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Omarelnaghy\LaravelAICopilot\Providers\AIServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [AIServiceProvider::class];
    }
}


