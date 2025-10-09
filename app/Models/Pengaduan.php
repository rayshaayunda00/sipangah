<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'nama_pengadu',
        'email_pengadu',
        'no_hp_pengadu',
        'judul_pengaduan',
        'isi_pengaduan',
        'tanggal_pengaduan',
        'status_pengaduan',
        'url_lampiran',
    ];
}
