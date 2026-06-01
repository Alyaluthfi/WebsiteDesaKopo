<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transparansi Keuangan - Desa Kopo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .page-header {
            height: 35vh;
            background: linear-gradient(rgba(2, 44, 34, 0.8), rgba(2, 44, 34, 0.6)), url('{{ asset("images/hero_kopo_1776842603076.png") }}') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding-top: 80px;
        }

        .page-header h1 {
            font-size: 2.8rem;
            color: white;
            margin-bottom: 0.5rem;
        }

        .page-header p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 600px;
            margin: 0 auto;
        }

        .main-container {
            padding: 4rem 5%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 1.5rem;
            margin-top: -6rem;
            margin-bottom: 3rem;
            position: relative;
            z-index: 10;
        }

        .stat-box {
            background: var(--bg-card);
            padding: 2rem 1.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-top: 5px solid var(--primary);
            transition: var(--transition);
        }

        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .stat-box.expense {
            border-top-color: #ef4444;
        }

        .stat-box.balance {
            border-top-color: var(--accent);
        }

        .stat-box.budget {
            border-top-color: #3b82f6;
        }

        .stat-box h3 {
            font-size: 0.95rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-box .amount {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .filter-card {
            background: var(--bg-card);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            align-items: flex-end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            flex: 1;
            min-width: 200px;
        }

        .form-group label {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-main);
        }

        .form-control {
            padding: 10px 15px;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            font-family: inherit;
            font-size: 0.95rem;
            background: white;
            outline: none;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(6, 95, 70, 0.1);
        }

        .btn-filter {
            background: var(--primary);
            color: white;
            padding: 10px 25px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: var(--transition);
        }

        .btn-filter:hover {
            background: var(--primary-light);
        }

        .btn-reset {
            background: #e2e8f0;
            color: var(--text-muted);
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            transition: var(--transition);
        }

        .btn-reset:hover {
            background: #cbd5e1;
        }

        .table-responsive {
            background: var(--bg-card);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.05);
            margin-bottom: 3rem;
        }

        .finance-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .finance-table th {
            background: #f8fafc;
            padding: 1.25rem 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            border-bottom: 2px solid #e2e8f0;
            font-size: 0.95rem;
        }

        .finance-table td {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .finance-table tr:last-child td {
            border-bottom: none;
        }

        .badge-type {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-type.pemasukan {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-type.pengeluaran {
            background: #fee2e2;
            color: #991b1b;
        }

        .amount-text {
            font-weight: 700;
            font-size: 1rem;
        }

        .amount-text.pemasukan {
            color: #059669;
        }

        .amount-text.pengeluaran {
            color: #dc2626;
        }

        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            margin-bottom: 2rem;
            position: relative;
            z-index: 20;
        }

        .back-home:hover {
            color: var(--primary-light);
            transform: translateX(-5px);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .admin-link {
            text-align: center;
            margin-top: 4rem;
            border-top: 1px solid #e2e8f0;
            padding-top: 2rem;
        }

        .admin-link a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .admin-link a:hover {
            color: var(--primary);
        }
    </style>
</head>

<body>

    @include('partials.navbar')

    <header class="page-header">
        <div class="header-content">
            <h1>Transparansi Keuangan Desa</h1>
            <p>Laporan pemasukan, pengeluaran, dan realisasi anggaran Desa Kopo secara transparan.</p>
        </div>
    </header>

    <main class="main-container">
        <a href="{{ route('home') }}" class="back-home"><i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda</a>

        <!-- Stats Cards Dashboard -->
        <section class="stats-grid">
            <div class="stat-box budget">
                <h3>Target APBDes {{ $budget->tahun ?? '2026' }}</h3>
                <div class="amount">Rp {{ number_format($budget->total_anggaran ?? 0, 0, ',', '.') }}</div>
            </div>
            <div class="stat-box">
                <h3>Total Pemasukan</h3>
                <div class="amount text-emerald">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
            </div>
            <div class="stat-box expense">
                <h3>Total Pengeluaran</h3>
                <div class="amount text-red">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            </div>
            <div class="stat-box balance">
                <h3>Sisa Saldo Kas Desa</h3>
                <div class="amount text-amber">Rp {{ number_format($sisaSaldo, 0, ',', '.') }}</div>
            </div>
        </section>

        <h2 style="color: var(--primary-dark); font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700;">Daftar
            Transaksi Keuangan</h2>

        <!-- Filter Card -->
        <div class="filter-card">
            <form action="{{ route('keuangan.index') }}" method="GET" class="filter-form">
                <div class="form-group">
                    <label for="type">Jenis Transaksi</label>
                    <select name="type" id="type" class="form-control">
                        <option value="">Semua Transaksi</option>
                        <option value="pemasukan" {{ request('type') == 'pemasukan' ? 'selected' : '' }}>Pemasukan
                        </option>
                        <option value="pengeluaran" {{ request('type') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bumdes_id">Sumber BUMDes</label>
                    <select name="bumdes_id" id="bumdes_id" class="form-control">
                        <option value="">Semua Sumber</option>
                        @foreach($bumdesList as $bumdes)
                            <option value="{{ $bumdes->id }}" {{ request('bumdes_id') == $bumdes->id ? 'selected' : '' }}>
                                {{ $bumdes->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="display: flex; gap: 0.5rem; align-items: flex-end;">
                    <button type="submit" class="btn-filter">Filter</button>
                    <a href="{{ route('keuangan.index') }}" class="btn-reset">Reset</a>
                </div>
            </form>
        </div>

        <!-- Transactions Table -->
        <div class="table-responsive">
            @if(count($transactions) > 0)
                <table class="finance-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Sumber / Uraian</th>
                            <th>Unit BUMDes Terkait</th>
                            <th style="text-align: right;">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $tx)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($tx->transaction_date)->translatedFormat('d M Y') }}</td>
                                <td>
                                    <span class="badge-type {{ $tx->type }}">
                                        {{ $tx->type }}
                                    </span>
                                </td>
                                <td style="font-weight: 600; color: var(--text-main);">
                                    {{ $tx->source }}
                                    @if($tx->description)
                                        <div
                                            style="font-size: 0.8rem; font-weight: normal; color: var(--text-muted); margin-top: 4px;">
                                            {{ $tx->description }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($tx->bumdes)
                                        <span style="color: var(--primary); font-weight: 500;">
                                            <i class="fa-solid fa-store"
                                                style="font-size: 0.85rem; margin-right: 5px;"></i>{{ $tx->bumdes->name }}
                                        </span>
                                    @else
                                        <span class="text-muted" style="font-size: 0.9rem;">—</span>
                                    @endif
                                </td>
                                <td style="text-align: right;" class="amount-text {{ $tx->type }}">
                                    {{ $tx->type == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($tx->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="fa-solid fa-receipt"></i>
                    <h3>Belum Ada Data Transaksi</h3>
                    <p>Tidak ditemukan data transaksi keuangan yang cocok dengan filter Anda.</p>
                </div>
            @endif
        </div>

    </main>

    @include('partials.footer')

    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>