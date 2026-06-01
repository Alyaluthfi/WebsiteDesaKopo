<?php

namespace App\Http\Controllers;

use App\Models\Bumdes;
use App\Models\Finance;
use App\Models\FinancialTransaction;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $year = request('tahun', 2026);

        // Fetch target APBDes budget
        $budget = Finance::where('tahun', $year)->first();
        if (!$budget) {
            $budget = Finance::latest('tahun')->first();
        }

        // Transactions query
        $query = FinancialTransaction::with('bumdes');

        // Apply filters if present
        if ($request->has('type') && in_array($request->type, ['pemasukan', 'pengeluaran'])) {
            $query->where('type', $request->type);
        }

        if ($request->has('bumdes_id') && $request->bumdes_id != '') {
            $query->where('bumdes_id', $request->bumdes_id);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->get();

        // Calculate aggregates (overall - not affected by category filter for dashboard stats)
        $totalPemasukan = FinancialTransaction::where('type', 'pemasukan')->sum('amount');
        $totalPengeluaran = FinancialTransaction::where('type', 'pengeluaran')->sum('amount');
        $sisaSaldo = $totalPemasukan - $totalPengeluaran;

        $bumdesList = Bumdes::all();

        return view('keuangan.index', compact(
            'transactions',
            'budget',
            'totalPemasukan',
            'totalPengeluaran',
            'sisaSaldo',
            'bumdesList'
        ));
    }
}
