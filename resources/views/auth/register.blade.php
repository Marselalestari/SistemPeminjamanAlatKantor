<x-guest-layout>
    {{-- Wrapper dengan Background Hijau Samar --}}
    <div class="fixed inset-0 -z-10 bg-[radial-gradient(circle_at_top_right,_#ecfdf5,_#ffffff)]"></div>
    
    {{-- Ornamen Lingkaran Samar untuk estetika --}}
    <div class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-emerald-100/30 rounded-full blur-3xl"></div>

    <div class="mb-10 text-center relative">
        {{-- Badge Kecil di atas judul --}}
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100/50 border border-emerald-200 mb-4">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
            <span class="text-[9px] font-black text-emerald-700 uppercase tracking-[0.2em]">Registration Portal</span>
        </div>
        
        <h2 class="text-3xl font-bold tracking-tight text-emerald-950 sm:text-4xl heading-classic">
            Create <span class="text-gradient italic">Account.</span>
        </h2>
        <p class="text-emerald-900/60 text-sm mt-3 font-medium tracking-wide">
            Daftarkan diri untuk bergabung dengan SIPAK
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6 relative">
        @csrf

        {{-- FULL NAME --}}
        <div class="group">
            <label for="name" class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-800/50 mb-2 group-focus-within:text-emerald-600 transition-colors">
                Full Name
            </label>
            <div class="relative flex items-center">
                <div class="absolute left-4 text-emerald-300 group-focus-within:text-emerald-500 transition-colors">
                    <i data-lucide="user" class="w-5 h-5"></i>
                </div>
                <input id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Nama Lengkap"
                    class="w-full pl-12 pr-5 py-4 rounded-2xl bg-white/60 border border-emerald-100 text-emerald-950 placeholder-emerald-200
                           focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none
                           transition-all duration-300 shadow-sm shadow-emerald-900/5" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-[10px] font-bold uppercase tracking-wider text-red-500" />
        </div>

        {{-- NIK --}}
        <div class="group">
            <label for="nik" class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-800/50 mb-2 group-focus-within:text-emerald-600 transition-colors">
                Nomor Induk Karyawan (NIK)
            </label>
            <div class="relative flex items-center">
                <div class="absolute left-4 text-emerald-300 group-focus-within:text-emerald-500 transition-colors">
                    <i data-lucide="credit-card" class="w-5 h-5"></i>
                </div>
                <input id="nik"
                    type="text"
                    name="nik"
                    value="{{ old('nik') }}"
                    required
                    placeholder="Masukkan NIK"
                    class="w-full pl-12 pr-5 py-4 rounded-2xl bg-white/60 border border-emerald-100 text-emerald-950 placeholder-emerald-200
                           focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none
                           transition-all duration-300 shadow-sm shadow-emerald-900/5" />
            </div>
            <x-input-error :messages="$errors->get('nik')" class="mt-2 text-[10px] font-bold uppercase tracking-wider text-red-500" />
        </div>

        {{-- EMAIL --}}
        <div class="group">
            <label for="email" class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-800/50 mb-2 group-focus-within:text-emerald-600 transition-colors">
                Email Address
            </label>
            <div class="relative flex items-center">
                <div class="absolute left-4 text-emerald-300 group-focus-within:text-emerald-500 transition-colors">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                </div>
                <input id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    placeholder="nama@perusahaan.com"
                    class="w-full pl-12 pr-5 py-4 rounded-2xl bg-white/60 border border-emerald-100 text-emerald-950 placeholder-emerald-200
                           focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none
                           transition-all duration-300 shadow-sm shadow-emerald-900/5" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] font-bold uppercase tracking-wider text-red-500" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- PASSWORD --}}
            <div class="group">
                <label for="password" class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-800/50 mb-2 group-focus-within:text-emerald-600 transition-colors">
                    Password
                </label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 text-emerald-300 group-focus-within:text-emerald-500 transition-colors">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                    </div>
                    <input id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full pl-12 pr-5 py-4 rounded-2xl bg-white/60 border border-emerald-100 text-emerald-950 placeholder-emerald-200
                               focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none
                               transition-all duration-300 shadow-sm shadow-emerald-900/5" />
                </div>
            </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="group">
                <label for="password_confirmation" class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-800/50 mb-2 group-focus-within:text-emerald-600 transition-colors">
                    Confirm
                </label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 text-emerald-300 group-focus-within:text-emerald-500 transition-colors">
                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                    </div>
                    <input id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        placeholder="••••••••"
                        class="w-full pl-12 pr-5 py-4 rounded-2xl bg-white/60 border border-emerald-100 text-emerald-950 placeholder-emerald-200
                               focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none
                               transition-all duration-300 shadow-sm shadow-emerald-900/5" />
                </div>
            </div>
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-[10px] font-bold uppercase tracking-wider text-red-500" />

        {{-- BUTTON --}}
        <div class="pt-4">
            <button type="submit"
                class="w-full py-4 rounded-2xl font-black text-[11px] tracking-[0.25em] uppercase
                       bg-gradient-to-r from-emerald-500 to-emerald-700 text-white
                       hover:from-emerald-400 hover:to-emerald-600
                       shadow-xl shadow-emerald-200
                       transform transition duration-300 hover:-translate-y-1 active:scale-[0.98] focus:outline-none">
                Buat Akun SIPAK
            </button>
        </div>

        <div class="text-center pt-2">
            <p class="text-xs text-emerald-900/40 font-bold uppercase tracking-tighter">
                Sudah memiliki akun?
                <a href="{{ route('login') }}"
                   class="text-emerald-600 hover:text-emerald-400 font-black tracking-widest ml-1 transition-colors border-b-2 border-emerald-100 hover:border-emerald-400">
                    Masuk
                </a>
            </p>
        </div>
    </form>
    
    {{-- Inisialisasi Lucide Icons --}}
    <script>lucide.createIcons();</script>
</x-guest-layout>