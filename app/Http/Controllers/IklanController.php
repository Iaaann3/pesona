<?php
namespace App\Http\Controllers;

use App\Models\Iklan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class IklanController extends Controller
{
    public function index()
    {
        $iklans = auth()->user()->role === 'admin'
            ? Iklan::with('user')->latest()->paginate(5)
            : Iklan::with('user')->where('id_user', auth()->id())->latest()->paginate(5);

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
            'id_user' => 'required|exists:users,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:5120',
        ]);

        DB::transaction(function() use ($request) {
            $data = $request->except('gambar');

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/iklan'), $filename);
                $data['gambar'] = 'uploads/iklan/' . $filename;
            }

            Iklan::create($data);
        });

        return redirect()->route('admin.iklan.index')->with('success', 'Iklan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $iklan = Iklan::findOrFail($id);
        if (auth()->user()->role !== 'admin' && $iklan->id_user !== auth()->id()) abort(403);

        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.iklan.edit', compact('iklan', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:5120',
        ]);

        $iklan = Iklan::findOrFail($id);
        if (auth()->user()->role !== 'admin' && $iklan->id_user !== auth()->id()) abort(403);

        DB::transaction(function() use ($request, $iklan) {
            $data = $request->except('gambar');

            if ($request->hasFile('gambar')) {
                // Hapus file lama
                if ($iklan->gambar && File::exists(public_path($iklan->gambar))) {
                    File::delete(public_path($iklan->gambar));
                }

                $file = $request->file('gambar');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/iklan'), $filename);
                $data['gambar'] = 'uploads/iklan/' . $filename;
            }

            $iklan->update($data);
        });

        return redirect()->route('admin.iklan.index')->with('success', 'Iklan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $iklan = Iklan::findOrFail($id);
        if (auth()->user()->role !== 'admin' && $iklan->id_user !== auth()->id()) abort(403);

        DB::transaction(function() use ($iklan) {
            if ($iklan->gambar && File::exists(public_path($iklan->gambar))) {
                File::delete(public_path($iklan->gambar));
            }
            $iklan->delete();
        });

        return redirect()->route('admin.iklan.index')->with('success', 'Iklan berhasil dihapus.');
    }
}
