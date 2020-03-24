<?php

namespace Giuga\LaravelMailLog\Models;

use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    protected $table = 'mail_log';
    protected $guarded = [];
    protected $casts = [
        'data' => 'array',
    ];

    public function occurredProcess() {
        return $this->morphTo();
    }

    public function occurredEntity() {
        return $this->morphTo();
    }

}
