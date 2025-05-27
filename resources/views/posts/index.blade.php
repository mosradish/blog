<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">投稿一覧</h2>
    </x-slot>

    <div class="p-6">
        @auth
            <a href="{{ route('posts.create') }}" class="text-blue-500 underline">新規投稿</a>
        @endauth

        @foreach($posts as $post)
            <div class="mt-4 p-4 border rounded">
            <h3 class="text-lg font-bold">
                <a href="{{ route('posts.show', $post) }}" class="text-blue-600 underline">{{ $post->title }}</a>
            </h3>
                <p class="text-sm text-gray-600">by {{ $post->user->name }} at {{ $post->created_at->format('Y/m/d H:i') }}</p>
                @if($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" class="mt-2 max-w-xs">
                @endif
                <p class="mt-2">{{ $post->body }}</p>
                @auth
                    @if ($post->user_id === Auth::id())
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-500 mr-2">編集</a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>
</x-app-layout>
