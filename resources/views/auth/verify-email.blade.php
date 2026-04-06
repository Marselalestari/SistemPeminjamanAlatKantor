<x-guest-layout>
    <div class="mb-8 flex justify-center">
        <div class="relative">
            <div class="absolute inset-0 bg-emerald-500/20 rounded-full blur-2xl"></div>
            <div class="relative bg-white/[0.03] border border-white/10 p-5 rounded-full backdrop-blur-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold tracking-tight text-white">
            Verify <span class="text-emerald-500 italic font-serif">Email.</span>
        </h2>
        <p class="text-slate-400 text-sm mt-4 leading-relaxed px-2">
            {{ __('Terima kasih telah bergabung! Silakan verifikasi alamat email Anda melalui tautan yang baru saja kami kirimkan. Belum menerima email? Kami akan mengirimkan ulang.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-8 p-4 rounded-2xl bg-green-500/10 border border-green-500/20 text-center">
            <p class="text-xs font-bold uppercase tracking-widest text-green-400">
                {{ __('Tautan baru telah dikirimkan ke email Anda.') }}
            </p>
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="w-full py-4 rounded-2xl font-bold text-xs tracking-[0.2em] uppercase
                       bg-gradient-to-r from-emerald-600 to-green-800 text-white
                       hover:from-emerald-500 hover:to-green-700
                       shadow-xl shadow-emerald-900/20
                       transform transition duration-300 hover:-translate-y-1 active:scale-[0.98] focus:outline-none">
                {{ __('Kirim Ulang Email Verifikasi') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" 
                class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 hover:text-red-400 transition-colors duration-300">
                {{ __('Keluar Sesi (Log Out)') }}
            </button>
        </form>
    </div>
</x-guest-layout>