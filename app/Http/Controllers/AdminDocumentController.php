<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminDocumentController extends Controller
{
    public function index()
    {
        $documents = Document::orderBy('created_at', 'desc')->get();
        return view('admin.dokumen', compact('documents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,png,jpg,jpeg,webp,doc,docx,xls,xlsx|max:20480', // Max 20MB
            'description' => 'nullable|string|max:1000',
        ], [
            'title.required' => 'Judul dokumen wajib diisi.',
            'title.max' => 'Judul dokumen tidak boleh lebih dari 255 karakter.',
            'file.required' => 'File dokumen wajib diunggah.',
            'file.file' => 'Input harus berupa file yang valid.',
            'file.mimes' => 'Format file harus berupa: PDF, PNG, JPG, JPEG, WEBP, DOC, DOCX, XLS, atau XLSX.',
            'file.max' => 'Ukuran file tidak boleh lebih dari 20 MB (20.480 KB).',
            'description.max' => 'Deskripsi tidak boleh lebih dari 1.000 karakter.',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = 'doc_' . time() . '_' . uniqid() . '.' . $extension;
            $file->move(public_path('documents'), $filename);
            
            $validated['file_path'] = 'documents/' . $filename;
            $validated['file_type'] = in_array(strtolower($extension), ['png', 'jpg', 'jpeg', 'webp']) ? 'gambar' : 'pdf';
        }

        Document::create([
            'title' => $validated['title'],
            'file_path' => $validated['file_path'],
            'file_type' => $validated['file_type'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.document.index')->with('success', 'Dokumen berhasil diunggah!');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        if ($document->file_path && File::exists(public_path($document->file_path))) {
            File::delete(public_path($document->file_path));
        }

        $document->delete();

        return redirect()->route('admin.document.index')->with('success', 'Dokumen berhasil dihapus!');
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);
        
        $filePath = public_path($document->file_path);
        if (File::exists($filePath)) {
            $document->increment('downloads_count');
            return response()->download($filePath);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan di server.');
    }
}
