<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">投稿詳細</h2>
    </x-slot>

    <div class="p-6 max-w-full px-[10%] mx-auto">
        <h3 class="text-2xl font-bold">{{ $post->title }}</h3>
        <p class="text-sm text-gray-500 mb-4">投稿者: {{ $post->user->name }}</p>
        
        <p class="mb-4">{{ $post->body }}</p>

        @if ($post->image_path)
            <img src="{{ asset('storage/' . $post->image_path) }}" class="max-w-[50%] max-h-64 mx-auto my-4">
        @endif

        <a href="{{ route('posts.index') }}" class="text-blue-600 underline hover:opacity-75">← 一覧に戻る</a>
    </div>

    <hr class="my-6">

    @auth
        <div class="m-4 w-[80%] mx-[10%]">
            @if ($post->isLikedBy(auth()->user()))
                <form action="{{ route('posts.unlike', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 border-b border-transparent hover:border-red-500 transition duration-150">♥ いいね取り消し</button>
                </form>
            @else
                <form action="{{ route('posts.like', $post) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-500 border-b border-transparent hover:border-gray-500 transition duration-150">♡ いいね</button>
                </form>
            @endif
        </div>
    @endauth

    <div class="flex_box max-w-full px-[10%] mx-auto">
        <h2 class="text-2xl font-bold mb-4">
            コメント {{ $post->comments_count ?: '-' }}件 いいね {{ $post->likes_count ?: '-' }}件
        </h2>
    </div>


    @foreach ($post->comments as $comment)
        <div class="border rounded p-2 mb-2 w-[80%] mx-[10%] mx-auto">
            <!-- \nを<br>タグに変換 -->
            <p>{!! nl2br(e($comment->body)) !!}</p>
            <small>投稿者: {{ $comment->user->name }} | {{ $comment->created_at->diffForHumans() }}</small>

            @if (auth()->id() === $comment->user_id)
                <div class="flex space-x-2 mt-2">

                    <!-- ボタンレイアウト -->
                    <a href="{{ route('comments.edit', $comment) }}" class="inline-flex items-center bg-blue-500 text-white mr-2 px-4 py-2 rounded hover:underline">編集</a>

                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <!-- ボタンレイアウト -->
                        <button type="submit" class="inline-flex items-center bg-red-500 text-white px-4 py-2 rounded hover:underline" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>

                </div>
            @endif

        </div>
    @endforeach

    @auth
        <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-4">
            @csrf
            <textarea name="body" rows="3" class="w-[80%] mx-[10%] border rounded p-2" placeholder="コメントを書く..."></textarea>
            <div class="py-5 max-w-full px-[10%] mx-auto">
                <button type="submit" class="inline-flex items-center bg-blue-500 text-white px-4 py-2 rounded hover:underline">投稿</button>
            </div>
        </form>
    @else
        <p class="pb-4 w-[80%] mx-[10%] mt-4 text-sm text-gray-600">コメントを投稿するにはログインしてください。</p>
    @endauth


</x-app-layout>

