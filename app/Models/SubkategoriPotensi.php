<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubkategoriPotensi extends Model
{
    use HasFactory;

    protected $table = 't_subkategori_potensi';
    protected $primaryKey = 'id_subkategori_potensi';
    protected $fillable = ['id_kategori_potensi', 'nama_subkategori'];

    public function kategori()
    {
        return $this->belongsTo(KategoriPotensi::class, 'id_kategori_potensi');
    }

    public function itemPotensi()
    {
        return $this->hasMany(ItemPotensi::class, 'id_subkategori_potensi');
    }
}
