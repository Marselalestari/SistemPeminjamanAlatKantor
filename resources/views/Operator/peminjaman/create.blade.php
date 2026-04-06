<x-app-layout>
    <div class="max-w-3xl mx-auto py-12 px-6">

        {{-- Header Form --}}
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                Formulir <span class="text-indigo-600">Peminjaman</span>
            </h1>
            <p class="text-slate-500 mt-2 text-sm italic">
                Buat peminjaman baru atas nama pengguna.
            </p>
        </div>

        <div class="bg-white border border-slate-200 shadow-2xl shadow-slate-200/50 rounded-3xl p-8 md:p-10">
            <form action="{{ route('operator.peminjaman.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Pilih Pengguna --}}
                <div class="group">
                    <label class="block text-sm font-bold text-slate-700 mb-2 transition-colors group-focus-within:text-indigo-600">
                        Pilih Pengguna
                    </label>
                    <div class="relative">
                        <select name="user_id" 
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl px-4 py-3 text-slate-700 focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all appearance-none cursor-pointer" 
                                required>
                            <option value="" disabled selected>-- Pilih pengguna --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

              
                {{-- Pilih Alat --}}
                <div class="group">
                    <label class="block text-sm font-bold text-slate-700 mb-2 transition-colors group-focus-within:text-indigo-600">
                        Pilih Alat
                    </label>
                    <div class="relative">
                        <select name="alat_id" 
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl px-4 py-3 text-slate-700 focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all appearance-none cursor-pointer" 
                                required>
                            <option value="" disabled selected>-- Cari alat yang tersedia --</option>
                            @foreach ($alat as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama_alat }} (Tersedia: {{ $item->stok }})
                                </option>
                            @endforeach
                        </select>
                        {{-- Custom Arrow Icon --}}
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                {{-- Jumlah --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah Unit</label>
                    <input type="number" name="jumlah" min="1" 
                           class="w-full bg-slate-50 border-slate-200 rounded-2xl px-4 py-3 text-slate-700 focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all" 
                           placeholder="0" required>
                </div>

                {{-- Grid Tanggal --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam"
                               class="w-full bg-slate-50 border-slate-200 rounded-2xl px-4 py-3 text-slate-700 focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all" 
                               required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali"
                               class="w-full bg-slate-50 border-slate-200 rounded-2xl px-4 py-3 text-slate-700 focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all" 
                               required>
                    </div>
                </div>

                {{-- Keperluan --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Alasan / Keperluan</label>
                    <textarea name="keperluan" rows="4"
                              class="w-full bg-slate-50 border-slate-200 rounded-2xl px-4 py-3 text-slate-700 focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all resize-none"
                              placeholder="Ceritakan singkat tujuan peminjaman..." 
                              required></textarea>
                </div>

                {{-- Button Group --}}
                <div class="flex items-center justify-end space-x-4 pt-4">
                    <a href="{{ route('operator.dashboard') }}"
                       class="px-6 py-3 text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-xs">
                        Simpan Peminjaman
                    </button>
                </div>
            </form>
        </div>

        {{-- Soft Footer Info --}}
        <div class="mt-8 text-center">
            <p class="text-xs text-slate-400">
                Peminjaman yang dibuat oleh operator akan langsung disetujui.
            </p>
        </div>
    </div>
</x-app-layout>
