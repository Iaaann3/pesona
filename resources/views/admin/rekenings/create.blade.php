@extends('layouts.admin')

@section('content')
<br><br><br>
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Tambah Rekening Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.rekenings.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="bank_name" class="form-label">Nama Bank</label>
                    <input type="text" name="bank_name" id="bank_name" class="form-control @error('bank_name') is-invalid @enderror" value="{{ old('bank_name') }}" required>
                    @error('bank_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="number" class="form-label">Nomor Rekening</label>
                    <input type="text" name="number" id="number" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') }}" required>
                    @error('number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.rekenings.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
