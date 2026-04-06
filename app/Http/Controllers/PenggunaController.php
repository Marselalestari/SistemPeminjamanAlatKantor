<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::latest()->get();
        return view('admin.pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        return view('admin.pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:users,nik',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:user,operator,admin',
        ]);

        User::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit(User $pengguna)
    {
        return view('admin.pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, User $pengguna)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:users,nik,' . $pengguna->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pengguna->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:user,operator,admin',
        ]);

        $data = [
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pengguna->update($data);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy(User $pengguna)
    {
        // Cegah menghapus user yang sedang login
        if (auth()->id() === $pengguna->id) {
            return back()->with('error', 'Tidak bisa menghapus user yang sedang login');
        }

        $pengguna->delete();

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus');
    }
}
