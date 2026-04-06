<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;

class UserAlatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $alat = Alat::with('kategori')
            ->when($search, function ($query, $search) {
                $query->where('nama_alat', 'like', "%{$search}%")
                      ->orWhereHas('kategori', function ($q) use ($search) {
                          $q->where('nama_kategori', 'like', "%{$search}%");
                      });
            })
            ->latest()
            ->get();

        return view('User.lihat_alat', compact('alat', 'search'));
    }

    public function show(Alat $alat)
    {
        return view('User.detail_alat', compact('alat'));
    }
}