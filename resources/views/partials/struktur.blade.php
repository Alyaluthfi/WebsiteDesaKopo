@php
    $kades = $strukturList->firstWhere('peran', 'kades');
    $sekdes = $strukturList->firstWhere('peran', 'sekdes');
    $kaurKeuangan = $strukturList->firstWhere('peran', 'kaur_keuangan');
    $kaurUmum = $strukturList->firstWhere('peran', 'kaur_umum');
    $kaurPerencanaan = $strukturList->firstWhere('peran', 'kaur_perencanaan');
    $kasiPemerintahan = $strukturList->firstWhere('peran', 'kasi_pemerintahan');
    $kasiKesra = $strukturList->firstWhere('peran', 'kasi_kesra');
    $kasiPelayanan = $strukturList->firstWhere('peran', 'kasi_pelayanan');
@endphp

<section class="struktur-section" id="struktur">
    <div class="container">
        <h2 class="section-title">Struktur Organisasi</h2>
        <p class="section-subtitle">Susunan Pemerintah Desa Kopo yang siap melayani masyarakat dengan integritas dan dedikasi.</p>
        
        <div class="struktur-tree">
            <!-- Level 1: Kepala Desa -->
            <div class="tree-level level-1">
                <div class="member-card leader">
                    <div class="avatar-wrapper">
                        @if($kades && $kades->foto)
                            <img src="{{ asset($kades->foto) }}" alt="Foto {{ $kades->nama }}" class="avatar-img">
                        @else
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=kades" alt="Default Avatar" class="avatar-img">
                        @endif
                    </div>
                    <h3>{{ $kades->nama ?? 'Nama Kepala Desa' }}</h3>
                    <span class="role">{{ $kades->jabatan ?? 'Kepala Desa' }}</span>
                </div>
            </div>

            <!-- Connector Line -->
            <div class="tree-connector-v"></div>

            <!-- Level 2: Sekretaris Desa -->
            <div class="tree-level level-2">
                <div class="member-card co-leader">
                    <div class="avatar-wrapper">
                        @if($sekdes && $sekdes->foto)
                            <img src="{{ asset($sekdes->foto) }}" alt="Foto {{ $sekdes->nama }}" class="avatar-img">
                        @else
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=sekdes" alt="Default Avatar" class="avatar-img">
                        @endif
                    </div>
                    <h3>{{ $sekdes->nama ?? 'Nama Sekretaris Desa' }}</h3>
                    <span class="role">{{ $sekdes->jabatan ?? 'Sekretaris Desa' }}</span>
                </div>
            </div>

            <!-- Connector Line -->
            <div class="tree-connector-v"></div>

            <!-- Level 3: Kepala Urusan & Kepala Seksi Grid -->
            <div class="tree-grid-row">
                <!-- Group 1: Kepala Urusan (Kaur) -->
                <div class="staff-group">
                    <h4>Kepala Urusan (Kaur)</h4>
                    <div class="staff-grid">
                        <div class="member-card staff">
                            <div class="avatar-wrapper">
                                @if($kaurKeuangan && $kaurKeuangan->foto)
                                    <img src="{{ asset($kaurKeuangan->foto) }}" alt="Foto {{ $kaurKeuangan->nama }}" class="avatar-img">
                                @else
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=kaur_keuangan" alt="Default Avatar" class="avatar-img">
                                @endif
                            </div>
                            <h3>{{ $kaurKeuangan->nama ?? 'Nama Kaur Keuangan' }}</h3>
                            <span class="role">{{ $kaurKeuangan->jabatan ?? 'Kaur Keuangan' }}</span>
                        </div>
                        <div class="member-card staff">
                            <div class="avatar-wrapper">
                                @if($kaurUmum && $kaurUmum->foto)
                                    <img src="{{ asset($kaurUmum->foto) }}" alt="Foto {{ $kaurUmum->nama }}" class="avatar-img">
                                @else
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=kaur_umum" alt="Default Avatar" class="avatar-img">
                                @endif
                            </div>
                            <h3>{{ $kaurUmum->nama ?? 'Nama Kaur TU & Umum' }}</h3>
                            <span class="role">{{ $kaurUmum->jabatan ?? 'Kaur TU & Umum' }}</span>
                        </div>
                        <div class="member-card staff">
                            <div class="avatar-wrapper">
                                @if($kaurPerencanaan && $kaurPerencanaan->foto)
                                    <img src="{{ asset($kaurPerencanaan->foto) }}" alt="Foto {{ $kaurPerencanaan->nama }}" class="avatar-img">
                                @else
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=kaur_perencanaan" alt="Default Avatar" class="avatar-img">
                                @endif
                            </div>
                            <h3>{{ $kaurPerencanaan->nama ?? 'Nama Kaur Perencanaan' }}</h3>
                            <span class="role">{{ $kaurPerencanaan->jabatan ?? 'Kaur Perencanaan' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Group 2: Kepala Seksi (Kasi) -->
                <div class="staff-group">
                    <h4>Kepala Seksi (Kasi)</h4>
                    <div class="staff-grid">
                        <div class="member-card staff">
                            <div class="avatar-wrapper">
                                @if($kasiPemerintahan && $kasiPemerintahan->foto)
                                    <img src="{{ asset($kasiPemerintahan->foto) }}" alt="Foto {{ $kasiPemerintahan->nama }}" class="avatar-img">
                                @else
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=kasi_pemerintahan" alt="Default Avatar" class="avatar-img">
                                @endif
                            </div>
                            <h3>{{ $kasiPemerintahan->nama ?? 'Nama Kasi Pemerintahan' }}</h3>
                            <span class="role">{{ $kasiPemerintahan->jabatan ?? 'Kasi Pemerintahan' }}</span>
                        </div>
                        <div class="member-card staff">
                            <div class="avatar-wrapper">
                                @if($kasiKesra && $kasiKesra->foto)
                                    <img src="{{ asset($kasiKesra->foto) }}" alt="Foto {{ $kasiKesra->nama }}" class="avatar-img">
                                @else
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=kasi_kesra" alt="Default Avatar" class="avatar-img">
                                @endif
                            </div>
                            <h3>{{ $kasiKesra->nama ?? 'Nama Kasi Kesejahteraan' }}</h3>
                            <span class="role">{{ $kasiKesra->jabatan ?? 'Kasi Kesejahteraan (Kesra)' }}</span>
                        </div>
                        <div class="member-card staff">
                            <div class="avatar-wrapper">
                                @if($kasiPelayanan && $kasiPelayanan->foto)
                                    <img src="{{ asset($kasiPelayanan->foto) }}" alt="Foto {{ $kasiPelayanan->nama }}" class="avatar-img">
                                @else
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=kasi_pelayanan" alt="Default Avatar" class="avatar-img">
                                @endif
                            </div>
                            <h3>{{ $kasiPelayanan->nama ?? 'Nama Kasi Pelayanan' }}</h3>
                            <span class="role">{{ $kasiPelayanan->jabatan ?? 'Kasi Pelayanan' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .struktur-section {
        padding: 6rem 5%;
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }

    .struktur-tree {
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .tree-level {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .member-card {
        background: var(--bg-card);
        border-radius: 20px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        transition: var(--transition);
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 250px;
    }

    .member-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1);
        border-color: var(--primary-light);
    }

    .member-card.leader {
        border-top: 4px solid var(--accent);
        width: 280px;
        padding: 2rem 1.5rem;
    }

    .member-card.co-leader {
        border-top: 4px solid var(--primary);
        width: 260px;
    }

    .member-card.staff {
        border-top: 4px solid var(--primary-light);
        width: 220px;
        padding: 1.25rem 1rem;
    }

    .avatar-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        color: var(--text-muted);
        font-size: 2.2rem;
        transition: var(--transition);
        overflow: hidden;
    }

    .member-card:hover .avatar-wrapper {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        color: white;
        transform: scale(1.05);
    }

    .member-card.leader .avatar-wrapper {
        width: 90px;
        height: 90px;
        font-size: 2.5rem;
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .member-card h3 {
        font-size: 1.1rem;
        color: var(--text-main);
        margin-bottom: 0.25rem;
        font-weight: 700;
        line-height: 1.3;
    }

    .member-card.leader h3 {
        font-size: 1.25rem;
    }

    .member-card .role {
        font-size: 0.85rem;
        color: var(--primary);
        font-weight: 600;
        background: rgba(6, 95, 70, 0.08);
        padding: 4px 12px;
        border-radius: 50px;
        margin-top: 0.5rem;
    }

    .member-card.leader .role {
        background: rgba(245, 158, 11, 0.15);
        color: #b45309;
    }

    .tree-connector-v {
        width: 2px;
        height: 30px;
        background: #cbd5e1;
    }

    .tree-connector-h {
        height: 2px;
        background: #cbd5e1;
        width: 100%;
    }

    .tree-grid-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        width: 100%;
        margin-top: 1.5rem;
    }

    .staff-group {
        background: rgba(255, 255, 255, 0.5);
        border-radius: 24px;
        padding: 2rem 1.5rem;
        border: 1px dashed #cbd5e1;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .staff-group h4 {
        font-size: 1.2rem;
        color: var(--primary-dark);
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 8px;
        font-weight: 700;
    }

    .staff-group h4::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 3px;
        background: var(--primary-light);
        border-radius: 2px;
    }

    .staff-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1.5rem;
        width: 100%;
    }

    @media (max-width: 992px) {
        .tree-grid-row {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
    }
</style>
