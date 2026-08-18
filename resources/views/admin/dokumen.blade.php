<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin Dokumen - Desa Kopo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #f87171;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }

        .alert-danger ul {
            margin-left: 1.5rem;
            margin-top: 0.5rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .grid-layout {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
        }

        @media (max-width: 900px) {
            .grid-layout {
                grid-template-columns: 1fr;
            }
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

        .form-group {
            margin-bottom: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-main);
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-family: inherit;
            font-size: 0.95rem;
            outline: none;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(6, 95, 70, 0.1);
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
        }

        .btn-submit:hover {
            background: var(--primary-light);
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
        }

        .admin-table tr:last-child td {
            border-bottom: none;
        }

        .actions-cell {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: var(--transition);
        }

        .btn-action.delete {
            background: #ef4444;
            color: white;
        }

        .btn-action.delete:hover {
            background: #dc2626;
        }

        .admin-header-sticky {
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .doc-icon-span {
            font-size: 1.5rem;
            margin-right: 10px;
        }
        
        .doc-icon-span.pdf { color: #ef4444; }
        .doc-icon-span.gambar { color: #3b82f6; }
    </style>
</head>
<body>

    <!-- Header & Sub-navigation Sticky Wrapper -->
    <div class="admin-header-sticky">
        <!-- Header Navbar Admin -->
        <nav class="admin-nav">
            <h2><img src="{{ asset('images/logos/logokabserang.png') }}" alt="Logo Desa Kopo" style="height: 30px; vertical-align: middle; margin-right: 10px;"> Panel Admin Desa Kopo</h2>
            <div class="user-menu">
                <span><i class="fa-solid fa-user-tie" style="margin-right: 5px; color: var(--accent);"></i> {{ Auth::user()->name }}</span>
                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout"><i class="fa-solid fa-right-from-bracket" style="margin-right: 5px;"></i> Keluar</button>
                </form>
            </div>
        </nav>

        <!-- Sub-navigation Tabs -->
        <div class="admin-tabs" style="background: white; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: center; gap: 1.5rem; padding: 0.5rem 0; box-shadow: 0 2px 4px rgba(0,0,0,0.02); flex-wrap: wrap;">
            <a href="{{ route('admin.finance.index') }}" style="text-decoration: none; font-weight: 700; color: var(--text-muted); padding: 0.5rem 1rem; border-bottom: 3px solid transparent; display: flex; align-items: center; gap: 8px; font-size: 0.95rem; transition: var(--transition);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
                <i class="fa-solid fa-wallet"></i> Kelola Keuangan
            </a>
            <a href="{{ route('admin.berita.index') }}" style="text-decoration: none; font-weight: 700; color: var(--text-muted); padding: 0.5rem 1rem; border-bottom: 3px solid transparent; display: flex; align-items: center; gap: 8px; font-size: 0.95rem; transition: var(--transition);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
                <i class="fa-solid fa-newspaper"></i> Kelola Berita Acara
            </a>
            <a href="{{ route('admin.struktur.index') }}" style="text-decoration: none; font-weight: 700; color: var(--text-muted); padding: 0.5rem 1rem; border-bottom: 3px solid transparent; display: flex; align-items: center; gap: 8px; font-size: 0.95rem; transition: var(--transition);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
                <i class="fa-solid fa-sitemap"></i> Kelola Struktur
            </a>
            <a href="{{ route('admin.permohonan.index') }}" style="text-decoration: none; font-weight: 700; color: var(--text-muted); padding: 0.5rem 1rem; border-bottom: 3px solid transparent; display: flex; align-items: center; gap: 8px; font-size: 0.95rem; transition: var(--transition);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
                <i class="fa-solid fa-file-invoice"></i> Kelola Permohonan
            </a>
            <a href="{{ route('admin.bumdes.index') }}" style="text-decoration: none; font-weight: 700; color: var(--text-muted); padding: 0.5rem 1rem; border-bottom: 3px solid transparent; display: flex; align-items: center; gap: 8px; font-size: 0.95rem; transition: var(--transition);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
                <i class="fa-solid fa-store"></i> Kelola BUMDes
            </a>
            <a href="{{ route('admin.document.index') }}" style="text-decoration: none; font-weight: 700; color: var(--primary); padding: 0.5rem 1rem; border-bottom: 3px solid var(--primary); display: flex; align-items: center; gap: 8px; font-size: 0.95rem;">
                <i class="fa-solid fa-file-pdf"></i> Kelola Dokumen
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

        <!-- Alert Error Validasi -->
        @if($errors->any())
            <div class="alert alert-danger">
                <div>
                    <strong style="display: block; margin-bottom: 5px;"><i class="fa-solid fa-triangle-exclamation"></i> Gagal mengunggah dokumen:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="grid-layout">
            <!-- Sisi Kiri: Form Unggah Dokumen Baru -->
            <div>
                <div class="card">
                    <h3 class="card-title"><i class="fa-solid fa-cloud-arrow-up"></i> Unggah Dokumen Baru</h3>
                    
                    <form action="{{ route('admin.document.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Nama / Judul Dokumen</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Contoh: Peraturan Desa No 3 Tahun 2026" required>
                        </div>

                        <div class="form-group">
                            <label for="file">Pilih Dokumen File</label>
                            <input type="file" name="file" id="file" class="form-control" accept=".pdf,.png,.jpg,.jpeg,.webp,.doc,.docx,.xls,.xlsx" required>
                            <small style="color: var(--text-muted); font-size: 0.8rem; margin-top: 3px;">Format: PDF, PNG, JPG, DOCX, XLSX (Max 20MB)</small>
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi Singkat (Opsional)</label>
                            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Tuliskan isi ringkas atau petunjuk penggunaan dokumen..."></textarea>
                        </div>

                        <button type="submit" class="btn-submit">Mulai Unggah Dokumen</button>
                    </form>
                </div>
            </div>

            <!-- Sisi Rangan: Tabel Daftar Dokumen -->
            <div>
                <div class="card">
                    <h3 class="card-title"><i class="fa-solid fa-folder-open"></i> Daftar Dokumen Unggahan</h3>
                    
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Nama Dokumen</th>
                                    <th>Tanggal Unggah</th>
                                    <th>Unduhan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($documents as $doc)
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center;">
                                                <span class="doc-icon-span {{ $doc->file_type }}">
                                                    @if($doc->file_type === 'gambar')
                                                        <i class="fa-regular fa-file-image"></i>
                                                    @else
                                                        <i class="fa-regular fa-file-pdf"></i>
                                                    @endif
                                                </span>
                                                <div>
                                                    <div style="font-weight: 700; color: var(--text-main);">{{ $doc->title }}</div>
                                                    @if($doc->description)
                                                        <small style="color: var(--text-muted); display: block; margin-top: 2px;">{{ Str::limit($doc->description, 60) }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td style="white-space: nowrap;">
                                            {{ $doc->created_at->format('d/m/Y') }}
                                        </td>
                                        <td style="font-weight: 700; text-align: center;">
                                            {{ $doc->downloads_count }}
                                        </td>
                                        <td>
                                            <div class="actions-cell">
                                                <form action="{{ route('admin.document.destroy', $doc->id) }}" method="POST" class="delete-form" data-confirm="Apakah Anda yakin ingin menghapus dokumen ini secara permanen dari server?">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action delete"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center; padding: 4rem;">
                                            <i class="fa-solid fa-folder-open" style="font-size: 2.5rem; color: #cbd5e1; display: block; margin-bottom: 0.5rem;"></i>
                                            Belum ada dokumen yang diunggah.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <script>
        document.addEventListener('submit', function (e) {
            if (e.target && e.target.classList.contains('delete-form')) {
                e.preventDefault();
                const form = e.target;
                const message = form.getAttribute('data-confirm') || 'Apakah Anda yakin ingin menghapus data ini?';
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    background: '#ffffff',
                    color: '#0f172a',
                    customClass: {
                        popup: 'swal2-custom-popup',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
</body>
</html>
