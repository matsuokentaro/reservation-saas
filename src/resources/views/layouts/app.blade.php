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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            {{-- @include('layouts.navigation') --}}

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
<!-- Page Content -->
    <div class="flex">
            <!-- Sidebar -->
            <aside class="w-56 h-screen sticky top-0 bg-gray-800 text-white p-6">

                <h2 class="text-lg font-semibold mb-10 text-center text-gray-300">
                    Reservation
                    Manager
                </h2>

                <nav class="space-y-6">

                    <a href="{{ route('dashboard') }}"
                    class="block p-2 rounded
                    {{ request()->routeIs('dashboard')
                            ? 'bg-blue-600 text-white'
                            : 'hover:text-blue-300' }}">
                        📊 Dashboard
                    </a>

                    <a href="{{ route('reservations.index') }}"
                    class="block p-2 rounded
                    {{ request()->routeIs('reservations.*')
                        ? 'bg-blue-600 text-white'
                        : 'hover:text-blue-300' }}">
                        📅 予約管理
                    </a>

                    <a href="{{ route('shops.index') }}"
                    class="block p-2 rounded
                    {{ request()->routeIs('shops.*')
                            ? 'bg-blue-600 text-white'
                            : 'hover:text-blue-300' }}">
                        🏢 店舗管理
                    </a>

                </nav>

            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
        </div>
    </body>
</html>
