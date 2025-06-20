<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\ActivityLog;

class LogRegisteredUser
{
    public function handle(Registered $event)
    {
        ActivityLog::create([
            'user_id' => $event->user->id,
            'action' => 'User Registered',
            'description' => '新規ユーザー登録が完了しました。',
        ]);
    }
}

