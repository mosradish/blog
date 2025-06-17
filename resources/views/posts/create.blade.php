<x-app-layout>
    <x-slot name="header">
        <h2 class="w-full place-content-center text-center font-semibold text-xl text-gray-800 dark:text-gray-200">新規投稿</h2>
    </x-slot>

    <div class="p-6 w-[80%] mx-[10%] bg-gray-100 dark:bg-gray-800 border-2 border-gray-400 dark:border-white rounded shadow">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">タイトル</label>
                <input
                    type="text"
                    name="title"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2"
                    value="{{ old('title') }}"
                >
                @error('title') <div class="text-red-500">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">本文</label>
                <textarea
                    name="body"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2"
                >{{ old('body') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">画像（任意）</label>
                <input id="imageInput" type="file" name="image" class="text-gray-900 dark:text-gray-100" />
                @error('image') <div class="text-red-500">{{ $message }}</div> @enderror

                <!-- 画像プレビュー表示用 -->
                <div class="mt-2">
                    <img id="imagePreview" src="#" alt="画像プレビュー" class="max-w-full max-h-64 hidden rounded border border-gray-300 dark:border-gray-600" />
                </div>
            </div>


            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors">
                投稿
            </button>
        </form>
    </div>
</x-app-layout>
