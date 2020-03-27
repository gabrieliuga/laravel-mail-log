<?php

namespace Giuga\LaravelMailLog\Listeners;

use Giuga\LaravelMailLog\Models\MailLog;
use Giuga\LaravelMailLog\Traits\Occurrable;
use Giuga\LaravelMailLog\Traits\Recipientable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Log;

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
     * @param MessageSent $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        try {
            $msg = $event->message;
            $parts = $msg->getChildren();
            $body = $event->message->getBody();
            if (! empty($parts)) {
                foreach ($parts as $part) {
                    if (stripos($part->getBodyContentType(), 'image') !== false) {
                        $ptr = str_replace("\n", '', trim(str_replace($part->getHeaders(), '', $part->toString())));
                        $body = str_replace('cid:'.$part->getId(), 'data:'.$part->getBodyContentType().';base64,'.$ptr, $body);
                    }
                }
            }

            $to = $event->message->getTo() ?? [];
            $cc = $event->message->getCc() ?? [];
            $bcc = $event->message->getBcc() ?? [];
            $data = [
                'to' => implode(', ', is_array($to) ? array_keys($to) : $to),
                'cc' => implode(', ', is_array($cc) ? array_keys($cc) : $cc),
                'bcc' => implode(', ', is_array($bcc) ? array_keys($bcc) : $bcc),
                'subject' => $event->message->getSubject(),
                'message' => $body,
                'data' => [],
            ];
            $log = MailLog::create($data);

            $occuredEntity = $event->data[Occurrable::getOccuredEntityKey()] ?? null;
            $occuredProcess = $event->data[Occurrable::getOccuredProcessKey()] ?? null;

            if ($occuredEntity && $occuredEntity instanceof Model) {
                $log->occurredEntity()->associate($occuredEntity)->save();
            }

            if ($occuredProcess && $occuredProcess instanceof Model) {
                $log->occurredProcess()->associate($occuredProcess)->save();
            }

            $recipient = $event->data[Recipientable::getRecipientKey()] ?? null;

            if ($recipient && $recipient instanceof Model) {
                $log->recipient()->associate($recipient)->save();
            }
        } catch (\Throwable $e) {
            Log::debug('Failed to save mail log ['.$e->getMessage().']');
        }
    }
}
