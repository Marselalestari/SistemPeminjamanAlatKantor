<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard untuk operator beserta statistik sederhana.
     */
    public function index()
    {
        // Hitung jumlah peminjaman yang dilakukan hari ini (tanggal_pinjam)
        $peminjamanHariIni = Peminjaman::whereDate('tanggal_pinjam', now())->count();

        // Hitung peminjaman yang sedang aktif (status disetujui)
        $peminjamanAktif = Peminjaman::where('status', 'disetujui')->count();

        // Hitung total pengguna biasa (role user)
        $totalUser = User::where('role', 'user')->count();

        // Ambil peminjaman yang menunggu approval
        $peminjamanMenunggu = Peminjaman::with(['user', 'alat'])
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('operator.dashboard', compact(
            'peminjamanHariIni',
            'peminjamanAktif',
            'totalUser',
            'peminjamanMenunggu'
        ));
    }

    /**
     * Cetak struk peminjaman
     */
    public function cetakStruk(Peminjaman $peminjaman)
    {
        // Izinkan struk ditampilkan untuk peminjaman yang disetujui atau sudah dikembalikan
        if (!in_array($peminjaman->status, ['disetujui', 'dikembalikan'])) {
            abort(403, 'Struk hanya bisa dicetak untuk peminjaman yang disetujui atau dikembalikan');
        }

        return view('operator.cetak-struk', compact('peminjaman'));
    }

    /**
     * Simpan denda dan tandai peminjaman sebagai dikembalikan
     */
    public function simpanDenda(Peminjaman $peminjaman, Request $request)
    {
        // Validasi
        $request->validate([
            'denda' => 'required|numeric|min:0',
            'tanggal_kembali_sebenarnya' => 'required|date|after_or_equal:tanggal_pinjam'
        ]);

        // Pastikan hanya peminjaman yang disetujui yang bisa diproses
        if ($peminjaman->status !== 'disetujui') {
            return response()->json(['error' => 'Hanya peminjaman yang disetujui yang bisa diproses'], 403);
        }

        // Update peminjaman
        $peminjaman->update([
            'denda' => $request->denda,
            'tanggal_kembali_sebenarnya' => $request->tanggal_kembali_sebenarnya,
            'status' => 'dikembalikan'
        ]);

        // Kembalikan stok alat
        $peminjaman->alat->increment('stok', $peminjaman->jumlah);

        return response()->json([
            'success' => true,
            'message' => 'Denda berhasil disimpan dan peminjaman ditandai sebagai dikembalikan',
            'denda' => $request->denda
        ]);
    }
}
