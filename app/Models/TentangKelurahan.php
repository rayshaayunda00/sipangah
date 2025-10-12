<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangKelurahan extends Model
{
    use HasFactory;

    protected $table = 'tentang_kelurahan';

    protected $fillable = [
        'nama_kelurahan',
        'visi',
        'misi',
        'sejarah',
        'struktur_organisasi',
        'peta_wilayah'
    ];
}
