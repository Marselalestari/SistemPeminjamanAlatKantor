<aside class="w-72 h-screen bg-gradient-to-b from-white to-emerald-50/30 border-r border-emerald-100 fixed left-0 top-0 flex flex-col shadow-xl transition-all duration-300 z-50">

    {{-- LOGO SECTION --}}
    <div class="h-28 flex items-center px-6 border-b border-emerald-100/60">
        <a href="{{ route('operator.dashboard') }}" class="flex items-center gap-4 group">
            {{-- LOGO IMAGE --}}
            <div class="h-14 w-14 rounded-2xl bg-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-200 transition-transform duration-300 group-hover:scale-105">
                <span class="text-white font-bold text-2xl tracking-tighter">E</span>
            </div>

            {{-- BRAND TEXT --}}
            <div class="flex flex-col leading-tight">
                <span class="text-gray-900 font-extrabold tracking-tight text-xl">
                    EMERALD
                </span>
                <p class="text-[10px] text-emerald-600 font-semibold uppercase tracking-[0.2em]">
                    Inventory System
                </p>
            </div>
        </a>
    </div>

    {{-- MENU SECTION --}}
    <div class="flex-1 overflow-y-auto py-6 px-4">
        <p class="text-[10px] font-bold text-emerald-400/80 uppercase tracking-[0.2em] px-4 mb-4">Menu Utama</p>
        
        <nav class="space-y-1.5">
            @php
                $isActive = fn($route) => request()->routeIs($route) 
                    ? 'bg-emerald-100/80 text-emerald-800 shadow-sm border border-emerald-200/50' 
                    : 'text-gray-500 hover:bg-white hover:text-emerald-600 hover:shadow-sm border border-transparent';
                
                $isIconActive = fn($route) => request()->routeIs($route) 
                    ? 'text-emerald-600' 
                    : 'text-gray-400 group-hover:text-emerald-500';
            @endphp

            {{-- Dashboard --}}
            <a href="{{ route('operator.dashboard') }}" 
               class="group flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isActive('operator.dashboard') }}">
                <svg class="w-5 h-5 {{ $isIconActive('operator.dashboard') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            {{-- Peminjaman --}}
            <a href="{{ route('operator.peminjaman.index') }}" 
               class="group flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isActive('operator.peminjaman.*') }}">
                <svg class="w-5 h-5 {{ $isIconActive('operator.peminjaman.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                </svg>
                Peminjaman
            </a>

            {{-- Laporan --}}
            <a href="{{ route('operator.peminjaman.laporan-bulanan') }}" 
               class="group flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isActive('operator.peminjaman.laporan-bulanan') }}">
                <svg class="w-5 h-5 {{ $isIconActive('operator.peminjaman.laporan-bulanan') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6m4 6v-10m4 10v-4M5 21h14"/>
                </svg>
                Laporan
            </a>
        </nav>
    </div>

    {{-- USER PROFILE SECTION --}}
    <div class="p-4 border-t border-emerald-100 bg-white/40">
        <div class="flex items-center gap-3 p-3 rounded-xl bg-white/80 mb-3 border border-emerald-100 shadow-sm">
            <div class="h-10 w-10 rounded-lg bg-emerald-600 flex items-center justify-center text-white font-bold text-sm shadow-md">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm text-gray-800 font-bold truncate leading-tight">{{ Auth::user()->name }}</p>
                <div class="flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <p class="text-[10px] text-emerald-600 font-bold uppercase">Operator</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full flex items-center justify-center gap-2 text-gray-400 hover:bg-red-50 hover:text-red-500 rounded-xl transition-all duration-300 text-xs font-bold py-2.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                KELUAR SISTEM
            </button>
        </form>
    </div>
</aside>