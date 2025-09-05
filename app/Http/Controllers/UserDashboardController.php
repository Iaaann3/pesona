<?php
namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pengumuman;

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

            'tagihan' => $tagihan,
        ]);
    }
    
}

