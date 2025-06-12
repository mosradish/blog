<x-app-layout>
    <x-slot name="header">
        <h2 class="w-full place-content-center text-center text-xl font-semibold text-gray-800">投稿の編集</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block">タイトル</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" class="w-full border rounded">
            </div>

            <div class="mb-4">
                <label class="block">本文</label>
                <textarea name="body" class="w-full border rounded">{{ old('body', $post->body) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block">画像</label>
                <input type="file" name="image">
                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" class="w-32 mt-2">
                @endif
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">更新</button>
        </form>
    </div>
</x-app-layout>
