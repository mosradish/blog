<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <!-- dark mode script -->
        <script>
            const prefersDark = localStorage.getItem('darkMode') === 'true'
                || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

            if (prefersDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-yHskJh0kXbeppYbJMGK0JkGZqXf2li3DvlG4P4CBkxOGQOqlLPK9eCr5OW3dRUay+y1XwLJSWvV1xyhEZ+V4aQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/common.css', 'resources/js/app.js'])
    </head>

    <body x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
        x-bind:class="{ 'dark': darkMode }"
        x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
        class="bg-white dark:bg-gray-900 text-gray-800 dark:text-white transition-colors">

        <div class="bg-white dark:bg-gray-900 min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="mt-16 mb-6 w-full mx-auto flex items-center h-16 bg-white dark:bg-gray-900 border-b border-gray-100  flex shadow dark:border-gray-700 dark:shadow-md relative">
                    <!-- トグルボタン -->
                    {{ $header }}
                    <button @click="darkMode = !darkMode
                        if (darkMode) {
                            document.documentElement.classList.add('dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                        }"
                            class="absolute right-[10%] w-6 h-6 justify-end text-sm top-1/2 transform -translate-y-1/2 border border-black rounded text-black bg-white
                                dark:text-white dark:border-white dark:bg-gray-700">
                        <template x-if="darkMode">
                            <span class="flex items-center justify-center gap-2">
                                <i class="fas fa-sun"></i>
                            </span>
                        </template>
                        <template x-if="!darkMode">
                            <span class="flex items-center justify-center gap-2">
                                <i class="fas fa-moon"></i>
                            </span>
                        </template>
                    </button>
                </header>

            @endisset

            <!-- Page Content -->
            <main class="pb-4">
                <div id="x-full bg-gray-100">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
