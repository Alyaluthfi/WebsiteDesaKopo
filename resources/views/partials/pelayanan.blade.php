<section id="pelayanan">
    <h2 class="section-title">Pelayanan Desa</h2>
    <p class="section-subtitle">Pilih layanan administrasi surat keterangan mandiri yang Anda butuhkan. Proses cepat dan efisien langsung dari akun Anda.</p>
    
    <div class="services-grid">
        <a href="{{ route('pelayanan.form', ['jenis' => 'domisili']) }}" class="service-card-link">
            <div class="service-card">
                <i class="fa-solid fa-house-user service-icon"></i>
                <h3>Surat Keterangan Domisili</h3>
                <p>Pengajuan surat keterangan tempat tinggal resmi bagi warga yang berdomisili di Desa Kopo.</p>
                <span class="service-action-btn">Ajukan Surat <i class="fa-solid fa-arrow-right"></i></span>
            </div>
        </a>
        <a href="{{ route('pelayanan.form', ['jenis' => 'sku']) }}" class="service-card-link">
            <div class="service-card">
                <i class="fa-solid fa-store service-icon"></i>
                <h3>Surat Keterangan Usaha (SKU)</h3>
                <p>Penerbitan surat izin/keterangan usaha warga untuk syarat pengajuan kredit usaha atau legalitas.</p>
                <span class="service-action-btn">Ajukan Surat <i class="fa-solid fa-arrow-right"></i></span>
            </div>
        </a>
        <a href="{{ route('pelayanan.form', ['jenis' => 'sktm']) }}" class="service-card-link">
            <div class="service-card">
                <i class="fa-solid fa-hand-holding-hand service-icon"></i>
                <h3>Surat Keterangan Tidak Mampu</h3>
                <p>Penerbitan SKTM untuk keringanan biaya rumah sakit, pengajuan bantuan sosial, atau beasiswa sekolah.</p>
                <span class="service-action-btn">Ajukan Surat <i class="fa-solid fa-arrow-right"></i></span>
            </div>
        </a>
        <a href="{{ route('pelayanan.form', ['jenis' => 'pindah']) }}" class="service-card-link">
            <div class="service-card">
                <i class="fa-solid fa-truck-moving service-icon"></i>
                <h3>Surat Keterangan Pindah</h3>
                <p>Pengurusan berkas kepindahan domisili dari Desa Kopo menuju ke alamat kota/kabupaten tujuan baru.</p>
                <span class="service-action-btn">Ajukan Surat <i class="fa-solid fa-arrow-right"></i></span>
            </div>
        </a>
    </div>
</section>

<style>
    .service-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .service-card {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        background: var(--bg-card);
        padding: 2.5rem 2rem;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        border: 1px solid rgba(0,0,0,0.04);
        text-align: center;
        transition: var(--transition);
    }

    .service-card-link:hover .service-card {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(6, 95, 70, 0.08);
        border-color: var(--primary-light);
    }

    .service-action-btn {
        margin-top: 1.5rem;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 6px;
        transition: var(--transition);
    }

    .service-card-link:hover .service-action-btn {
        color: var(--primary-light);
    }
</style>
