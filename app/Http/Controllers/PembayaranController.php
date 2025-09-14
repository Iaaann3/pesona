<?php
namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\BiayaSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search  = $request->get('search');
        $status  = $request->get('status');

        if (auth()->guard('admin')->check()) {
            $query = Pembayaran::with('user', 'dibayar.rekening');

            if ($request->filled('search')) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('no_rumah', 'like', "%{$search}%");
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $status);
            }
        } else {
            $query = Pembayaran::with('user', 'dibayar')
                ->where('id_user', auth()->id());

            if ($request->filled('search')) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('no_rumah', 'like', "%{$search}%");
                });
            }
        }

        $data = $query->latest()->paginate($perPage)->appends($request->all());

        return view('admin.pembayaran.index', compact('data'));
    }

    public function create()
    {
        return view('admin.pembayaran.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'keamanan'   => 'required|integer|min:0',
        'kebersihan' => 'required|integer|min:0',
    ]);

    $today = now();

    if ($request->has('id_user') && $request->id_user) {
        // Buat pembayaran untuk user tertentu
        $exists = Pembayaran::where('id_user', $request->id_user)
            ->whereMonth('tanggal', $today->month)
            ->whereYear('tanggal', $today->year)
            ->exists();

        if (!$exists) {
            Pembayaran::create([
                'id_user'    => $request->id_user,
                'keamanan'   => $request->keamanan,
                'kebersihan' => $request->kebersihan,
                'tanggal'    => $today,
                'status'     => 'belum terbayar',
                'total'      => $request->keamanan + $request->kebersihan,
            ]);
        }
    } else {
        // Buat pembayaran massal untuk semua user
        $users = \App\Models\User::all();

        foreach ($users as $user) {
            $exists = Pembayaran::where('id_user', $user->id)
                ->whereMonth('tanggal', $today->month)
                ->whereYear('tanggal', $today->year)
                ->exists();

            if (!$exists) {
                Pembayaran::create([
                    'id_user'    => $user->id,
                    'keamanan'   => $request->keamanan,
                    'kebersihan' => $request->kebersihan,
                    'tanggal'    => $today,
                    'status'     => 'belum terbayar',
                    'total'      => $request->keamanan + $request->kebersihan,
                ]);
            }
        }
    }

    return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil dibuat.');
}


    public function edit($id)
    {
        $pembayaran = Pembayaran::with('dibayar')->findOrFail($id);

        if (auth()->user()->role !== 'admin' && $pembayaran->id_user !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('admin.pembayaran.edit', compact('pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::with('dibayar')->findOrFail($id);

        if (auth()->user()->role !== 'admin' && $pembayaran->id_user !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'status' => 'required|in:belum terbayar,pembayaran berhasil',
            'foto'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::transaction(function() use ($request, $pembayaran) {
            $pembayaran->update(['status' => $request->status]);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = 'uploads/bukti/'.$filename;
                $file->move(public_path('uploads/bukti'), $filename);

                if ($pembayaran->dibayar) {
                    if ($pembayaran->dibayar->foto && File::exists(public_path($pembayaran->dibayar->foto))) {
                        File::delete(public_path($pembayaran->dibayar->foto));
                    }
                    $pembayaran->dibayar->update(['foto' => $path]);
                } else {
                    $pembayaran->dibayar()->create([
                        'id_user' => $pembayaran->id_user,
                        'rekening_id' => $request->rekening_id ?? null,
                        'foto' => $path,
                    ]);
                }
            }
        });

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil diupdate.');
    }

    public function destroyPembayaran($id)
    {
        $pembayaran = Pembayaran::with('dibayar')->findOrFail($id);

        if (auth()->user()->role !== 'admin' && $pembayaran->id_user !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        DB::transaction(function() use ($pembayaran) {
            if ($pembayaran->dibayar && $pembayaran->dibayar->foto && File::exists(public_path($pembayaran->dibayar->foto))) {
                File::delete(public_path($pembayaran->dibayar->foto));
                $pembayaran->dibayar->delete();
            }
            $pembayaran->delete();
        });

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }

    public function destroyDibayar($id)
    {
        $pembayaran = Pembayaran::with('dibayar')->findOrFail($id);

        if (auth()->user()->role !== 'admin' && $pembayaran->id_user !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        DB::transaction(function() use ($pembayaran) {
            if ($pembayaran->dibayar) {
                if ($pembayaran->dibayar->foto && File::exists(public_path($pembayaran->dibayar->foto))) {
                    File::delete(public_path($pembayaran->dibayar->foto));
                }
                $pembayaran->dibayar->delete();
                $pembayaran->update(['status' => 'belum terbayar']);
            }
        });

        return redirect()->route('admin.pembayaran.index')->with('success', 'Bukti pembayaran berhasil dihapus.');
    }


    public function generate(Request $request)
{
    $today = now();
    $biaya = \App\Models\BiayaSetting::latest()->first();

    if (!$biaya) {
        return redirect()->back()->with('error', 'Silakan atur biaya setting terlebih dahulu.');
    }

    $users = \App\Models\User::all();

    foreach ($users as $user) {
        $exists = Pembayaran::where('id_user', $user->id)
            ->whereMonth('tanggal', $today->month)
            ->whereYear('tanggal', $today->year)
            ->exists();

        if (!$exists) {
            Pembayaran::create([
                'id_user' => $user->id,
                'keamanan' => $biaya->keamanan,
                'kebersihan' => $biaya->kebersihan,
                'tanggal' => $today,
                'status' => 'belum terbayar',
                'total' => $biaya->keamanan + $biaya->kebersihan,
            ]);
        }
    }

    return redirect()->route('admin.pembayaran.index')
        ->with('success', 'Pembayaran berhasil dibuat untuk semua user.');
}
}
