<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelayananController extends Controller
{
    public function showForm($jenis)
    {
        $validTypes = ['domisili', 'sku', 'sktm', 'pindah'];
        if (!in_array($jenis, $validTypes)) {
            abort(404);
        }

        return view('pelayanan.form', compact('jenis'));
    }

    public function submitForm(Request $request, $jenis)
    {
        $validTypes = ['domisili', 'sku', 'sktm', 'pindah'];
        if (!in_array($jenis, $validTypes)) {
            abort(404);
        }

        // Dynamic validation depending on the type
        $rules = [];
        if ($jenis === 'domisili') {
            $rules = [
                'nik' => 'required|string|size:16',
                'nama' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
                'agama' => 'required|string|max:100',
                'pekerjaan' => 'required|string|max:255',
                'alamat' => 'required|string',
                'keperluan' => 'required|string|max:255',
            ];
        } elseif ($jenis === 'sku') {
            $rules = [
                'nik' => 'required|string|size:16',
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string',
                'nama_usaha' => 'required|string|max:255',
                'jenis_usaha' => 'required|string|max:255',
                'sektor_usaha' => 'required|string|max:255',
                'alamat_usaha' => 'required|string',
                'lama_usaha' => 'required|string|max:100',
            ];
        } elseif ($jenis === 'sktm') {
            $rules = [
                'nik' => 'required|string|size:16',
                'nama' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'pekerjaan' => 'required|string|max:255',
                'alamat' => 'required|string',
                'nama_ortu' => 'required|string|max:255',
                'pekerjaan_ortu' => 'required|string|max:255',
                'keperluan' => 'required|string|max:255',
            ];
        } elseif ($jenis === 'pindah') {
            $rules = [
                'nik' => 'required|string|size:16',
                'nama' => 'required|string|max:255',
                'alamat_asal' => 'required|string',
                'alamat_tujuan' => 'required|string',
                'alasan_pindah' => 'required|string|max:255',
                'jumlah_pengikut' => 'required|integer|min:0',
            ];
        }

        $validated = $request->validate($rules);

        // Store the request
        PermohonanSurat::create([
            'user_id' => Auth::id(),
            'jenis_surat' => $jenis,
            'data_syarat' => $validated,
            'status' => 'menunggu',
        ]);

        return redirect()->route('home')->with('success', 'Permohonan surat berhasil diajukan! Silakan pantau status pengajuan Anda di halaman Akun.');
    }

    public function showProfile()
    {
        $user = Auth::user();
        $permohonanList = PermohonanSurat::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $bumdesTransactions = \App\Models\BumdesTransaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('auth.profile', compact('user', 'permohonanList', 'bumdesTransactions'));
    }
}
