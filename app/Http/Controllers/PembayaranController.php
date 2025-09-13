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
   public function index(Request $request)
{
   if (auth()->guard('admin')->check()) {
        // Kalau admin login → tampilkan semua pembayaran

        $perPage = $request->get('per_page', 10); // default 10
        $search  = $request->get('search');
        $status  = $request->get('status');

        $query = Pembayaran::with('user', 'dibayar.rekening');

        // Tambahkan filter pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('no_rumah', 'like', "%{$search}%");
            });
        }

        // Filter status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }


    } else {
        // Kalau user login → hanya lihat pembayaran miliknya
        $query = Pembayaran::with('user', 'dibayar')
            ->where('id_user', auth()->id());

        // Filter pencarian juga bisa dipakai user
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                 $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('no_rumah', 'like', '%' . $request->search . '%');
            });
        }

        $data = $query->latest()->get();
    }

    $data = $query->paginate($perPage)->appends($request->all());


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
$today = now();
$users = \App\Models\User::all();

foreach ($users as $user) {
    $exists = Pembayaran::where('id_user', $user->id)
        ->whereMonth('tanggal', $today->month)
        ->whereYear('tanggal', $today->year)
        ->exists();

    if (!$exists) {
        Pembayaran::create([
            'id_user' => $user->id,
            'keamanan' => $request->keamanan,
            'kebersihan' => $request->kebersihan,
            'tanggal' => $today,
            'status' => 'belum terbayar',
            'total' => $request->keamanan + $request->kebersihan,
        ]);
    }
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
   // Hapus hanya pembayaran (dan otomatis hapus relasi jika ada karena foreign key onDelete cascade)
public function destroyPembayaran($id)
{
    $pembayaran = \App\Models\Pembayaran::findOrFail($id);

    // Kalau mau aman, hapus dulu bukti bayar terkait manual
    if ($pembayaran->dibayar && $pembayaran->dibayar->foto) {
        $fotoPath = $pembayaran->dibayar->foto;
        if (\Storage::disk('public')->exists($fotoPath)) {
            \Storage::disk('public')->delete($fotoPath);
        }
        $pembayaran->dibayar->delete();
    }

    $pembayaran->delete();

    return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
}


// Hapus hanya data bukti bayar (foto + relasi dibayar)
public function destroyDibayar($id)
{
    $pembayaran = \App\Models\Pembayaran::with('dibayar')->findOrFail($id);

    if ($pembayaran->dibayar) {
        // hapus file foto
        if ($pembayaran->dibayar->foto && \Storage::disk('public')->exists($pembayaran->dibayar->foto)) {
            \Storage::disk('public')->delete($pembayaran->dibayar->foto);
        }

        $pembayaran->dibayar->delete();
        // ubah status pembayaran kembali ke "belum terbayar"
        $pembayaran->update(['status' => 'belum terbayar']);
    }

    return redirect()->route('admin.pembayaran.index')->with('success', 'Bukti pembayaran berhasil dihapus.');
}
}
