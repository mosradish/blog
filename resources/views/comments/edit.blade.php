<x-app-layout>
    <x-slot name="header">
        <h2 class="w-full place-content-center text-center font-semibold text-xl text-gray-800 dark:text-gray-200">
            コメント編集
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-8">
        <form action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="body" class="block text-gray-700 dark:text-gray-100">コメント</label>
                <textarea name="body" id="body" rows="4" class="w-full border rounded p-2 dark:text-gray-800" required>{{ old('body', $comment->body) }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white mr-2 px-4 py-2 rounded">更新する</button>
            <a href="{{ route('posts.show', $comment->post_id) }}"
                class="inline-flex items-center bg-blue-500 text-white ml-2 px-4 py-2 rounded hover:underline hover:bg-blue-600 dark:hover:bg-blue-600">
                戻る
            </a>
        </form>
    </div>
</x-app-layout>
