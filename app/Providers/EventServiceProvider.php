<?php

namespace App\Providers;

use App\Services\ActivityLogger;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Event::listen(Login::class, function (Login $event) {
            $user = $event->user;
            ActivityLogger::log(
                'auth',
                'login',
                'Login ke sistem',
                null,
                null,
                null,
                'info',
                $user ? ($user->nama ?? $user->email ?? 'User') : 'User',
                $user
            );
        });

        Event::listen(Logout::class, function (Logout $event) {
            $user = $event->user;
            if (!$user) return;
            ActivityLogger::log(
                'auth',
                'logout',
                'Keluar (logout) dari sistem',
                null,
                null,
                null,
                'info',
                $user->nama ?? $user->email ?? 'User',
                $user
            );
        });

        Event::listen(Failed::class, function (Failed $event) {
            $email = $event->credentials['email'] ?? ($event->credentials['username'] ?? 'unknown');
            ActivityLogger::log(
                'auth',
                'login_failed',
                "Percobaan login gagal untuk akun: {$email}",
                null,
                null,
                ['email' => $email],
                'warning',
                $email,
                $event->user
            );
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
