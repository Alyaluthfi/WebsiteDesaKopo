<section id="keuangan" style="padding: 0 0 6rem 0;">
    <div class="finance-section">
        <h2 class="section-title">Transparansi Keuangan</h2>
        <p class="section-subtitle">Bentuk komitmen Pemerintah Desa Kopo dalam mewujudkan tata kelola pemerintahan yang baik, bersih, dan terbuka bagi seluruh masyarakat.</p>
        
        <div class="finance-stats">
            <div class="stat-card">
                <h4>Total Anggaran Desa (APBDes) {{ $finance->tahun }}</h4>
                <div class="stat-amount">Rp {{ number_format($finance->total_anggaran, 0, ',', '.') }}</div>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 100%;"></div>
                </div>
                <div class="progress-labels">
                    <span>Penerimaan</span>
                    <span>100%</span>
                </div>
            </div>
            <div class="stat-card">
                <h4>Realisasi Penyerapan Dana</h4>
                <div class="stat-amount">Rp {{ number_format($finance->realisasi_penyerapan, 0, ',', '.') }}</div>
                <div class="progress-bar-container">
                    @php
                        $percentage = $finance->total_anggaran > 0 ? round(($finance->realisasi_penyerapan / $finance->total_anggaran) * 100) : 0;
                    @endphp
                    <div class="progress-bar" style="width: {{ $percentage }}%;"></div>
                </div>
                <div class="progress-labels">
                    <span>Terserap</span>
                    <span>{{ $percentage }}%</span>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 3.5rem;">
            <a href="{{ route('keuangan.index') }}" class="btn btn-accent" style="display: inline-flex; align-items: center; gap: 10px; text-decoration: none; padding: 14px 36px; border-radius: 50px; font-weight: 700; font-size: 1.05rem; box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2); transition: var(--transition);">
                Lihat Detail Transparansi Keuangan <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
