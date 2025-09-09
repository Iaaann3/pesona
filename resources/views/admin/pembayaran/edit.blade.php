@extends('layouts.admin')

@section('content')
<div class="container-fluid d-flex flex-column align-items-center min-vh-100 p-3 mt-5">
    <h1 class="mb-4 text-center">Edit Pembayaran</h1>
    <div class="card w-100" style="max-width:800px;">
        <div class="card-body">
            <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="keamanan" class="form-label">Biaya Keamanan</label>
                    <input type="number" id="keamanan" 
                           class="form-control" 
                           value="{{ $pembayaran->keamanan }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="kebersihan" class="form-label">Biaya Kebersihan</label>
                    <input type="number" id="kebersihan" 
                           class="form-control" 
                           value="{{ $pembayaran->kebersihan }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" id="tanggal" 
                           class="form-control" 
                           value="{{ $pembayaran->tanggal }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" id="total" 
                           class="form-control" 
                           value="{{ $pembayaran->total }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" 
                            class="form-control @error('status') is-invalid @enderror" required>
                        <option value="belum terbayar" {{ $pembayaran->status == 'belum terbayar' ? 'selected' : '' }}>
                            Belum Terbayar
                        </option>
                        <option value="pembayaran berhasil" {{ $pembayaran->status == 'pembayaran berhasil' ? 'selected' : '' }}>
                            Pembayaran Berhasil
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
