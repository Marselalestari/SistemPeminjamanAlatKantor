<x-app-layout>
    {{-- Container Utama dengan Background Hijau Muda --}}
    <div class="min-h-screen bg-emerald-50/30 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Kategori Alat</h1>
                    <p class="text-emerald-600/70 text-sm mt-1">Kelola daftar kategori untuk sistem peminjaman Anda.</p>
                </div>

                <a href="{{ route('admin.kategori.create') }}"
                   class="inline-flex items-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold uppercase tracking-wide rounded-lg transition-all duration-200 shadow-sm hover:shadow-emerald-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Kategori
                </a>
            </div>

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-100 border border-emerald-200 text-emerald-800 rounded-lg text-sm font-medium flex items-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Data Table --}}
            <div class="bg-white border border-emerald-100 rounded-xl shadow-sm overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-emerald-50/50 border-b border-emerald-100">
                        <tr>
                            <th class="px-6 py-4 font-bold text-emerald-600 uppercase tracking-wider text-[11px]">No</th>
                            <th class="px-6 py-4 font-bold text-emerald-600 uppercase tracking-wider text-[11px]">Kategori</th>
                            <th class="px-6 py-4 font-bold text-emerald-600 uppercase tracking-wider text-[11px]">Deskripsi</th>
                            <th class="px-6 py-4 font-bold text-emerald-600 uppercase tracking-wider text-[11px] text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-emerald-50">
                        @forelse($kategoris as $kategori)
                            <tr class="hover:bg-emerald-50/30 transition-colors">
                                <td class="px-6 py-4 text-gray-500 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-semibold text-gray-800">{{ $kategori->nama_kategori }}</td>
                                <td class="px-6 py-4 text-gray-500 text-xs italic">{{ $kategori->deskripsi ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="p-2 text-emerald-600 hover:bg-emerald-100 rounded-md transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Hapus data?')" class="p-2 text-red-400 hover:bg-red-50 rounded-md transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-gray-400 font-medium italic">Belum ada data tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>