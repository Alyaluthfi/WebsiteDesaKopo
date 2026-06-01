<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin Berita Acara - Desa Kopo</title>
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

        .alert-danger {
            background: #fee2fee2;
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

        .btn-action.edit {
            background: #3b82f6;
            color: white;
        }

        .btn-action.edit:hover {
            background: #2563eb;
        }

        .btn-action.delete {
            background: #ef4444;
            color: white;
        }

        .btn-action.delete:hover {
            background: #dc2626;
        }

        .thumbnail-img {
            width: 80px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .preview-box {
            display: none;
            margin-top: 0.5rem;
            padding: 8px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #f8fafc;
        }

        .preview-box img {
            max-width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 6px;
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
            <a href="{{ route('admin.berita.index') }}" style="text-decoration: none; font-weight: 700; color: var(--primary); padding: 0.5rem 1rem; border-bottom: 3px solid var(--primary); display: flex; align-items: center; gap: 8px; font-size: 0.95rem;">
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
                    <strong style="display: block; margin-bottom: 5px;"><i class="fa-solid fa-triangle-exclamation"></i> Gagal menyimpan data:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="grid-layout">
            <!-- Sisi Kiri: Form Kelola Berita Acara (Tambah/Edit) -->
            <div>
                <div class="card" id="form-card">
                    <h3 class="card-title" id="form-title"><i class="fa-solid fa-plus-circle"></i> Tambah Berita Acara</h3>
                    
                    <form id="berita-form" action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" id="form-method" value="POST">

                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" id="form-nama_kegiatan" class="form-control" placeholder="Contoh: Rapat Musyawarah RKPDes 2026" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
                            <input type="date" name="tanggal_pelaksanaan" id="form-tanggal_pelaksanaan" class="form-control" required value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="form-group">
                            <label for="foto_kegiatan" id="foto-label">Foto Kegiatan</label>
                            <input type="file" name="foto_kegiatan" id="form-foto_kegiatan" class="form-control" accept="image/*" required>
                            <small style="color: var(--text-muted); font-size: 0.8rem; margin-top: 3px;">Format: JPG, JPEG, PNG, WEBP (Max 2MB)</small>
                            
                            <!-- Preview Box for existing / selected image -->
                            <div class="preview-box" id="preview-box">
                                <div class="preview-title">Foto Terkini:</div>
                                <img src="" id="image-preview" alt="Pratinjau Foto">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
                            <textarea name="deskripsi_kegiatan" id="form-deskripsi_kegiatan" class="form-control" rows="8" placeholder="Tulis rincian jalannya kegiatan secara lengkap..." required></textarea>
                        </div>

                        <button type="submit" class="btn-submit" id="btn-submit">Simpan Berita Acara</button>
                        <a href="javascript:void(0)" class="btn-cancel" id="btn-cancel" style="display: none;" onclick="resetForm()">Batal Edit</a>
                    </form>
                </div>
            </div>

            <!-- Sisi Rangan: Tabel Daftar Berita Acara -->
            <div>
                <div class="card">
                    <h3 class="card-title"><i class="fa-solid fa-list"></i> Riwayat Berita Acara</h3>
                    
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Tanggal</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Deskripsi Singkat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($beritaAcaraList as $berita)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($berita->foto_kegiatan) }}" alt="Foto" class="thumbnail-img">
                                        </td>
                                        <td style="white-space: nowrap;">
                                            {{ \Carbon\Carbon::parse($berita->tanggal_pelaksanaan)->format('d/m/Y') }}
                                        </td>
                                        <td>
                                            <div style="font-weight: 700; color: var(--text-main);">{{ $berita->nama_kegiatan }}</div>
                                        </td>
                                        <td>
                                            {{ Str::limit($berita->deskripsi_kegiatan, 80) }}
                                        </td>
                                        <td>
                                            <div class="actions-cell">
                                                <button class="btn-action edit" onclick="editBerita({{ json_encode($berita) }})"><i class="fa-solid fa-pen"></i></button>
                                                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita acara ini? Semua data dan foto kegiatan akan dihapus permanen.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action delete"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 4rem;">
                                            <i class="fa-solid fa-newspaper" style="font-size: 2.5rem; color: #cbd5e1; display: block; margin-bottom: 0.5rem;"></i>
                                            Belum ada berita acara yang diunggah.
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
        function editBerita(berita) {
            // Change form card header and action button
            document.getElementById('form-title').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Edit Berita Acara #' + berita.id;
            document.getElementById('berita-form').action = '/admin/berita/' + berita.id;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('btn-submit').innerText = 'Perbarui Berita Acara';
            document.getElementById('btn-cancel').style.display = 'inline-block';

            // Populate text/date inputs
            document.getElementById('form-nama_kegiatan').value = berita.nama_kegiatan;
            document.getElementById('form-tanggal_pelaksanaan').value = berita.tanggal_pelaksanaan.substring(0, 10);
            document.getElementById('form-deskripsi_kegiatan').value = berita.deskripsi_kegiatan;

            // Foto is now optional on edit
            document.getElementById('form-foto_kegiatan').required = false;
            document.getElementById('foto-label').innerText = 'Ganti Foto Kegiatan (Opsional)';

            // Setup preview box
            const previewBox = document.getElementById('preview-box');
            const imgPreview = document.getElementById('image-preview');
            imgPreview.src = "{{ asset('') }}" + berita.foto_kegiatan;
            previewBox.style.display = 'block';
            
            // Scroll to form smoothly
            document.getElementById('form-card').scrollIntoView({ behavior: 'smooth' });
        }

        function resetForm() {
            document.getElementById('form-title').innerHTML = '<i class="fa-solid fa-plus-circle"></i> Tambah Berita Acara';
            document.getElementById('berita-form').action = '{{ route("admin.berita.store") }}';
            document.getElementById('form-method').value = 'POST';
            document.getElementById('btn-submit').innerText = 'Simpan Berita Acara';
            document.getElementById('btn-cancel').style.display = 'none';

            // Reset fields
            document.getElementById('berita-form').reset();
            document.getElementById('form-tanggal_pelaksanaan').value = '{{ date("Y-m-d") }}';
            
            // Re-require photo
            document.getElementById('form-foto_kegiatan').required = true;
            document.getElementById('foto-label').innerText = 'Foto Kegiatan';

            // Hide preview box
            document.getElementById('preview-box').style.display = 'none';
            document.getElementById('image-preview').src = '';
        }
    </script>
</body>
</html>
