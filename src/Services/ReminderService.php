<?php

namespace BeFuture\ScheduledReminders\Services;

use BeFuture\ScheduledReminders\Models\Reminder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ReminderService
{
    public function create(array $data): Reminder
    {
        if (! isset($data['id'])) {
            $data['id'] = (string) Str::uuid();
        }

        return Reminder::query()->create($data);
    }

    public function dueReminders(): Collection
    {
        return Reminder::query()
            ->where('is_sent', false)
            ->where('scheduled_at', '<=', now())
            ->get();
    }

    public function markAsSent(Reminder $reminder): void
    {
        $reminder->update(['is_sent' => true]);
    }
}