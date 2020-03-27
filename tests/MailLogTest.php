<?php

namespace Gabrieliuga\LaravelMailLog\Tests;

use Carbon\Carbon;
use Giuga\LaravelMailLog\Models\MailLog;
use Giuga\LaravelMailLog\Tests\TestCase;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Artisan;

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
        $swiftMessage->setId('a300a4ca2fd6853ee1763ce5dbe4ab9e@swift.generated');
        event(new MessageSent($swiftMessage, []));

        $this->assertEquals(1, MailLog::all()->count());
        $this->assertEquals('test@example.com', MailLog::first()->to);
        $this->assertEquals('test_bcc@example.com', MailLog::first()->bcc);
        $this->assertEquals('test_cc@example.com', MailLog::first()->cc);
        $this->assertEquals('a300a4ca2fd6853ee1763ce5dbe4ab9e@swift.generated', MailLog::first()->message_id);
    }

    /** @test */
    public function testMailImageAttached()
    {
        $swiftMessage = new \Swift_Message('Test Subject', 'Test Content');
        $swiftMessage->addTo('test@example.com');
        $swiftMessage->addBcc('test_bcc@example.com');
        $swiftMessage->addCc('test_cc@example.com');
        $newMsg = new Message($swiftMessage);

        $newMsg->setBody('<div>TextContent<img src="'.$newMsg->embed(__DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'test.png').'" /></div>');
        event(new MessageSent($newMsg->getSwiftMessage(), []));

        $this->assertEquals(1, MailLog::all()->count());
        $model = MailLog::first();
        $this->assertEquals('test@example.com', $model->to);
        $this->assertEquals('test_bcc@example.com', $model->bcc);
        $this->assertEquals('test_cc@example.com', $model->cc);
        $this->assertStringContainsString('<img src="data:image/png;base64,', $model->message);
        $this->assertStringNotContainsString('cid:', $model->message);
    }

    /** @test */
    public function testPurgeCommand()
    {
        MailLog::truncate();
        for ($x = 0; $x < 100; $x++) {
            MailLog::create([
                'to' => $x.'example@test.com',
                'created_at' => Carbon::now()->subDays($x),
            ]);
        }
        $this->assertEquals(100, MailLog::all()->count());
        $this->assertEquals(7, config('mail-log.purge_after'));
        $this->assertEquals(true, config('mail-log.purge'));

        Artisan::call('giuga:purge-mail-log');
        $this->assertLessThan(10, MailLog::all()->count());
    }
}
