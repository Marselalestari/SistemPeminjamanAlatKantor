<aside class="w-72 h-screen bg-gradient-to-b from-white to-emerald-50/30 border-r border-emerald-100 fixed left-0 top-0 flex flex-col shadow-xl transition-all duration-300">

{{-- LOGO SECTION --}}
<div class="h-28 flex items-center px-6 border-b border-emerald-100/60">

    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 group">

        {{-- LOGO IMAGE --}}
        <img 
            src="{{ asset('images/logo.png') }}"
            class="h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-105"
            alt="Logo SIPAK"
        >

        {{-- BRAND TEXT --}}
        <div class="flex flex-col leading-tight">

            <span class="text-gray-900 font-extrabold tracking-tight text-xl">
                SIPAK
            </span>

            <p class="text-[10px] text-emerald-600 font-semibold uppercase tracking-[0.2em]">
                Sistem Peminjaman Alat Kantor
            </p>

        </div>

    </a>

</div>

    {{-- MENU SECTION --}}
    <div class="flex-1 overflow-y-auto py-6 px-4">
        <p class="text-[10px] font-bold text-emerald-400/80 uppercase tracking-[0.2em] px-4 mb-4">Menu Admin</p>
        <nav class="space-y-1.5">
            @php
                $isActive = fn($route) => request()->routeIs($route) ? 'bg-emerald-100/80 text-emerald-800' : 'text-gray-500 hover:bg-white hover:text-emerald-600 hover:shadow-sm';
                $isIconActive = fn($route) => request()->routeIs($route) ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-500';
            @endphp

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isActive('admin.dashboard') }}">
                <svg class="w-5 h-5 {{ $isIconActive('admin.dashboard') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            {{-- Kategori --}}
            <a href="{{ route('admin.kategori.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isActive('admin.kategori.*') }}">
                <svg class="w-5 h-5 {{ $isIconActive('admin.kategori.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Kategori
            </a>

            {{-- Daftar Alat --}}
            <a href="{{ route('admin.alat.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isActive('admin.alat.*') }}">
                <svg class="w-5 h-5 {{ $isIconActive('admin.alat.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                Daftar Alat
            </a>

            {{-- Pengguna --}}
            <a href="{{ route('admin.pengguna.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isActive('admin.pengguna.*') }}">
                <svg class="w-5 h-5 {{ $isIconActive('admin.pengguna.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Pengguna
            </a>
        </nav>
    </div>


    

    {{-- USER PROFILE --}}
    <div class="p-4 border-t border-emerald-100">
        <div class="flex items-center gap-3 p-3 rounded-xl bg-white/50 mb-3 border border-emerald-100 shadow-sm">
            <div class="h-10 w-10 rounded-lg bg-emerald-600 flex items-center justify-center text-white font-bold text-sm shadow-inner">
                {{ substr(Auth::user()->name,0,1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm text-gray-800 font-bold truncate">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-gray-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full flex items-center justify-center gap-2 text-gray-400 hover:bg-red-50 hover:text-red-500 rounded-xl transition-all duration-200 text-xs font-bold py-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                KELUAR
            </button>
        </form>
    </div>
</aside>