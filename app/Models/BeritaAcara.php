<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory;

    protected $table = 'berita_acara';

    protected $fillable = [
        'nama_kegiatan',
        'foto_kegiatan',
        'tanggal_pelaksanaan',
        'deskripsi_kegiatan',
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
    ];
}
