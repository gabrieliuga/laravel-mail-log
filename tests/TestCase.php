<?php

namespace Giuga\LaravelMailLog\Tests;

use Giuga\LaravelMailLog\LaravelMailLogServiceProvider;
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
        include_once __DIR__.'/../database/migrations/2020_01_22_215032_change_message_column.php';
        include_once __DIR__.'/../database/migrations/2020_03_23_211950_alter_mail_log_table_add_occurred_columns.php';
        include_once __DIR__.'/../database/migrations/2020_03_27_135120_alter_mail_log_table_add_message_id_column.php';

        (new \CreateMailLogTables())->up();
        (new \ChangeMessageColumn())->up();
        (new \AlterMailLogTableAddOccurredColumns())->up();
        (new \AlterMailLogTableAddMessageIdColumn())->up();
    }
}
