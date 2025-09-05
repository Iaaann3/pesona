@extends('layouts.user')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        {{-- Judul --}}
        <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $kegiatan->nama_kegiatan_kegiatan }}</h1>

        {{-- Gambar --}}
        @if($kegiatan->gambar)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" 
                     alt="{{ $kegiatan->judul }}" 
                     class="w-full h-56 object-cover rounded-lg shadow">
            </div>
        @endif

        {{-- Deskripsi --}}
        <p class="text-gray-700 text-2xl leading-relaxed mb-6">
            {{ $kegiatan->deskripsi }}
        </p>

        {{-- Info tambahan --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 text-gray-600 text-base border-t pt-4">
            <span>📍 Lokasi: <b>{{ $kegiatan->lokasi ?? '-' }}</b></span>
        </div>

        {{-- Tombol kembali --}}
        <div class="mt-6">
            <a href="{{ route('user.kegiatan.index') }}" 
               class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                ← Kembali
            </a>
        </div>
    </div>
</div>
@endsection
