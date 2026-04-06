<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4">

            {{-- Welcome --}}
            <div class="mb-10">
                <h2 class="text-2xl md:text-3xl font-semibold text-slate-800 tracking-tight">
                    Halo, {{ Auth::user()->name }}
                </h2>
                <p class="text-slate-500 text-sm mt-1">
                    Kelola peminjaman alat dengan mudah dan cepat.
                </p>
            </div>

            {{-- Menu --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Card --}}
                <a href="{{ route('user.alat.index') }}"
                   class="group bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-lg hover:-translate-y-1 transition duration-300">

                    <div class="flex items-center justify-between mb-6">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-slate-300 group-hover:text-emerald-500 transition">→</span>
                    </div>

                    <h3 class="text-base font-semibold text-slate-800">
                        Daftar Alat
                    </h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Lihat dan pilih alat yang tersedia.
                    </p>
                </a>

                {{-- Card --}}
                <a href="{{ route('user.peminjaman.index') }}"
                   class="group bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-lg hover:-translate-y-1 transition duration-300">

                    <div class="flex items-center justify-between mb-6">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0"/>
                            </svg>
                        </div>
                        <span class="text-slate-300 group-hover:text-emerald-500 transition">→</span>
                    </div>

                    <h3 class="text-base font-semibold text-slate-800">
                        Riwayat
                    </h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Cek aktivitas peminjaman kamu.
                    </p>
                </a>

                {{-- Card --}}
                <a href="{{ route('user.peminjaman.create') }}"
                   class="group bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-lg hover:-translate-y-1 transition duration-300">

                    <div class="flex items-center justify-between mb-6">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M9 12l2 2 4-4"/>
                            </svg>
                        </div>
                        <span class="text-slate-300 group-hover:text-emerald-500 transition">→</span>
                    </div>

                    <h3 class="text-base font-semibold text-slate-800">
                        Pinjam Alat
                    </h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Ajukan peminjaman baru.
                    </p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>