@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Atur Biaya Pembayaran</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.biaya_setting.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        <div class="mb-3">
            <label class="form-label">Biaya Keamanan</label>
            <input type="number" name="keamanan" class="form-control" value="{{ old('keamanan', $setting->keamanan ?? 0) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Biaya Kebersihan</label>
            <input type="number" name="kebersihan" class="form-control" value="{{ old('kebersihan', $setting->kebersihan ?? 0) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Tagih</label>
            <input type="date" name="tanggal_tagih" class="form-control" value="{{ old('tanggal_tagih', $setting->tanggal_tagih ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Jatuh Tempo</label>
            <input type="date" name="tanggal_jatuh_tempo" class="form-control" value="{{ old('tanggal_jatuh_tempo', $setting->tanggal_jatuh_tempo ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
