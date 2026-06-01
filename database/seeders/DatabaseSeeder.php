<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'admin@desakoposerang.id'],
            [
                'name' => 'Admin Desa Kopo',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'penduduk@desakoposerang.id'],
            [
                'name' => 'Penduduk Desa Kopo',
                'password' => bcrypt('penduduk123'),
                'role' => 'penduduk',
            ]
        );

        $this->call([
            BumdesSeeder::class,
            FinanceSeeder::class,
            FinancialTransactionSeeder::class,
            StrukturOrganisasiSeeder::class,
        ]);
    }
}
