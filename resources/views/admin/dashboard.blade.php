<x-app-layout>
    <div class="min-h-screen bg-slate-50/50 py-12">
        <div class="max-w-7xl mx-auto px-6">

            {{-- HEADER SECTION --}}
            <div class="flex items-end justify-between mb-12">
                <div>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase">Dashboard</h1>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="h-1 w-8 bg-emerald-500 rounded-full"></span>
                        <p class="text-[11px] text-emerald-600 font-bold uppercase tracking-[0.3em]">
                            Inventory Intelligence Overview
                        </p>
                    </div>
                </div>
                <div class="hidden md:block text-right">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu Server</p>
                    <p class="text-sm font-bold text-slate-700">{{ now()->format('d F Y | H:i') }}</p>
                </div>
            </div>

            {{-- STATISTICS CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                @php
                $stats = [
                    ['label'=>'Total Alat','value'=>$totalAlat,'icon'=>'M20 7v8a2 2 0 01-2 2H6a2 2 0 01-2-2V7m16 0l-8-4-8 4m16 0l-8 4m8-4L12 11m0 0l-8-4m8 4v8', 'color' => 'emerald'],
                    ['label'=>'Kategori','value'=>$totalKategori,'icon'=>'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z', 'color' => 'blue'],
                    ['label'=>'Total User','value'=>$totalUser,'icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'indigo'],
                    ['label'=>'Peminjaman','value'=>$totalPeminjaman,'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'color' => 'amber']
                ];
                @endphp

                @foreach ($stats as $stat)
                <div class="bg-white p-7 rounded-[2.5rem] border border-slate-200/60 shadow-[0_10px_30px_rgba(0,0,0,0.02)] hover:shadow-xl hover:shadow-emerald-900/5 transition-all duration-500 group">
                    <div class="flex flex-col gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500 shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $stat['icon'] }}" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em] mb-1">{{ $stat['label'] }}</p>
                            <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $stat['value'] }}</h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- AKTIVITAS TERBARU (LOG) --}}
                <div class="lg:col-span-2 flex flex-col gap-6">
                    {{-- GRAFIK --}}
                    <div class="bg-white rounded-[2.5rem] border border-slate-200/60 shadow-sm p-10">
                        <div class="flex items-center justify-between mb-10">
                            <h3 class="text-[11px] font-black text-slate-900 uppercase tracking-[0.25em]">Statistik Peminjaman</h3>
                            <span class="text-[10px] font-bold text-slate-400 px-3 py-1 bg-slate-50 rounded-lg border border-slate-100">Annual Data 2024</span>
                        </div>
                        <canvas id="monthlyChart" height="100"></canvas>
                    </div>

                    {{-- LIST AKTIVITAS --}}
                    <div class="bg-white rounded-[2.5rem] border border-slate-200/60 shadow-sm p-10">
                        <div class="flex items-center justify-between mb-10">
                            <h3 class="text-[11px] font-black text-slate-900 uppercase tracking-[0.25em]">Log Aktivitas Terbaru</h3>
                            <button class="text-[10px] font-black text-emerald-600 hover:underline tracking-widest uppercase">Lihat Semua</button>
                        </div>
                        
                        <div class="relative">
                            {{-- Vertical Line for Timeline --}}
                            <div class="absolute left-[21px] top-0 bottom-0 w-[1px] bg-slate-100"></div>

                            <div class="space-y-10 relative">
                                @forelse ($peminjamanTerbaru as $peminjaman)
                                <div class="flex items-start gap-6 group">
                                    <div class="relative z-10">
                                        <div class="w-11 h-11 rounded-xl bg-white border-2 border-slate-100 flex items-center justify-center text-slate-400 group-hover:border-emerald-500 group-hover:text-emerald-500 transition-all shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 pb-2 border-b border-slate-50 group-last:border-none">
                                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
                                            <div>
                                                <p class="text-sm font-black text-slate-900 group-hover:text-emerald-600 transition-colors">{{ $peminjaman->user->name }}</p>
                                                <p class="text-xs text-slate-500 mt-0.5">
                                                    Melakukan peminjaman aset <span class="font-bold text-slate-700 italic">"{{ $peminjaman->alat->nama_alat }}"</span>
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-3">
                                                <span class="text-[10px] font-bold text-slate-400 uppercase">{{ $peminjaman->created_at->translatedFormat('d M, H:i') }}</span>
                                                <span class="text-[9px] font-black text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg uppercase tracking-tighter">{{ $peminjaman->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-10">
                                    <p class="text-slate-400 text-xs italic tracking-widest uppercase">System idle - No recent logs</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SIDEBAR: STOCK ALERTS --}}
                <div class="space-y-6">
                    <div class="bg-slate-900 rounded-[2.5rem] shadow-2xl p-8 text-white relative overflow-hidden group">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-500/20 rounded-full blur-3xl transition-all group-hover:bg-emerald-500/40"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-8">
                                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                                <h3 class="text-[11px] font-black uppercase tracking-[0.25em]">Peringatan Stok</h3>
                            </div>

                            <div class="space-y-8">
                                @foreach ($alatStokRendah as $alat)
                                <div class="group/item">
                                    <div class="flex justify-between items-end mb-3">
                                        <div>
                                            <p class="text-[10px] font-black text-slate-500 uppercase mb-1 tracking-widest">Inventory Asset</p>
                                            <h4 class="text-sm font-bold text-slate-200 group-hover/item:text-emerald-400 transition-colors">{{ $alat->nama_alat }}</h4>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-xl font-black text-white leading-none">{{ $alat->stok }}</span>
                                            <p class="text-[9px] font-black text-red-500 uppercase tracking-tighter">Sisa Unit</p>
                                        </div>
                                    </div>
                                    <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-red-600 to-rose-400 h-full rounded-full transition-all duration-1000 shadow-[0_0_10px_rgba(225,29,72,0.5)]" 
                                             style="width: {{ min(100, ($alat->stok / 10) * 100) }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            <button class="w-full mt-10 py-4 bg-slate-800 hover:bg-white hover:text-slate-900 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all duration-300 border border-slate-700">
                                Restock Aset Sekarang
                            </button>
                        </div>
                    </div>

                    <div class="bg-emerald-600 rounded-[2.5rem] p-8 text-white">
                        <h3 class="text-[11px] font-black uppercase tracking-[0.25em] mb-4 opacity-80">Info Cepat</h3>
                        <p class="text-lg font-bold leading-tight">Pastikan semua alat yang dikembalikan dicek kondisinya sebelum masuk sistem.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyData = @json($monthlyPeminjaman);
        const labels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        const data = labels.map((_, index) => monthlyData[index + 1] || 0);

        new Chart(ctx, {
            type: 'line', // Diubah ke line agar terlihat lebih "premium" dan profesional
            data: {
                labels: labels,
                datasets: [{
                    label: 'Peminjaman',
                    data: data,
                    borderColor: '#10b981',
                    borderWidth: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#10b981',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4,
                    fill: true,
                    backgroundColor: (context) => {
                        const gradient = context.chart.ctx.createLinearGradient(0, 0, 0, 300);
                        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
                        gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');
                        return gradient;
                    },
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { 
                    y: { 
                        beginAtZero: true, 
                        grid: { borderDash: [5, 5], color: '#f1f5f9' },
                        ticks: { font: { size: 10, weight: '600' }, color: '#94a3b8' }
                    }, 
                    x: { 
                        grid: { display: false },
                        ticks: { font: { size: 10, weight: '600' }, color: '#94a3b8' }
                    } 
                }
            }
        });
    </script>
</x-app-layout>