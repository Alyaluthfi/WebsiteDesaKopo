<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin Permohonan Surat - Desa Kopo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        :root {
            --primary: #065f46;
            --primary-light: #10b981;
            --primary-dark: #022c22;
            --bg-body: #f1f5f9;
        }

        body {
            background-color: var(--bg-body);
        }

        .admin-nav {
            position: relative;
            top: auto;
            width: auto;
            z-index: auto;
            backdrop-filter: none;
            background: var(--primary-dark);
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .admin-nav h2 {
            color: white;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-nav h2 i {
            color: var(--accent);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-menu span {
            font-size: 0.95rem;
            font-weight: 600;
            color: rgba(255,255,255,0.9);
        }

        .btn-logout {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-logout:hover {
            background: #ef4444;
            border-color: #ef4444;
        }

        .admin-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 5%;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 2rem;
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

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th {
            text-align: left;
            padding: 1rem;
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            font-weight: 700;
            color: var(--text-main);
            font-size: 0.9rem;
        }

        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
            color: var(--text-muted);
            vertical-align: top;
        }

        .admin-table tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
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

        .details-list {
            margin: 0;
            padding: 0;
            list-style: none;
            font-size: 0.85rem;
        }

        .details-list li {
            margin-bottom: 4px;
        }

        .details-list strong {
            color: var(--text-main);
        }

        .btn-status-update {
            background: #e2e8f0;
            color: var(--text-main);
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-family: inherit;
            font-weight: 600;
            font-size: 0.8rem;
            transition: var(--transition);
        }

        .btn-status-update:hover {
            background: #cbd5e1;
        }

        .actions-col {
            display: flex;
            flex-direction: column;
            gap: 5px;
            width: 140px;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-family: inherit;
            font-weight: 600;
            font-size: 0.8rem;
            transition: var(--transition);
            text-align: center;
        }

        .btn-delete:hover {
            background: #fca5a5;
        }

        .admin-header-sticky {
            position: sticky;
            top: 0;
            z-index: 999;
        }
    </style>
</head>
<body>

    <!-- Header & Sub-navigation Sticky Wrapper -->
    <div class="admin-header-sticky">
        <!-- Header Navbar Admin -->
        <nav class="admin-nav">
            <h2><i class="fa-solid fa-gauge-high"></i> Panel Admin Desa Kopo</h2>
            <div class="user-menu">
                <span><i class="fa-solid fa-user-tie" style="margin-right: 5px; color: var(--accent);"></i> {{ Auth::user()->name }}</span>
                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout"><i class="fa-solid fa-right-from-bracket" style="margin-right: 5px;"></i> Keluar</button>
                </form>
            </div>
        </nav>

        <!-- Sub-navigation Tabs -->
        <div class="admin-tabs" style="background: white; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: center; gap: 2rem; padding: 0.5rem 0; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
            <a href="{{ route('admin.finance.index') }}" style="text-decoration: none; font-weight: 700; color: var(--text-muted); padding: 0.5rem 1rem; border-bottom: 3px solid transparent; display: flex; align-items: center; gap: 8px; font-size: 0.95rem; transition: var(--transition);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
                <i class="fa-solid fa-wallet"></i> Kelola Keuangan
            </a>
            <a href="{{ route('admin.berita.index') }}" style="text-decoration: none; font-weight: 700; color: var(--text-muted); padding: 0.5rem 1rem; border-bottom: 3px solid transparent; display: flex; align-items: center; gap: 8px; font-size: 0.95rem; transition: var(--transition);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
                <i class="fa-solid fa-newspaper"></i> Kelola Berita Acara
            </a>
            <a href="{{ route('admin.struktur.index') }}" style="text-decoration: none; font-weight: 700; color: var(--text-muted); padding: 0.5rem 1rem; border-bottom: 3px solid transparent; display: flex; align-items: center; gap: 8px; font-size: 0.95rem; transition: var(--transition);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
                <i class="fa-solid fa-sitemap"></i> Kelola Struktur
            </a>
            <a href="{{ route('admin.permohonan.index') }}" style="text-decoration: none; font-weight: 700; color: var(--primary); padding: 0.5rem 1rem; border-bottom: 3px solid var(--primary); display: flex; align-items: center; gap: 8px; font-size: 0.95rem;">
                <i class="fa-solid fa-file-invoice"></i> Kelola Permohonan
            </a>
            <a href="{{ route('admin.bumdes.index') }}" style="text-decoration: none; font-weight: 700; color: var(--text-muted); padding: 0.5rem 1rem; border-bottom: 3px solid transparent; display: flex; align-items: center; gap: 8px; font-size: 0.95rem; transition: var(--transition);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
                <i class="fa-solid fa-store"></i> Kelola BUMDes
            </a>
        </div>
    </div>

    <div class="admin-container">
        <!-- Alert Sukses -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="card">
            <h3 class="card-title"><i class="fa-solid fa-file-signature"></i> Daftar Permohonan Surat Keterangan</h3>
            
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Tanggal Masuk</th>
                            <th>Pemohon</th>
                            <th>Jenis Surat</th>
                            <th>Detail Persyaratan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonanList as $permohonan)
                            <tr>
                                <td>
                                    {{ $permohonan->created_at->format('d M Y') }}<br>
                                    <small style="color: var(--text-muted);">{{ $permohonan->created_at->format('H:i') }} WIB</small>
                                </td>
                                <td>
                                    <strong>{{ $permohonan->user->name }}</strong><br>
                                    <span style="font-size: 0.8rem; color: var(--text-muted);">{{ $permohonan->user->email }}</span>
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
                                    <span class="status-badge status-{{ str_replace(' ', '-', $permohonan->status) }}">
                                        {{ $permohonan->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="actions-col">
                                        <form action="{{ route('admin.permohonan.update', $permohonan->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 5px;">
                                            @csrf
                                            @method('PUT')
                                            
                                            <select name="status" class="form-control" style="font-size: 0.8rem; padding: 4px 8px; height: auto;" onchange="this.form.submit()">
                                                <option value="menunggu" {{ $permohonan->status === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                <option value="konfir admin" {{ $permohonan->status === 'konfir admin' ? 'selected' : '' }}>Konfir Admin</option>
                                                <option value="proses pembuatan" {{ $permohonan->status === 'proses pembuatan' ? 'selected' : '' }}>Proses Pembuatan</option>
                                                <option value="sudah siap" {{ $permohonan->status === 'sudah siap' ? 'selected' : '' }}>Sudah Siap</option>
                                                <option value="selesai" {{ $permohonan->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </form>

                                        <form action="{{ route('admin.permohonan.destroy', $permohonan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus permohonan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" style="width: 100%;"><i class="fa-solid fa-trash"></i> Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 4rem; color: var(--text-muted);">
                                    <i class="fa-solid fa-envelope-open" style="font-size: 2.5rem; margin-bottom: 1rem; color: #cbd5e1; display: block;"></i>
                                    Belum ada permohonan surat masuk dari warga.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
