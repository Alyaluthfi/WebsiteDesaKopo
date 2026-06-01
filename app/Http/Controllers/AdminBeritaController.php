<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminBeritaController extends Controller
{
    public function index()
    {
        $beritaAcaraList = BeritaAcara::orderBy('tanggal_pelaksanaan', 'desc')->get();
        return view('admin.berita', compact('beritaAcaraList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'foto_kegiatan' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tanggal_pelaksanaan' => 'required|date',
            'deskripsi_kegiatan' => 'required|string',
        ]);

        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $filename = 'berita_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $validated['foto_kegiatan'] = 'images/' . $filename;
        }

        BeritaAcara::create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita Acara berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $berita = BeritaAcara::findOrFail($id);

        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tanggal_pelaksanaan' => 'required|date',
            'deskripsi_kegiatan' => 'required|string',
        ]);

        if ($request->hasFile('foto_kegiatan')) {
            // Delete old file if exists
            if ($berita->foto_kegiatan && File::exists(public_path($berita->foto_kegiatan))) {
                File::delete(public_path($berita->foto_kegiatan));
            }

            $file = $request->file('foto_kegiatan');
            $filename = 'berita_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $validated['foto_kegiatan'] = 'images/' . $filename;
        } else {
            // Retain old photo if not uploading a new one
            unset($validated['foto_kegiatan']);
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita Acara berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = BeritaAcara::findOrFail($id);

        // Delete photo file if exists
        if ($berita->foto_kegiatan && File::exists(public_path($berita->foto_kegiatan))) {
            File::delete(public_path($berita->foto_kegiatan));
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita Acara berhasil dihapus!');
    }
}
