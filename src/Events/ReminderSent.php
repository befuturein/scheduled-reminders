<?php

namespace BeFuture\ScheduledReminders\Events;

use BeFuture\ScheduledReminders\Models\Reminder;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReminderSent
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public Reminder $reminder
    ) {
    }
}