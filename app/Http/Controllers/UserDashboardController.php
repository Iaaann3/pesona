<?php
namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pengumuman;
use App\Models\Dibayar;
use Illuminate\Http\Request;
use App\Models\Rekening;

use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->take(5)->get();

        $userId = Auth::id();

        // Ambil tagihan terakhir user ini
       $tagihan = Pembayaran::where('id_user', $userId)
    ->where('status', 'Belum Terbayar') // hanya yg belum terbayar
    ->latest('tanggal')
    ->first();


            $totalPembayaran = Pembayaran::where('id_user', $userId)
            ->sum('total');

        return view('users.home.index', [
            'pengumuman' => $pengumuman,
            'tagihan' => $tagihan,
            'rekenings' => Rekening::all(),
            'totalPembayaran' => $totalPembayaran,
        ]);
    }
    
    public function store(Request $request)
    {
        // 1️⃣ Validasi input
    $request->validate([
        'id_tagihan' => 'required|exists:pembayarans,id',
        'rekening_id' => 'required|exists:rekenings,id',
        'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // 2️⃣ Simpan file bukti transfer
    $fotoPath = null;
    if ($request->hasFile('bukti_pembayaran')) {
        $fotoPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
    }

    // 3️⃣ Buat record Dibayar
    $dibayar = Dibayar::create([
        'id_user' => auth()->id(),
        'rekening_id' => $request->rekening_id,
        'foto' => $fotoPath,
        'pembayaran_id' => $request->id_tagihan,
    ]);

    // 4️⃣ Update kolom dibayar_id di Pembayaran
    $pembayaran = Pembayaran::find($request->id_tagihan);
    $pembayaran->update(['dibayar_id' => $dibayar->id]);

    // 5️⃣ Redirect ke home
    return redirect()->route('user.home.index')->with('success', 'Bukti pembayaran berhasil dikirim.');
    }
}

