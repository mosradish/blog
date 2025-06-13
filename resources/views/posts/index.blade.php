<x-app-layout>
    <x-slot name="header">
        <h2 class="w-full place-content-center text-center font-semibold text-xl text-gray-800 dark:text-white">投稿一覧</h2>
    </x-slot>

    <div class="w-full px-[10%] mx-auto pb-4 bg-white dark:bg-gray-900 text-gray-800 dark:text-white">

        @auth
            <a href="{{ route('posts.create') }}"
                class="block w-24 bg-blue-500 text-white px-4 py-2 my-4 rounded hover:underline hover:bg-blue-600 dark:hover:bg-blue-600">
                新規投稿
            </a>
        @endauth

        @foreach($posts as $post)
            <div class="mt-2 p-4 border-4 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800">
                <h3 class="text-lg font-bold">
                    <a href="{{ route('posts.show', $post) }}"
                        class="text-blue-600 dark:text-blue-400 underline hover:opacity-80">
                        {{ $post->title }}
                    </a>
                </h3>

                <div class="text-gray-600 dark:text-gray-300 text-sm mx-2px">
                    コメント {{ $post->comments_count ?: '-' }}件 いいね {{ $post->likes_count ?: '-' }}件
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    投稿者：{{ $post->user->name }}
                </p>

                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}"
                        alt="サムネイル画像"
                        class="w-40 h-30 object-cover rounded mt-2">
                @endif

                <p class="mt-2 py-4 text-gray-800 dark:text-gray-100">{!! nl2br(e($post->body)) !!}</p>

                @auth
                    @if ($post->user_id === Auth::id())
                        <a href="{{ route('posts.edit', $post) }}"
                            class="inline-flex items-center bg-blue-500 text-white mr-2 px-4 py-2 rounded hover:underline hover:bg-blue-600 dark:hover:bg-blue-600">
                            編集
                        </a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center bg-red-500 text-white px-4 py-2 rounded hover:underline hover:bg-red-600 dark:hover:bg-red-600"
                                    onclick="return confirm('本当に削除しますか？')">
                                削除
                            </button>
                        </form>
                    @endif
                @endauth

                <p class="text-sm text-gray-600 dark:text-gray-400 text-right">
                    {{ $post->created_at->format('Y/m/d H:i') }}
                </p>
            </div>
        @endforeach
    </div>
</x-app-layout>
