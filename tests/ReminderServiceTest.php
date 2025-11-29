<?php

namespace BeFuture\ScheduledReminders\Tests;

use BeFuture\ScheduledReminders\Models\Reminder;
use BeFuture\ScheduledReminders\Services\ReminderService;
use Illuminate\Support\Str;

class ReminderServiceTest extends TestCase
{
    /** @test */
    public function it_returns_due_reminders()
    {
        Reminder::create([
            'id' => (string) Str::uuid(),
            'title' => 'Test reminder',
            'message' => 'Test message',
            'channel' => 'email',
            'scheduled_at' => now()->subMinute(),
            'is_sent' => false,
        ]);

        $service = $this->app->make(ReminderService::class);

        $this->assertCount(1, $service->dueReminders());
    }

    /** @test */
    public function console_command_runs_successfully()
    {
        // Komut register olmuş mu ve çalışıyor mu görelim
        $this->artisan('scheduled-reminders:send')
            ->assertExitCode(0);
    }
}