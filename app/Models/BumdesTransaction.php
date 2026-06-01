<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BumdesTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bumdes_id',
        'bumdes_slug',
        'bumdes_name',
        'nama_pembeli',
        'email',
        'no_hp',
        'kebutuhan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bumdes()
    {
        return $this->belongsTo(Bumdes::class);
    }
}
