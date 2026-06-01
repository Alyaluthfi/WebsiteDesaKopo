<?php

namespace App\Http\Controllers;

use App\Models\Bumdes;
use App\Models\Finance;
use App\Models\FinancialTransaction;
use Illuminate\Http\Request;

class AdminFinanceController extends Controller
{
    public function index(Request $request)
    {
        $transactions = FinancialTransaction::with('bumdes')
            ->orderBy('transaction_date', 'desc')
            ->get();

        $totalPemasukan = FinancialTransaction::where('type', 'pemasukan')->sum('amount');
        $totalPengeluaran = FinancialTransaction::where('type', 'pengeluaran')->sum('amount');
        $sisaSaldo = $totalPemasukan - $totalPengeluaran;

        $budget = Finance::where('tahun', 2026)->first() ?? Finance::latest('tahun')->first();
        $bumdesList = Bumdes::all();

        return view('admin.keuangan', compact(
            'transactions',
            'totalPemasukan',
            'totalPengeluaran',
            'sisaSaldo',
            'budget',
            'bumdesList'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'source' => 'required|string|max:255',
            'bumdes_id' => 'nullable|exists:bumdes,id',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        FinancialTransaction::create($validated);

        // Update total realisasi in finances table if relevant
        $this->updateRealisasiBudget();

        return redirect()->route('admin.finance.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $transaction = FinancialTransaction::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'source' => 'required|string|max:255',
            'bumdes_id' => 'nullable|exists:bumdes,id',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $transaction->update($validated);

        // Update total realisasi in finances table if relevant
        $this->updateRealisasiBudget();

        return redirect()->route('admin.finance.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaction = FinancialTransaction::findOrFail($id);
        $transaction->delete();

        // Update total realisasi in finances table if relevant
        $this->updateRealisasiBudget();

        return redirect()->route('admin.finance.index')->with('success', 'Transaksi berhasil dihapus!');
    }

    public function updateBudget(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer',
            'total_anggaran' => 'required|numeric|min:0',
        ]);

        $totalPengeluaran = FinancialTransaction::where('type', 'pengeluaran')->sum('amount');

        Finance::updateOrCreate(
            ['tahun' => $validated['tahun']],
            [
                'total_anggaran' => $validated['total_anggaran'],
                'realisasi_penyerapan' => $totalPengeluaran
            ]
        );

        return redirect()->route('admin.finance.index')->with('success', 'Target Anggaran APBDes berhasil diperbarui!');
    }

    private function updateRealisasiBudget()
    {
        $totalPengeluaran = FinancialTransaction::where('type', 'pengeluaran')->sum('amount');
        
        $budget = Finance::where('tahun', 2026)->first();
        if ($budget) {
            $budget->update([
                'realisasi_penyerapan' => $totalPengeluaran
            ]);
        }
    }
}
