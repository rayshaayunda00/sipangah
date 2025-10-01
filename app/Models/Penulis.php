<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    protected $table = 't_penulis';
    protected $primaryKey = 'id_penulis';

    protected $fillable = [
        'nama_penulis',
        'email',
        'bio',
    ];

    // Relasi ke Artikel
    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'id_penulis', 'id_penulis');
    }
}
