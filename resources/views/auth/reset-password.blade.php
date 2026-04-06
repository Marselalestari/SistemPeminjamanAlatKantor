<x-guest-layout>

    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
            Reset <span class="text-emerald-500 italic font-serif">Security.</span>
        </h2>
        <p class="text-slate-400 text-sm mt-2 font-medium tracking-wide">
            Perbarui kata sandi Anda untuk mengamankan akun
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="group">
            <label for="email" class="block text-xs font-bold uppercase tracking-[0.2em] text-slate-400 mb-2 group-focus-within:text-emerald-400 transition-colors">
                Confirmed Email
            </label>
            <div class="relative flex items-center">
                <div class="absolute left-4 text-slate-500 group-focus-within:text-emerald-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input id="email"
                    type="email"
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    required
                    autofocus
                    readonly
                    autocomplete="username"
                    class="w-full pl-12 pr-5 py-4 rounded-2xl bg-white/[0.03] border border-white/10 text-slate-400 cursor-not-allowed
                           focus:outline-none backdrop-blur-md" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] font-bold uppercase tracking-wider text-red-400/80" />
        </div>

        <div class="group">
            <label for="password" class="block text-xs font-bold uppercase tracking-[0.2em] text-slate-400 mb-2 group-focus-within:text-emerald-400 transition-colors">
                New Password
            </label>
            <div class="relative flex items-center">
                <div class="absolute left-4 text-slate-500 group-focus-within:text-emerald-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <input id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Minimal 8 karakter"
                    class="w-full pl-12 pr-5 py-4 rounded-2xl bg-white/[0.03] border border-white/10 text-white placeholder-slate-600
                           focus:border-emerald-500/50 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none
                           transition-all duration-300 backdrop-blur-md" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[10px] font-bold uppercase tracking-wider text-red-400/80" />
        </div>

        <div class="group">
            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-[0.2em] text-slate-400 mb-2 group-focus-within:text-emerald-400 transition-colors">
                Verify New Password
            </label>
            <div class="relative flex items-center">
                <div class="absolute left-4 text-slate-500 group-focus-within:text-emerald-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <input id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    placeholder="Ulangi password baru"
                    class="w-full pl-12 pr-5 py-4 rounded-2xl bg-white/[0.03] border border-white/10 text-white placeholder-slate-600
                           focus:border-emerald-500/50 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none
                           transition-all duration-300 backdrop-blur-md" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-[10px] font-bold uppercase tracking-wider text-red-400/80" />
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full py-4 rounded-2xl font-bold text-xs tracking-[0.2em] uppercase
                       bg-gradient-to-r from-emerald-600 to-green-800 text-white
                       hover:from-emerald-500 hover:to-green-700
                       shadow-xl shadow-emerald-900/20
                       transform transition duration-300 hover:-translate-y-1 active:scale-[0.98] focus:outline-none">
                Update Password
            </button>
        </div>

    </form>
</x-guest-layout>