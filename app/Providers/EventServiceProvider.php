<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogRegisteredUser;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    // Login + Register log
    protected $listen = [
        Login::class => [
            LogSuccessfulLogin::class,
        ],
        Registered::class => [
            LogRegisteredUser::class,
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
