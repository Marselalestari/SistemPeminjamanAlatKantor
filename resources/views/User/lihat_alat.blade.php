<x-app-layout>
    <div class="max-w-full py-8 px-6 lg:px-10 bg-slate-50 min-h-screen text-slate-600">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center space-x-2 bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border border-emerald-100">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span>Inventory Monitoring</span>
                </div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                    Katalog <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">Alat Kantor</span>
                </h1>
                <p class="text-slate-500 text-sm font-medium">Manajemen aset inventaris dalam kendali satu layar.</p>
            </div>
            
            {{-- Statistik & Search Combo --}}
            <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                {{-- Search Bar --}}
                <form action="{{ route('user.alat.index') }}" method="GET" class="relative w-full sm:w-72 group">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari alat kantor..." 
                           class="w-full pl-12 pr-4 py-3 bg-white border border-emerald-100 rounded-2xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all placeholder:text-slate-400 text-slate-900 shadow-sm">
                    <div class="absolute left-4 top-3.5 text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </form>

                <div class="hidden sm:flex items-center space-x-4 bg-white p-2 rounded-2xl border border-emerald-100 shadow-sm">
                    <div class="bg-gradient-to-br from-emerald-500 to-teal-600 p-2.5 rounded-xl text-white shadow-md shadow-emerald-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div class="pr-4">
                        <span class="block text-[10px] uppercase font-black text-slate-400 tracking-widest leading-none mb-1">Total Aset</span>
                        <span class="text-xl font-black text-slate-900 leading-none">{{ $alat->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Container --}}
        <div class="bg-white border border-emerald-100 shadow-xl shadow-emerald-900/5 rounded-[2.5rem] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-emerald-50/50 border-b border-emerald-100">
                            <th class="px-8 py-6 text-left text-[11px] font-black text-emerald-800/50 uppercase tracking-[0.2em]">Item Visual</th>
                            <th class="px-8 py-6 text-left text-[11px] font-black text-emerald-800/50 uppercase tracking-[0.2em]">Spesifikasi Alat</th>
                            <th class="px-8 py-6 text-left text-[11px] font-black text-emerald-800/50 uppercase tracking-[0.2em]">Kategori</th>
                            <th class="px-8 py-6 text-center text-[11px] font-black text-emerald-800/50 uppercase tracking-[0.2em]">Ketersediaan</th>
                            <th class="px-8 py-6 text-right text-[11px] font-black text-emerald-800/50 uppercase tracking-[0.2em]">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-emerald-50">
                        @forelse ($alat as $a)
                        <tr class="hover:bg-emerald-50/30 transition-all duration-300 group">
                            <td class="px-8 py-5">
                                @if ($a->foto)
                                    <div class="relative w-20 h-20 rounded-[1.5rem] overflow-hidden border border-emerald-100 shadow-sm group-hover:border-emerald-400 transition-all duration-500">
                                        <img src="{{ asset('storage/' . $a->foto) }}"
                                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                    </div>
                                @else
                                    <div class="w-20 h-20 bg-slate-50 rounded-[1.5rem] flex items-center justify-center border-2 border-dashed border-slate-200 group-hover:border-emerald-200 transition-colors">
                                        <svg class="w-8 h-8 text-slate-300 group-hover:text-emerald-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>

                            <td class="px-8 py-5">
                                <div class="space-y-1">
                                    <span class="block font-extrabold text-slate-900 text-lg group-hover:text-emerald-600 transition-colors">
                                        {{ $a->nama_alat }}
                                    </span>
                                    <p class="text-slate-500 text-xs leading-relaxed max-w-xs line-clamp-2 italic">
                                        {{ $a->deskripsi ?? 'Detail teknis belum ditambahkan.' }}
                                    </p>
                                </div>
                            </td>

                            <td class="px-8 py-5">
                                <span class="inline-flex items-center px-4 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-xl text-[10px] font-bold uppercase tracking-wider group-hover:bg-emerald-100 transition-all">
                                    {{ $a->kategori->nama_kategori ?? 'Umum' }}
                                </span>
                            </td>

                            <td class="px-8 py-5">
                                <div class="flex flex-col items-center">
                                    @if ($a->stok > 0)
                                        <div class="bg-emerald-50 text-emerald-600 border border-emerald-100 px-4 py-2 rounded-2xl text-center min-w-[80px] shadow-sm">
                                            <span class="block text-lg font-black leading-none">{{ $a->stok }}</span>
                                            <span class="text-[9px] font-bold uppercase tracking-tighter mt-1">Available</span>
                                        </div>
                                    @else
                                        <span class="px-4 py-2 bg-rose-50 text-rose-500 border border-rose-100 rounded-2xl text-[10px] font-black uppercase tracking-tight">
                                            Out of Stock
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td class="px-8 py-5">
                                <div class="flex gap-3 justify-end items-center">
                                    <a href="{{ route('user.alat.show', $a->id) }}"
                                       class="px-5 py-2.5 bg-white text-slate-600 font-bold text-xs rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all active:scale-95 border border-slate-200 hover:border-emerald-200 shadow-sm">
                                        Detail
                                    </a>
                                    {{-- @if ($a->stok > 0)
                                        <a href="{{ route('user.alat.show', $a->id) }}#formPeminjaman"
                                           class="px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold text-xs rounded-xl hover:from-emerald-500 hover:to-teal-500 transition-all active:scale-95 shadow-md shadow-emerald-200">
                                            Pinjam Alat
                                        </a>
                                    @endif --}}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-24 text-center">
                                <div class="max-w-xs mx-auto flex flex-col items-center">
                                    <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-6 border border-emerald-100">
                                        <svg class="w-10 h-10 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-slate-900 font-black text-xl mb-2">Item Tidak Ditemukan</h3>
                                    <p class="text-slate-500 text-sm">Maaf, kami tidak menemukan alat tersebut di inventaris.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-12 flex flex-col items-center space-y-4">
            <div class="h-px w-20 bg-emerald-100"></div>
            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.3em]">Light Interface &bull; System v2.1</p>
        </div>
    </div>
</x-app-layout>