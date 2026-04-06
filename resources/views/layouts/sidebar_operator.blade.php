<aside class="w-72 h-screen bg-gradient-to-b from-white to-emerald-50/30 border-r border-emerald-100 fixed left-0 top-0 flex flex-col shadow-xl transition-all duration-300 z-50">

    {{-- LOGO SECTION --}}
    <div class="h-28 flex items-center px-6 border-b border-emerald-100/60 bg-white/50 backdrop-blur-md">
        <a href="{{ route('operator.dashboard') }}" class="flex items-center gap-4 group">
            <img 
                src="{{ asset('images/logo.png') }}" 
                class="h-14 w-auto object-contain transition-transform duration-500 group-hover:rotate-6 group-hover:scale-110" 
                alt="Logo">

            <div class="flex flex-col leading-tight">
                <span class="text-gray-900 font-black tracking-tighter text-2xl group-hover:text-emerald-600 transition-colors">
                    SIPAK
                </span>
                <p class="text-[9px] text-emerald-600/70 font-black uppercase tracking-[0.25em]">
                    Inventory System
                </p>
            </div>
        </a>
    </div>

    {{-- MENU SECTION --}}
    <div class="flex-1 overflow-y-auto py-8 px-4">
        <p class="text-[10px] font-black text-emerald-800/40 uppercase tracking-[0.3em] px-4 mb-5">Main Navigation</p>
        
        <nav class="space-y-2">
            {{-- Dashboard --}}
            @php $dashActive = request()->routeIs('operator.dashboard'); @endphp
            <a href="{{ route('operator.dashboard') }}" 
               class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl text-sm font-bold transition-all duration-300 
               {{ $dashActive ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'text-slate-500 hover:bg-emerald-50 hover:text-emerald-600' }}">
                <svg class="w-5 h-5 {{ $dashActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            {{-- Peminjaman --}}
            @php $peminjamanActive = request()->routeIs('operator.peminjaman.index', 'operator.peminjaman.create', 'operator.peminjaman.edit'); @endphp
            <a href="{{ route('operator.peminjaman.index') }}" 
               class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl text-sm font-bold transition-all duration-300 
               {{ $peminjamanActive ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'text-slate-500 hover:bg-emerald-50 hover:text-emerald-600' }}">
                <svg class="w-5 h-5 {{ $peminjamanActive ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                </svg>
                Peminjaman
            </a>

            {{-- Laporan (Diferensiasi warna Slate) --}}
            @php $laporanActive = request()->routeIs('operator.peminjaman.laporan-bulanan'); @endphp
            <a href="{{ route('operator.peminjaman.laporan-bulanan') }}" 
               class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl text-sm font-bold transition-all duration-300 
               {{ $laporanActive ?  'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'text-slate-500 hover:bg-emerald-50 hover:text-emerald-600' }}">
                <svg class="w-5 h-5 {{ $laporanActive ? 'text-white' : 'text-slate-400 group-hover:text-slate-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6m4 6v-10m4 10v-4M5 21h14"/>
                </svg>
                Laporan
            </a>
        </nav>
    </div>

    {{-- USER PROFILE SECTION --}}
    <div class="p-6 border-t border-emerald-100 bg-white/60 backdrop-blur-sm">
        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white border border-emerald-100 shadow-sm mb-4">
            <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-700 flex items-center justify-center text-white font-black text-sm shadow-md shadow-emerald-100">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm text-slate-800 font-black truncate leading-none mb-1">{{ Auth::user()->name }}</p>
                <div class="flex items-center gap-1.5">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <p class="text-[9px] text-emerald-600 font-black uppercase tracking-widest">Active</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="group w-full flex items-center justify-center gap-2 text-slate-400 hover:bg-rose-50 hover:text-rose-600 rounded-xl transition-all duration-300 text-[10px] font-black py-3 border border-transparent hover:border-rose-100 uppercase tracking-widest">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar Sistem
            </button>
        </form>
    </div>
</aside>