<x-app-layout>
    <x-slot name="header">
        <h2 class="w-full place-content-center text-center text-xl font-semibold text-gray-800 dark:text-gray-200">投稿の編集</h2>
    </x-slot>

    <div class="py-6 w-[80%] mx-[10%]">
        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">タイトル</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}"
                    class="w-full border rounded text-gray-900 dark:text-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">本文</label>
                <textarea name="body"
                    class="w-full border rounded text-gray-900 dark:text-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600"
                >{{ old('body', $post->body) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">画像</label>
                <input type="file" name="image" class="text-gray-900 dark:text-gray-100">
                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}"
                        class="w-32 mt-2 rounded border border-gray-300 dark:border-gray-600">
                @endif
            </div>

            <button
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 dark:hover:bg-blue-600 transition-colors"
            >
                更新
            </button>
        </form>
    </div>
</x-app-layout>
