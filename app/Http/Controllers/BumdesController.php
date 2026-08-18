<?php

namespace App\Http\Controllers;

use App\Models\Bumdes;
use App\Models\BumdesTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class BumdesController extends Controller
{
    private function getFallbackData($slug)
    {
        $bumdesData = [
            'ikan' => [
                'name' => 'BUMDes Perikanan Desa Kopo',
                'category' => 'Perikanan',
                'image' => 'images/bumdes-Perikanan kolam Kopo.png',
                'description' => 'Unit usaha budidaya ikan air tawar yang menyediakan komoditas segar berkualitas tinggi untuk kebutuhan warga dan pasar. Usaha ini memanfaatkan potensi air bersih Desa Kopo untuk menggerakkan ekonomi desa.',
                'detail' => 'Unit Perikanan BUMDes Desa Kopo berfokus pada budidaya ikan Gurame dan Nila berkualitas prima dengan sistem pengelolaan kolam yang bersih dan pakan terkontrol. Ikan Gurame difokuskan untuk menyuplai restoran dan bisnis kuliner, sementara ikan Nila disediakan untuk memenuhi kebutuhan konsumsi harian masyarakat serta pedagang pasar dengan jaminan kondisi yang selalu segar dan bebas bau lumpur. Selain memperkuat ketahanan pangan lokal, seluruh keuntungan usaha ini dikelola kembali untuk meningkatkan Pendapatan Asli Desa.',
                'address' => 'Jl. Raya Kopo No. 12, Desa Kopo, Kec. Kopo, Kabupaten Serang, Banten 42178',
                'jam_buka' => 'Setiap Hari, 09:00 - 17:00 WIB',
                'kontak' => '0896-5090-4585',
                'produk' => ['Ikan Gurame Segar (Per Kg)', 'Ikan Nila Segar (Per Kg)']
            ],
            'agro' => [
                'name' => 'Pusat Pengolahan Tani Jagung',
                'category' => 'Agrobisnis',
                'image' => 'images/bumdes-perkebunan jagung kopo.png',
                'description' => 'Unit usaha agribisnis perkebunan jagung yang memanfaatkan lahan produktif desa untuk menghasilkan komoditas pangan berkualitas. Usaha ini bertujuan untuk memperkuat ketahanan pangan dan mengoptimalkan potensi pertanian Desa Kopo.',
                'detail' => 'Unit Perkebunan Jagung BUMDes Desa Kopo berfokus pada budidaya jagung (seperti jagung manis untuk konsumsi dan jagung pipil untuk kebutuhan pakan ternak) dengan menerapkan teknik pertanian yang efisien dan ramah lingkungan. Kami mengoptimalkan lahan tidur milik desa menjadi lahan produktif serta melibatkan langsung para petani lokal dalam proses pengelolaan dan masa panen. Hasil panen jagung ini dipasarkan secara kompetitif ke pasar tradisional, industri pakan, maupun pengepul besar, di mana seluruh keuntungan usahanya dialokasikan kembali untuk pembangunan dan kesejahteraan masyarakat Desa Kopo.',
                'address' => 'Kp. Sawah Kopo RT 02/01, Desa Kopo, Kec. Kopo, Kabupaten Serang, Banten 42178',
                'jam_buka' => 'Senin - Sabtu, 08:00 - 16:00 WIB',
                'kontak' => '0823-4567-8901',
                'produk' => ['Jagung Manis (Per Kg)', 'Jagung Pipil Ternak (Per Kg)', 'Pupuk Organik Pertanian']
            ],
            'mart' => [
                'name' => 'Warung BUMDes "KOPO SEJAHTERA"',
                'category' => 'Komersial',
                'image' => 'images/bumdes-Warung Ritel Kopo.png',
                'description' => 'Toko ritel modern yang menyediakan berbagai kebutuhan alat-alat dan perlengkapan rumah tangga berkualitas dengan harga yang sangat bersahabat bagi warga Desa Kopo dan sekitarnya.',
                'detail' => 'Unit Usaha Toko Perlengkapan Rumah Tangga BUMDes Desa Kopo didirikan untuk mempermudah warga dalam memenuhi kebutuhan hunian tanpa harus pergi jauh ke pusat kota. Toko ritel ini menyediakan produk yang lengkap, mulai dari peralatan dapur, alat kebersihan, hingga perabotan plastik esensial. Dengan pelayanan yang ramah and lokasi yang strategis, unit usaha ini telah berhasil membangun basis pelanggan tetap yang kuat dari warga sekitar. Selain menjadi solusi belanja yang hemat dan dekat, seluruh keuntungan dari toko ritel ini diputar kembali untuk mendukung kas desa dan pembangunan infrastruktur di Desa Kopo.',
                'address' => 'Jalan Raya Kopo-Maja Km 1 Desa Kopo, Kec. Kopo, Kabupaten Serang, Banten 42178',
                'jam_buka' => 'Setiap Hari, 07:00 - 21:00 WIB',
                'kontak' => '0834-5678-9012',
                'produk' => ['Sembako & Bahan Pokok', 'Peralatan Dapur', 'Alat Kebersihan', 'Perabotan Rumah Tangga']
            ],
        ];

        return $bumdesData[$slug] ?? null;
    }

    public function show($slug)
    {
        $data = null;
        $bumdesId = null;

        try {
            if (Schema::hasTable('bumdes')) {
                $bumdes = Bumdes::where('slug', $slug)->first();
                if ($bumdes) {
                    $data = $bumdes->toArray();
                    $bumdesId = $bumdes->id;
                    // Add products matching the slug
                    $fallback = $this->getFallbackData($slug);
                    $data['produk'] = $fallback['produk'] ?? [];
                }
            }
        } catch (\Exception $e) {
            // fallback
        }

        if (!$data) {
            $data = $this->getFallbackData($slug);
        }

        if (!$data) {
            abort(404);
        }

        return view('bumdes.show', compact('data', 'slug', 'bumdesId'));
    }

    public function buy(Request $request, $slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengajukan pemesanan.');
        }

        $validated = $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:50',
            'kebutuhan' => 'nullable|string|max:1000',
            'kebutuhan_produk' => 'nullable|string|max:255',
            'catatan_kebutuhan' => 'nullable|string|max:500',
        ]);

        $kebutuhan = $validated['kebutuhan'] ?? '';
        if (!empty($validated['kebutuhan_produk'])) {
            $kebutuhan = $validated['kebutuhan_produk'];
            if (!empty($validated['catatan_kebutuhan'])) {
                $kebutuhan .= ' - ' . $validated['catatan_kebutuhan'];
            }
        }

        if (empty($kebutuhan)) {
            return redirect()->back()->withErrors(['kebutuhan' => 'Kebutuhan yang akan dibeli wajib diisi.'])->withInput();
        }

        $bumdesId = null;
        $bumdesName = '';

        try {
            if (Schema::hasTable('bumdes')) {
                $bumdes = Bumdes::where('slug', $slug)->first();
                if ($bumdes) {
                    $bumdesId = $bumdes->id;
                    $bumdesName = $bumdes->name;
                }
            }
        } catch (\Exception $e) {
            // ignore
        }

        if (!$bumdesName) {
            $fallback = $this->getFallbackData($slug);
            $bumdesName = $fallback['name'] ?? 'Unit BUMDes';
        }

        BumdesTransaction::create([
            'user_id' => Auth::id(),
            'bumdes_id' => $bumdesId,
            'bumdes_slug' => $slug,
            'bumdes_name' => $bumdesName,
            'nama_pembeli' => $validated['nama_pembeli'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'kebutuhan' => $kebutuhan,
            'status' => 'menunggu',
        ]);

        return redirect()->route('bumdes.show', $slug)->with('success', 'Pesanan pembelian berhasil diajukan! Anda dapat memantau status pesanan di halaman Akun.');
    }
}
