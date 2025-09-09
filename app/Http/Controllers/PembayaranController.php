<?php

// app/Http/Controllers/PembayaranController.php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class PembayaranController extends Controller
{
    
    // Menampilkan semua pembayaran
   public function index()
{
    if (auth()->guard('admin')->check()) {
        // Kalau admin login → tampilkan semua pembayaran
        $data = Pembayaran::with('user')->get();
    } else {
        // Kalau user login → tampilkan hanya pembayaran user tersebut
        $data = Pembayaran::with('user')->where('id_user', auth()->id())->get();
    }


    return view('admin.pembayaran.index', compact('data'));
}



public function create()
    {
        return view('admin.pembayaran.create');
    }

    // Simpan data baru
    public function store(Request $request)
{
   $today = now(); // tanggal hari ini

$request->validate([
    'keamanan'   => 'required|integer|min:0',
    'kebersihan' => 'required|integer|min:0',
]);

// Cek apakah bulan ini sudah ada pembayaran untuk semua user
$exists = Pembayaran::whereMonth('tanggal', $today->month)
    ->whereYear('tanggal', $today->year)
    ->exists();

if ($exists) {
    return back()->withErrors(['msg' => 'Pembayaran bulan ini sudah dibuat.'])->withInput();
}

$users = \App\Models\User::all();

foreach ($users as $user) {
    Pembayaran::create([
        'id_user'    => $user->id,
        'keamanan'   => $request->keamanan,
        'kebersihan' => $request->kebersihan,
        'tanggal'    => $today,
        'status'     => 'belum terbayar',
        'total'      => $request->keamanan + $request->kebersihan,
    ]);
}

return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil dibuat untuk semua user.');

}


public function edit($id)
{
    $pembayaran = Pembayaran::with('dibayar')->findOrFail($id);

    // pastikan hanya owner yg bisa akses kecuali admin
    if (auth()->user()->role !== 'admin' && $pembayaran->id_user !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    return view('admin.pembayaran.edit', compact('pembayaran'));
}

public function update(Request $request, $id)
{
    $pembayaran = Pembayaran::with('dibayar')->findOrFail($id);

    $request->validate([
        'status' => 'required|in:belum terbayar,pembayaran berhasil',
        'foto'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // update status
    $pembayaran->update([
        'status' => $request->status,
    ]);

    // kalau ada upload bukti
    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('bukti', 'public');

        if ($pembayaran->dibayar) {
            $pembayaran->dibayar->update([
                'foto' => $path,
            ]);
        } else {
            $pembayaran->dibayar()->create([
                'id_user' => $pembayaran->id_user,
                'rekening_id' => $request->rekening_id ?? null,
                'foto' => $path,
            ]);
        }
    }

    return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil diupdate.');
}


    // Hapus pembayaran
    public function destroy($id)
    {
       
    }
}
