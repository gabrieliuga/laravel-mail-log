<?php

namespace Giuga\LaravelMailLog;

use Giuga\LaravelMailLog\Models\MailLog;
use Giuga\LaravelMailLog\Policies\MailLogPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class MailPolicyServiceProvider extends ServiceProvider
{
    protected $policies = [
        MailLog::class => MailLogPolicy::class,
    ];

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
