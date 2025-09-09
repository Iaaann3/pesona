@extends('layouts.admin')

@section('content')
<div class="container-fluid d-flex flex-column align-items-center min-vh-100 p-3 mt-5">
    <h1 class="mb-4 text-center">Tambah Pembayaran</h1>
    <div class="card w-100" style="max-width:800px;">
        <div class="card-body">
            <form action="{{ route('admin.pembayaran.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="keamanan" class="form-label">Biaya Keamanan</label>
                    <input type="number" name="keamanan" id="keamanan" 
                           class="form-control @error('keamanan') is-invalid @enderror" 
                           value="{{ old('keamanan') }}" required>
                    @error('keamanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kebersihan" class="form-label">Biaya Kebersihan</label>
                    <input type="number" name="kebersihan" id="kebersihan" 
                           class="form-control @error('kebersihan') is-invalid @enderror" 
                           value="{{ old('kebersihan') }}" required>
                    @error('kebersihan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" id="tanggal" class="form-control" 
                           value="{{ date('Y-m-d') }}" readonly>
                    <input type="hidden" name="tanggal" value="{{ date('Y-m-d') }}">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
