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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/common.css', 'resources/js/app.js'])
    </head>

    <body>
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="mt-16 w-full mx-auto h-16 bg-white flex shadow">
                        {{ $header }}
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                <div id="x-full bg-gray text-center">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
