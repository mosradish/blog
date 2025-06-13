<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome for icon toggle -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-yHskJh0kXbeppYbJMGK0JkGZqXf2li3DvlG4P4CBkxOGQOqlLPK9eCr5OW3dRUay+y1XwLJSWvV1xyhEZ+V4aQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/common.css', 'resources/js/app.js'])
</head>

<body
    x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
    x-bind:class="darkMode ? 'dark' : ''"
    x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
    class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900 dark:text-white transition-colors"
>
    <div class="mb-6 min-h-screen flex flex-col sm:justify-center items-center relative dark:bg-gray-900">

        @include('layouts.navigation')

        @isset($header)
            <header class="mt-16 w-full mx-auto h-16 bg-white dark:bg-gray-900 flex shadow dark:shadow-md dark:border-b dark:border-gray-700 relative">
                {{ $header }}
                <!-- ダークモード切替ボタン -->
                <button @click="darkMode = !darkMode"
                    class="absolute right-[10%] w-6 h-6 justify-end text-sm top-1/2 transform -translate-y-1/2 border border-black rounded text-black bg-white
                        dark:text-white dark:border-white dark:bg-gray-700">
                    <template x-if="darkMode">
                        <i class="fas fa-sun"></i>
                    </template>
                    <template x-if="!darkMode">
                        <i class="fas fa-moon"></i>
                    </template>
                </button>
            </header>
        @endisset

        <div class="mt-4">
            <a href="/">
                <div class="w-[50%] h-auto mx-auto rounded dark:bg-white">
                    <x-application-logo />
                </div>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
