<aside class="w-72 h-screen bg-gradient-to-b from-white to-emerald-50/30 border-r border-emerald-100 fixed left-0 top-0 flex flex-col shadow-xl transition-all duration-300 z-50">

    {{-- LOGO SECTION --}}
    <div class="h-28 flex items-center px-6 border-b border-emerald-100/60">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-4 group">
            {{-- LOGO IMAGE --}}
            <img 
                src="{{ asset('images/logo.png') }}"
                class="h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-105"
                alt="Logo SIPAK"
            >

            {{-- BRAND TEXT --}}
            <div class="flex flex-col leading-tight">
                <span class="text-gray-900 font-extrabold tracking-tight text-xl uppercase">
                    SIPAK
                </span>
                <p class="text-[10px] text-emerald-600 font-semibold uppercase tracking-[0.2em]">
                    User Access System
                </p>
            </div>
        </a>
    </div>

    {{-- MENU SECTION --}}
    <div class="flex-1 overflow-y-auto py-6 px-4">
        <p class="text-[10px] font-bold text-emerald-400/80 uppercase tracking-[0.2em] px-4 mb-4">Menu Utama</p>
        
        <nav class="space-y-1.5">
            @php
                // Logika warna aktif/tidak aktif disamakan dengan Admin
                $isActive = fn($route) => request()->routeIs($route) ? 'bg-emerald-100/80 text-emerald-800 shadow-sm' : 'text-gray-500 hover:bg-white hover:text-emerald-600 hover:shadow-sm';
                $isIconActive = fn($route) => request()->routeIs($route) ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-500';
                $baseLink = "group flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200";
            @endphp

            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}" class="{{ $baseLink }} {{ $isActive('dashboard') }}">
                <svg class="w-5 h-5 {{ $isIconActive('dashboard') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            {{-- Daftar Alat --}}
            <a href="{{ route('user.alat.index') }}" class="{{ $baseLink }} {{ $isActive('user.alat.*') }}">
                <svg class="w-5 h-5 {{ $isIconActive('user.alat.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Daftar Alat
            </a>

            {{-- Riwayat Peminjaman --}}
            <a href="{{ route('user.peminjaman.index') }}" class="{{ $baseLink }} {{ $isActive('user.peminjaman.index') }}">
                <svg class="w-5 h-5 {{ $isIconActive('user.peminjaman.index') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Riwayat Pinjam
            </a>
        </nav>
    </div>

    {{-- USER PROFILE SECTION --}}
    <div class="p-4 border-t border-emerald-100">
        {{-- Profile Card --}}
        <div class="flex items-center gap-3 p-3 rounded-xl bg-white/50 mb-3 border border-emerald-100 shadow-sm group">
            <div class="h-10 w-10 rounded-lg bg-emerald-600 flex items-center justify-center text-white font-bold text-sm shadow-inner transition-transform group-hover:scale-105">
                {{ substr(Auth::user()->name,0,1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm text-gray-800 font-bold truncate leading-none mb-1">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-gray-400 truncate tracking-tight">{{ Auth::user()->email }}</p>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="space-y-1">
            <a href="{{ route('profile.edit') }}" class="w-full flex items-center justify-center gap-2 text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 rounded-xl transition-all duration-200 text-xs font-bold py-2">
                PENGATURAN
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center justify-center gap-2 text-gray-400 hover:bg-rose-50 hover:text-rose-500 rounded-xl transition-all duration-200 text-xs font-bold py-2 uppercase">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</aside>