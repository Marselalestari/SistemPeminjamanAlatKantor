<nav x-data="{ open: false }" class="bg-[#020d0a]/90 backdrop-blur-xl border-b border-emerald-500/20 sticky top-0 z-50 shadow-[0_4px_30px_rgba(0,0,0,0.5)]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">

            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('operator.dashboard') }}" class="group transition-all duration-300">
                        <div class="relative">
                            {{-- Cahaya di belakang logo --}}
                            <div class="absolute -inset-2 bg-emerald-500/20 blur-xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <x-application-logo class="relative block h-10 w-auto fill-current text-emerald-400 drop-shadow-[0_0_12px_rgba(52,211,153,0.6)]" />
                        </div>
                    </a>
                </div>

                <!-- Navigation Links (DESKTOP) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @php
                        $navClasses = "inline-flex items-center px-1 pt-1 text-sm font-bold tracking-wider transition-all duration-300 uppercase";
                        $activeClass = "text-emerald-400 border-b-2 border-emerald-400 drop-shadow-[0_0_8px_rgba(52,211,153,0.5)]";
                        $inactiveClass = "text-emerald-100/50 border-b-2 border-transparent hover:text-emerald-300 hover:border-emerald-500/50";
                    @endphp

                    <x-nav-link :href="route('operator.dashboard')" :active="request()->routeIs('operator.dashboard')" 
                        class="{{ request()->routeIs('operator.dashboard') ? $activeClass : $inactiveClass }} {{ $navClasses }}">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('operator.peminjaman.index')" :active="request()->routeIs('operator.peminjaman.*')"
                        class="{{ request()->routeIs('operator.peminjaman.*') ? $activeClass : $inactiveClass }} {{ $navClasses }}">
                        {{ __('Peminjaman') }}
                    </x-nav-link>

                    <x-nav-link :href="route('operator.peminjaman.laporan-bulanan')" :active="request()->routeIs('operator.peminjaman.laporan-bulanan')"
                        class="{{ request()->routeIs('operator.peminjaman.laporan-bulanan') ? $activeClass : $inactiveClass }} {{ $navClasses }}">
                        {{ __('Laporan') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 bg-emerald-950/30 border border-emerald-500/30 rounded-2xl text-sm font-bold text-emerald-300 hover:bg-emerald-500/10 hover:border-emerald-400/50 transition-all duration-300 group shadow-[0_0_15px_rgba(16,185,129,0.05)]">
                            <div class="flex items-center gap-3">
                                {{-- Status Indicator Dot --}}
                                <div class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </div>
                                <span class="group-hover:text-white transition-colors">{{ Auth::user()->name }}</span>
                            </div>
                            <svg class="ms-2 h-4 w-4 fill-current text-emerald-500 group-hover:rotate-180 transition-transform duration-300" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-[#05110e] border border-emerald-500/20 rounded-xl overflow-hidden shadow-2xl">
                            <x-dropdown-link :href="route('profile.edit')" class="text-emerald-100/70 hover:bg-emerald-500/10 hover:text-emerald-400 transition-colors">
                                {{ __('My Profile') }}
                            </x-dropdown-link>

                            <div class="border-t border-emerald-500/10"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-red-400 hover:bg-red-500/10 transition-colors">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-emerald-400 hover:bg-emerald-500/10 border border-transparent hover:border-emerald-500/30 transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#020d0a] border-t border-emerald-500/20">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('operator.dashboard')" :active="request()->routeIs('operator.dashboard')" 
                class="border-s-4 border-emerald-500 text-emerald-100 bg-emerald-500/10">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            {{-- Tambahkan link lainnya dengan style serupa --}}
        </div>
    </div>
</nav>