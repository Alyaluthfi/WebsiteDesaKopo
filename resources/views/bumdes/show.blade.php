<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['name'] }} - Desa Kopo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .detail-hero {
            height: 50vh;
            background: linear-gradient(rgba(2, 44, 34, 0.8), rgba(2, 44, 34, 0.5)), url('{{ asset($data["image"]) }}') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding-top: 80px; /* Offset for navbar */
        }

        .detail-hero h1 {
            font-size: 3rem;
            color: white;
            margin-bottom: 1rem;
        }

        .detail-hero .badge {
            background: var(--accent);
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 1rem;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .content-section {
            padding: 4rem 5%;
            background: var(--bg-body);
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 3rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .main-content {
            background: var(--bg-card);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .main-content h2 {
            font-size: 1.8rem;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(0,0,0,0.05);
        }

        .main-content p {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .sidebar-info {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .info-card {
            background: var(--bg-card);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            border-top: 4px solid var(--primary);
        }

        .info-card h3 {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            color: var(--primary-dark);
        }

        .info-list {
            list-style: none;
        }

        .info-list li {
            display: flex;
            gap: 15px;
            margin-bottom: 1.2rem;
            align-items: flex-start;
        }

        .info-list i {
            color: var(--primary-light);
            font-size: 1.2rem;
            margin-top: 4px;
        }

        .info-list .text h4 {
            font-size: 0.95rem;
            margin-bottom: 0.2rem;
            color: var(--text-main);
        }

        .info-list .text p {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.4;
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

        @media (max-width: 900px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    @include('partials.navbar')

    <section class="detail-hero">
        <div class="hero-content">
            <span class="badge">{{ $data['category'] }}</span>
            <h1>{{ $data['name'] }}</h1>
        </div>
    </section>

    <section class="content-section">
        <div class="content-grid">
            <div class="main-content">
                <a href="{{ route('home') }}#bumdes" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda</a>
                
                <h2>Tentang BUMDes</h2>
                <p>{{ $data['detail'] }}</p>
                
                <img src="{{ asset($data['image']) }}" alt="{{ $data['name'] }}" style="width: 100%; border-radius: 15px; margin-top: 2rem; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
            </div>

            <div class="sidebar-info">
                <div class="info-card">
                    <h3>Informasi Operasional</h3>
                    <ul class="info-list">
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <div class="text">
                                <h4>Alamat Lokasi</h4>
                                <p>{{ $data['address'] }}</p>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-clock"></i>
                            <div class="text">
                                <h4>Jam Operasional</h4>
                                <p>{{ $data['jam_buka'] }}</p>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-phone"></i>
                            <div class="text">
                                <h4>Kontak Pengelola</h4>
                                <p>{{ $data['kontak'] }}</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="info-card" style="border-top: 4px solid var(--accent);">
                    <h3>Form Pemesanan / Pembelian</h3>
                    
                    @if(session('success'))
                        <div style="background: #d1fae5; color: #065f46; padding: 12px; border-radius: 10px; font-size: 0.85rem; margin-bottom: 1.25rem; font-weight: 600; border: 1px solid #10b981;">
                            <i class="fa-solid fa-circle-check" style="margin-right: 5px;"></i> {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div style="background: #fee2e2; color: #dc2626; padding: 12px; border-radius: 10px; font-size: 0.85rem; margin-bottom: 1.25rem; font-weight: 600; border: 1px solid #fca5a5;">
                            <i class="fa-solid fa-circle-xmark" style="margin-right: 5px;"></i> {{ session('error') }}
                        </div>
                    @endif

                    @auth
                        <form action="{{ route('bumdes.buy', $slug) }}" method="POST" style="display: flex; flex-direction: column; gap: 12px;">
                            @csrf
                            <div style="display: flex; flex-direction: column; gap: 4px;">
                                <label style="font-size: 0.8rem; font-weight: 700; color: var(--text-main); text-transform: uppercase; letter-spacing: 0.5px;">Nama Pembeli</label>
                                <input type="text" name="nama_pembeli" value="{{ Auth::user()->name }}" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.9rem; font-family: inherit; background-color: #f8fafc;" required readonly>
                            </div>
                            
                            <div style="display: flex; flex-direction: column; gap: 4px;">
                                <label style="font-size: 0.8rem; font-weight: 700; color: var(--text-main); text-transform: uppercase; letter-spacing: 0.5px;">Email</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.9rem; font-family: inherit; background-color: #f8fafc;" required readonly>
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 4px;">
                                <label style="font-size: 0.8rem; font-weight: 700; color: var(--text-main); text-transform: uppercase; letter-spacing: 0.5px;">No HP / WhatsApp</label>
                                <input type="text" name="no_hp" placeholder="Contoh: 08123456789" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.9rem; font-family: inherit;" required>
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 4px;">
                                <label style="font-size: 0.8rem; font-weight: 700; color: var(--text-main); text-transform: uppercase; letter-spacing: 0.5px;">Kebutuhan Yang Akan Dibeli</label>
                                @if(!empty($data['produk']))
                                    <select name="kebutuhan_produk" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.9rem; font-family: inherit; margin-bottom: 8px;" required>
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach($data['produk'] as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    <textarea name="catatan_kebutuhan" placeholder="Catatan tambahan (contoh: Jumlah Kg / Ukuran / detail pesanan)..." rows="2" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.9rem; font-family: inherit; resize: vertical;"></textarea>
                                @else
                                    <textarea name="kebutuhan" placeholder="Tuliskan kebutuhan barang atau jasa yang ingin dibeli..." rows="3" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.9rem; font-family: inherit; resize: vertical;" required></textarea>
                                @endif
                            </div>

                            <button type="submit" style="background: var(--primary); color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 700; font-size: 0.9rem; cursor: pointer; transition: background 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 0.5rem;" onmouseover="this.style.background='var(--primary-light)'" onmouseout="this.style.background='var(--primary)'">
                                <i class="fa-solid fa-cart-shopping"></i> Kirim Pengajuan Pembelian
                            </button>
                        </form>
                    @else
                        <div style="text-align: center; padding: 1.5rem 1rem; border: 2px dashed #cbd5e1; border-radius: 12px; background: #f8fafc;">
                            <i class="fa-solid fa-lock" style="font-size: 2rem; color: #94a3b8; margin-bottom: 0.75rem; display: block;"></i>
                            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.25rem; line-height: 1.5;">
                                Anda harus login terlebih dahulu untuk melakukan transaksi pembelian BUMDes.
                            </p>
                            <a href="{{ route('login') }}" style="display: block; background: var(--primary); color: white; padding: 10px; border-radius: 8px; font-size: 0.85rem; font-weight: 700; text-decoration: none; transition: background 0.2s; text-align: center;" onmouseover="this.style.background='var(--primary-light)'" onmouseout="this.style.background='var(--primary)'">
                                Login Sekarang
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
