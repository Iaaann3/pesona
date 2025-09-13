<?php
namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

        DB::beginTransaction();
        try {
            $pengumuman          = new Pengumuman();
            $pengumuman->judul   = $request->judul;
            $pengumuman->isi     = $request->isi;
            $pengumuman->tanggal = $request->tanggal;

            if ($request->hasFile('gambar')) {
                $path               = $request->file('gambar')->store('pengumuman', 'public');
                $pengumuman->gambar = $path; // simpan path file, bukan judul
            }

            $pengumuman->save();
            DB::commit();

            return redirect()->route('admin.pengumuman.index')
                ->with('success', 'Pengumuman berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menambahkan pengumuman: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
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

        DB::beginTransaction();
        try {
            $pengumuman          = Pengumuman::findOrFail($id);
            $pengumuman->judul   = $request->judul;
            $pengumuman->isi     = $request->isi;
            $pengumuman->tanggal = $request->tanggal;

            if ($request->hasFile('gambar')) {
                if ($pengumuman->gambar && Storage::disk('public')->exists($pengumuman->gambar)) {
                    Storage::disk('public')->delete($pengumuman->gambar);
                }

                $path               = $request->file('gambar')->store('pengumuman', 'public');
                $pengumuman->gambar = $path;
            }

            $pengumuman->save();
            DB::commit();

            return redirect()->route('admin.pengumuman.index')
                ->with('success', 'Pengumuman berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui pengumuman: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $pengumuman = Pengumuman::findOrFail($id);

            if ($pengumuman->gambar && Storage::disk('public')->exists($pengumuman->gambar)) {
                Storage::disk('public')->delete($pengumuman->gambar);
            }

            $pengumuman->delete();
            DB::commit();

            return redirect()->route('admin.pengumuman.index')
                ->with('success', 'Pengumuman berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus pengumuman: ' . $e->getMessage());
        }
    }
}
