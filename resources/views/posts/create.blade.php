<x-app-layout>
    <x-slot name="header">
        <h2 class="w-full place-content-center text-center font-semibold text-xl text-gray-800">新規投稿</h2>
    </x-slot>

    <div class="p-6 w-[80%] mx-[10%]">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block">タイトル</label>
                <input type="text" name="title" class="w-full border rounded" value="{{ old('title') }}">
                @error('title') <div class="text-red-500">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="block">本文</label>
                <textarea name="body" class="w-full border rounded">{{ old('body') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block">画像（任意）</label>
                <input type="file" name="image">
                @error('image') <div class="text-red-500">{{ $message }}</div> @enderror
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">投稿</button>
        </form>
    </div>
</x-app-layout>
