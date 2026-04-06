<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">
                    Riwayat <span class="text-emerald-600">Peminjaman</span>
                </h1>
                <p class="text-slate-500 mt-2 font-medium">Pantau dan kelola seluruh aktivitas peminjaman alat Anda.</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-4 py-2 bg-white border border-slate-200 rounded-2xl shadow-sm text-sm font-semibold text-slate-700">
                    Total: {{ $peminjaman->count() }} Transaksi
                </span>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="bg-white border border-slate-200/60 shadow-[0_20px_50px_rgba(0,0,0,0.05)] rounded-[2.5rem] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-6 text-[11px] font-black uppercase tracking-[0.15em] text-slate-400">Informasi Alat</th>
                            <th class="px-6 py-6 text-[11px] font-black uppercase tracking-[0.15em] text-slate-400 text-center">Jumlah</th>
                            <th class="px-6 py-6 text-[11px] font-black uppercase tracking-[0.15em] text-slate-400">Periode Pinjam</th>
                            <th class="px-6 py-6 text-[11px] font-black uppercase tracking-[0.15em] text-slate-400">Keperluan</th>
                            <th class="px-6 py-6 text-[11px] font-black uppercase tracking-[0.15em] text-slate-400">Denda</th>
                            <th class="px-8 py-6 text-[11px] font-black uppercase tracking-[0.15em] text-slate-400 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($peminjaman as $p)
                        <tr class="group hover:bg-emerald-50/20 transition-all duration-300">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-slate-900">{{ optional($p->alat)->nama_alat ?? 'Alat tidak tersedia' }}</div>
                                        <div class="text-[11px] text-slate-400 font-medium uppercase tracking-wider">ID: #{{ str_pad($p->id, 5, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex justify-center">
                                    <span class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-600">
                                        {{ $p->jumlah }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-2 text-xs font-bold text-slate-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        {{ optional($p->tanggal_pinjam)->format('d M Y') ?? '-' }}
                                    </div>
                                    <div class="flex items-center gap-2 text-xs font-bold text-slate-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                        {{ optional($p->tanggal_kembali)->format('d M Y') ?? '-' }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <p class="text-xs text-slate-600 leading-relaxed max-w-[200px] truncate" title="{{ $p->keperluan }}">
                                    {{ $p->keperluan }}
                                </p>
                            </td>
                            <td class="px-6 py-6">
                                @if ($p->status === 'dikembalikan' && ($p->denda_kerusakan > 0 || $p->denda > 0))
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-rose-600">Rp{{ number_format(max($p->denda_kerusakan, $p->denda), 0, ',', '.') }}</span>
                                        <span class="text-[10px] font-bold text-rose-400 uppercase tracking-tighter">Late/Damage Fee</span>
                                    </div>
                                @else
                                    <span class="text-slate-300 font-medium text-xs italic">Clear</span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-right">
                                @php
                                    $statusConfig = [
                                        'menunggu' => ['class' => 'bg-amber-50 text-amber-600 border-amber-100', 'icon' => '⏳'],
                                        'disetujui' => ['class' => 'bg-emerald-50 text-emerald-600 border-emerald-100', 'icon' => '✅'],
                                        'ditolak' => ['class' => 'bg-rose-50 text-rose-600 border-rose-100', 'icon' => '❌'],
                                        'dikembalikan' => ['class' => 'bg-slate-50 text-slate-600 border-slate-200', 'icon' => '📦'],
                                    ][$p->status] ?? ['class' => 'bg-gray-50 text-gray-600 border-gray-100', 'icon' => '•'];
                                @endphp
                                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-xl text-[11px] font-black uppercase tracking-widest border {{ $statusConfig['class'] }}">
                                    <span class="text-[14px]">{{ $statusConfig['icon'] }}</span>
                                    {{ $p->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-32 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                    </div>
                                    <h3 class="text-slate-900 font-bold">Belum ada riwayat</h3>
                                    <p class="text-slate-400 text-sm mt-1">Transaksi peminjaman Anda akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Footer Note --}}
        <p class="mt-8 text-center text-slate-400 text-xs font-medium italic">
            *Jika terdapat ketidaksesuaian data, harap hubungi administrator bagian sarana dan prasarana.
        </p>

    </div>
</x-app-layout>