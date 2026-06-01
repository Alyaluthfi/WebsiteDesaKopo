<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSurat;
use Illuminate\Http\Request;

class AdminPermohonanController extends Controller
{
    public function index()
    {
        $permohonanList = PermohonanSurat::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.permohonan', compact('permohonanList'));
    }

    public function updateStatus(Request $request, $id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string|in:menunggu,konfir admin,proses pembuatan,sudah siap,selesai',
        ]);

        $permohonan->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.permohonan.index')->with('success', 'Status permohonan surat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);
        $permohonan->delete();

        return redirect()->route('admin.permohonan.index')->with('success', 'Permohonan surat berhasil dihapus!');
    }
}
