<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Umum
        $totalAlat = Alat::count();
        $totalKategori = Kategori::count();
        $totalUser = User::where('role', 'user')->count();
        $totalPeminjaman = Peminjaman::count();
        $peminjamanAktif = Peminjaman::where('status', 'aktif')->count();
        
        // Alat dengan stok rendah
        $alatStokRendah = Alat::where('stok', '<', 5)
            ->orderBy('stok', 'asc')
            ->limit(5)
            ->get();
        
        // Peminjaman terbaru
        $peminjamanTerbaru = Peminjaman::with(['user', 'alat'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Statistik peminjaman berdasarkan status
        $peminjamanByStatus = Peminjaman::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // Statistik peminjaman bulanan
        $monthlyPeminjaman = Peminjaman::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        return view('admin.dashboard', [
            'totalAlat' => $totalAlat,
            'totalKategori' => $totalKategori,
            'totalUser' => $totalUser,
            'totalPeminjaman' => $totalPeminjaman,
            'peminjamanAktif' => $peminjamanAktif,
            'alatStokRendah' => $alatStokRendah,
            'peminjamanTerbaru' => $peminjamanTerbaru,
            'peminjamanByStatus' => $peminjamanByStatus,
            'monthlyPeminjaman' => $monthlyPeminjaman,
        ]);
    }
}
