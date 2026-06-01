<?php

namespace Database\Seeders;

use App\Models\Finance;
use Illuminate\Database\Seeder;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Finance::updateOrCreate(
            ['tahun' => 2026],
            [
                'total_anggaran' => 1450000000,
                'realisasi_penyerapan' => 1232500000,
            ]
        );
    }
}
