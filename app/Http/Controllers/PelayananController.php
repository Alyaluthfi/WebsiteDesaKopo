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

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email sudah digunakan oleh pengguna lain.',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('akun')->with('success', 'Profil Anda berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal harus 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini yang Anda masukkan salah.']);
        }

        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->new_password),
        ]);

        return redirect()->route('akun')->with('success', 'Password Anda berhasil diperbarui.');
    }
}
