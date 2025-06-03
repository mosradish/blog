<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

         // コメント作成時に user_id を明示的に設定
        $comment = new Comment([
            'body' => $request->body,
        ]);
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->route('posts.show', $post)->with('success', 'コメントを投稿しました');
    }

    public function destroy(Comment $comment)
    {
        // ログインユーザー本人のみ削除可能
        if (auth()->id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'コメントを削除する権限がありません。');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'コメントを削除しました。');
    }

    public function edit(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'コメントを編集する権限がありません。');
        }

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'コメントを編集する権限がありません。');
        }

        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->body = $request->body;
        $comment->save();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'コメントを更新しました。');
    }

}

