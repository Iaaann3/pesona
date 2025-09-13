<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Iklan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IklanController extends Controller
{
    public function index()
    {
      if (auth()->guard('admin')->check()) {
        // Admin lihat semua
        $iklans = Iklan::with('user')->latest()->paginate(5);
    } else {
        // User login dengan guard default
        $iklans = Iklan::with('user')
            ->where('id_user', auth()->id())
            ->latest()
            ->paginate(5);
    }

    $users = User::where('role', '!=', 'admin')->get();

    return view('admin.iklan.index', compact('iklans', 'users'));
    }

    public function create()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.iklan.create', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_user'   => 'required|exists:users,id',
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|max:5120',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $data = $request->except('gambar');

                if ($request->hasFile('gambar')) {
                    $file           = $request->file('gambar');
                    $path           = $file->store('iklan', 'public');
                    $data['gambar'] = $path;
                }

                Iklan::create($data);
            });

            return redirect()->route('admin.iklan.index')->with('success', 'Iklan berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan iklan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan iklan.');
        }
    }

    public function edit($id)
    {
        try {
            $iklan = Iklan::findOrFail($id);

            return view('admin.iklan.edit', [
                'iklan' => $iklan,
                'users' => User::where('role', '!=', 'admin')->get(),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.iklan.index')->with('error', 'Data iklan tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|max:5120',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $iklan = Iklan::findOrFail($id);
                $data  = $request->except('gambar');

                if ($request->hasFile('gambar')) {
                    $file           = $request->file('gambar');
                    $path           = $file->store('iklan', 'public');
                    $data['gambar'] = $path;
                }

                $iklan->update($data);
            });

            return redirect()->route('admin.iklan.index')->with('success', 'Iklan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal update iklan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui iklan.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $iklan = Iklan::findOrFail($id);
                $iklan->delete();
            });

            return redirect()->route('admin.iklan.index')->with('success', 'Iklan berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal hapus iklan: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus iklan.');
        }
    }
}
