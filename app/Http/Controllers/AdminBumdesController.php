<?php

namespace App\Http\Controllers;

use App\Models\BumdesTransaction;
use Illuminate\Http\Request;

class AdminBumdesController extends Controller
{
    public function index()
    {
        $transactions = BumdesTransaction::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bumdes', compact('transactions'));
    }

    public function updateStatus(Request $request, $id)
    {
        $transaction = BumdesTransaction::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string|in:menunggu,habis,di proses,sudah siap,selesai',
        ]);

        $transaction->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.bumdes.index')->with('success', 'Status transaksi BUMDes berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaction = BumdesTransaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('admin.bumdes.index')->with('success', 'Transaksi BUMDes berhasil dihapus!');
    }
}
