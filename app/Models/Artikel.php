<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

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

    // **TAMBAHKAN BAGIAN INI UNTUK OTOMATIS MENGUBAH STRING MENJADI OBJEK TANGGAL (CARBON)**
    protected $casts = [
        'tanggal_publikasi' => 'datetime',
    ];
    // ***********************************************************************************

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'id_penulis', 'id_penulis');
    }
}
