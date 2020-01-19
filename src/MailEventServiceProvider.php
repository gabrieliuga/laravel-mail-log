<?php

namespace Giuga\LaravelMailLog;

use Giuga\LaravelMailLog\Listeners\MailSentListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Mail\Events\MessageSent;

class MailEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MessageSent::class => [
            MailSentListener::class,
        ],
    ];

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
