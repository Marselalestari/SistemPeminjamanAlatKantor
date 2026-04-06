<x-app-layout>
    {{-- Tambahkan ID 'area-laporan' untuk mempermudah targeting jika diperlukan --}}
    <div id="print-area" class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 print:p-0 print:m-0">

        {{-- KOP SURAT (Hanya tampil saat print) --}}
        <div class="hidden print:block mb-8 border-b-4 border-emerald-800 pb-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-black text-emerald-900 uppercase tracking-tighter">Sistem Manajemen Aset</h2>
                    <p class="text-sm font-bold text-slate-600">Laporan Aktivitas Peminjaman Alat Kantor - Tahun {{ $tahun }}</p>
                    <p class="text-xs text-slate-500 mt-1 italic">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
                </div>
                <div class="text-right text-xs text-slate-400">
                    Halaman 1 dari 1
                </div>
            </div>
        </div>

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4 print:hidden">
            <div>
                <h1 class="text-4xl font-bold text-emerald-900 tracking-tight">
                    Laporan <span class="text-emerald-600">Bulanan</span>
                </h1>
                <p class="text-emerald-600 mt-2 font-medium">
                    📊 Ringkasan Performa Peminjaman Alat Kantor
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('operator.peminjaman.index') }}"
                    class="inline-flex items-center px-5 py-3 bg-white border-2 border-emerald-500 text-emerald-700 text-sm font-bold rounded-lg hover:bg-emerald-50 transition shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
                
                <button onclick="window.print()" 
                    class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white text-sm font-bold rounded-lg transition shadow-lg shadow-emerald-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Laporan
                </button>
            </div>
        </div>

        {{-- FILTER CARD (Akan disembunyikan saat print) --}}
        <div class="bg-white rounded-xl shadow-lg border-2 border-emerald-200 p-6 mb-8 print:hidden">
            <form method="GET" action="{{ route('operator.peminjaman.laporan-bulanan') }}" class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="flex-1 w-full">
                    <label class="block text-xs font-bold text-emerald-700 uppercase mb-2 ml-1">Cari Bulan</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Januari, Februari..."
                        class="w-full px-4 py-3 bg-emerald-50 border-2 border-emerald-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:bg-white transition font-medium">
                </div>

                <div class="w-full sm:w-48">
                    <label class="block text-xs font-bold text-emerald-700 uppercase mb-2 ml-1">Tahun</label>
                    <select name="tahun" class="w-full px-4 py-3 bg-emerald-50 border-2 border-emerald-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition font-medium">
                        @for ($y = date('Y'); $y >= date('Y')-5; $y--)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div class="flex gap-2 w-full sm:w-auto">
                    <button type="submit" class="flex-1 sm:flex-none px-6 py-3 bg-gradient-to-r from-emerald-700 to-emerald-600 hover:from-emerald-800 hover:to-emerald-700 text-white text-sm font-bold rounded-lg transition shadow-md">
                        Filter
                    </button>
                    <a href="{{ route('operator.peminjaman.laporan-bulanan') }}" class="px-4 py-3 bg-emerald-100 hover:bg-emerald-200 text-emerald-700 text-sm font-bold rounded-lg transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- TABLE CARD --}}
        <div class="bg-white rounded-xl shadow-lg border-2 border-emerald-200 overflow-hidden mb-8 print:shadow-none print:border-slate-300 print:rounded-none">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-emerald-800 border-b-2 border-emerald-900 print:bg-emerald-50 print:border-black">
                            <th class="px-6 py-4 text-xs font-extrabold text-white uppercase tracking-wider print:text-black">Bulan</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-white uppercase tracking-wider text-center print:text-black">Total Pinjam</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-white uppercase tracking-wider text-center print:text-black">Unit</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-emerald-100 uppercase tracking-wider text-center print:text-black">✓ Setuju</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-emerald-100 uppercase tracking-wider text-center print:text-black">⏳ Tunggu</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-emerald-100 uppercase tracking-wider text-center print:text-black">✗ Tolak</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-emerald-100 uppercase tracking-wider text-center print:text-black">↩ Kembali</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-emerald-100 uppercase tracking-wider text-right print:text-black">💰 Denda Keterlambatan</th>
                            <th class="px-6 py-4 text-xs font-extrabold text-rose-400 uppercase tracking-wider text-right print:text-black">💰 Denda Kerusakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-emerald-100 print:divide-slate-300">
                        @forelse ($laporan as $item)
                        <tr class="hover:bg-emerald-50 transition print:bg-transparent">
                            <td class="px-6 py-4 text-sm font-bold text-emerald-900 print:text-black">
                                {{ \Carbon\Carbon::create()->month((int)$item->bulan)->translatedFormat('F') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-center font-bold text-emerald-700 print:text-black">{{ $item->total_peminjaman }}</td>
                            <td class="px-6 py-4 text-sm text-center font-bold text-emerald-600 print:text-black">{{ $item->total_unit }}</td>
                            <td class="px-6 py-4 text-sm text-center print:text-black">{{ $item->disetujui }}</td>
                            <td class="px-6 py-4 text-sm text-center print:text-black">{{ $item->menunggu }}</td>
                            <td class="px-6 py-4 text-sm text-center print:text-black">{{ $item->ditolak }}</td>
                            <td class="px-6 py-4 text-sm text-center font-bold text-emerald-700 print:text-black">{{ $item->dikembalikan }}</td>
                            <td class="px-6 py-4 text-sm text-right font-mono font-bold text-emerald-900 print:text-black italic">
                                Rp{{ number_format($item->total_denda_keterlambatan, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-right font-mono font-bold text-rose-700 print:text-black italic">
                                Rp{{ number_format($item->total_denda_kerusakan, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center text-slate-400 font-bold">Data Tidak Tersedia</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- SUMMARY CARDS --}}
        @if($laporan->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-8 print:grid-cols-4 print:gap-4">
            <div class="bg-white p-6 rounded-xl border-2 border-emerald-200 shadow-lg print:border-slate-300 print:shadow-none print:rounded-none">
                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">Total Peminjaman</p>
                <p class="text-3xl font-black text-emerald-900 print:text-black">{{ number_format($laporan->sum('total_peminjaman')) }}</p>
            </div>
            
            <div class="bg-white p-6 rounded-xl border-2 border-emerald-200 shadow-lg print:border-slate-300 print:shadow-none print:rounded-none">
                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">Total Unit Keluar</p>
                <p class="text-3xl font-black text-emerald-900 print:text-black">{{ number_format($laporan->sum('total_unit')) }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl border-2 border-emerald-200 shadow-lg print:border-slate-300 print:shadow-none print:rounded-none">
                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">Avg / Bulan</p>
                <p class="text-3xl font-black text-emerald-900 print:text-black">{{ round($laporan->avg('total_peminjaman'), 1) }}</p>
            </div>

            <div class="bg-emerald-900 p-6 rounded-xl border-2 border-emerald-950 shadow-lg print:bg-white print:border-slate-300 print:shadow-none print:rounded-none">
                <p class="text-[10px] font-black text-emerald-100 uppercase tracking-widest mb-1 print:text-black italic">Total Denda Keterlambatan</p>
                <p class="text-2xl font-black text-white print:text-black italic">Rp{{ number_format($totalDendaKeterlambatan, 0, ',', '.') }}</p>
            </div>
            <div class="bg-rose-100 p-6 rounded-xl border-2 border-rose-400 shadow-lg print:bg-white print:border-slate-300 print:shadow-none print:rounded-none">
                <p class="text-[10px] font-black text-rose-700 uppercase tracking-widest mb-1 print:text-black italic">Total Denda Kerusakan</p>
                <p class="text-2xl font-black text-rose-700 print:text-black italic">Rp{{ number_format($totalDendaKerusakan, 0, ',', '.') }}</p>
            </div>
        </div>
        @endif

        {{-- Tanda Tangan (Hanya saat print) --}}
        <div class="hidden print:grid grid-cols-2 mt-20 gap-12 text-center text-sm font-bold">
            <div></div>
            <div>
                <p>Dicetak Pada: {{ now()->translatedFormat('d F Y') }}</p>
                <p class="mb-24 uppercase">Mengetahui, Manajer Operasional</p>
                <p class="border-b-2 border-black inline-block px-12 italic text-lg"> ( ............................................ ) </p>
            </div>
        </div>

    </div>
</x-app-layout>

<style>
@media print {
    /* 1. Sembunyikan elemen bawaan Laravel (Navigasi, Sidebar, Footer) */
    nav, aside, footer, .py-12, header {
        display: none !important;
    }

    /* 2. Pastikan kontainer utama tidak punya padding/margin liar */
    body, html {
        background: white !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* 3. Paksa area laporan untuk mengambil seluruh lebar kertas */
    #print-area {
        width: 100% !important;
        max-width: none !important;
        padding: 0 !important;
        position: absolute;
        top: 0;
        left: 0;
    }

    /* 4. Tampilkan Kop dan Hilangkan Bayangan */
    .print\:hidden { display: none !important; }
    .shadow-lg, .shadow-md, .shadow-xl { box-shadow: none !important; }

    /* 5. Optimasi Kertas */
    @page {
        size: A4 landscape; /* Disarankan landscape agar tabel tidak sempit */
        margin: 1.5cm;
    }

    /* 6. Perbaikan warna teks */
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        color-adjust: exact !important;
    }
}
</style>