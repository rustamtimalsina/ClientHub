# ClientHub

A client portal built with Laravel, where clients can track their project's progress, milestones, files, and invoices — and admins can manage all of it without touching the database directly.

## Features

### Client Side
- Login / logout with "remember me"
- Forgot password / reset password via email
- Account settings (update name, change password)
- Dashboard showing project status, progress bar, and key dates
- Support for multiple projects per client, with a project switcher
- View and mark milestones as complete
- Download project files
- Download invoices as PDF

### Admin Side
- Overview dashboard with key stats (total clients, total projects, revenue collected, outstanding amount, project status breakdown)
- Full create / edit / delete for projects
- Full create / edit / delete for milestones
- Full create / edit / delete for invoices
- Create client accounts (auto-sends a welcome email)
- Upload and manage project files
- Search and filter projects by name or client

### Notifications
Emails are sent automatically for:
- New client account created
- Password reset requested
- New invoice added
- Milestone marked complete

## Tech Stack
- **Backend:** Laravel 12 (PHP 8.4)
- **Database:** SQLite
- **PDF generation:** barryvdh/laravel-dompdf
- **Templating:** Blade
- **Testing:** Pest

## Getting Started

### 1. Install dependencies
```bash
composer install
```

### 2. Set up environment
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Run migrations
```bash
php artisan migrate
```

### 4. Create an admin user
```bash
php artisan tinker
```
```php
$user = App\Models\User::factory()->create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => bcrypt('password123'),
    'role' => 'admin',
]);
```

### 5. Start the server
```bash
php artisan serve
```
Visit `http://127.0.0.1:8000`.

### Note on emails
By default, `MAIL_MAILER` is set to `log` in `.env` — emails are written to `storage/logs/laravel.log` instead of actually being sent, which is fine for local development and testing. Switch to a real mail driver (like Mailtrap or SMTP) before using this in production.

## Running Tests
```bash
php artisan test
```

## Project Structure Notes
- `app/Http/Controllers/Admin/` — all admin-only controllers (protected by the `admin` role middleware)
- `app/Mail/` — email classes for the 4 notification types
- `resources/views/admin/` — admin panel views
- `resources/views/emails/` — email templates