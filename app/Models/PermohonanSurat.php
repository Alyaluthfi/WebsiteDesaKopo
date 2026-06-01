<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;

    protected $table = 'permohonan_surats';

    protected $fillable = [
        'user_id',
        'jenis_surat',
        'data_syarat',
        'status',
    ];

    protected $casts = [
        'data_syarat' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
