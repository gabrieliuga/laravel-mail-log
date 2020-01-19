<?php

return [
    'purge' => env('MAIL_LOG_PURGE', true),
    'purge_after' => env('MAIL_LOG_PURGE_AFTER', 7), //purge entries older than 7 days
];
