<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Arsip extends Model
    {
        use HasFactory;

        protected $fillable = [
            'nomor_arsip',
            'judul_arsip',
            'kategori',
            'deskripsi',
            'tanggal_arsip',
            'file_lampiran',
            'status',
        ];

        // Definisikan tipe enum untuk memastikan data valid (opsional, tapi baik)
        protected $casts = [
            'kategori' => 'string', // atau bisa diset enum jika Laravel Anda mendukung
            'status' => 'string',
            'tanggal_arsip' => 'date',
        ];
    }

