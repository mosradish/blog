<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // 投稿一覧表示
    public function index()
    {
        $posts = Post::with(['user'])
            ->withCount(['comments', 'likes'])
            ->latest()
            ->get();
        return view('posts.index', compact('posts'));
    }

    // 投稿作成フォーム
    public function create()
    {
        return view('posts.create');
    }

    // 投稿保存
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
            'image_path' => $path,
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'post_created',
            'description' => "ブログ「{$post->title}」を投稿しました。",
        ]);

        return redirect()->route('posts.index')->with('success', '投稿が作成されました');
    }

    // 投稿詳細
    public function show(Post $post)
    {
        $post->loadCount('comments', 'likes'); // ← コメント数を追加で読み込む
        $post->load(['comments']); // コメントを取得
        return view('posts.show', compact('post'));
    }

    // 編集フォーム
    public function edit(Post $post)
    {
        // 投稿者本人でなければ403エラー
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        return view('posts.edit', compact('post'));
    }

    // 更新処理
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'body' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $post->image_path;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image_path' => $path,
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'post_update',
            'description' => "ブログ「{$post->title}」を編集しました。",
        ]);

        return redirect()->route('posts.index')->with('success', '投稿を更新しました');
    }

    // 削除処理
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'post_deleted',
            'description' => "ブログ「{$post->title}」を削除しました。",
        ]);


        return redirect()->route('posts.index')->with('success', '投稿を削除しました');
    }
}