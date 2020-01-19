<?php

namespace Gabrieliuga\LaravelMailLog\Tests;

use Giuga\LaravelMailLog\Tests\TestCase;

class MailLogTest extends TestCase
{
    /** @test */
    public function testMailEventIsRegistered()
    {
        $this->assertArrayHasKey('Giuga\LaravelMailLog\MailEventServiceProvider', $this->app->getLoadedProviders());
    }
}
