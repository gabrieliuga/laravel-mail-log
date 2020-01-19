<?php

namespace Giuga\LaravelMailLog;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Giuga\LaravelMailLog\LaravelMailLog
 */
class LaravelMailLogFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-mail-log';
    }
}
