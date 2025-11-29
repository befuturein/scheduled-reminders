<?php

namespace BeFuture\ScheduledReminders;

use Illuminate\Support\ServiceProvider;
use BeFuture\ScheduledReminders\Services\ReminderService;

class ScheduledRemindersServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/scheduled-reminders.php',
            'scheduled-reminders'
        );

        $this->app->singleton(ReminderService::class, function () {
            return new ReminderService();
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/scheduled-reminders.php' => config_path('scheduled-reminders.php'),
        ], 'scheduled-reminders-config');

        if (! class_exists('CreateRemindersTable')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations'),
            ], 'scheduled-reminders-migrations');
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\SendDueRemindersCommand::class,
            ]);
        }
    }
}