<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
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

        return back();
    }

    public function destroy(Post $post)
    {
        $user = Auth::user();

        $post->likes()->where('user_id', $user->id)->delete();

        return back();
    }
}
