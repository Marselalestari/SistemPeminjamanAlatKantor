<x-app-layout>
    <div class="min-h-screen bg-emerald-50/30 py-10">
        <div class="max-w-7xl mx-auto px-4 relative space-y-8">

            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-extrabold text-emerald-900 tracking-tight">
                        👋 Dashboard <span class="text-emerald-600">Operator</span>
                    </h1>
                    <p class="text-sm text-emerald-700/70 font-medium mt-1">
                        Kelola peminjaman dan pantau aktivitas harian sistem.
                    </p>
                </div>

                <div class="inline-flex items-center gap-3 bg-white border border-emerald-100 px-4 py-2.5 rounded-2xl shadow-sm shadow-emerald-100">
                    <div class="h-2.5 w-2.5 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-xs font-bold text-emerald-800 tracking-wide uppercase">
                        Sistem Online • {{ now()->format('H:i') }}
                    </span>
                </div>
            </div>

            {{-- FLASH MESSAGES --}}
            @if (session('success'))
                <div class="p-4 bg-white border border-emerald-200 border-l-4 border-l-emerald-500 text-emerald-900 rounded-xl shadow-sm flex items-center animate-fade-in">
                    <svg class="w-5 h-5 mr-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            {{-- WELCOME CARD --}}
            <div class="relative overflow-hidden bg-gradient-to-r from-emerald-800 to-emerald-700 rounded-3xl p-8 text-white shadow-xl shadow-emerald-900/20">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold mb-2">Selamat Bekerja, {{ Auth::user()->name }}!</h3>
                    <p class="text-emerald-100 text-sm font-medium max-w-2xl">
                        Anda memiliki kendali penuh untuk menyetujui atau menolak permintaan peminjaman alat kantor hari ini.
                    </p>
                </div>
                {{-- Decorative Element --}}
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            {{-- STATISTIK RINGKAS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Card 1 --}}
                <div class="bg-white p-6 rounded-3xl border border-emerald-100 shadow-sm shadow-emerald-100/50 group hover:border-emerald-300 transition-all duration-300">
                    <p class="text-[10px] uppercase text-emerald-500 font-black tracking-[0.2em]">Peminjaman Hari Ini</p>
                    <div class="flex items-end justify-between mt-2">
                        <h3 class="text-4xl font-black text-emerald-900">{{ $peminjamanHariIni ?? 0 }}</h3>
                        <div class="p-3 bg-emerald-50 rounded-2xl text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="bg-white p-6 rounded-3xl border border-emerald-100 shadow-sm shadow-emerald-100/50 group hover:border-emerald-300 transition-all duration-300">
                    <p class="text-[10px] uppercase text-emerald-500 font-black tracking-[0.2em]">Sedang Dipinjam</p>
                    <div class="flex items-end justify-between mt-2">
                        <h3 class="text-4xl font-black text-emerald-900">{{ $peminjamanAktif ?? 0 }}</h3>
                        <div class="p-3 bg-emerald-50 rounded-2xl text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/></svg>
                        </div>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="bg-white p-6 rounded-3xl border border-emerald-100 shadow-sm shadow-emerald-100/50 group hover:border-emerald-300 transition-all duration-300">
                    <p class="text-[10px] uppercase text-emerald-500 font-black tracking-[0.2em]">Total Pengguna</p>
                    <div class="flex items-end justify-between mt-2">
                        <h3 class="text-4xl font-black text-emerald-900">{{ $totalUser ?? 0 }}</h3>
                        <div class="p-3 bg-emerald-50 rounded-2xl text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- QUICK ACTION CARD --}}
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-emerald-100 text-center relative overflow-hidden">
                <div class="relative z-10">
                    <h4 class="text-xl font-extrabold text-emerald-900 mb-2">⚡ Aksi Cepat</h4>
                    <p class="text-sm text-emerald-600/70 mb-8 font-medium">Buat data peminjaman langsung atau pantau seluruh riwayat transaksi.</p>
                    
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('operator.peminjaman.create') }}" 
                           class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-emerald-200 transition-all active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                            Peminjaman Baru
                        </a>

                        <a href="{{ route('operator.peminjaman.index') }}" 
                           class="inline-flex items-center justify-center gap-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold px-8 py-3.5 rounded-2xl border border-emerald-200 transition-all active:scale-95">
                            Lihat Semua Data
                        </a>
                    </div>
                </div>
            </div>

            {{-- APPROVAL LIST SECTION --}}
            @if($peminjamanMenunggu->count() > 0)
            <div class="bg-white rounded-3xl shadow-sm border border-emerald-200 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-800 to-emerald-700 px-8 py-5 flex items-center justify-between">
                    <h4 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="flex h-3 w-3 bg-rose-400 rounded-full animate-ping"></span>
                        Menunggu Persetujuan
                    </h4>
                    <span class="bg-emerald-900/50 text-emerald-200 text-xs font-black px-3 py-1 rounded-full uppercase tracking-tighter border border-emerald-600">
                        {{ $peminjamanMenunggu->count() }} Permintaan
                    </span>
                </div>

                <div class="divide-y divide-emerald-100">
                    @foreach($peminjamanMenunggu as $peminjaman)
                    <div class="p-6 hover:bg-emerald-50/50 transition-colors">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                            
                            {{-- User Info --}}
                            <div class="flex items-center gap-4">
                                <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center text-white font-black text-xl shadow-md">
                                    {{ substr($peminjaman->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h5 class="font-extrabold text-emerald-900 text-lg">{{ $peminjaman->user->name }}</h5>
                                    <p class="text-xs font-bold text-emerald-500 uppercase tracking-widest">ID: #{{ $peminjaman->id }}</p>
                                </div>
                            </div>

                            {{-- Item Info --}}
                            <div class="flex-1 lg:px-10">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-sm font-black text-emerald-800">{{ $peminjaman->alat->nama_alat }}</span>
                                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-md">{{ $peminjaman->jumlah }} UNIT</span>
                                </div>
                                <p class="text-sm text-emerald-600/80 font-medium italic">"{{ $peminjaman->keperluan }}"</p>
                                <div class="flex items-center gap-3 mt-2 text-[11px] font-bold text-emerald-400 uppercase">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d/m/Y') }}
                                    </span>
                                    <span>→</span>
                                    <span class="flex items-center gap-1 text-rose-400">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex items-center gap-2">
                                <form action="{{ route('operator.peminjaman.approve', $peminjaman) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black rounded-xl transition shadow-md shadow-emerald-100 uppercase tracking-wider">
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('operator.peminjaman.reject', $peminjaman) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-6 py-2.5 bg-white hover:bg-rose-50 text-rose-500 border border-rose-100 text-xs font-black rounded-xl transition uppercase tracking-wider">
                                        Tolak
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>