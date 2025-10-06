<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanGaleri extends Model
{
    use HasFactory;

    protected $table = 't_kegiatan_galeri';
    protected $primaryKey = 'id_kegiatan';
    protected $fillable = [
        'judul_kegiatan',
        'deskripsi_singkat',
        'tanggal_kegiatan',
        'thumbnail_url'
    ];

    // **TAMBAHKAN INI:**
    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    public function fotoGaleri()
    {
        return $this->hasMany(FotoGaleri::class, 'id_kegiatan');
    }
}
