<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased" style="background: linear-gradient(135deg, #f5faf9 0%, #ecf7f4 100%);">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar_operator')

    {{-- MAIN CONTENT --}}
    <div class="flex-1 ml-64 flex flex-col">

        {{-- HEADER --}}
        @isset($header)
        <header class="bg-gradient-to-r from-emerald-900 to-emerald-700 shadow-lg border-b border-emerald-600">
            <div class="max-w-7xl mx-auto py-6 px-8 text-white">
                <h2 class="text-2xl font-bold text-white">{{ $header }}</h2>
            </div>
        </header>
        @endisset

        {{-- PAGE CONTENT --}}
        <main class="flex-1 p-8">
            {{ $slot }}
        </main>

        {{-- FOOTER OPTIONAL --}}
        <footer class="text-center text-sm py-6 border-t border-emerald-200" style="color: #1f2937;">
            <div class="text-emerald-700 font-semibold">© {{ date('Y') }} EMERALD INVENTORY</div>
            <p class="text-gray-500">Sistem Manajemen Peminjaman Alat Kantor Premium</p>
        </footer>

    </div>

</div>

</body>
</html>