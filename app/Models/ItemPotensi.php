<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPotensi extends Model
{
    use HasFactory;

    protected $table = 't_item_potensi';
    protected $primaryKey = 'id_item_potensi';
    protected $fillable = [
        'id_subkategori_potensi',
        'nama_item',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'alamat',
        'no_hp',
        'url_gambar_utama',
        'status_publikasi'
    ];

    public function subkategori()
    {
        return $this->belongsTo(SubkategoriPotensi::class, 'id_subkategori_potensi');
    }

    // 🔧 Tambahkan ini agar Laravel tahu key-nya bukan "id"
    public function getRouteKeyName()
    {
        return 'id_item_potensi';
    }
}
