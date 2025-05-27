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
</x-app-layout>
