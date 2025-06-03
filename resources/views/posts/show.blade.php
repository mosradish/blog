<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">投稿詳細</h2>
    </x-slot>

    <div class="p-6">
        <h3 class="text-2xl font-bold">{{ $post->title }}</h3>
        <p class="text-sm text-gray-500 mb-4">投稿者: {{ $post->user->name }}</p>
        
        <p class="mb-4">{{ $post->body }}</p>

        @if ($post->image_path)
            <img src="{{ asset('storage/' . $post->image_path) }}" class="w-64 mb-4">
        @endif

        <a href="{{ route('posts.index') }}" class="text-blue-500 underline">← 一覧に戻る</a>
    </div>

    <hr class="my-6">

    <div class="flex_box">
        <h4 class="text-lg font-semibold mb-2">コメント</h4>
        <h2 class="text-2xl font-bold mb-4">
            コメント（{{ $post->comments_count > 0 ? $post->comments_count . '件' : '-' }}件）
        </h2>
    </div>


    @foreach ($post->comments as $comment)
        <div class="border rounded p-2 mb-2">
            <p>{{ $comment->body }}</p>
            <small>投稿者: {{ $comment->user->name }} | {{ $comment->created_at->diffForHumans() }}</small>

            @if (auth()->id() === $comment->user_id)
                <div class="flex space-x-2 mt-2">
                    <a href="{{ route('comments.edit', $comment) }}" class="text-blue-500 hover:underline">編集</a>

                    <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('本当に削除しますか？')" class="text-red-500 hover:underline">削除</button>
                    </form>
                </div>
            @endif

        </div>
    @endforeach

    @auth
        <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-4">
            @csrf
            <textarea name="body" rows="3" class="w-full border rounded p-2" placeholder="コメントを書く..."></textarea>
            <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">投稿</button>
        </form>
    @else
        <p class="mt-4 text-sm text-gray-600">コメントを投稿するにはログインしてください。</p>
    @endauth



</x-app-layout>

