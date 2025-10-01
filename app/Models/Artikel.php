<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 't_artikel';
    protected $primaryKey = 'id_artikel';

    protected $fillable = [
        'judul',
        'url_seo',
        'isi_konten',
        'url_gambar_utama',
        'id_kategori',
        'id_penulis',
        'jumlah_dibaca',
        'jumlah_suka',
        'jumlah_dibagikan',
        'tanggal_publikasi',
        'status_publikasi',
    ];

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Relasi ke Penulis
    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'id_penulis', 'id_penulis');
    }
}
