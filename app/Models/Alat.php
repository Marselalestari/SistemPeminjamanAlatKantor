<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';

    protected $fillable = [
        'nama_alat',
        'kategori_id',
        'deskripsi',
        'stok',
        'foto',
    ];

    protected $casts = [
        'stok' => 'integer',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
