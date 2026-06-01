<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin Keuangan - Desa Kopo</title>
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

        .badge-type {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
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

        .stats-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            border-left: 4px solid var(--primary);
            position: relative;
        }

        .stat-card.expense { border-left-color: #ef4444; }
        .stat-card.balance { border-left-color: var(--accent); }
        .stat-card.budget { border-left-color: #3b82f6; }

        .stat-card h4 {
            font-size: 0.85rem;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
            letter-spacing: 0.5px;
        }

        .stat-card .amount {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .edit-budget-btn {
            background: transparent;
            border: none;
            color: #3b82f6;
            font-weight: 600;
            font-size: 0.8rem;
            cursor: pointer;
            padding: 0;
            margin-top: 5px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: var(--transition);
        }

        .edit-budget-btn:hover {
            color: #2563eb;
            text-decoration: underline;
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
            <a href="{{ route('admin.finance.index') }}" style="text-decoration: none; font-weight: 700; color: var(--primary); padding: 0.5rem 1rem; border-bottom: 3px solid var(--primary); display: flex; align-items: center; gap: 8px; font-size: 0.95rem;">
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

        <!-- Card Baris Statistik -->
        <div class="stats-summary">
            <div class="stat-card budget">
                <h4>APBDes Target ({{ $budget->tahun ?? '2026' }})</h4>
                <div class="amount">Rp {{ number_format($budget->total_anggaran ?? 0, 0, ',', '.') }}</div>
                <button onclick="openBudgetModal()" class="edit-budget-btn"><i class="fa-solid fa-pen"></i> Edit Target</button>
            </div>
            <div class="stat-card">
                <h4>Total Pemasukan</h4>
                <div class="amount" style="color: #059669;">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
            </div>
            <div class="stat-card expense">
                <h4>Total Pengeluaran</h4>
                <div class="amount" style="color: #dc2626;">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            </div>
            <div class="stat-card balance">
                <h4>Sisa Saldo Kas</h4>
                <div class="amount" style="color: var(--accent);">Rp {{ number_format($sisaSaldo, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="grid-layout">
            <!-- Sisi Kiri: Form Kelola Transaksi (Tambah/Edit) -->
            <div>
                <div class="card" id="form-card">
                    <h3 class="card-title" id="form-title"><i class="fa-solid fa-plus-circle"></i> Tambah Transaksi Baru</h3>
                    
                    <form id="transaction-form" action="{{ route('admin.finance.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" id="form-method" value="POST">

                        <div class="form-group">
                            <label for="type">Jenis Transaksi</label>
                            <select name="type" id="form-type" class="form-control" required onchange="toggleBumdesField()">
                                <option value="pemasukan">Pemasukan</option>
                                <option value="pengeluaran">Pengeluaran</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="source">Uraian / Sumber Dana</label>
                            <input type="text" name="source" id="form-source" class="form-control" placeholder="Contoh: Iuran Kas Bulanan / Hasil Penjualan BUMDes Mart" required>
                        </div>

                        <div class="form-group" id="bumdes-group">
                            <label for="bumdes_id">Unit BUMDes Terkait (Opsional)</label>
                            <select name="bumdes_id" id="form-bumdes_id" class="form-control">
                                <option value="">— Tidak Ada Hubungan BUMDes —</option>
                                @foreach($bumdesList as $bumdes)
                                    <option value="{{ $bumdes->id }}">{{ $bumdes->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount">Jumlah Uang (Rupiah)</label>
                            <input type="number" name="amount" id="form-amount" class="form-control" placeholder="Contoh: 5000000" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="transaction_date">Tanggal Transaksi</label>
                            <input type="date" name="transaction_date" id="form-transaction_date" class="form-control" required value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Keterangan / Deskripsi Lengkap (Opsional)</label>
                            <textarea name="description" id="form-description" class="form-control" rows="3" placeholder="Tambahkan keterangan opsional di sini..."></textarea>
                        </div>

                        <button type="submit" class="btn-submit" id="btn-submit">Simpan Transaksi</button>
                        <a href="javascript:void(0)" class="btn-cancel" id="btn-cancel" style="display: none;" onclick="resetForm()">Batal Edit</a>
                    </form>
                </div>
            </div>

            <!-- Sisi Kanan: Tabel Riwayat Transaksi -->
            <div>
                <div class="card">
                    <h3 class="card-title"><i class="fa-solid fa-list"></i> Riwayat Transaksi Keuangan</h3>
                    
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Uraian</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $tx)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($tx->transaction_date)->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge-type {{ $tx->type }}">{{ $tx->type }}</span>
                                        </td>
                                        <td>
                                            <div style="font-weight: 700; color: var(--text-main);">{{ $tx->source }}</div>
                                            @if($tx->bumdes)
                                                <div style="font-size: 0.8rem; color: var(--primary); margin-top: 2px;">
                                                    <i class="fa-solid fa-store" style="font-size: 0.75rem;"></i> {{ $tx->bumdes->name }}
                                                </div>
                                            @endif
                                        </td>
                                        <td style="font-weight: 700; color: {{ $tx->type == 'pemasukan' ? '#059669' : '#dc2626' }};">
                                            Rp {{ number_format($tx->amount, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <div class="actions-cell">
                                                <button class="btn-action edit" onclick="editTransaction({{ json_encode($tx) }})"><i class="fa-solid fa-pen"></i></button>
                                                <form action="{{ route('admin.finance.destroy', $tx->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action delete"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 3rem;">
                                            <i class="fa-solid fa-receipt" style="font-size: 2.5rem; color: #cbd5e1; display: block; margin-bottom: 0.5rem;"></i>
                                            Belum ada transaksi.
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

    <!-- Modal Target APBDes Target Anggaran -->
    <div id="budget-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div class="card" style="width: 100%; max-width: 400px; margin: 20px;">
            <h3 class="card-title"><i class="fa-solid fa-bullseye"></i> Edit Target APBDes</h3>
            <form action="{{ route('admin.budget.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tahun">Tahun Anggaran</label>
                    <input type="number" name="tahun" id="budget-tahun" class="form-control" value="{{ $budget->tahun ?? '2026' }}" required>
                </div>
                <div class="form-group">
                    <label for="total_anggaran">Total Anggaran (Rupiah)</label>
                    <input type="number" name="total_anggaran" id="budget-amount" class="form-control" value="{{ $budget->total_anggaran ?? '0' }}" required>
                </div>
                <div style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    <button type="submit" class="btn-submit" style="flex: 1;">Perbarui Target</button>
                    <button type="button" class="btn-cancel" style="margin-top: 0; flex: 1;" onclick="closeBudgetModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleBumdesField() {
            const type = document.getElementById('form-type').value;
            const bumdesGroup = document.getElementById('bumdes-group');
            // Unit BUMDes are usually for both income (shares) and expenses (investments), so keep it optional but visible.
        }

        function editTransaction(tx) {
            // Change form card header and buttons
            document.getElementById('form-title').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Edit Transaksi #' + tx.id;
            document.getElementById('transaction-form').action = '/admin/keuangan/' + tx.id;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('btn-submit').innerText = 'Perbarui Transaksi';
            document.getElementById('btn-cancel').style.display = 'inline-block';

            // Populate form fields
            document.getElementById('form-type').value = tx.type;
            document.getElementById('form-source').value = tx.source;
            document.getElementById('form-bumdes_id').value = tx.bumdes_id ? tx.bumdes_id : '';
            document.getElementById('form-amount').value = tx.amount;
            document.getElementById('form-transaction_date').value = tx.transaction_date;
            document.getElementById('form-description').value = tx.description ? tx.description : '';
            
            // Scroll to form smoothly
            document.getElementById('form-card').scrollIntoView({ behavior: 'smooth' });
        }

        function resetForm() {
            document.getElementById('form-title').innerHTML = '<i class="fa-solid fa-plus-circle"></i> Tambah Transaksi Baru';
            document.getElementById('transaction-form').action = '{{ route("admin.finance.store") }}';
            document.getElementById('form-method').value = 'POST';
            document.getElementById('btn-submit').innerText = 'Simpan Transaksi';
            document.getElementById('btn-cancel').style.display = 'none';

            // Reset fields
            document.getElementById('transaction-form').reset();
            document.getElementById('form-transaction_date').value = '{{ date("Y-m-d") }}';
        }

        function openBudgetModal() {
            document.getElementById('budget-modal').style.display = 'flex';
        }

        function closeBudgetModal() {
            document.getElementById('budget-modal').style.display = 'none';
        }
    </script>
</body>
</html>
