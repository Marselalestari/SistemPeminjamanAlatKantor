<x-app-layout>
    <div class="min-h-screen bg-[#f1f5f9] py-12 px-6 lg:px-8 font-sans antialiased">
        <div class="max-w-7xl mx-auto">
            
            {{-- HEADER SECTION --}}
            <div class="relative flex flex-col md:flex-row md:items-center justify-between mb-12 gap-6">
                <div class="relative z-10">
                    <nav class="flex mb-4">
                        <ol class="flex items-center space-x-2 text-[11px] font-semibold tracking-[0.2em] uppercase text-emerald-600/80">
                            <li><a href="#" class="hover:text-emerald-800 transition-colors">Workspace</a></li>
                            <li class="text-slate-300">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </li>
                            <li class="text-slate-400">Inventory Logs</li>
                        </ol>
                    </nav>
                    <h1 class="text-4xl font-light text-slate-900 tracking-tight leading-none">
                        Manajemen <span class="font-black text-emerald-600">Peminjaman</span>
                    </h1>
                    <p class="text-slate-500 text-base mt-3 max-w-2xl leading-relaxed font-light">
                        Rekapitulasi aktivitas penggunaan aset alat laboratorium secara real-time.
                    </p>
                </div>
                
                <div class="flex items-center gap-4">
                    <a href="{{ route('operator.peminjaman.laporan-bulanan') }}" 
                       class="group inline-flex items-center px-6 py-3 bg-white border border-slate-200 text-slate-600 hover:text-emerald-600 hover:border-emerald-200 text-xs font-bold rounded-xl transition-all duration-300 shadow-sm">
                        <svg class="w-4 h-4 mr-2.5 text-slate-400 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Export PDF
                    </a>
                    <a href="{{ route('operator.peminjaman.create') }}" 
                       class="inline-flex items-center px-8 py-3 bg-slate-900 hover:bg-emerald-600 text-white text-xs font-bold rounded-xl transition-all duration-500 shadow-2xl shadow-slate-300 uppercase tracking-[0.1em] active:scale-95">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        Entry Baru
                    </a>
                </div>
            </div>

            {{-- FLASH MESSAGES --}}
            @if (session('success'))
                <div class="mb-10 p-5 bg-white border border-emerald-100 shadow-[0_10px_40px_-15px_rgba(16,185,129,0.2)] rounded-2xl flex items-center animate-fade-in border-l-[6px] border-l-emerald-500">
                    <div class="w-10 h-10 bg-emerald-50 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <span class="font-bold text-slate-800 text-sm tracking-tight">{{ session('success') }}</span>
                </div>
            @endif

            {{-- MAIN CONTENT CARD --}}
            <div class="bg-white border border-slate-200 shadow-[0_20px_50px_rgba(0,0,0,0.04)] rounded-[2.5rem] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-separate border-spacing-0">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-100">
                                <th class="pl-12 pr-6 py-6 text-[10px] font-extrabold uppercase tracking-[0.2em] text-slate-400">Identity</th>
                                <th class="px-6 py-6 text-[10px] font-extrabold uppercase tracking-[0.2em] text-slate-400">Equipment</th>
                                <th class="px-6 py-6 text-[10px] font-extrabold uppercase tracking-[0.2em] text-slate-400 text-center">Period</th>
                                <th class="px-6 py-6 text-[10px] font-extrabold uppercase tracking-[0.2em] text-slate-400 text-center">Status</th>
                                <th class="px-6 py-6 text-[10px] font-extrabold uppercase tracking-[0.2em] text-slate-400 text-center">Fine</th>
                                <th class="pr-12 pl-6 py-6 text-[10px] font-extrabold uppercase tracking-[0.2em] text-slate-400 text-right">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($peminjaman as $item)
                                <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                                    {{-- Identity --}}
                                    <td class="pl-12 pr-6 py-8">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-full ring-2 ring-emerald-50 ring-offset-2 bg-slate-100 flex items-center justify-center text-emerald-700 font-bold text-sm shadow-sm">
                                                {{ substr($item->user->name, 0, 2) }}
                                            </div>
                                            <div class="ml-5">
                                                <div class="font-extrabold text-slate-900 text-[15px] tracking-tight group-hover:text-emerald-700 transition-colors">{{ $item->user->name }}</div>
                                                <div class="text-[11px] text-slate-400 mt-1 font-medium italic">NIK: {{ $item->user->nik ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Equipment --}}
                                    <td class="px-6 py-8">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-slate-700">{{ $item->alat->nama_alat }}</span>
                                            <div class="flex items-center mt-2">
                                                <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 mr-2"></span>
                                                <span class="text-xs text-slate-500 font-semibold uppercase tracking-tighter">Qty: {{ $item->jumlah }} Unit</span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Period --}}
                                    <td class="px-6 py-8">
                                        <div class="flex flex-col items-center">
                                            <div class="px-4 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] font-black text-slate-700 shadow-sm tabular-nums">
                                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M, Y') }}
                                            </div>
                                            <div class="h-4 w-[1px] bg-slate-200 my-1"></div>
                                            <div class="px-4 py-1.5 bg-rose-50 border border-rose-100 rounded-lg text-[10px] font-black text-rose-600 shadow-sm tabular-nums">
                                                {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M, Y') }}
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-8 text-center">
                                        @php
                                            $statusStyle = [
                                                'menunggu'     => 'bg-amber-100/50 text-amber-700 border-amber-200/60',
                                                'disetujui'    => 'bg-emerald-500 text-white border-emerald-600 shadow-lg shadow-emerald-100',
                                                'dikembalikan' => 'bg-slate-900 text-white border-slate-800 shadow-lg shadow-slate-200',
                                                'ditolak'      => 'bg-rose-50 text-rose-600 border-rose-200',
                                            ][$item->status] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                                        @endphp
                                        <span class="inline-block px-4 py-1.5 rounded-full text-[9px] font-black border {{ $statusStyle }} uppercase tracking-widest leading-none">
                                            {{ $item->status }}
                                        </span>
                                    </td>

                                    {{-- Fine --}}
                                    <td class="px-6 py-8 text-center font-mono">
                                        @if ($item->status === 'dikembalikan' && ($item->denda_kerusakan > 0 || $item->denda > 0))
                                            <span class="text-xs font-black text-rose-600">
                                                Rp{{ number_format(max($item->denda_kerusakan, $item->denda), 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="text-slate-300 font-light text-xs">No Fine</span>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td class="pr-12 pl-6 py-8 text-right">
                                        <div class="flex justify-end items-center gap-3">
                                            @if ($item->status === 'menunggu')
                                                <form action="{{ route('operator.peminjaman.approve', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button title="Accept" class="w-10 h-10 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full flex items-center justify-center transition-all shadow-lg shadow-emerald-100 hover:rotate-12">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                    </button>
                                                </form>
                                                <form action="{{ route('operator.peminjaman.reject', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button title="Reject" class="w-10 h-10 bg-white border border-slate-200 text-rose-500 hover:bg-rose-50 rounded-full flex items-center justify-center transition-all shadow-sm">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </button>
                                                </form>
                                            @elseif ($item->status === 'disetujui')
                                                <a href="{{ route('operator.peminjaman.cetak-struk', $item->id) }}" class="p-3 text-slate-400 hover:text-slate-900 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                                </a>
                                                <form action="{{ route('operator.peminjaman.kembalikan', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button class="px-6 py-2.5 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-lg hover:bg-emerald-700 transition-all shadow-lg active:scale-95 shadow-emerald-100">
                                                        Process Return
                                                    </button>
                                                </form>
                                            @else
                                                <div class="flex items-center text-slate-400 font-bold text-[10px] uppercase tracking-widest">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                    Finalized
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-32 text-center bg-slate-50/30">
                                        <div class="flex flex-col items-center">
                                            <div class="w-24 h-24 bg-white shadow-xl rounded-[2rem] flex items-center justify-center mb-6">
                                                <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 00-2 2H6a2 2 0 00-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                            </div>
                                            <p class="text-slate-400 font-bold uppercase tracking-[0.3em] text-[10px]">No activity logs found</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION SECTION --}}
                <div class="px-12 py-8 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
                    <div class="text-xs text-slate-400 font-medium italic">
                        Menampilkan {{ $peminjaman->firstItem() }} s/d {{ $peminjaman->lastItem() }} dari total {{ $peminjaman->total() }} record
                    </div>
                    <div class="custom-pagination">
                        {{ $peminjaman->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
        
        /* Custom Scrollbar for Luxury Feel */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { bg: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</x-app-layout>