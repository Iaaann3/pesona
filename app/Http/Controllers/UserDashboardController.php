<?php
namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pengumuman;
use App\Models\Dibayar;
use App\Models\Iklan;
use Illuminate\Http\Request;
use App\Models\Rekening;

use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->take(5)->get();
        $iklans = Iklan::latest()->take(5)->get();
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
            'iklans' => $iklans,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_tagihan' => 'required|exists:pembayarans,id',
            'rekening_id' => 'required|exists:rekenings,id',
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pembayaran = Pembayaran::findOrFail($request->id_tagihan);

        // Otorisasi: pemilik atau admin
        if ($pembayaran->id_user !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        DB::transaction(function () use ($request, $pembayaran) {
            $fotoPath = null;
            if ($request->hasFile('bukti_pembayaran')) {
                $fotoPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            }

            $dibayar = Dibayar::create([
                'id_user' => $pembayaran->id_user,
                'rekening_id' => $request->rekening_id,
                'foto' => $fotoPath,
                'pembayaran_id' => $pembayaran->id,
            ]);

            $pembayaran->update(['dibayar_id' => $dibayar->id, 'status' => 'pembayaran berhasil']);
        });

        return redirect()->route('user.home.index')->with('success', 'Bukti pembayaran berhasil dikirim.');
    }
}

