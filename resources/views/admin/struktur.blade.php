<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin Struktur Organisasi - Desa Kopo</title>
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

        .btn-cancel {
            background: #e2e8f0;
            color: var(--text-muted);
            padding: 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-top: 0.5rem;
        }

        .btn-cancel:hover {
            background: #cbd5e1;
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
            vertical-align: middle;
        }

        .admin-table tr:last-child td {
            border-bottom: none;
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

        .btn-action.edit {
            background: #3b82f6;
            color: white;
        }

        .btn-action.edit:hover {
            background: #2563eb;
        }

        .thumbnail-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid #e2e8f0;
            background: #f1f5f9;
        }

        .preview-box {
            display: none;
            margin-top: 0.5rem;
            padding: 8px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #f8fafc;
            text-align: center;
        }

        .preview-box img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid var(--primary-light);
        }

        .preview-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-muted);
            margin-bottom: 4px;
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
            <a href="{{ route('admin.struktur.index') }}" style="text-decoration: none; font-weight: 700; color: var(--primary); padding: 0.5rem 1rem; border-bottom: 3px solid var(--primary); display: flex; align-items: center; gap: 8px; font-size: 0.95rem;">
                <i class="fa-solid fa-sitemap"></i> Kelola Struktur
            </a>
            <a href="{{ route('admin.permohonan.index') }}" style="text-decoration: none; font-weight: 700; color: var(--text-muted); padding: 0.5rem 1rem; border-bottom: 3px solid transparent; display: flex; align-items: center; gap: 8px; font-size: 0.95rem; transition: var(--transition);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
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

        <div class="grid-layout">
            <!-- Sisi Kiri: Form Kelola Struktur (Pilih Member Dulu untuk Diedit) -->
            <div>
                <div class="card" id="form-card">
                    <h3 class="card-title" id="form-title"><i class="fa-solid fa-user-edit"></i> Edit Aparat Desa</h3>
                    
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;" id="form-helper">
                        Silakan klik tombol edit (<i class="fa-solid fa-pen" style="color: #3b82f6;"></i>) pada tabel sebelah kanan untuk memperbarui nama, jabatan, dan foto aparat.
                    </p>

                    <form id="struktur-form" action="" method="POST" enctype="multipart/form-data" style="display: none;">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label for="form-peran">Peran / Kode Sistem</label>
                            <input type="text" id="form-peran" class="form-control" readonly style="background: #e2e8f0; font-weight: 600;">
                        </div>

                        <div class="form-group">
                            <label for="form-nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="form-nama" class="form-control" placeholder="Contoh: Budi Santoso, S.Sos" required>
                        </div>

                        <div class="form-group">
                            <label for="form-jabatan">Nama Jabatan</label>
                            <input type="text" name="jabatan" id="form-jabatan" class="form-control" placeholder="Contoh: Kepala Desa" required>
                        </div>

                        <div class="form-group">
                            <label for="form-foto" id="foto-label">Foto Profil</label>
                            <input type="file" name="foto" id="form-foto" class="form-control" accept="image/*">
                            <small style="color: var(--text-muted); font-size: 0.8rem; margin-top: 3px;">Format: JPG, JPEG, PNG, WEBP (Max 2MB)</small>
                            
                            <div class="preview-box" id="preview-box">
                                <div class="preview-title">Pratinjau Foto:</div>
                                <img src="" id="image-preview" alt="Pratinjau Foto">
                            </div>
                        </div>

                        <button type="submit" class="btn-submit" id="btn-submit">Simpan Perubahan</button>
                        <button type="button" class="btn-cancel" onclick="resetForm()">Batal</button>
                    </form>
                </div>
            </div>

            <!-- Sisi Kanan: Daftar Aparat Desa -->
            <div>
                <div class="card">
                    <h3 class="card-title"><i class="fa-solid fa-users"></i> Daftar Aparatur Desa</h3>
                    
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Jabatan</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($aparatList as $aparat)
                                    <tr>
                                        <td>
                                            @if($aparat->foto)
                                                <img src="{{ asset($aparat->foto) }}" alt="Foto {{ $aparat->nama }}" class="thumbnail-img">
                                            @else
                                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $aparat->peran }}" alt="Default Avatar" class="thumbnail-img">
                                            @endif
                                        </td>
                                        <td>
                                            <div style="font-weight: 700; color: var(--text-main);">{{ $aparat->jabatan }}</div>
                                            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">{{ $aparat->peran }}</span>
                                        </td>
                                        <td>
                                            {{ $aparat->nama }}
                                        </td>
                                        <td>
                                            <button class="btn-action edit" onclick="editAparat({{ json_encode($aparat) }})">
                                                <i class="fa-solid fa-pen"></i> Edit
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center; padding: 3rem;">
                                            Tidak ada data aparat. Silakan jalankan seeder terlebih dahulu.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editAparat(aparat) {
            // Show form, hide helper text
            document.getElementById('struktur-form').style.display = 'block';
            document.getElementById('form-helper').style.display = 'none';

            // Set Form Action
            document.getElementById('struktur-form').action = '/admin/struktur/' + aparat.id;

            // Set values
            document.getElementById('form-peran').value = aparat.peran;
            document.getElementById('form-nama').value = aparat.nama;
            document.getElementById('form-jabatan').value = aparat.jabatan;

            // Preview Photo
            const previewBox = document.getElementById('preview-box');
            const imgPreview = document.getElementById('image-preview');
            if (aparat.foto) {
                imgPreview.src = "{{ asset('') }}" + aparat.foto;
            } else {
                imgPreview.src = "https://api.dicebear.com/7.x/avataaars/svg?seed=" + aparat.peran;
            }
            previewBox.style.display = 'block';

            // Scroll smoothly to form card
            document.getElementById('form-card').scrollIntoView({ behavior: 'smooth' });
        }

        function resetForm() {
            document.getElementById('struktur-form').style.display = 'none';
            document.getElementById('form-helper').style.display = 'block';
            document.getElementById('struktur-form').reset();
        }
    </script>
</body>
</html>
