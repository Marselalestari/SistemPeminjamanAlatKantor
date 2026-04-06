<x-app-layout>
    {{-- Background Wrapper --}}
    <div class="min-h-screen bg-emerald-50/30 py-12 relative overflow-hidden">
        
        {{-- Dekorasi Latar --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, #10b981 1px, transparent 0); background-size: 40px 40px;"></div>

        <div class="max-w-2xl mx-auto px-4 relative z-10">
            
            {{-- Breadcrumb --}}
            <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center text-emerald-400 hover:text-emerald-600 transition-colors mb-6 group text-xs font-black uppercase tracking-widest">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Data
            </a>

            {{-- Form Card --}}
            <div class="bg-white rounded-[2rem] border border-emerald-200 shadow-xl shadow-emerald-200/30 overflow-hidden">
                <div class="p-8 md:p-12">
                    <div class="mb-10">
                        <h1 class="text-3xl font-black text-emerald-900 tracking-tighter italic uppercase">
                            Register <span class="text-emerald-600">New Category</span>
                        </h1>
                        <p class="text-emerald-600/70 text-[10px] font-black uppercase tracking-[0.4em] mt-1">Classification Input Module</p>
                    </div>

                    <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-8">
                        @csrf

                        {{-- Input Nama Kategori --}}
                        <div class="relative group">
                            <label class="block text-[10px] font-black text-emerald-700 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-emerald-600 transition-colors">
                                Nama Kategori
                            </label>
                            <input type="text"
                                   name="nama_kategori"
                                   value="{{ old('nama_kategori') }}"
                                   placeholder="Masukkan label kategori..."
                                   class="w-full bg-emerald-50 border border-emerald-200 rounded-2xl px-5 py-4 text-emerald-900 placeholder-emerald-300 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300">
                            @error('nama_kategori')
                                <div class="flex items-center gap-1 mt-2 text-rose-500 italic font-bold text-xs ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Input Deskripsi --}}
                        <div class="relative group">
                            <label class="block text-[10px] font-black text-emerald-700 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-emerald-600 transition-colors">
                                Deskripsi Metadata
                            </label>
                            <textarea name="deskripsi"
                                      rows="4"
                                      placeholder="Tambahkan detail informasi kategori..."
                                      class="w-full bg-emerald-50 border border-emerald-200 rounded-2xl px-5 py-4 text-emerald-900 placeholder-emerald-300 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300 resize-none">{{ old('deskripsi') }}</textarea>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <button type="submit"
                                    class="flex-1 flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl transition-all duration-300 shadow-lg shadow-emerald-600/20 active:scale-95">
                                <span>Inisialisasi & Simpan</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </button>
                            
                            <a href="{{ route('admin.kategori.index') }}"
                               class="flex items-center justify-center px-8 py-4 bg-emerald-100 text-emerald-600 hover:bg-emerald-200 hover:text-emerald-700 text-xs font-black uppercase tracking-[0.2em] rounded-2xl transition-all duration-300">
                                Batalkan
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info Footer --}}
            <p class="text-center mt-8 text-emerald-300 text-[9px] font-bold uppercase tracking-[0.5em]">
                Secure Data Input Protocol
            </p>
        </div>
    </div>
</x-app-layout>