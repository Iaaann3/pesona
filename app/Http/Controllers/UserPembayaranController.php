<?php
namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class UserPembayaranController extends Controller
{
    
    public function index()
    {
        $pembayarans = Pembayaran::where('id_user', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('users.pembayaran.index', compact('pembayarans'));
    }
    public function riwayat()
    {
        $pembayarans = Pembayaran::where('id_user', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('users.pembayaran.index', compact('pembayarans'));
    }
    // public function konfirmasi($id)
    // {
    //     $pembayaran = Pembayaran::where('id', $id)
    //         ->where('id_user', auth()->id())
    //         ->firstOrFail();

    //     return view('users.pembayaran.konfirmasi', compact('pembayaran'));
    // }
    public function detail($id)
    {
        $pembayaran = Pembayaran::where('id_user', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        return view('users.pembayaran.detail', compact('pembayaran'));
    }

    

    
}
