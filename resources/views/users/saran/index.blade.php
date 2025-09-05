@extends('layouts.user')

@section('content')
<div class="mobile-container">
    <div class="main-content">
        <h3 class="section-title">Kritik & Saran</h3>

        {{-- Notifikasi sukses --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Kritik & Saran --}}
        <form action="{{ route('user.saran.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="isi" class="form-label">Tulis kritik atau saran Anda</label>
                <textarea 
                    name="isi" 
                    id="isi" 
                    rows="4" 
                    class="form-control @error('isi') is-invalid @enderror" 
                    placeholder="Ketik pesan di sini...">{{ old('isi') }}</textarea>
                
                {{-- Pesan error validasi --}}
                @error('isi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-success">Kirim</button>
        </form>

        {{-- Riwayat Saran --}}
        <h5 class="mb-3">Riwayat Kritik & Saran Anda</h5>
        @forelse($saran as $item)
            <div class="card mb-2">
                <div class="card-body">
                    <p class="mb-1">{{ $item->isi }}</p>
                    <small class="text-muted">Dikirim pada {{ $item->created_at->format('d M Y H:i') }}</small>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada kritik atau saran.</p>
        @endforelse
    </div>
</div>
@endsection
