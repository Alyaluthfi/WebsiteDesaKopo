<?php

namespace Database\Seeders;

use App\Models\StrukturOrganisasi;
use Illuminate\Database\Seeder;

class StrukturOrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultAparat = [
            [
                'nama' => 'Nama Kepala Desa',
                'jabatan' => 'Kepala Desa',
                'foto' => null,
                'peran' => 'kades',
                'urutan' => 1,
            ],
            [
                'nama' => 'Nama Sekretaris Desa',
                'jabatan' => 'Sekretaris Desa',
                'foto' => null,
                'peran' => 'sekdes',
                'urutan' => 2,
            ],
            // Kaur Group
            [
                'nama' => 'Nama Kaur Keuangan',
                'jabatan' => 'Kaur Keuangan',
                'foto' => null,
                'peran' => 'kaur_keuangan',
                'urutan' => 3,
            ],
            [
                'nama' => 'Nama Kaur TU & Umum',
                'jabatan' => 'Kaur Tata Usaha & Umum',
                'foto' => null,
                'peran' => 'kaur_umum',
                'urutan' => 4,
            ],
            [
                'nama' => 'Nama Kaur Perencanaan',
                'jabatan' => 'Kaur Perencanaan',
                'foto' => null,
                'peran' => 'kaur_perencanaan',
                'urutan' => 5,
            ],
            // Kasi Group
            [
                'nama' => 'Nama Kasi Pemerintahan',
                'jabatan' => 'Kasi Pemerintahan',
                'foto' => null,
                'peran' => 'kasi_pemerintahan',
                'urutan' => 6,
            ],
            [
                'nama' => 'Nama Kasi Kesejahteraan',
                'jabatan' => 'Kasi Kesejahteraan (Kesra)',
                'foto' => null,
                'peran' => 'kasi_kesra',
                'urutan' => 7,
            ],
            [
                'nama' => 'Nama Kasi Pelayanan',
                'jabatan' => 'Kasi Pelayanan',
                'foto' => null,
                'peran' => 'kasi_pelayanan',
                'urutan' => 8,
            ],
        ];

        foreach ($defaultAparat as $aparat) {
            StrukturOrganisasi::updateOrCreate(
                ['peran' => $aparat['peran']],
                $aparat
            );
        }
    }
}
