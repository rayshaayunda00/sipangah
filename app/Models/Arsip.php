<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_arsip',
        'judul_arsip',
        'kategori',
        'deskripsi',
        'tanggal_arsip',
        'file_lampiran',
        'status',
    ];

    // 🔥 TAMBAHKAN BAGIAN INI (PENTING!)
    protected $casts = [
        'file_lampiran' => 'array', // <--- Ini yang mengubah JSON String jadi Array
        'tanggal_arsip' => 'date',
    ];
}
