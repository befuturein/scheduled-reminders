<?php

namespace BeFuture\ScheduledReminders\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Reminder extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'message',
        'channel',
        'scheduled_at',
        'is_sent',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'is_sent' => 'boolean',
    ];
}