# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- (Placeholder) Future improvements and new features will be listed here.

## [v0.1.0] - 2025-11-29

### Added
- Initial public release of **BeFuture Scheduled Reminders**.
- Laravel-ready package structure (PSR-4 autoload, service provider, config, migrations).
- `Reminder` model with UUID primary key and basic fields (`title`, `message`, `channel`, `scheduled_at`, `is_sent`).
- `ReminderService` for creating reminders, resolving due reminders, and marking them as sent.
- `scheduled-reminders:send` console command for processing due reminders via the scheduler.
- `ReminderSent` event to hook into custom notification channels (email, SMS, push, database, etc.).
- Publishable configuration file (`scheduled-reminders.php`) and migration for the `reminders` table.
- PHPUnit + Orchestra Testbench integration with a basic test suite.