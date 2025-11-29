<?php

namespace BeFuture\ScheduledReminders\Console;

use Illuminate\Console\Command;
use BeFuture\ScheduledReminders\Services\ReminderService;
use BeFuture\ScheduledReminders\Events\ReminderSent;

class SendDueRemindersCommand extends Command
{
    protected $signature = 'scheduled-reminders:send';
    protected $description = 'Send all due reminders.';

    public function handle(ReminderService $service): int
    {
        $due = $service->dueReminders();

        foreach ($due as $reminder) {
            event(new ReminderSent($reminder));
            $service->markAsSent($reminder);
        }

        $this->info("Processed {$due->count()} reminders.");

        return self::SUCCESS;
    }
}