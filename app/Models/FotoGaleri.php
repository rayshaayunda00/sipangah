<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoGaleri extends Model
{
    use HasFactory;

    protected $table = 't_foto_galeri';
    protected $primaryKey = 'id_foto';
    protected $fillable = [
        'id_kegiatan',
        'url_foto',
        'deskripsi_foto'
    ];

    public function kegiatan()
    {
        return $this->belongsTo(KegiatanGaleri::class, 'id_kegiatan');
    }
}
