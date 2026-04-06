@if ($alat->stok > 0 && auth()->user()->role === 'user')
<div id="formPeminjaman"
     class="hidden bg-white border border-emerald-200 rounded-[2rem] p-8 mt-8 shadow-2xl shadow-emerald-900/10 animate-in fade-in slide-in-from-top-4 duration-500">

    <div class="flex items-center gap-3 mb-8">
        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </svg>
        </div>
        <h2 class="text-2xl font-black text-emerald-900 tracking-tight">
            Form Peminjaman Alat
        </h2>
    </div>

    <form action="{{ route('user.peminjaman.store') }}" method="POST" class="space-y-6">
        @csrf

        <input type="hidden" name="alat_id" value="{{ $alat->id }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama --}}
            <div class="space-y-2">
                <label class="block text-[10px] font-black text-emerald-700 uppercase tracking-widest">
                    Nama Peminjam
                </label>
                <input type="text"
                       value="{{ auth()->user()->name }}"
                       readonly
                       class="w-full bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3 text-emerald-600 font-bold cursor-not-allowed">
            </div>

            {{-- Jumlah --}}
            <div class="space-y-2">
                <label class="block text-[10px] font-black text-emerald-700 uppercase tracking-widest">
                    Jumlah Unit
                </label>
                <input type="number"
                       name="jumlah"
                       min="1"
                       max="{{ $alat->stok }}"
                       required
                       placeholder="Max: {{ $alat->stok }}"
                       class="w-full bg-emerald-50 border border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-emerald-900 font-bold outline-none transition-all">
            </div>
        </div>



        {{-- Tanggal --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="block text-[10px] font-black text-emerald-700 uppercase tracking-widest">
                    Tanggal Pinjam
                </label>
                <input type="date"
                       name="tanggal_pinjam"
                       required
                       class="w-full bg-emerald-50 border border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-emerald-900 font-bold outline-none transition-all">
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black text-emerald-700 uppercase tracking-widest">
                    Estimasi Kembali
                </label>
                <input type="date"
                       name="tanggal_kembali"
                       required
                       class="w-full bg-emerald-50 border border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-emerald-900 font-bold outline-none transition-all">
            </div>
        </div>

        {{-- Keperluan --}}
        <div class="space-y-2">
            <label class="block text-[10px] font-black text-emerald-700 uppercase tracking-widest">
                Alasan Keperluan
            </label>
            <textarea name="keperluan"
                      rows="3"
                      required
                      placeholder="Jelaskan tujuan peminjaman secara singkat..."
                      class="w-full bg-emerald-50 border border-emerald-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-emerald-900 font-bold outline-none transition-all resize-none"></textarea>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4 pt-4">
            <button type="submit"
                class="flex-1 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white px-8 py-4 rounded-2xl font-black transition-all shadow-lg shadow-emerald-200 active:scale-[0.98]">
                Konfirmasi Peminjaman
            </button>

            <button type="button"
                onclick="document.getElementById('formPeminjaman').classList.add('hidden'); window.scrollTo({top: 0, behavior: 'smooth'});"
                class="px-8 py-4 bg-emerald-100 hover:bg-emerald-200 text-emerald-600 rounded-2xl font-black transition-all active:scale-[0.98]">
                Batalkan
            </button>
        </div>
    </form>
</div>
@endif