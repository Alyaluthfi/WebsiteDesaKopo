<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bumdes extends Model
{
    use HasFactory;

    protected $table = 'bumdes';

    protected $fillable = [
        'slug',
        'name',
        'category',
        'image',
        'description',
        'detail',
        'address',
        'jam_buka',
        'kontak',
    ];

    /**
     * Get the transactions for the BUMDes.
     */
    public function transactions()
    {
        return $this->hasMany(FinancialTransaction::class, 'bumdes_id');
    }
}
