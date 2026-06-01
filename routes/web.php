<?php

use Illuminate\Support\Facades\Route;
use App\Models\Bumdes;
use App\Models\Finance;
use App\Models\BeritaAcara;
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminFinanceController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\AdminStrukturController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\AdminPermohonanController;
use App\Http\Controllers\BumdesController;
use App\Http\Controllers\AdminBumdesController;

Route::get('/', function () {
    $bumdesList = [];
    $finance = null;
    $beritaList = [];
    $strukturList = [];

    try {
        if (Schema::hasTable('bumdes')) {
            $bumdesList = Bumdes::all();
        }
        if (Schema::hasTable('finances')) {
            $finance = Finance::where('tahun', 2026)->first() ?? Finance::latest('tahun')->first();
        }
        if (Schema::hasTable('berita_acara')) {
            $beritaList = BeritaAcara::orderBy('tanggal_pelaksanaan', 'desc')->get();
        }
        if (Schema::hasTable('struktur_organisasis')) {
            $strukturList = StrukturOrganisasi::orderBy('urutan', 'asc')->get();
        }
    } catch (\Exception $e) {
        // Fallback to empty/static if database not yet migrated
    }

    // Fallback if database is empty or tables not migrated
    if (count($bumdesList) === 0) {
        $bumdesList = collect([
            (object)[
                'slug' => 'mart',
                'name' => 'BUMDes Mart "Kopo Makmur"',
                'category' => 'Perdagangan',
                'image' => 'images/bumdes_store_1776842621020.png',
                'description' => 'Minimarket modern yang menyediakan kebutuhan pokok warga dengan harga terjangkau. BUMDes Mart ini juga menjadi tempat pemasaran produk-produk UMKM lokal dari masyarakat Desa Kopo.'
            ],
            (object)[
                'slug' => 'agro',
                'name' => 'Pusat Pengolahan Tani',
                'category' => 'Agrobisnis',
                'image' => 'images/bumdes_agri_1776842636235.png',
                'description' => 'Fasilitas pengolahan hasil pertanian untuk meningkatkan nilai jual gabah dan palawija. Dilengkapi dengan mesin penggilingan padi modern dan gudang penyimpanan standar.'
            ],
            (object)[
                'slug' => 'wisata',
                'name' => 'Desa Wisata Tirta Kopo',
                'category' => 'Pariwisata',
                'image' => 'images/bumdes_tourism_1776842653286.png',
                'description' => 'Destinasi ekowisata yang menonjolkan keindahan alam pedesaan, aliran sungai yang jernih, dan fasilitas outbound. Menjadi sumber Pendapatan Asli Desa (PADes) unggulan.'
            ],
            (object)[
                'slug' => 'kriya',
                'name' => 'Sentra Kriya Bambu Kopo',
                'category' => 'Industri Kreatif',
                'image' => 'images/bumdes_crafts_1776842672130.png',
                'description' => 'Pusat kerajinan anyaman bambu yang memberdayakan pengrajin lokal. Menghasilkan produk furnitur, dekorasi rumah, hingga suvenir yang telah menembus pasar nasional.'
            ],
            (object)[
                'slug' => 'waste',
                'name' => 'Bank Sampah "Kopo Bersih"',
                'category' => 'Lingkungan',
                'image' => 'images/bumdes_waste_1776842688452.png',
                'description' => 'Fasilitas manajemen sampah terpadu yang mengubah limbah menjadi berkah. Warga dapat menabung sampah yang bernilai ekonomis dan diolah menjadi pupuk kompos.'
            ]
        ]);
    }

    if (!$finance) {
        $finance = (object)[
            'tahun' => 2026,
            'total_anggaran' => 1450000000,
            'realisasi_penyerapan' => 1232500000
        ];
    }

    return view('welcome', compact('bumdesList', 'finance', 'beritaList', 'strukturList'));
})->name('home');

Route::get('/bumdes/{slug}', [BumdesController::class, 'show'])->name('bumdes.show');
Route::post('/bumdes/{slug}/pesan', [BumdesController::class, 'buy'])->name('bumdes.buy');

// Public route for detail transparency
Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');

// Admin & Resident Auth routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login']);
Route::get('/register', [AdminAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AdminAuthController::class, 'register']);

// Pelayanan routes
Route::middleware(['auth'])->group(function () {
    Route::get('/pelayanan/{jenis}', [PelayananController::class, 'showForm'])->name('pelayanan.form');
    Route::post('/pelayanan/{jenis}', [PelayananController::class, 'submitForm'])->name('pelayanan.submit');
    Route::get('/akun', [PelayananController::class, 'showProfile'])->name('akun');
});

// Admin Dashboard routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/keuangan', [AdminFinanceController::class, 'index'])->name('admin.finance.index');
    Route::post('/admin/keuangan', [AdminFinanceController::class, 'store'])->name('admin.finance.store');
    Route::put('/admin/keuangan/{id}', [AdminFinanceController::class, 'update'])->name('admin.finance.update');
    Route::delete('/admin/keuangan/{id}', [AdminFinanceController::class, 'destroy'])->name('admin.finance.destroy');
    Route::post('/admin/anggaran', [AdminFinanceController::class, 'updateBudget'])->name('admin.budget.update');

    // Berita Acara admin routes
    Route::get('/admin/berita', [AdminBeritaController::class, 'index'])->name('admin.berita.index');
    Route::post('/admin/berita', [AdminBeritaController::class, 'store'])->name('admin.berita.store');
    Route::put('/admin/berita/{id}', [AdminBeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/admin/berita/{id}', [AdminBeritaController::class, 'destroy'])->name('admin.berita.destroy');

    // Struktur Organisasi admin routes
    Route::get('/admin/struktur', [AdminStrukturController::class, 'index'])->name('admin.struktur.index');
    Route::put('/admin/struktur/{id}', [AdminStrukturController::class, 'update'])->name('admin.struktur.update');

    // Permohonan Surat admin routes
    Route::get('/admin/permohonan', [AdminPermohonanController::class, 'index'])->name('admin.permohonan.index');
    Route::put('/admin/permohonan/{id}', [AdminPermohonanController::class, 'updateStatus'])->name('admin.permohonan.update');
    Route::delete('/admin/permohonan/{id}', [AdminPermohonanController::class, 'destroy'])->name('admin.permohonan.destroy');

    // BUMDes Transactions admin routes
    Route::get('/admin/bumdes', [AdminBumdesController::class, 'index'])->name('admin.bumdes.index');
    Route::put('/admin/bumdes/{id}', [AdminBumdesController::class, 'updateStatus'])->name('admin.bumdes.update');
    Route::delete('/admin/bumdes/{id}', [AdminBumdesController::class, 'destroy'])->name('admin.bumdes.destroy');
});
