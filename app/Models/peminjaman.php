<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'alat_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_kembali_sebenarnya',
        'keperluan',
        'status',
        'denda',
        'denda_kerusakan',
        'dibayar',
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_kembali_sebenarnya' => 'date',
        'denda' => 'decimal:2',
        'denda_kerusakan' => 'decimal:2',
        'dibayar' => 'boolean',
    ];
}