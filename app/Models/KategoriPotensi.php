<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPotensi extends Model
{
    use HasFactory;

    protected $table = 't_kategori_potensi';
    protected $primaryKey = 'id_kategori_potensi';
    protected $fillable = ['nama_kategori', 'deskripsi_kategori'];

    public function subkategori()
    {
        return $this->hasMany(SubkategoriPotensi::class, 'id_kategori_potensi');
    }
}
