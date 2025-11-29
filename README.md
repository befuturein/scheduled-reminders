# BeFuture Scheduled Reminders

[![Tests](https://github.com/befuturein/scheduled-reminders/actions/workflows/tests.yml/badge.svg)](https://github.com/befuturein/scheduled-reminders/actions/workflows/tests.yml)

BeFuture Scheduled Reminders is a simple, extensible, and reliable scheduled reminder package for Laravel. It stores reminders in the database, processes them when their scheduled time arrives, and dispatches an event so you can send notifications through any channel (email, SMS, push, database, etc.).

## Features

- Create scheduled reminders easily  
- Automatically resolve due reminders  
- Prevent duplicate processing using `is_sent` flag  
- Fully event-driven architecture  
- Publishable config and migrations  
- UUID-based model  
- Service-based API  
- Console command for the scheduler  
- Complete Testbench integration  
- PSR-4 & SOLID compliant structure

## Installation

```bash
composer require befuturein/scheduled-reminders
```

Laravel automatically discovers the service provider.

## Publish Config & Migrations

Run these commands **inside your Laravel application**:

```bash
php artisan vendor:publish --tag=scheduled-reminders-config
php artisan vendor:publish --tag=scheduled-reminders-migrations
php artisan migrate
```

## Configuration

`config/scheduled-reminders.php`:

```php
return [
    'default_channel' => 'email',

    'channels' => [
        'email',
        'database',
        'sms',
    ],

    'run_interval_minutes' => 5,
];
```

## Scheduler Setup

Add to your scheduler:

```php
// app/Console/Kernel.php

protected function schedule(\Illuminate\Console\Scheduling\Schedule $schedule): void
{
    $schedule->command('scheduled-reminders:send')->everyMinute();
}
```

## Usage (Service API)

### Create a reminder

```php
use BeFuture\ScheduledReminders\Services\ReminderService;

$reminder = app(ReminderService::class)->create([
    'title'        => 'Payment Reminder',
    'message'      => 'Please don’t forget your monthly payment.',
    'channel'      => 'email',
    'scheduled_at' => now()->addMinutes(10),
]);
```

### Fetch due reminders

```php
$due = app(ReminderService::class)->dueReminders();
```

### Mark as sent

```php
app(ReminderService::class)->markAsSent($reminder);
```

## Event System

When a reminder is processed, this event is dispatched:

```php
BeFuture\ScheduledReminders\Events\ReminderSent
```

Example listener:

```php
class LogReminderSent
{
    public function handle(ReminderSent $event)
    {
        logger('Reminder sent', [
            'id' => $event->reminder->id,
        ]);
    }
}
```

## Testing

This package includes full PHPUnit + Orchestra Testbench integration.

Run tests:

```bash
vendor/bin/phpunit
```

### Example TestCase

```php
abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app): array
    {
        return [
            ScheduledRemindersServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
```

## Directory Structure

```
src/
    ScheduledRemindersServiceProvider.php
    Services/
    Models/
    Events/
    Console/

config/
database/
tests/
composer.json
phpunit.xml.dist
README.md
```

## Architecture

- **Namespace:** `BeFuture\ScheduledReminders`  
- **Vendor:** `befuturein`  
- Fully PSR-4 compliant  
- UUID-based primary keys  
- Service container bindings  
- Event-driven flow  
- Config-driven channel architecture  
- Extensible by design for email, SMS, push, queue systems, etc.

## Development

```bash
composer install
vendor/bin/phpunit
```

## License

MIT License.

## About BeFuture Interactive

This package is part of the BeFuture Interactive open-source ecosystem. More packages coming soon.
