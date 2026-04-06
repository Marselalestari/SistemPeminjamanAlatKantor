<x-app-layout>
    {{-- Background Wrapper --}}
    <div class="min-h-screen bg-gray-50 py-12 relative overflow-hidden">
        
        {{-- Dekorasi Lembut --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-20 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, #e5e7eb 1px, transparent 0); background-size: 40px 40px;"></div>

        <div class="max-w-2xl mx-auto px-4 relative z-10">
            
            {{-- Link Kembali --}}
            <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center text-gray-400 hover:text-emerald-600 transition-colors mb-6 group text-xs font-black uppercase tracking-widest">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Database
            </a>

            {{-- Form Card --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-gray-200/50 overflow-hidden">
                <div class="p-8 md:p-12">
                    <div class="mb-10">
                        <h1 class="text-3xl font-black text-gray-800 tracking-tighter italic uppercase">
                             <span class="text-emerald-600">Perbarui Data</span>
                        </h1>
                        <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.4em] mt-1"></p>
                    </div>

                    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        {{-- Input Nama Kategori --}}
                        <div class="relative group">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-emerald-600 transition-colors">
                                Label Kategori
                            </label>
                            <input type="text"
                                   name="nama_kategori"
                                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                                   class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300">
                            @error('nama_kategori')
                                <div class="flex items-center gap-1 mt-2 text-rose-500 italic font-bold text-xs ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Input Deskripsi --}}
                        <div class="relative group">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-emerald-600 transition-colors">
                                Deskripsi Kategori
                            </label>
                            <textarea name="deskripsi"
                                      rows="4"
                                      class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300 resize-none">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <button type="submit"
                                    class="flex-1 flex items-center justify-center gap-3 px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl transition-all duration-300 shadow-lg shadow-emerald-600/20 active:scale-95">
                                <span>Perbarui</span>
                            </button>
                            
                            <a href="{{ route('admin.kategori.index') }}"
                               class="flex items-center justify-center px-8 py-4 bg-gray-100 text-gray-500 hover:bg-gray-200 hover:text-gray-700 text-xs font-black uppercase tracking-[0.2em] rounded-2xl transition-all duration-300">
                                <span>Batal</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

           
    </div>
</x-app-layout>