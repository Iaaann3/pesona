@extends('layouts.user')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Detail Tagihan</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Informasi Tagihan</h5>
            <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Tanggal Tagihan:</strong> {{ $pembayaran->tanggal->format('d M Y') }}</p>
            <p><strong>Status:</strong> 
               @if($pembayaran->status == 'belum terbayar' && $pembayaran->dibayar && $pembayaran->dibayar->foto)
                    <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                @elseif($pembayaran->status == 'belum terbayar')
                    <span class="badge bg-danger">Belum Terbayar</span>
                @elseif($pembayaran->status == 'pembayaran berhasil')
                    <span class="badge bg-success">Berhasil</span>
                @endif
            </p>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Rincian Biaya</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Deskripsi</th>
                        <th class="text-end">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayaran->items ?? [] as $item)
                        <tr>
                            <td>{{ $item->nama_item }}</td>
                            <td class="text-end">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="fw-bold">
                        <td>Total</td>
                        <td class="text-end">Rp {{ number_format($pembayaran->total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @if($pembayaran->status == 'belum terbayar')
        <form action="{{ route('user.pembayaran.bayar', $pembayaran->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success w-100 py-2">
                <i class="fas fa-credit-card"></i> Bayar Sekarang
            </button>
        </form>
    @else
        <div class="alert alert-success text-center">
            <i class="fas fa-check-circle"></i> Tagihan sudah dibayar ✅
        </div>
    @endif
</div>
@endsection
