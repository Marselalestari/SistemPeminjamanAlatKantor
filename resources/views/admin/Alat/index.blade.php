<x-app-layout>

<div class="min-h-screen bg-emerald-50/30 py-10">

    <div class="max-w-7xl mx-auto px-4 relative">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-8">

            <h1 class="text-3xl font-extrabold text-emerald-900 tracking-tight">
                📦 Data <span class="text-emerald-600">Alat</span>
            </h1>

            <a href="{{ route('admin.alat.create') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600
                       text-white font-semibold px-5 py-2.5 rounded-xl
                       shadow-md shadow-emerald-200 transition active:scale-95">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                        d="M12 4v16m8-8H4"/>
                </svg>

                Tambah Alat
            </a>

        </div>

        {{-- TABLE CONTAINER --}}
        <div class="bg-white border border-emerald-200 shadow-sm shadow-emerald-100/50 rounded-2xl overflow-hidden">

            <table class="w-full">

                {{-- HEAD --}}
                <thead class="bg-gradient-to-r from-emerald-800 to-emerald-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider border-b border-emerald-600">
                            Foto
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider border-b border-emerald-600">
                            Nama Alat
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider border-b border-emerald-600">
                            Kategori
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider border-b border-emerald-600">
                            Deskripsi
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider border-b border-emerald-600">
                            Stok
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider border-b border-emerald-600">
                            Aksi
                        </th>
                    </tr>
                </thead>

                {{-- BODY --}}
                <tbody class="divide-y divide-emerald-100">

                    @forelse ($alat as $a)

                    <tr class="hover:bg-emerald-50/50 transition">

                        {{-- FOTO --}}
                        <td class="px-6 py-4">
                            @if ($a->foto)
                                <img src="{{ asset('storage/' . $a->foto) }}"
                                    class="w-16 h-12 object-cover rounded-lg border border-emerald-200 shadow-sm">
                            @else
                                <div class="w-16 h-12 flex items-center justify-center
                                            bg-emerald-50 rounded-lg border border-dashed border-emerald-300">
                                    <span class="text-emerald-400 text-[10px] font-bold">
                                        NO IMAGE
                                    </span>
                                </div>
                            @endif
                        </td>

                        {{-- NAMA --}}
                        <td class="px-6 py-4 font-bold text-emerald-900">
                            {{ $a->nama_alat }}
                        </td>

                        {{-- KATEGORI --}}
                        <td class="px-6 py-4 text-emerald-700">
                            <span class="px-2.5 py-1 bg-emerald-100 text-emerald-800 rounded-md text-xs font-semibold">
                                {{ $a->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>

                        {{-- DESKRIPSI --}}
                        <td class="px-6 py-4 text-sm text-emerald-600">
                            {{ $a->deskripsi ? Str::limit($a->deskripsi, 40) : '-' }}
                        </td>

                        {{-- STOK --}}
                        <td class="px-6 py-4 text-center">
                            <span class="inline-block min-w-[32px] px-2 py-1 bg-emerald-100 text-emerald-800
                                         rounded-lg text-xs font-bold border border-emerald-200">
                                {{ $a->stok }}
                            </span>
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.alat.edit', $a->id) }}"
                                    class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition"
                                    title="Edit Data">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 morning-828 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>

                                <form action="{{ route('admin.alat.destroy', $a->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus data alat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition"
                                        title="Hapus Data">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center py-20">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-emerald-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 00-2 2H6a2 2 0 00-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                <p class="text-emerald-400 font-medium">Belum ada data alat tersedia.</p>
                            </div>
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

</x-app-layout>