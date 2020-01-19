<?php

namespace Gabrieliuga\LaravelMailLog\Tests;

use Giuga\LaravelMailLog\Models\MailLog;
use Giuga\LaravelMailLog\Tests\FakeEmailClass;
use Giuga\LaravelMailLog\Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class MailLogTest extends TestCase
{
    /** @test */
    public function testMailEventIsRegistered()
    {
        $this->assertArrayHasKey('Giuga\LaravelMailLog\MailEventServiceProvider', $this->app->getLoadedProviders());
    }
}
