<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    // 🔹 Konstanta Status (best practice)
    const STATUS_MENUNGGU     = 'menunggu';
    const STATUS_DISETUJUI    = 'disetujui';
    const STATUS_DITOLAK      = 'ditolak';
    const STATUS_DIKEMBALIKAN = 'dikembalikan';

    /**
     * Daftar peminjaman
     */
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])
            ->latest()
            ->paginate(5);

        return view('operator.peminjaman.index', compact('peminjaman'));
    }

    /**
     * Form tambah peminjaman
     */
    public function create()
    {
        $users = User::where('role', 'user')->get();
        $alat  = Alat::where('stok', '>', 0)->get();

        return view('operator.peminjaman.create', compact('users', 'alat'));
    }

    /**
     * Simpan peminjaman
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'         => 'required|exists:users,id',
            'alat_id'         => 'required|exists:alat,id', // sesuaikan jika tabel: alats
            'jumlah'          => 'required|integer|min:1|max:1000',
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'keperluan'       => 'required|string|max:255',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($request->jumlah > $alat->stok) {
            return back()
                ->withErrors(['jumlah' => 'Jumlah pinjam melebihi stok tersedia'])
                ->withInput();
        }

        Peminjaman::create([
            'user_id'         => $request->user_id,
            'alat_id'         => $request->alat_id,
            'jumlah'          => $request->jumlah,
            'tanggal_pinjam'  => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'keperluan'       => $request->keperluan,
            'status'          => self::STATUS_MENUNGGU
        ]);

        return redirect()->route('operator.peminjaman.index')
            ->with('success', 'Peminjaman baru berhasil dibuat.');
    }

    /**
     * Approve peminjaman
     */
    public function approve(Peminjaman $peminjaman)
    {
        $peminjaman->load('alat');

        if ($peminjaman->status !== self::STATUS_MENUNGGU) {
            return back()->with('error', 'Peminjaman sudah diproses');
        }

        if (!$peminjaman->alat) {
            return back()->with('error', 'Data alat tidak ditemukan');
        }

        if ($peminjaman->jumlah > $peminjaman->alat->stok) {
            return back()->with('error', 'Stok alat tidak mencukupi');
        }

        DB::transaction(function () use ($peminjaman) {
            $peminjaman->alat->decrement('stok', $peminjaman->jumlah);
            $peminjaman->update(['status' => self::STATUS_DISETUJUI]);
        });

        return back()->with('success', 'Peminjaman disetujui');
    }

    /**
     * Reject peminjaman
     */
    public function reject(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== self::STATUS_MENUNGGU) {
            return back()->with('error', 'Peminjaman sudah diproses');
        }

        $peminjaman->update(['status' => self::STATUS_DITOLAK]);

        return back()->with('success', 'Peminjaman ditolak');
    }

    /**
     * Kembalikan alat + hitung denda otomatis
     */
    public function kembalikan(Peminjaman $peminjaman)
    {
        $peminjaman->load('alat');

        if ($peminjaman->status !== self::STATUS_DISETUJUI) {
            return back()->with('error', 'Hanya peminjaman disetujui yang bisa dikembalikan');
        }

        if (!$peminjaman->alat) {
            return back()->with('error', 'Data alat tidak ditemukan');
        }

        $tanggalKembaliSebenarnya = now();
        $tanggalKembaliHarusnya   = Carbon::parse($peminjaman->tanggal_kembali);

        $denda = 0;

        if ($tanggalKembaliSebenarnya->gt($tanggalKembaliHarusnya)) {
            $hariTerlambat = $tanggalKembaliHarusnya->diffInDays($tanggalKembaliSebenarnya);
            $denda = $hariTerlambat * 10000 * $peminjaman->jumlah;
        }

        try {
            DB::transaction(function () use ($peminjaman, $tanggalKembaliSebenarnya, $denda) {
                $peminjaman->alat->increment('stok', $peminjaman->jumlah);

                $peminjaman->update([
                    'status' => self::STATUS_DIKEMBALIKAN,
                    'tanggal_kembali_sebenarnya' => $tanggalKembaliSebenarnya,
                    'denda' => $denda
                ]);
            });

            $pesan = 'Peminjaman berhasil dikembalikan';
            if ($denda > 0) {
                $pesan .= '. Denda: Rp ' . number_format($denda, 0, ',', '.');
            }

            return back()->with('success', $pesan);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Simpan denda manual
     */
    public function simpanDendaStruk(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'denda_manual' => 'required|numeric|min:0',
        ]);

        if (!in_array($peminjaman->status, [self::STATUS_DISETUJUI, self::STATUS_DIKEMBALIKAN])) {
            return back()->with('error', 'Status tidak valid');
        }

        DB::transaction(function () use ($peminjaman, $request) {

            if ($peminjaman->status === self::STATUS_DISETUJUI) {
                $peminjaman->alat->increment('stok', $peminjaman->jumlah);

                $peminjaman->update([
                    'status' => self::STATUS_DIKEMBALIKAN,
                    'tanggal_kembali_sebenarnya' => now(),
                ]);
            }

            $peminjaman->update([
                'denda_kerusakan' => $request->denda_manual,
                'dibayar' => true,
            ]);
        });

        return redirect()->route('operator.peminjaman.cetak-struk', $peminjaman)
            ->with('success', 'Denda berhasil disimpan');
    }

    /**
     * Laporan bulanan
     */
    public function laporanBulanan(Request $request)
    {
        $tahun  = $request->get('tahun', date('Y'));
        $search = $request->get('search');

        $laporan = Peminjaman::select(
                DB::raw('MONTH(tanggal_pinjam) as bulan'),
                DB::raw('YEAR(tanggal_pinjam) as tahun'),
                DB::raw('COUNT(*) as total_peminjaman'),
                DB::raw('SUM(jumlah) as total_unit'),
                DB::raw("SUM(CASE WHEN status = 'disetujui' THEN 1 ELSE 0 END) as disetujui"),
                DB::raw("SUM(CASE WHEN status = 'ditolak' THEN 1 ELSE 0 END) as ditolak"),
                DB::raw("SUM(CASE WHEN status = 'menunggu' THEN 1 ELSE 0 END) as menunggu"),
                DB::raw("SUM(CASE WHEN status = 'dikembalikan' THEN 1 ELSE 0 END) as dikembalikan"),
                DB::raw("SUM(denda) as total_denda_keterlambatan"),
                DB::raw("SUM(denda_kerusakan) as total_denda_kerusakan")
            )
            ->whereYear('tanggal_pinjam', $tahun)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('alat', function ($q2) use ($search) {
                        $q2->where('nama_alat', 'like', "%{$search}%");
                    })
                    ->orWhereMonth('tanggal_pinjam', $search);
                });
            })
            ->groupBy(DB::raw('YEAR(tanggal_pinjam)'), DB::raw('MONTH(tanggal_pinjam)'))
            ->orderBy('bulan')
            ->get();

        $totalDendaKeterlambatan = Peminjaman::whereYear('tanggal_pinjam', $tahun)
            ->where('status', self::STATUS_DIKEMBALIKAN)
            ->sum('denda');

        $totalDendaKerusakan = Peminjaman::whereYear('tanggal_pinjam', $tahun)
            ->where('status', self::STATUS_DIKEMBALIKAN)
            ->sum('denda_kerusakan');

        return view('operator.peminjaman.laporan-bulanan', compact(
            'laporan',
            'tahun',
            'totalDendaKeterlambatan',
            'totalDendaKerusakan'
        ));
    }
}