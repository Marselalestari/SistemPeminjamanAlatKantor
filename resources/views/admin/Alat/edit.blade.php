<x-app-layout>
    {{-- Container Utama: Clean White Background --}}
    <div class="min-h-screen bg-gray-50 py-12">
        
        {{-- Form Card: Clean Minimalist Style --}}
        <div class="max-w-2xl mx-auto py-10 px-8 bg-white border border-gray-200 shadow-sm rounded-[2rem] relative">

            <h1 class="text-3xl font-black text-gray-900 italic tracking-tighter mb-8 uppercase">
                {{ isset($alat) ? 'Modify' : 'Add' }} 
                <span class="text-emerald-600">Asset Alat</span>
            </h1>

            <form method="POST"
                  action="{{ isset($alat)
                          ? route('admin.alat.update', $alat->id)
                          : route('admin.alat.store') }}"
                  enctype="multipart/form-data"
                  class="space-y-6">

                @csrf
                @isset($alat)
                    @method('PUT')
                @endisset

                <div class="group">
                    <label class="block mb-2 text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 ml-1">
                        Nama Alat
                    </label>
                    <input type="text"
                           name="nama_alat"
                           value="{{ old('nama_alat', $alat->nama_alat ?? '') }}"
                           placeholder="Enter device name..."
                           class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none transition-all duration-300">
                </div>

                <div class="group">
                    <label class="block mb-2 text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 ml-1">
                        Kategori
                    </label>
                    <div class="relative">
                        <select name="kategori_id"
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none transition-all duration-300 appearance-none cursor-pointer">
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id }}"
                                    @selected(old('kategori_id', $alat->kategori_id ?? '') == $k->id)>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        {{-- Custom Arrow --}}
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-emerald-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                <div class="group">
                    <label class="block mb-2 text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 ml-1">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi"
                              placeholder="Describe the asset details..."
                              class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none transition-all duration-300 resize-none"
                              rows="4">{{ old('deskripsi', $alat->deskripsi ?? '') }}</textarea>
                </div>

                <div class="group">
                    <label class="block mb-2 text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 ml-1">
                        Stok Unit
                    </label>
                    <input type="number"
                           name="stok"
                           value="{{ old('stok', $alat->stok ?? '') }}"
                           class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none transition-all duration-300">
                </div>

                <div class="group">
                    <label class="block mb-2 text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 ml-1">
                        Visual Source (Foto)
                    </label>
                    <input type="file"
                           name="foto"
                           class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 text-gray-600 text-sm file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 transition-all cursor-pointer">
                </div>

                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('admin.alat.index') }}"
                       class="px-6 py-3 rounded-xl bg-gray-100 text-gray-600 text-xs font-black uppercase tracking-widest hover:bg-gray-200 transition-all duration-300">
                        Kembali
                    </a>
                    <button type="submit"
                            class="px-10 py-3 rounded-xl bg-emerald-600 text-white text-xs font-black uppercase tracking-widest hover:bg-emerald-700 transition-all duration-300 active:scale-95">
                        Simpan Data
                    </button>
                </div>

            </form>
        </div>

        {{-- Footer Info --}}
        <p class="text-center mt-8 text-gray-400 text-[9px] font-bold uppercase tracking-[0.5em]">
            Secure Inventory Management Protocol
        </p>
    </div>
</x-app-layout>