@extends('layouts.admin')

@section('content')
<div class="container-fluid d-flex flex-column align-items-center min-vh-100 p-3 mt-5">
    <h1 class="mb-4 text-center">Data Pembayaran</h1>
    <div class="card w-100 mt-2" style="max-width:1200px;">
        <div class="card-body">

            {{-- Tombol Tambah Pembayaran --}}
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-success">
                    + Tambah Pembayaran
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-success text-white text-center">
                        <tr>
                            <th>#</th>
                            <th>Nama User</th>
                            <th>No Rumah</th>
                            <th>Keamanan</th>
                            <th>Kebersihan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Bukti Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($data as $pembayaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pembayaran->user->name ?? '-' }}</td>
                                <td>{{ $pembayaran->user->no_rumah ?? '-' }}</td>
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

                                {{-- Tombol Show --}}
                                <td>
                                    @if($pembayaran->dibayar && $pembayaran->dibayar->foto)
                                        <button class="btn btn-primary btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#showModal{{ $pembayaran->id }}">
                                            Show
                                        </button>

                                        {{-- Modal Show --}}
                                        <div class="modal fade" id="showModal{{ $pembayaran->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success text-white">
                                                        <h5 class="modal-title">Detail Pembayaran</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul class="list-group text-start">
                                                                    <li class="list-group-item"><strong>Nama:</strong> {{ $pembayaran->user->name }}</li>
                                                                    <li class="list-group-item"><strong>No Rumah:</strong> {{ $pembayaran->user->no_rumah }}</li>
                                                                    <li class="list-group-item"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d-m-Y') }}</li>
                                                                    <li class="list-group-item"><strong>Keamanan:</strong> Rp {{ number_format($pembayaran->keamanan, 0, ',', '.') }}</li>
                                                                    <li class="list-group-item"><strong>Kebersihan:</strong> Rp {{ number_format($pembayaran->kebersihan, 0, ',', '.') }}</li>
                                                                    <li class="list-group-item"><strong>Total:</strong> Rp {{ number_format($pembayaran->total, 0, ',', '.') }}</li>
                                                                    <li class="list-group-item">
                                                                        <strong>Status:</strong> 
                                                                        @if($pembayaran->status == 'belum terbayar')
                                                                            <span class="badge bg-danger">Belum Terbayar</span>
                                                                        @else
                                                                            <span class="badge bg-success">Pembayaran Berhasil</span>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <p><strong>Bukti Pembayaran</strong></p>
                                                                <img src="{{ asset('storage/' . $pembayaran->dibayar->foto) }}" 
                                                                     class="img-fluid rounded shadow" 
                                                                     alt="Bukti Pembayaran">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-danger fw-bold">Belum ada foto</span>
                                    @endif
                                </td>

                                <td>
                                   @if($pembayaran->status == 'belum terbayar')
                                    <a href="{{ route('admin.pembayaran.edit', $pembayaran->id) }}" 
                                    class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    @else
                                       
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Belum ada data pembayaran</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
