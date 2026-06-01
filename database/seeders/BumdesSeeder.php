<?php

namespace Database\Seeders;

use App\Models\Bumdes;
use Illuminate\Database\Seeder;

class BumdesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bumdesData = config('bumdes.list', []);

        foreach ($bumdesData as $data) {
            Bumdes::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
