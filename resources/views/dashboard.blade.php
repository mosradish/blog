<x-app-layout>
    <x-slot name="header">
        <h2 class="w-full place-content-center text-center font-semibold text-xl text-gray-800 dark:text-white">Dashboard</h2>
    </x-slot>
    <h2 class="w-[80%] mx-[10%] place-content-center text-center font-semibold text-xl text-gray-800 dark:text-white">最近のアクティビティ</h2>
    <ul>
        @foreach($activities as $log)
            <li class="p-4 my-4 w-[80%] mx-[10%] bg-gray-100 dark:bg-gray-800 border-2 border-gray-400 dark:border-white text-gray-900 dark:text-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                {{ $log->created_at->format('Y-m-d H:i') }} - 
                {{ $log->user->name ?? 'ゲスト' }}: 
                {{ $log->description }}
            </li>
        @endforeach
    </ul>
</x-app-layout>
