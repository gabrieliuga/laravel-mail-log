<?php

namespace Giuga\LaravelMailLog\Tests;

use Giuga\LaravelMailLog\LaravelMailLogServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelMailLogServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpDatabase($app)
    {
        Schema::dropAllTables();

        include_once __DIR__.'/../database/migrations/2020_01_12_215032_create_mail_log_tables.php';

        (new \CreateMailLogTables())->up();

        $app['db']->connection()->getSchemaBuilder()->create('test_model_a', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
        });

        $app['db']->connection()->getSchemaBuilder()->create('test_model_b', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
        });
    }
}
