<?php

namespace Database\Seeders;

use App\Models\Bumdes;
use App\Models\FinancialTransaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FinancialTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bumdesMart = Bumdes::where('slug', 'mart')->first();
        $bumdesWisata = Bumdes::where('slug', 'wisata')->first();
        $bumdesAgro = Bumdes::where('slug', 'agro')->first();

        $transactions = [
            // PEMASUKAN
            [
                'type' => 'pemasukan',
                'source' => 'Hasil Penjualan BUMDes Mart "Kopo Makmur"',
                'bumdes_id' => $bumdesMart ? $bumdesMart->id : null,
                'amount' => 150000000,
                'transaction_date' => Carbon::now()->subMonths(3)->format('Y-m-d'),
                'description' => 'Bagi hasil keuntungan triwulan dari unit usaha minimarket BUMDes Mart.',
            ],
            [
                'type' => 'pemasukan',
                'source' => 'Tiket Masuk & Outbound Desa Wisata Tirta Kopo',
                'bumdes_id' => $bumdesWisata ? $bumdesWisata->id : null,
                'amount' => 85000000,
                'transaction_date' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                'description' => 'Pendapatan retribusi tiket masuk dan sewa wahana outbound.',
            ],
            [
                'type' => 'pemasukan',
                'source' => 'Bagi Hasil Pusat Pengolahan Tani',
                'bumdes_id' => $bumdesAgro ? $bumdesAgro->id : null,
                'amount' => 45000000,
                'transaction_date' => Carbon::now()->subMonths(1)->format('Y-m-d'),
                'description' => 'Pendapatan jasa penggilingan padi dan penjualan gabah.',
            ],
            [
                'type' => 'pemasukan',
                'source' => 'Iuran Rutin Kas Desa Kopo',
                'bumdes_id' => null,
                'amount' => 120000000,
                'transaction_date' => Carbon::now()->subDays(15)->format('Y-m-d'),
                'description' => 'Iuran bulanan swadaya masyarakat untuk kebersihan dan keamanan desa.',
            ],
            [
                'type' => 'pemasukan',
                'source' => 'Sumbangan Donatur Pihak Ketiga',
                'bumdes_id' => null,
                'amount' => 50000000,
                'transaction_date' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'description' => 'Dana hibah dari CSR perusahaan sekitar desa.',
            ],

            // PENGELUARAN
            [
                'type' => 'pengeluaran',
                'source' => 'Perbaikan & Pengaspalan Jalan RT 03/RW 02',
                'bumdes_id' => null,
                'amount' => 250000000,
                'transaction_date' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                'description' => 'Biaya perbaikan jalan rusak sepanjang 200 meter.',
            ],
            [
                'type' => 'pengeluaran',
                'source' => 'Pembangunan Fasilitas Outbound & Toilet Wisata',
                'bumdes_id' => $bumdesWisata ? $bumdesWisata->id : null,
                'amount' => 60000000,
                'transaction_date' => Carbon::now()->subMonths(1)->format('Y-m-d'),
                'description' => 'Renovasi toilet umum dan penambahan fasilitas flying fox.',
            ],
            [
                'type' => 'pengeluaran',
                'source' => 'Penyaluran Bantuan Sosial Lansia',
                'bumdes_id' => null,
                'amount' => 40000000,
                'transaction_date' => Carbon::now()->subDays(20)->format('Y-m-d'),
                'description' => 'Bantuan sembako dan uang tunai untuk 80 lansia kurang mampu.',
            ],
            [
                'type' => 'pengeluaran',
                'source' => 'Pengadaan Komputer Kantor Desa',
                'bumdes_id' => null,
                'amount' => 25000000,
                'transaction_date' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'description' => 'Pembelian 3 unit komputer desktop untuk pelayanan masyarakat.',
            ],
        ];

        foreach ($transactions as $data) {
            FinancialTransaction::create($data);
        }
    }
}
