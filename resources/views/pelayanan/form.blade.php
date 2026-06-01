<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if($jenis === 'domisili') Pembuatan Surat Keterangan Domisili
        @elseif($jenis === 'sku') Pembuatan Surat Keterangan Usaha (SKU)
        @elseif($jenis === 'sktm') Pembuatan Surat Keterangan Tidak Mampu (SKTM)
        @elseif($jenis === 'pindah') Pembuatan Surat Keterangan Pindah
        @endif - Desa Kopo
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .form-hero {
            height: 35vh;
            background: linear-gradient(rgba(2, 44, 34, 0.85), rgba(2, 44, 34, 0.6)), url('https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=1200&auto=format&fit=crop') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding-top: 80px;
        }

        .form-hero h1 {
            font-size: 2.2rem;
            color: white;
            margin-bottom: 0.5rem;
            font-weight: 800;
        }

        .form-hero p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
        }

        .content-section {
            padding: 4rem 5%;
            background: #f8fafc;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 3rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        @media (max-width: 900px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-card {
            background: white;
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            margin-bottom: 2rem;
            transition: var(--transition);
        }

        .back-btn:hover {
            color: var(--primary-light);
            transform: translateX(-5px);
        }

        .form-title {
            font-size: 1.6rem;
            color: var(--primary-dark);
            margin-bottom: 2rem;
            font-weight: 800;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-main);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            font-family: inherit;
            font-size: 1rem;
            outline: none;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(6, 95, 70, 0.1);
        }

        select.form-control {
            background-color: white;
            cursor: pointer;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            padding: 14px 28px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            margin-top: 1rem;
            box-shadow: 0 4px 12px rgba(6, 95, 70, 0.15);
        }

        .btn-submit:hover {
            background: var(--primary-light);
            box-shadow: 0 6px 16px rgba(6, 95, 70, 0.25);
            transform: translateY(-2px);
        }

        .sidebar-card {
            background: white;
            padding: 2.5rem 2rem;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border-top: 4px solid var(--accent);
            height: fit-content;
        }

        .sidebar-card h3 {
            font-size: 1.25rem;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .requirements-list {
            list-style: none;
            padding: 0;
        }

        .requirements-list li {
            display: flex;
            gap: 12px;
            margin-bottom: 1rem;
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .requirements-list i {
            color: var(--primary-light);
            font-size: 1.1rem;
            margin-top: 3px;
        }

        .error-feedback {
            color: #ef4444;
            font-size: 0.85rem;
            font-weight: 500;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>

    @include('partials.navbar')

    <section class="form-hero">
        <div class="hero-content">
            <h1>
                @if($jenis === 'domisili') Surat Keterangan Domisili
                @elseif($jenis === 'sku') Surat Keterangan Usaha (SKU)
                @elseif($jenis === 'sktm') Surat Keterangan Tidak Mampu (SKTM)
                @elseif($jenis === 'pindah') Surat Keterangan Pindah
                @endif
            </h1>
            <p>Formulir Pengajuan Layanan Administrasi Mandiri Desa Kopo</p>
        </div>
    </section>

    <section class="content-section">
        <div class="content-grid">
            <div class="form-card">
                <a href="{{ route('home') }}#pelayanan" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda</a>
                
                <h2 class="form-title">Lengkapi Data Pengajuan</h2>

                <form action="{{ route('pelayanan.submit', ['jenis' => $jenis]) }}" method="POST">
                    @csrf

                    <!-- NIK & Nama (Semua Surat Butuh Ini) -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" name="nik" id="nik" class="form-control" placeholder="16 digit NIK Anda" required maxlength="16" minlength="16" value="{{ old('nik') }}">
                            @error('nik') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama sesuai KTP" required value="{{ old('nama', Auth::user()->name) }}">
                            @error('nama') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- FORM SPESIFIK: DOMISILI -->
                    @if($jenis === 'domisili')
                        <div class="form-row">
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Contoh: Serang" required value="{{ old('tempat_lahir') }}">
                                @error('tempat_lahir') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <input type="text" name="agama" id="agama" class="form-control" placeholder="Contoh: Islam" required value="{{ old('agama') }}">
                                @error('agama') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Contoh: Karyawan Swasta" required value="{{ old('pekerjaan') }}">
                            @error('pekerjaan') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" class="form-control" placeholder="Kampung, RT/RW, Desa Kopo..." required>{{ old('alamat') }}</textarea>
                            @error('alamat') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="keperluan">Keperluan Pembuatan Surat</label>
                            <input type="text" name="keperluan" id="keperluan" class="form-control" placeholder="Contoh: Syarat melamar pekerjaan / pembukaan rekening bank" required value="{{ old('keperluan') }}">
                            @error('keperluan') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <!-- FORM SPESIFIK: SKU -->
                    @if($jenis === 'sku')
                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap Pemohon</label>
                            <textarea name="alamat" id="alamat" class="form-control" placeholder="Kampung, RT/RW, Desa Kopo..." required>{{ old('alamat') }}</textarea>
                            @error('alamat') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nama_usaha">Nama Usaha / Toko</label>
                                <input type="text" name="nama_usaha" id="nama_usaha" class="form-control" placeholder="Contoh: Warung Sembako Barokah" required value="{{ old('nama_usaha') }}">
                                @error('nama_usaha') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="jenis_usaha">Jenis Barang/Jasa Usaha</label>
                                <input type="text" name="jenis_usaha" id="jenis_usaha" class="form-control" placeholder="Contoh: Dagang Kelontong / Bengkel Motor" required value="{{ old('jenis_usaha') }}">
                                @error('jenis_usaha') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="sektor_usaha">Sektor Usaha</label>
                                <input type="text" name="sektor_usaha" id="sektor_usaha" class="form-control" placeholder="Contoh: Perdagangan / Jasa / Pertanian" required value="{{ old('sektor_usaha') }}">
                                @error('sektor_usaha') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="lama_usaha">Lama Usaha Berdiri</label>
                                <input type="text" name="lama_usaha" id="lama_usaha" class="form-control" placeholder="Contoh: 2 Tahun" required value="{{ old('lama_usaha') }}">
                                @error('lama_usaha') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat_usaha">Alamat Lokasi Usaha</label>
                            <textarea name="alamat_usaha" id="alamat_usaha" class="form-control" placeholder="Masukkan alamat lengkap tempat usaha dijalankan..." required>{{ old('alamat_usaha') }}</textarea>
                            @error('alamat_usaha') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <!-- FORM SPESIFIK: SKTM -->
                    @if($jenis === 'sktm')
                        <div class="form-row">
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Contoh: Serang" required value="{{ old('tempat_lahir') }}">
                                @error('tempat_lahir') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan Pemohon</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Contoh: Buruh Harian Lepas / Mahasiswa" required value="{{ old('pekerjaan') }}">
                            @error('pekerjaan') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap Pemohon</label>
                            <textarea name="alamat" id="alamat" class="form-control" placeholder="Kampung, RT/RW, Desa Kopo..." required>{{ old('alamat') }}</textarea>
                            @error('alamat') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nama_ortu">Nama Orang Tua / Wali</label>
                                <input type="text" name="nama_ortu" id="nama_ortu" class="form-control" placeholder="Nama ayah/ibu/wali" required value="{{ old('nama_ortu') }}">
                                @error('nama_ortu') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan_ortu">Pekerjaan Orang Tua / Wali</label>
                                <input type="text" name="pekerjaan_ortu" id="pekerjaan_ortu" class="form-control" placeholder="Pekerjaan ayah/ibu/wali" required value="{{ old('pekerjaan_ortu') }}">
                                @error('pekerjaan_ortu') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="keperluan">Keperluan Pembuatan SKTM</label>
                            <input type="text" name="keperluan" id="keperluan" class="form-control" placeholder="Contoh: Keringanan Biaya Sekolah Anak / Pengajuan KIP / Keringanan RS" required value="{{ old('keperluan') }}">
                            @error('keperluan') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <!-- FORM SPESIFIK: PINDAH -->
                    @if($jenis === 'pindah')
                        <div class="form-group">
                            <label for="alamat_asal">Alamat Lengkap Asal (Sesuai KTP)</label>
                            <textarea name="alamat_asal" id="alamat_asal" class="form-control" placeholder="Masukkan alamat asal lengkap..." required>{{ old('alamat_asal') }}</textarea>
                            @error('alamat_asal') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat_tujuan">Alamat Lengkap Tujuan Pindah</label>
                            <textarea name="alamat_tujuan" id="alamat_tujuan" class="form-control" placeholder="Kampung/Jalan, Kelurahan/Desa, Kecamatan, Kabupaten/Kota, Provinsi..." required>{{ old('alamat_tujuan') }}</textarea>
                            @error('alamat_tujuan') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="alasan_pindah">Alasan Kepindahan</label>
                                <input type="text" name="alasan_pindah" id="alasan_pindah" class="form-control" placeholder="Contoh: Ikut Suami / Pekerjaan / Domisili Baru" required value="{{ old('alasan_pindah') }}">
                                @error('alasan_pindah') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="jumlah_pengikut">Jumlah Pengikut Pindah (Orang)</label>
                                <input type="number" name="jumlah_pengikut" id="jumlah_pengikut" class="form-control" placeholder="0 jika tidak ada pengikut" required min="0" value="{{ old('jumlah_pengikut', 0) }}">
                                @error('jumlah_pengikut') <span class="error-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="btn-submit">Kirim Permohonan Surat</button>
                </form>
            </div>

            <!-- Sidebar Info Persyaratan -->
            <div class="sidebar-card">
                <h3><i class="fa-solid fa-circle-info"></i> Syarat & Ketentuan</h3>
                
                <ul class="requirements-list">
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Melampirkan Kartu Keluarga (KK) dan KTP saat diverifikasi aparat.</span>
                    </li>
                    @if($jenis === 'domisili')
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Membawa surat pengantar dari RT/RW setempat.</span>
                        </li>
                    @elseif($jenis === 'sku')
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Foto/bukti fisik lokasi usaha (warung, toko, dsb).</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Surat pengantar RT/RW terkait keberadaan usaha.</span>
                        </li>
                    @elseif($jenis === 'sktm')
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Membawa surat pengantar tidak mampu dari RT/RW.</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Fotokopi Kartu Indonesia Pintar (KIP) atau bukti pendukung jika ada.</span>
                        </li>
                    @elseif($jenis === 'pindah')
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Membawa surat pengantar pindah dari RT/RW setempat.</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>KTP dan KK asli harus diserahkan ke kantor desa untuk proses pencabutan data kependudukan.</span>
                        </li>
                    @endif
                    <li>
                        <i class="fa-solid fa-clock"></i>
                        <span>Waktu pengerjaan surat rata-rata 1-2 hari kerja sejak permohonan diverifikasi.</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>Pastikan data yang Anda masukkan sudah benar dan sesuai KTP.</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
