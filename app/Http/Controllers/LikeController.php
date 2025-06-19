<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $user = Auth::user();

        if (!$post->isLikedBy($user)) {
            $post->likes()->create(['user_id' => $user->id]);
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'like_created',
            'description' => "ブログ「{$post->title}」にいいねしました。",
        ]);

        return back();
    }

    public function destroy(Post $post)
    {
        $user = Auth::user();

        $post->likes()->where('user_id', $user->id)->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'like_deleted',
            'description' => "ブログ「{$post->title}」のいいねを取り消しました。",
        ]);

        return back();
    }
}
