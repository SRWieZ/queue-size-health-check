<?php

namespace Tests;

use Illuminate\Support\Facades\Schema;
use Spatie\Health\HealthServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            HealthServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        Schema::dropAllTables();

        $migration = include __DIR__.'/../vendor/spatie/laravel-health/database/migrations/create_health_tables.php.stub';
        $migration->up();
    }

    public function refreshServiceProvider(): void
    {
        (new HealthServiceProvider($this->app))->packageBooted();
    }
}
