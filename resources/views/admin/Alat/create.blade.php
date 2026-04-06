<x-app-layout>
    {{-- Background Wrapper - Off-White (Gray-50) --}}
    <div class="min-h-screen bg-gray-50 py-12">
        
        <div class="max-w-xl mx-auto px-4">
            
            {{-- Form Card - White Clean Look --}}
            <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-[0_20px_50px_rgba(0,0,0,0.05)]">

                <h2 class="text-2xl font-black text-gray-900 italic tracking-tighter mb-8 uppercase">
                    {{ isset($alat) ? 'Modify' : 'Register' }} 
                    <span class="text-emerald-600">Asset Data</span>
                </h2>

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
                        <label class="block text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-2 ml-1">
                            Nama Alat
                        </label>
                        <input type="text"
                               name="nama_alat"
                               value="{{ old('nama_alat', $alat->nama_alat ?? '') }}"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                    </div>

                    <div class="group">
                        <label class="block text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-2 ml-1">
                            Kategori
                        </label>
                        <select name="kategori_id"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all appearance-none cursor-pointer">
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id }}"
                                    @selected(old('kategori_id', $alat->kategori_id ?? '') == $k->id)>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="group">
                        <label class="block text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-2 ml-1">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi"
                                  class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all resize-none"
                                  rows="4">{{ old('deskripsi', $alat->deskripsi ?? '') }}</textarea>
                    </div>

                    <div class="group">
                        <label class="block text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-2 ml-1">
                            Stok Unit
                        </label>
                        <input type="number"
                               name="stok"
                               value="{{ old('stok', $alat->stok ?? '') }}"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                    </div>

                    <div class="group">
                        <label class="block text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-2 ml-1">
                            Visual Asset (Foto)
                        </label>
                        <input type="file"
                               name="foto"
                               class="w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 
                                      file:text-[10px] file:font-black file:uppercase
                                      file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer">
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit"
                                class="bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-[0.2em] px-10 py-4 rounded-xl transition-all shadow-lg shadow-emerald-600/20 active:scale-95">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
            
            <p class="text-center mt-6 text-gray-400 text-[9px] font-bold uppercase tracking-[0.5em]">
                System Ready: White Minimalist Mode
            </p>
        </div>
    </div>
</x-app-layout>