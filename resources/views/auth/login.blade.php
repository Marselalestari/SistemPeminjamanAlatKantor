<x-guest-layout>
    <x-auth-session-status class="mb-6" :status="session('status')" />
    
    @if (session('status'))
        <div class="mb-6 text-xs font-bold tracking-widest uppercase text-emerald-700 bg-emerald-50 border border-emerald-200 p-4 rounded-2xl text-center shadow-sm">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="group">
            <label for="email" class="block text-xs font-bold uppercase tracking-[0.2em] text-slate-500 mb-2 group-focus-within:text-emerald-600 transition-colors">
                Email Address
            </label>

            <div class="relative flex items-center">
                <div class="absolute left-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                
                <input id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="masukkan email anda"
                    class="w-full pl-12 pr-5 py-4 rounded-2xl bg-slate-50 border border-slate-200 text-slate-800 placeholder-slate-400
                           focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none
                           transition-all duration-300 shadow-sm" />
            </div>

            <x-input-error :messages="$errors->get('email')" 
                class="mt-2 text-[10px] font-bold uppercase tracking-wider text-red-500" />
        </div>

        <div class="group">
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-xs font-bold uppercase tracking-[0.2em] text-slate-500 group-focus-within:text-emerald-600 transition-colors">
                    Password
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-[10px] font-bold uppercase tracking-widest text-slate-400 hover:text-emerald-600 transition-colors">
                        Lupa?
                    </a>
                @endif
            </div>

            <div class="relative flex items-center">
                <div class="absolute left-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>

                <input id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full pl-12 pr-12 py-4 rounded-2xl bg-slate-50 border border-slate-200 text-slate-800 placeholder-slate-400
                           focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none
                           transition-all duration-300 shadow-sm" />

                <button type="button"
                        class="absolute right-4 text-slate-400 hover:text-emerald-600 transition-colors focus:outline-none"
                        onclick="togglePassword()">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path id="eyePath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" 
                class="mt-2 text-[10px] font-bold uppercase tracking-wider text-red-500" />
        </div>

        <div class="flex items-center">
            <label for="remember_me" class="flex items-center group cursor-pointer">
                <input id="remember_me"
                       type="checkbox"
                       name="remember"
                       class="w-4 h-4 rounded border-slate-300 bg-white text-emerald-600 focus:ring-emerald-500 transition-all cursor-pointer">
                <span class="ml-3 text-xs font-semibold text-slate-500 group-hover:text-emerald-700 transition-colors uppercase tracking-widest">Ingat sesi saya</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full py-4 rounded-2xl font-bold text-xs tracking-[0.2em] uppercase
                       bg-emerald-600 text-white
                       hover:bg-emerald-500
                       shadow-lg shadow-emerald-200
                       transform transition duration-300 hover:-translate-y-1 active:scale-[0.98] focus:outline-none">
                Masuk Dashboard
            </button>
        </div>

        @if (Route::has('register'))
            <div class="text-center pt-4">
                <p class="text-xs text-slate-500 font-medium tracking-wide">
                    Belum memiliki akun? 
                    <a href="{{ route('register') }}"
                       class="text-emerald-600 hover:text-emerald-700 font-bold uppercase tracking-widest ml-1 transition-colors border-b-2 border-emerald-100 hover:border-emerald-500">
                        Daftar
                    </a>
                </p>
            </div>
        @endif
    </form>

    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyePath = document.getElementById('eyePath');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyePath.setAttribute('d', 'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18');
        } else {
            passwordInput.type = 'password';
            eyePath.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z');
        }
    }
    </script>
</x-guest-layout>