<?php

namespace Kauffinger\OnOfficeApi\Tests;

use Kauffinger\OnOfficeApi\OnOfficeApiServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            OnOfficeApiServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_onoffice-laravel-adapter_table.php.stub';
        $migration->up();
        */
    }
}
