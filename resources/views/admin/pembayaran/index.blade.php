@extends('layouts.admin')

@section('content')
<div class="container-fluid d-flex flex-column align-items-center min-vh-100 p-3 mt-5">
    <h1 class="mb-4 text-center">Data Pembayaran</h1>
    <div class="card w-100 mt-2" style="max-width:1200px;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-success text-white text-center">
                        <tr>
                            <th>#</th>
                            <th>Nama User</th>
                            <th>Keamanan</th>
                            <th>Kebersihan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($data as $pembayaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pembayaran->user->name ?? '-' }}</td>
                                <td>Rp {{ number_format($pembayaran->keamanan, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($pembayaran->kebersihan, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d-m-Y') }}</td>
                                <td>
                                    @if($pembayaran->status == 'belum terbayar')
                                        <span class="badge bg-danger">Belum Terbayar</span>
                                    @else
                                        <span class="badge bg-success">Pembayaran Berhasil</span>
                                    @endif
                                </td>
                                <td>Rp {{ number_format($pembayaran->total, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data pembayaran</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection