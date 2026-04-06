<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PeminjamanController extends Controller
{
    /**
     * CRUD ADMIN: Tampilkan semua data peminjaman
     */
    public function adminIndex()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])->latest()->get();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    /**
     * CRUD ADMIN: Form tambah peminjaman
     */
    public function adminCreate()
    {
        $users = \App\Models\User::where('role', 'user')->get();
        $alat = Alat::where('stok', '>', 0)->get();
        return view('admin.peminjaman.create', compact('users', 'alat'));
    }

    /**
     * CRUD ADMIN: Simpan data peminjaman
     */
    public function adminStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alat_id' => 'required|exists:alat,id',
            'tanggal_pinjam' => 'required|date',
        ]);
        Peminjaman::create($request->all());
        return redirect()->route('admin.peminjaman.index')->with('success', 'Data peminjaman berhasil ditambahkan');
    }

    /**
     * CRUD ADMIN: Form edit peminjaman
     */
    public function adminEdit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $users = \App\Models\User::where('role', 'user')->get();
        $alat = Alat::all();
        return view('admin.peminjaman.edit', compact('peminjaman', 'users', 'alat'));
    }

    /**
     * CRUD ADMIN: Update data peminjaman
     */
    public function adminUpdate(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update($request->all());
        return redirect()->route('admin.peminjaman.index')->with('success', 'Data peminjaman berhasil diupdate');
    }

    /**
     * CRUD ADMIN: Hapus data peminjaman
     */
    public function adminDestroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();
        return redirect()->route('admin.peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus');
    }

    /**
     * FORM PEMINJAMAN (USER)
     */
    public function create()
    {
        $alat = Alat::where('stok', '>', 0)->get();

        return view('user.peminjaman.create', compact('alat'));
    }

    /**
     * SIMPAN PENGAJUAN PEMINJAMAN (USER)
     */
    public function store(Request $request)
    {
        // VALIDASI INPUT
        $request->validate([
            'alat_id' => 'required|exists:alat,id',
            'nomor_ktp' => 'nullable|string|max:20',
            'nomor_kk' => 'nullable|string|max:20',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'keperluan' => 'required|string|max:255',
        ]);

        // AMBIL DATA ALAT
        $alat = Alat::findOrFail($request->alat_id);

        // CEK STOK
        if ($request->jumlah > $alat->stok) {
            return back()
                ->withErrors(['jumlah' => 'Jumlah pinjam melebihi stok tersedia'])
                ->withInput();
        }

        // SIMPAN DATA PEMINJAMAN
        Peminjaman::create([
            'user_id' => Auth::id(),
            'alat_id' => $alat->id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'keperluan' => $request->keperluan,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('user.peminjaman.index')
            ->with('success', 'Peminjaman berhasil diajukan dan menunggu persetujuan operator');
    }

    /**
     * RIWAYAT PEMINJAMAN USER
     */
    public function index()
    {
        $peminjaman = Peminjaman::with('alat')
            ->where('user_id', Auth::id())
            ->orderByDesc('tanggal_pinjam')
            ->get();

        return view('user.peminjaman.index', compact('peminjaman'));
    }
}