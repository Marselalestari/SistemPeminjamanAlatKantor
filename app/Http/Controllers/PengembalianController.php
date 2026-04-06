<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Peminjaman::whereNotNull('tanggal_kembali_sebenarnya')->get();
        return view('admin.pengembalian.index', compact('pengembalians'));
    }

    public function show($id)
    {
        $pengembalian = Peminjaman::findOrFail($id);
        return view('admin.pengembalian.show', compact('pengembalian'));
    }

    public function edit($id)
    {
        $pengembalian = Peminjaman::findOrFail($id);
        return view('admin.pengembalian.edit', compact('pengembalian'));
    }

    public function update(Request $request, $id)
    {
        $pengembalian = Peminjaman::findOrFail($id);
        $pengembalian->update($request->all());
        return redirect()->route('admin.pengembalian.index')->with('success', 'Data pengembalian berhasil diupdate');
    }

    public function destroy($id)
    {
        $pengembalian = Peminjaman::findOrFail($id);
        $pengembalian->delete();
        return redirect()->route('admin.pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus');
    }
}
