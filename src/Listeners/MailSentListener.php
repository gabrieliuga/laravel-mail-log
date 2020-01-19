<?php

namespace Giuga\LaravelMailLog\Listeners;

use Giuga\LaravelMailLog\Models\MailLog;
use Illuminate\Mail\Events\MessageSent;

class MailSentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        $to = $event->message->getTo() ?? [];
        $cc = $event->message->getCc() ?? [];
        $bcc = $event->message->getBcc() ?? [];
        $data = [
            'to' => implode(', ', is_array($to) ? array_keys($to) : $to),
            'cc' => implode(', ', is_array($cc) ? array_keys($cc) : $cc),
            'bcc' => implode(', ', is_array($bcc) ? array_keys($bcc) : $bcc),
            'subject' => $event->message->getSubject(),
            'message' => $event->message->getBody(),
            'data' => [],
        ];
        MailLog::create($data);
    }
}
