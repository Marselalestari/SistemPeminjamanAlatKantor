<?php

namespace App\Http\Controllers\Admin;

// Controller utama Laravel
use App\Http\Controllers\Controller;

// Model User (untuk akses tabel users di database)
use App\Models\User;

// Request digunakan untuk mengambil data dari form input
use Illuminate\Http\Request;

// Hash digunakan untuk enkripsi password
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * INDEX
     * Fungsi: Menampilkan semua data pengguna
     */
    public function index()
    {
        // Ambil semua data user, urut dari terbaru
        $pengguna = User::latest()->get();

        // Kirim data ke view (halaman index)
        return view('admin.pengguna.index', compact('pengguna'));
    }

    /**
     * CREATE
     * Fungsi: Menampilkan form tambah pengguna
     */
    public function create()
    {
        // Hanya menampilkan halaman form
        return view('admin.pengguna.create');
    }

    /**
     * STORE
     * Fungsi: Menyimpan data pengguna baru ke database
     */
    public function store(Request $request)
    {
        // Request = mengambil data dari form input user

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255', // wajib isi nama
            'email' => 'required|email|unique:users,email', // email harus unik
            'password' => 'required|min:6', // minimal 6 karakter
            'role' => 'required|in:user,operator,admin', // hanya boleh ini
        ]);

        // Simpan data ke database
        User::create([
            'name' => $request->name, // ambil dari input form
            'email' => $request->email,
            
            // Password dienkripsi agar aman
            'password' => Hash::make($request->password),

            'role' => $request->role,
        ]);

        // Redirect ke halaman index + pesan sukses
        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan');
    }

    /**
     * EDIT
     * Fungsi: Menampilkan form edit pengguna
     */
    public function edit(User $pengguna)
    {
        // Route Model Binding:
        // Laravel otomatis ambil data user berdasarkan ID di URL

        // Kirim data user ke halaman edit
        return view('admin.pengguna.edit', compact('pengguna'));
    }

    /**
     * UPDATE
     * Fungsi: Mengupdate data pengguna
     */
    public function update(Request $request, User $pengguna)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',

            // Email harus unik, kecuali milik user ini sendiri
            'email' => 'required|email|unique:users,email,' . $pengguna->id,

            // Password boleh kosong (tidak wajib)
            'password' => 'nullable|min:6',

            'role' => 'required|in:user,operator,admin',
        ]);

        // Data yang akan diupdate
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Jika password diisi, update password
        if ($request->filled('password')) {

            // Enkripsi password sebelum disimpan
            $data['password'] = Hash::make($request->password);
        }

        // Update data ke database
        $pengguna->update($data);

        // Redirect ke index + pesan sukses
        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil diperbarui');
    }

    /**
     * DESTROY
     * Fungsi: Menghapus pengguna
     */
    public function destroy(User $pengguna)
    {
        // Ambil ID user yang sedang login
        $userLoginId = auth()->id();

        // Cegah user menghapus dirinya sendiri
        if ($userLoginId === $pengguna->id) {
            return back()->with('error', 'Tidak bisa menghapus user yang sedang login');
        }

        // Hapus data dari database
        $pengguna->delete();

        // Redirect ke index + pesan sukses
        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus');
    }
}