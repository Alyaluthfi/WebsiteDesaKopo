<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Akun Warga - Desa Kopo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .profile-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 0px;
        }

        .tab-btn {
            background: none;
            border: none;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-muted);
            border-bottom: 3px solid transparent;
            padding: 10px 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: -2px;
        }

        .tab-btn:hover {
            color: var(--primary);
        }

        .tab-btn.active {
            color: var(--primary);
            border-bottom: 3px solid var(--primary);
        }

        .tab-content {
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(6, 95, 70, 0.1);
            background-color: white;
        }

        .btn-save {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .btn-save:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        :root {
            --primary: #065f46;
            --primary-light: #10b981;
            --primary-dark: #022c22;
            --bg-body: #f8fafc;
        }

        body {
            background-color: var(--bg-body);
            padding-top: 100px;
            /* Offset for fixed navbar */
        }

        .profile-container {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 0 5%;
            display: grid;
            grid-template-columns: 1fr 2.5fr;
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .profile-container {
                grid-template-columns: 1fr;
            }
        }

        .profile-sidebar {
            position: sticky;
            top: 120px;
            height: fit-content;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .profile-card-header {
            text-align: center;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .profile-avatar {
            font-size: 5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .profile-name {
            font-size: 1.25rem;
            color: var(--primary-dark);
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .profile-role {
            font-size: 0.8rem;
            background: #d1fae5;
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 50px;
            font-weight: 700;
            display: inline-block;
            text-transform: uppercase;
        }

        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-list li {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            margin-bottom: 12px;
            color: var(--text-muted);
        }

        .info-list li strong {
            color: var(--text-main);
        }

        .card-title {
            font-size: 1.25rem;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 0.75rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th {
            text-align: left;
            padding: 1rem;
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            font-weight: 700;
            color: var(--text-main);
            font-size: 0.9rem;
        }

        .history-table td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
            color: var(--text-muted);
            vertical-align: top;
        }

        .history-table tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .status-menunggu {
            background: #fef3c7;
            color: #d97706;
        }

        .status-konfir-admin {
            background: #ffedd5;
            color: #ea580c;
        }

        .status-proses-pembuatan {
            background: #dbeafe;
            color: #2563eb;
        }

        .status-sudah-siap {
            background: #e0e7ff;
            color: #4f46e5;
        }

        .status-selesai {
            background: #d1fae5;
            color: #059669;
        }

        .status-habis {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-di-proses {
            background: #dbeafe;
            color: #2563eb;
        }

        .details-list {
            margin: 0;
            padding: 0;
            list-style: none;
            font-size: 0.8rem;
        }

        .details-list li {
            margin-bottom: 4px;
        }

        .details-list strong {
            color: var(--text-main);
        }

        .btn-kembali {
            display: block;
            text-align: center;
            background: var(--primary);
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-kembali:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    @include('partials.navbar')

    <div class="profile-container">
        <!-- Sidebar Identitas -->
        <div class="profile-sidebar">
            <div class="card">
                <div class="profile-card-header">
                    <div class="profile-avatar">
                        <i class="fa-solid fa-circle-user"></i>
                    </div>
                    <h3 class="profile-name">{{ $user->name }}</h3>
                    <span class="profile-role">Penduduk</span>
                </div>
                <ul class="info-list">
                    <li>
                        <span>Email:</span>
                        <strong>{{ $user->email }}</strong>
                    </li>
                    <li>
                        <span>Terdaftar:</span>
                        <strong>{{ $user->created_at->format('d M Y') }}</strong>
                    </li>
                </ul>
                <div style="margin-top: 1.5rem;">
                    <a href="{{ route('home') }}" class="btn-kembali"><i class="fa-solid fa-arrow-left"
                            style="margin-right: 5px;"></i> Kembali ke Beranda</a>
                </div>
            </div>
        </div>

        <!-- Konten Utama: Tabs & Detail Akun -->
        <div class="profile-main">
            <!-- Alert Notifikasi -->
            @if(session('success'))
                <div class="alert alert-success"
                    style="background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 12px 20px; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-weight: 600;">
                    <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger"
                    style="background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 12px 20px; border-radius: 12px; margin-bottom: 1.5rem; font-weight: 600;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                        <i class="fa-solid fa-circle-xmark" style="font-size: 1.2rem;"></i>
                        <strong>Gagal memperbarui data:</strong>
                    </div>
                    <ul style="margin: 0; padding-left: 20px; font-size: 0.9rem; font-weight: 500;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Navigation Tabs -->
            <div class="profile-tabs">
                <button class="tab-btn active" data-tab="tab-permohonan">
                    <i class="fa-solid fa-file-invoice"></i> Pengajuan Surat
                </button>
                <button class="tab-btn" data-tab="tab-bumdes">
                    <i class="fa-solid fa-store"></i> Pembelian BUMDes
                </button>
                <button class="tab-btn" data-tab="tab-settings">
                    <i class="fa-solid fa-user-gear"></i> Pengaturan Akun
                </button>
            </div>

            <!-- Tab Content: Riwayat Pengajuan -->
            <div id="tab-permohonan" class="tab-content">
                <div class="card">
                    <h3 class="card-title"><i class="fa-solid fa-history"></i> Riwayat Pengajuan Surat</h3>

                    <div class="table-responsive">
                        <table class="history-table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Layanan Surat</th>
                                    <th>Detail Data Syarat</th>
                                    <th>Status Tahapan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permohonanList as $permohonan)
                                    <tr>
                                        <td>
                                            <strong>{{ $permohonan->created_at->format('d M Y') }}</strong><br>
                                            <small
                                                style="color: var(--text-muted);">{{ $permohonan->created_at->format('H:i') }}
                                                WIB</small>
                                        </td>
                                        <td>
                                            <span style="font-weight: 700; color: var(--primary);">
                                                @if($permohonan->jenis_surat === 'domisili') Domisili
                                                @elseif($permohonan->jenis_surat === 'sku') SKU
                                                @elseif($permohonan->jenis_surat === 'sktm') SKTM
                                                @elseif($permohonan->jenis_surat === 'pindah') Pindah
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <ul class="details-list">
                                                @if(is_array($permohonan->data_syarat))
                                                    @foreach($permohonan->data_syarat as $key => $val)
                                                        <li>
                                                            <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong>
                                                            {{ $val }}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li><em style="color: var(--text-muted);">Format data salah</em></li>
                                                @endif
                                            </ul>
                                        </td>
                                        <td>
                                            <span
                                                class="status-badge status-{{ str_replace(' ', '-', $permohonan->status) }}">
                                                @if($permohonan->status === 'menunggu') Menunggu
                                                @elseif($permohonan->status === 'konfir admin') Konfir Admin
                                                @elseif($permohonan->status === 'proses pembuatan') Proses Pembuatan
                                                @elseif($permohonan->status === 'sudah siap') Sudah Siap
                                                @elseif($permohonan->status === 'selesai') Selesai
                                                @else {{ $permohonan->status }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            style="text-align: center; padding: 4rem; color: var(--text-muted);">
                                            <i class="fa-solid fa-folder-open"
                                                style="font-size: 2.5rem; margin-bottom: 1rem; color: #cbd5e1; display: block;"></i>
                                            Anda belum pernah mengajukan permohonan surat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Riwayat BUMDes -->
            <div id="tab-bumdes" class="tab-content" style="display: none;">
                <div class="card">
                    <h3 class="card-title"><i class="fa-solid fa-basket-shopping"></i> Riwayat Pembelian BUMDes</h3>

                    <div class="table-responsive">
                        <table class="history-table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Unit BUMDes</th>
                                    <th>Nama & Kontak</th>
                                    <th>Kebutuhan Pembelian</th>
                                    <th>Status Pesanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bumdesTransactions as $tx)
                                    <tr>
                                        <td>
                                            <strong>{{ $tx->created_at->format('d M Y') }}</strong><br>
                                            <small style="color: var(--text-muted);">{{ $tx->created_at->format('H:i') }}
                                                WIB</small>
                                        </td>
                                        <td>
                                            <span style="font-weight: 700; color: var(--primary);">
                                                {{ $tx->bumdes_name }}
                                            </span>
                                        </td>
                                        <td>
                                            <strong>{{ $tx->nama_pembeli }}</strong><br>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);"><i
                                                    class="fa-solid fa-phone"
                                                    style="font-size: 0.75rem; margin-right: 3px;"></i>
                                                {{ $tx->no_hp }}</span>
                                        </td>
                                        <td>
                                            <div
                                                style="font-size: 0.85rem; color: var(--text-main); font-weight: 500; line-height: 1.4;">
                                                {{ $tx->kebutuhan }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ str_replace(' ', '-', $tx->status) }}">
                                                @if($tx->status === 'menunggu') Menunggu
                                                @elseif($tx->status === 'habis') Hubis
                                                @elseif($tx->status === 'di proses') Di Proses
                                                @elseif($tx->status === 'sudah siap') Sudah Siap
                                                @elseif($tx->status === 'selesai') Selesai
                                                @else {{ $tx->status }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            style="text-align: center; padding: 4rem; color: var(--text-muted);">
                                            <i class="fa-solid fa-basket-shopping"
                                                style="font-size: 2.5rem; margin-bottom: 1rem; color: #cbd5e1; display: block;"></i>
                                            Anda belum memiliki riwayat pembelian di unit BUMDes.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Pengaturan Akun -->
            <div id="tab-settings" class="tab-content" style="display: none;">
                <!-- Edit Profil -->
                <div class="card">
                    <h3 class="card-title"><i class="fa-solid fa-user-pen"></i> Edit Profil</h3>
                    <form action="{{ route('akun.update-profile') }}" method="POST">
                        @csrf
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}"
                                required>
                        </div>
                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label for="email">Alamat Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}"
                                required>
                        </div>
                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Profil
                        </button>
                    </form>
                </div>

                <!-- Ubah Password -->
                <div class="card" style="margin-top: 2rem;">
                    <h3 class="card-title"><i class="fa-solid fa-key"></i> Ubah Password</h3>
                    <form action="{{ route('akun.update-password') }}" method="POST">
                        @csrf
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label for="current_password">Password Saat Ini</label>
                            <div style="position: relative;">
                                <input type="password" id="current_password" name="current_password"
                                    class="form-control" required style="padding-right: 45px;">
                                <i class="fa-solid fa-eye-slash toggle-pwd-settings" data-target="current_password"
                                    style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #64748b; font-size: 1rem; z-index: 10;"></i>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label for="new_password">Password Baru</label>
                            <div style="position: relative;">
                                <input type="password" id="new_password" name="new_password" class="form-control"
                                    required style="padding-right: 45px;">
                                <i class="fa-solid fa-eye-slash toggle-pwd-settings" data-target="new_password"
                                    style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #64748b; font-size: 1rem; z-index: 10;"></i>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                            <div style="position: relative;">
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                    class="form-control" required style="padding-right: 45px;">
                                <i class="fa-solid fa-eye-slash toggle-pwd-settings"
                                    data-target="new_password_confirmation"
                                    style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #64748b; font-size: 1rem; z-index: 10;"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-key"></i> Perbarui Kata Sandi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching logic
            const tabs = document.querySelectorAll('.tab-btn');
            const contents = document.querySelectorAll('.tab-content');

            function switchTab(targetId) {
                tabs.forEach(tab => {
                    const isTarget = tab.getAttribute('data-tab') === targetId;
                    tab.classList.toggle('active', isTarget);
                });

                contents.forEach(content => {
                    const isTarget = content.getAttribute('id') === targetId;
                    content.style.display = isTarget ? 'block' : 'none';
                });
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const targetId = tab.getAttribute('data-tab');
                    switchTab(targetId);
                });
            });

            // If validation errors are present, auto-switch to settings tab
            @if($errors->has('current_password') || $errors->has('new_password') || $errors->has('name') || $errors->has('email') || $errors->has('current_password_error'))
                switchTab('tab-settings');
            @endif

            // Toggle password visibility in settings
            const togglePwdIcons = document.querySelectorAll('.toggle-pwd-settings');
            togglePwdIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    const targetInputId = this.getAttribute('data-target');
                    const targetInput = document.getElementById(targetInputId);
                    
                    if (targetInput.type === 'password') {
                        targetInput.type = 'text';
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    } else {
                        targetInput.type = 'password';
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    }
                });
            });
        });
    </script>
</body>

</html>