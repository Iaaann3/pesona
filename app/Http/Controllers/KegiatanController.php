<?php
namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::latest()->paginate(10);
        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
            'lokasi'        => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->only(['nama_kegiatan', 'deskripsi', 'lokasi', 'tanggal']);

            if ($request->hasFile('gambar')) {
                $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
            }

            Kegiatan::create($data);

            DB::commit();
            return redirect()->route('admin.kegiatan.index')
                ->with('success', 'Kegiatan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan kegiatan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
            'lokasi'        => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        try {
            DB::beginTransaction();

            $kegiatan = Kegiatan::findOrFail($id);
            $data     = $request->only(['nama_kegiatan', 'deskripsi', 'lokasi', 'tanggal']);

            if ($request->hasFile('gambar')) {
                $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
            }

            $kegiatan->update($data);

            DB::commit();
            return redirect()->route('admin.kegiatan.index')
                ->with('success', 'Kegiatan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui kegiatan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $kegiatan = Kegiatan::findOrFail($id);
            $kegiatan->delete();

            return redirect()->route('admin.kegiatan.index')
                ->with('success', 'Kegiatan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus kegiatan: ' . $e->getMessage());
        }
    }
}