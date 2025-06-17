<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\ActivityLog;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        ActivityLog::create([
            'user_id' => $event->user->id,
            'action' => 'User Logged In',
            'description' => $event->user->name . 'がログインしました。',
        ]);
    }
}

