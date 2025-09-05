<?php
namespace App\Http\Controllers;

use App\Models\KritikSaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KritikSaranController extends Controller
{
    public function index()
    {
    $kritiks = KritikSaran::with('user')->where('id_user', auth()->id())->latest()->paginate(10);

        return view('admin.saran.index', compact('kritiks'));
    }

    public function create()
    {
        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.saran.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'nullable|exists:users,id',
            'isi'     => 'required|string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                KritikSaran::create($request->all());
            });

            return redirect()->route('admin.saran.index')->with('success', 'Kritik & saran berhasil dikirim.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengirim kritik & saran.');
        }
    }

    public function show($id)
    {
        $kritik = KritikSaran::with('user')->findOrFail($id);

        return view('admin.saran.show', compact('kritik'));
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $kritik = KritikSaran::findOrFail($id);
                $kritik->delete();
            });

            return redirect()->route('admin.saran.index')->with('success', 'Kritik & saran berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus kritik & saran.');
        }
    }
}