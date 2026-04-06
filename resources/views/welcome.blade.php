<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>SIPAK - Sistem Peminjaman Alat Kantor</title>

<link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">

<script src="https://unpkg.com/lucide@latest"></script>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background-color: #030303;
    color: #fafafa;
    font-size: 14px;
    line-height: 1.6;
    letter-spacing: 0.2px;
}

/* BACKGROUND */
#hero-video-bg {
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -2;
    filter: grayscale(100%) brightness(25%) contrast(120%);
}

.hero-overlay {
    position: fixed;
    inset: 0;
    background: radial-gradient(circle at center, rgba(16,185,129,0.12), rgba(0,0,0,0.95));
    z-index: -1;
}

/* NAVBAR */
.glass-nav {
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(16,185,129,0.2);
}

/* BUTTON */
.btn-classic {
    background: linear-gradient(135deg, #10b981, #22c55e);
    color: #fff;
    transition: 0.3s;
    box-shadow: 0 4px 15px rgba(16,185,129,0.4);
}

.btn-classic:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16,185,129,0.6);
}

.btn-outline {
    border: 1px solid rgba(16,185,129,0.5);
    color: #34d399;
}

/* TEXT */
h1, h2, h3 {
    font-weight: 600;
    letter-spacing: -0.3px;
}

p {
    font-size: 13.5px;
    line-height: 1.7;
    color: #9ca3af;
}

/* HEADING */
.heading-classic {
    font-family: 'Playfair Display', serif;
}

.text-gradient {
    background: linear-gradient(90deg, #10b981, #6ee7b7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* CARD */
.feature-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.06);
    backdrop-filter: blur(10px);
    transition: 0.3s;
}

.feature-card:hover {
    transform: translateY(-8px);
    border-color: rgba(16,185,129,0.5);
}

.icon-box {
    background: rgba(16,185,129,0.15);
    border: 1px solid rgba(16,185,129,0.3);
    color: #10b981;
}

/* ANIMATION */
.reveal {
    opacity: 0;
    transform: translateY(30px);
    transition: 0.7s ease;
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
}
</style>
</head>

<body class="antialiased">

<!-- VIDEO -->
<video id="hero-video-bg" autoplay muted loop>
    <source src="{{ asset('storage/video/video.mp4') }}" type="video/mp4">
</video>
<div class="hero-overlay"></div>

<!-- NAVBAR -->
<header class="fixed top-0 w-full glass-nav z-50">
<div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
    
    <div class="flex items-center gap-2">
        <img src="{{ asset('images/logo.png') }}" class="w-7">
        <h1 class="text-sm font-semibold">SIPAK<span class="text-emerald-500">.</span></h1>
    </div>

    @auth
    <a href="/dashboard" class="px-5 py-2 rounded-full btn-classic text-xs font-medium">
        Dashboard
    </a>
    @else
    <div class="flex gap-4 text-sm">
        <a href="{{ route('login') }}" class="text-gray-400 hover:text-white">Masuk</a>
        <a href="{{ route('register') }}" class="px-5 py-2 rounded-full btn-classic text-xs font-medium">
            Daftar
        </a>
    </div>
    @endauth

</div>
</header>

<!-- HERO -->
<section class="min-h-screen flex items-center justify-center text-center px-6">
<div>
    <h2 class="text-3xl md:text-5xl heading-classic mb-5">
        Sistem Peminjaman Alat Kantor <br>
        <span class="text-gradient">SIPAK</span>
    </h2>

    <p class="max-w-lg mx-auto mb-8">
        Sistem peminjaman alat modern, cepat, dan efisien untuk perusahaan Anda.
    </p>

    @guest
    <a href="{{ route('register') }}" class="px-7 py-3 rounded-full btn-classic text-xs font-medium">
        Mulai Sekarang
    </a>
    @endguest
</div>
</section>

<!-- CARA PEMINJAMAN -->
<section class="py-24 bg-black/80">
<div class="max-w-6xl mx-auto px-6">

    <div class="text-center mb-16">
        <h2 class="text-2xl md:text-3xl heading-classic mb-4">
            Cara Peminjaman <span class="text-gradient">Alat Kantor</span>
        </h2>
        <p class="max-w-xl mx-auto">
            Ikuti langkah sederhana berikut untuk melakukan peminjaman alat.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">

        <!-- STEP 1 -->
        <div class="feature-card p-6 rounded-xl text-center reveal">
            <div class="icon-box w-12 h-12 flex items-center justify-center rounded-lg mb-4 mx-auto">
                <i data-lucide="log-in" class="w-5 h-5"></i>
            </div>
            <h3 class="text-base mb-2">1. Login</h3>
            <p>Masuk ke sistem menggunakan akun Anda.</p>
        </div>

        <!-- STEP 2 -->
        <div class="feature-card p-6 rounded-xl text-center reveal">
            <div class="icon-box w-12 h-12 flex items-center justify-center rounded-lg mb-4 mx-auto">
                <i data-lucide="clipboard-list" class="w-5 h-5"></i>
            </div>
            <h3 class="text-base mb-2">2. Pilih Alat</h3>
            <p>Pilih alat dan ajukan peminjaman.</p>
        </div>

        <!-- STEP 3 -->
        <div class="feature-card p-6 rounded-xl text-center reveal">
            <div class="icon-box w-12 h-12 flex items-center justify-center rounded-lg mb-4 mx-auto">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
            </div>
            <h3 class="text-base mb-2">3. Ambil</h3>
            <p>Ambil alat setelah disetujui.</p>
        </div>

    </div>
</div>
</section>

<!-- FOOTER -->
<footer class="py-8 text-center text-gray-500 text-xs border-t border-white/10">
    © 2024 SIPAK - All Rights Reserved
</footer>

<script>
lucide.createIcons();

const observer = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) e.target.classList.add('active');
    });
});

document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>