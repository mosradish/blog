<x-app-layout>
    <x-slot name="header">
        <div class="h-16">
            <h2 class="font-semibold text-xl text-gray-800">投稿一覧</h2>
        </div>
    </x-slot>
    <div class="w-full px-[10%] mx-auto pb-4">
        @auth
            <a href="{{ route('posts.create') }}" class="inline-flex items-center bg-blue-500 text-white px-4 py-2 mb-2 rounded hover:underline">新規投稿</a>
        @endauth

        @foreach($posts as $post)
            <div class="mt-2 p-4 border-4 rounded">
                <h3 class="text-lg font-bold">
                    <a href="{{ route('posts.show', $post) }}" class="text-blue-600 underline">{{ $post->title }}</a>
                </h3>
                <p class="text-gray-600 text-sm">
                    コメント {{ $post->comments_count ?: '-' }}件
                </p>
                <p class="text-gray-600 text-sm">
                    いいね {{ $post->likes_count ?: '-' }}件
                </p>
                <p class="text-sm text-gray-600">by {{ $post->user->name }} at {{ $post->created_at->format('Y/m/d H:i') }}</p>
                <!-- 画像関連処理 -->
                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="サムネイル画像" class="w-40 h-30 object-cover rounded">
                @endif
                <p class="mt-2 py-4">{{ $post->body }}</p>
                @auth
                    @if ($post->user_id === Auth::id())
                        <!-- ボタンレイアウト -->
                        <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center bg-blue-500 text-white mr-2 px-4 py-2 rounded hover:underline">編集</a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <!-- ボタンレイアウト -->
                            <button type="submit" class="inline-flex items-center bg-red-500 text-white px-4 py-2 rounded hover:underline" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>
</x-app-layout>
