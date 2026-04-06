<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4">

        {{-- Alert Success --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-100 text-emerald-800 rounded-2xl border border-emerald-200 text-sm font-bold uppercase tracking-widest">
                ✓ {{ session('success') }}
            </div>
        @endif

        {{-- Alert Error --}}
        @if (session('error'))
            <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-2xl border border-red-200 text-sm font-bold uppercase tracking-widest">
                × {{ session('error') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="text-3xl font-black text-emerald-900 uppercase tracking-tighter">👥 Data Pengguna</h1>
                <p class="text-emerald-600/70 text-xs font-bold uppercase tracking-[0.2em] mt-1">Management System Access</p>
            </div>

            <a href="{{ route('admin.pengguna.create') }}"
               class="inline-flex items-center bg-gradient-to-r from-emerald-600 to-emerald-500 text-white px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:from-emerald-700 hover:to-emerald-600 transition-all shadow-lg shadow-emerald-600/20 active:scale-95">
                + Tambah Pengguna
            </a>
        </div>

        {{-- Table --}}
        <div class="bg-white border border-emerald-200 shadow-sm shadow-emerald-100/50 rounded-[2rem] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gradient-to-r from-emerald-800 to-emerald-700 text-white border-b border-emerald-600">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-black text-white uppercase tracking-[0.2em]">NIK</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black text-white uppercase tracking-[0.2em]">Nama</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black text-white uppercase tracking-[0.2em]">Email</th>
                            <th class="px-6 py-4 text-center text-[10px] font-black text-white uppercase tracking-[0.2em]">Role</th>
                            <th class="px-6 py-4 text-center text-[10px] font-black text-white uppercase tracking-[0.2em]">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-emerald-100">
                        @forelse ($pengguna as $p)
                        <tr class="hover:bg-emerald-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-emerald-900">{{ $p->nik }}</td>
                            <td class="px-6 py-4 font-bold text-emerald-900">{{ $p->name }}</td>
                            <td class="px-6 py-4 text-emerald-700">{{ $p->email }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($p->role === 'admin')
                                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-[10px] font-black uppercase tracking-widest inline-block">Admin</span>
                                @elseif ($p->role === 'operator')
                                    <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-black uppercase tracking-widest inline-block">Operator</span>
                                @else
                                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-black uppercase tracking-widest inline-block">User</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.pengguna.edit', $p->id) }}"
                                       class="px-4 py-2 bg-emerald-100 text-emerald-700 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-emerald-200 transition">
                                        Edit
                                    </a>

                                    @if (auth()->id() !== $p->id)
                                        <form action="{{ route('admin.pengguna.destroy', $p->id) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-4 py-2 bg-red-100 text-red-600 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-red-200 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-emerald-400 font-bold uppercase tracking-widest text-xs">
                                Tidak ada data pengguna
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>