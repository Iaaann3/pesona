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
    if (auth()->user()->role === 'admin') {
        $data = Pembayaran::all();
    } else {
        $data = Pembayaran::where('id_user', auth()->id())->get();
    }

    return view('admin.pembayaran.index', compact('data'));
}

    // Simpan data baru
    public function store(Request $request)
{
    // Validasi tanggal harus unik
    $validated = $request->validate([
        'tanggal' => 'required|unique:pembayarans,tanggal',
    ]);

    // Pastikan tanggal yang dipilih adalah tanggal 4
    if (\Carbon\Carbon::parse($request->tanggal)->day != 1) {
        return back()
            ->withErrors(['tanggal' => 'Pembayaran hanya bisa pada tanggal 1 setiap bulan.'])
            ->withInput();
    }

    DB::beginTransaction();
    try {
        $pembayaran = new Pembayaran();
        $pembayaran->id_user     = auth()->id(); // supaya nyimpen ke user yang login
        $pembayaran->keamanan    = 101120;       // nilai tetap
        $pembayaran->kebersihan  = 40000;        // nilai tetap
        $pembayaran->tanggal     = $request->tanggal;
        $pembayaran->total       = $pembayaran->keamanan + $pembayaran->kebersihan;
        $pembayaran->status      = 'belum terbayar';
        $pembayaran->save();

        DB::commit();

        toast('Data berhasil disimpan', 'success');
        return redirect()->route('admin.pembayaran.index');
    } catch (Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
    }
}


    // Update pembayaran
    public function update(Request $request, $id)
    {
        $request->validate([
            'keamanan'   => 'required|integer',
            'kebersihan' => 'required|integer',
            'tanggal'    => 'required|date',
            'status'     => 'required|in:belum terbayar,pembayaran berhasil',
        ]);

        DB::beginTransaction();
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            $total = $request->keamanan + $request->kebersihan;

            $pembayaran->update([
                'keamanan'   => $request->keamanan,
                'kebersihan' => $request->kebersihan,
                'tanggal'    => $request->tanggal,
                'status'     => $request->status,
                'total'      => $total,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil diupdate',
                'data'    => $pembayaran
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal update data',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // Hapus pembayaran
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            $pembayaran->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil dihapus'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal hapus data',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
