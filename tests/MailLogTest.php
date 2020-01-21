<?php

namespace Gabrieliuga\LaravelMailLog\Tests;

use Giuga\LaravelMailLog\Models\MailLog;
use Giuga\LaravelMailLog\Tests\TestCase;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Mail\Message;

class MailLogTest extends TestCase
{
    /** @test */
    public function testMailEventIsRegistered()
    {
        $this->assertArrayHasKey('Giuga\LaravelMailLog\MailEventServiceProvider', $this->app->getLoadedProviders());
    }

    /** @test */
    public function testMailEventCatch()
    {
        $swiftMessage = new \Swift_Message('Test Subject', 'Test Content');
        $swiftMessage->addTo('test@example.com');
        $swiftMessage->addBcc('test_bcc@example.com');
        $swiftMessage->addCc('test_cc@example.com');
        event(new MessageSent($swiftMessage, []));

        $this->assertEquals(1, MailLog::all()->count());
        $this->assertEquals('test@example.com', MailLog::first()->to);
        $this->assertEquals('test_bcc@example.com', MailLog::first()->bcc);
        $this->assertEquals('test_cc@example.com', MailLog::first()->cc);
    }
}
