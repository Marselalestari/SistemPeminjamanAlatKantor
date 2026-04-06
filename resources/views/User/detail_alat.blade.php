<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10 px-6">
        <div class="max-w-6xl mx-auto">

            {{-- Audio Notifikasi --}}
            <audio id="notifSound" preload="auto">
                <source src="{{ asset('audio/notif.mp3') }}" type="audio/mpeg">
            </audio>

            <script>
                function playSound() {
                    const audio = document.getElementById('notifSound');
                    if(audio){
                        audio.currentTime = 0;
                        audio.play().catch(error => {
                            console.log("Audio tidak bisa diputar:", error);
                        });
                    }
                }
            </script>

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                        Asset Details
                    </div>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                        {{ $alat->nama_alat }}
                    </h1>
                    <p class="text-slate-500 text-sm font-medium">
                        Manajemen inventaris aset kantor secara terpusat.
                    </p>
                </div>

                <a href="{{ route('user.alat.index') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-white hover:bg-slate-50 text-slate-700 font-bold text-sm rounded-2xl transition shadow-sm border border-slate-200 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>


            {{-- CONTENT --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- FOTO ALAT --}}
                <div class="md:col-span-1">
                    <div class="bg-white border border-emerald-100 rounded-[2.5rem] overflow-hidden shadow-xl shadow-emerald-900/5 group">
                        @if ($alat->foto)
                            <div class="relative overflow-hidden aspect-square md:aspect-auto md:h-[450px]">
                                <img src="{{ asset('storage/' . $alat->foto) }}"
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>
                        @else
                            <div class="w-full h-80 bg-slate-100 flex flex-col items-center justify-center gap-4">
                                <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-slate-400 font-bold text-xs uppercase tracking-widest">No Image Available</span>
                            </div>
                        @endif
                    </div>
                </div>


                {{-- INFORMASI ALAT --}}
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white border border-emerald-100 rounded-[2.5rem] p-8 md:p-10 shadow-xl shadow-emerald-900/5">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-8 pb-8 border-b border-slate-100">
                            {{-- KATEGORI --}}
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Kategori</label>
                                <span class="inline-flex items-center px-4 py-2 bg-emerald-50 text-emerald-700 rounded-xl text-sm font-bold border border-emerald-100">
                                    {{ $alat->kategori->nama_kategori ?? '-' }}
                                </span>
                            </div>

                            {{-- STOK --}}
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Ketersediaan Stok</label>
                                @if ($alat->stok > 0)
                                    <div class="flex items-center gap-3">
                                        <span class="text-4xl font-black text-emerald-600 tracking-tighter">{{ $alat->stok }}</span>
                                        <div class="leading-tight">
                                            <span class="block text-slate-900 font-bold text-sm">Unit Tersedia</span>
                                            <span class="text-emerald-500 text-[10px] font-bold uppercase">Ready to Borrow</span>
                                        </div>
                                    </div>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 bg-rose-50 text-rose-600 rounded-xl text-sm font-bold border border-rose-100">
                                        Stok Habis
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- DESKRIPSI --}}
                        <div class="mb-10">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Deskripsi Alat</label>
                            <p class="text-slate-600 leading-relaxed text-lg italic bg-slate-50 p-6 rounded-2xl border border-slate-100">
                                "{{ $alat->deskripsi ?? 'Tidak ada deskripsi tersedia untuk alat ini.' }}"
                            </p>
                        </div>

                        {{-- TOMBOL PINJAM --}}
                        <div class="pt-4">
                            @if ($alat->stok > 0 && auth()->user()->role === 'user')
                                <button
                                    onclick="playSound(); document.getElementById('formPeminjaman').classList.remove('hidden'); this.style.display='none'"
                                    class="group relative w-full inline-flex items-center justify-center px-8 py-4 font-black text-white transition-all duration-200 bg-emerald-600 rounded-2xl hover:bg-emerald-500 shadow-lg shadow-emerald-200 active:scale-95">
                                    Ajukan Peminjaman
                                </button>
                            @else
                                <button
                                    class="w-full bg-slate-100 text-slate-400 py-4 rounded-2xl cursor-not-allowed font-black uppercase tracking-widest text-xs border border-slate-200"
                                    disabled>
                                    Tidak Dapat Dipinjam
                                </button>
                            @endif
                        </div>

                        {{-- FORM PEMINJAMAN --}}
                        <div id="formContainer" class="mt-6">
                            @include('User.form_peminjaman', ['alat' => $alat])
                        </div>
                    </div>

                    {{-- INFORMASI TAMBAHAN --}}
                    <div class="bg-white border border-emerald-100 rounded-[2.5rem] p-8 shadow-xl shadow-emerald-900/5">
                        <h2 class="text-xs font-black text-slate-900 uppercase tracking-[0.3em] mb-6 flex items-center">
                            <span class="w-8 h-1 bg-emerald-500 rounded-full mr-3"></span>
                            Informasi Sistem
                        </h2>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 transition-hover hover:border-emerald-200">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">ID Alat</label>
                                <p class="text-lg font-black text-slate-800">#{{ str_pad($alat->id, 4, '0', STR_PAD_LEFT) }}</p>
                            </div>

                            <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 transition-hover hover:border-emerald-200">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">Registrasi</label>
                                <p class="text-lg font-black text-slate-800">{{ $alat->created_at->format('d/m/Y') }}</p>
                            </div>

                            <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 transition-hover hover:border-emerald-200">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">Update</label>
                                <p class="text-lg font-black text-slate-800">{{ $alat->updated_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FOOTER TAG --}}
            <div class="mt-12 flex flex-col items-center gap-4">
                <div class="h-px w-20 bg-emerald-200"></div>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.5em]">Inventory System v2.1</p>
            </div>
        </div>
    </div>
</x-app-layout>