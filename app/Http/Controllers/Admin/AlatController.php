<?php

// Menentukan namespace (lokasi file controller)
namespace App\Http\Controllers\Admin;

// Import class yang dibutuhkan
use App\Http\Controllers\Controller; // Controller utama Laravel
use App\Models\Alat; // Model untuk tabel alat
use App\Models\Kategori; // Model untuk tabel kategori
use Illuminate\Http\Request; // Untuk menangkap data request dari form
use Illuminate\Support\Facades\Storage; // Untuk mengelola file (upload/hapus)

class AlatController extends Controller
{
    // =======================
    // MENAMPILKAN DATA ALAT
    // =======================
    public function index()
    {
        // Ambil semua data alat + relasi kategori, urut terbaru
        $alat = Alat::with('kategori')->latest()->get();

        // Kirim data ke view halaman index
        return view('admin.alat.index', compact('alat'));
    }

    // =======================
    // FORM TAMBAH DATA
    // =======================
    public function create()
    {
        // Ambil semua kategori (untuk dropdown pilihan)
        $kategoris = Kategori::all();

        // Tampilkan halaman form tambah alat
        return view('admin.alat.create', compact('kategoris'));
    }

    // =======================
    // SIMPAN DATA BARU
    // =======================
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama_alat'   => 'required', // wajib diisi
            'kategori_id' => 'required', // wajib pilih kategori
            'foto'        => 'image|mimes:jpg,jpeg,png|max:2048' // harus gambar max 2MB
        ]);

        // Ambil semua data dari request
        $data = $request->all();

        // ===================
        // UPLOAD FOTO
        // ===================
        if ($request->hasFile('foto')) {
            // Simpan file ke folder storage/public/alat
            // dan simpan path-nya ke database
            $data['foto'] = $request->file('foto')->store('alat', 'public');
        }

        // Simpan data ke database
        Alat::create($data);

        // Redirect ke halaman index + pesan sukses
        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }

    // =======================
    // FORM EDIT DATA
    // =======================
    public function edit(Alat $alat)
    {
        // Ambil semua kategori
        $kategoris = Kategori::all();

        // Tampilkan form edit dengan data alat yang dipilih
        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    // =======================
    // UPDATE DATA
    // =======================
    public function update(Request $request, Alat $alat)
    {
        // Validasi input
        $request->validate([
            'nama_alat'   => 'required',
            'kategori_id' => 'required',
            'foto'        => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Ambil semua data dari request
        $data = $request->all();

        // ===================
        // CEK FOTO BARU
        // ===================
        if ($request->hasFile('foto')) {

            // Hapus foto lama jika ada
            if ($alat->foto) {
                Storage::disk('public')->delete($alat->foto);
            }

            // Upload foto baru
            $data['foto'] = $request->file('foto')->store('alat', 'public');
        }

        // Update data alat di database
        $alat->update($data);

        // Redirect + pesan sukses
        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil diperbarui');
    }

    // =======================
    // HAPUS DATA
    // =======================
    public function destroy(Alat $alat)
    {
        // Jika ada foto, hapus dari storage
        if ($alat->foto) {
            Storage::disk('public')->delete($alat->foto);
        }

        // Hapus data dari database
        $alat->delete();

        // Redirect + pesan sukses
        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil dihapus');
    }
}