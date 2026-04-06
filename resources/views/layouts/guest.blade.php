<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPAK - Sistem Peminjaman Alat Kantor') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #ffffff; 
        }
        
        .elegant-card {
            /* Kartu putih bersih dengan bayangan lembut */
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 2.5rem;
            box-shadow: 0 20px 50px -12px rgba(16, 185, 129, 0.1);
        }

        .logo-container {
            width: 110px;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #ffffff;
            border: 1px solid #f0fdf4;
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .logo-container:hover {
            transform: translateY(-8px) scale(1.05);
            border-color: #10b981;
            box-shadow: 0 20px 30px -10px rgba(16, 185, 129, 0.2);
        }

        /* Background mesh putih dengan bias hijau cerah di pojok */
        .bg-white-mesh {
            background-color: #ffffff;
            background-image: 
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(52, 211, 153, 0.05) 0px, transparent 50%);
        }
    </style>
</head>

<body class="antialiased text-slate-800 selection:bg-emerald-100 selection:text-emerald-900">

    <div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-white-mesh">
        
        <div class="absolute -top-32 -left-32 w-[600px] h-[600px] bg-emerald-400/5 rounded-full blur-[120px]"></div>
        <div class="absolute -bottom-32 -right-32 w-[600px] h-[600px] bg-lime-400/5 rounded-full blur-[120px]"></div>

        <div class="relative z-10 w-full max-w-md px-6 py-12">

            <div class="flex flex-col items-center mb-10">
                <a href="/" class="group relative">
                    <div class="absolute inset-0 bg-emerald-400/10 rounded-full blur-2xl group-hover:bg-emerald-400/20 transition duration-700"></div>
                    
                    <div class="logo-container relative z-10 flex items-center justify-center">
                        <img 
                            src="{{ asset('images/logo.png') }}" 
                            alt="Logo SIPAK" 
                            class="w-20 h-20 object-contain"
                        >
                    </div>
                </a>

                <div class="mt-6 text-center px-4">
                    <h1 class="text-3xl font-extrabold tracking-[0.25em] text-slate-900 uppercase">
                        SIPAK<span class="text-emerald-500">.</span>
                    </h1>
                    <div class="flex items-center justify-center gap-2.5 mt-2.5">
                        <span class="h-[1.5px] w-5 bg-emerald-500/20"></span>
                        <p class="text-[10px] uppercase tracking-[0.45em] text-emerald-600 font-bold">
                            Professional System
                        </p>
                        <span class="h-[1.5px] w-5 bg-emerald-500/20"></span>
                    </div>
                </div>
            </div>

            <div class="elegant-card px-8 py-10 transition-all duration-500">
                {{ $slot }}
            </div>

            <div class="mt-12 text-center">
                <p class="text-[10px] uppercase tracking-widest text-slate-400 font-bold">
                    &copy; {{ date('Y') }} <span class="text-emerald-400">—</span> SIPAK Global Teknologi
                </p>
                <div class="mt-4 flex justify-center gap-6">
                    <a href="#" class="text-[9px] font-bold text-slate-400 hover:text-emerald-500 transition-colors uppercase tracking-widest">Privacy Policy</a>
                    <a href="#" class="text-[9px] font-bold text-slate-400 hover:text-emerald-500 transition-colors uppercase tracking-widest">Terms of Service</a>
                </div>
            </div>

        </div>
    </div>

</body>
</html>