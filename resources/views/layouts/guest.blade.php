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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans bg-primary text-black antialiased py-10">
        <div class="w-full flex gap-10 items-center justify-center font-bold">
            <h1 class="text-2xl font-bold">Orange Drinks</h1>
            <img src="/images/orange.jpeg" alt="" class="rounded-2xl w-32 h-auto">
        </div>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 py-10">
            <div class="w-full sm:max-w-md mt-6 px-6 border border-solid border-white shadow-md overflow-hidden sm:rounded-lg py-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
