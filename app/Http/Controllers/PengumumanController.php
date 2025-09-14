<?php
namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->paginate(5);
        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'isi'     => 'required|string',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $pengumuman          = new Pengumuman();
            $pengumuman->judul   = $request->judul;
            $pengumuman->isi     = $request->isi;
            $pengumuman->tanggal = $request->tanggal;

            if ($request->hasFile('gambar')) {
                $pengumuman->gambar = $request->file('gambar')->store('pengumuman', 'public');
            }

            $pengumuman->save();
        });

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        // Otorisasi: admin atau pemilik (jika ada owner)
        if (auth()->user()->role !== 'admin') {
            // misal owner check bisa ditambahkan jika model punya id_user
        }

        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'isi'     => 'required|string',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|max:2048',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);

        DB::transaction(function () use ($request, $pengumuman) {
            $pengumuman->judul   = $request->judul;
            $pengumuman->isi     = $request->isi;
            $pengumuman->tanggal = $request->tanggal;

            if ($request->hasFile('gambar')) {
                // Hapus file lama
                if ($pengumuman->gambar && File::exists(public_path('uploads/' . $pengumuman->gambar))) {
                    File::delete(public_path('uploads/' . $pengumuman->gambar));
                }

                $pengumuman->gambar = $request->file('gambar')->store('pengumuman', 'public');
            }

            $pengumuman->save();
        });

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        // Otorisasi
        if (auth()->user()->role !== 'admin') {
            // bisa ditambahkan cek owner jika ada id_user
        }

        DB::transaction(function () use ($pengumuman) {
            if ($pengumuman->gambar && File::exists(public_path('uploads/' . $pengumuman->gambar))) {
                File::delete(public_path('uploads/' . $pengumuman->gambar));
            }

            $pengumuman->delete();
        });

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus');
    }
}
