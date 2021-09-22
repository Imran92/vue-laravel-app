<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;
    protected function assertException(string $expectClass, callable $callback)
    {
        try {
            $callback();
        } catch (\Throwable $exception) {
            $this->assertInstanceOf($expectClass, $exception, 'An invalid exception was thrown');
            return;
        }

        $this->fail('No exception was thrown');
    }
}
