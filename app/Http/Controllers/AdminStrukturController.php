<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminStrukturController extends Controller
{
    public function index()
    {
        $aparatList = StrukturOrganisasi::orderBy('urutan', 'asc')->get();
        return view('admin.struktur', compact('aparatList'));
    }

    public function update(Request $request, $id)
    {
        $aparat = StrukturOrganisasi::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Delete old file if exists and is not null
            if ($aparat->foto && File::exists(public_path($aparat->foto))) {
                File::delete(public_path($aparat->foto));
            }

            $file = $request->file('foto');
            $filename = 'struktur_' . $aparat->peran . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/struktur'), $filename);
            $validated['foto'] = 'images/struktur/' . $filename;
        }

        $aparat->update($validated);

        return redirect()->route('admin.struktur.index')->with('success', 'Data Struktur Organisasi berhasil diperbarui!');
    }
}
