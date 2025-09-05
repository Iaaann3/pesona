@extends('layouts.user')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    {{-- Judul --}}
    <h1 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
        📢 Detail Pengumuman
    </h1>

    {{-- Card pengumuman --}}
    <div class="bg-white rounded-lg shadow-md border border-gray-100 p-6">
        
        {{-- Gambar jika ada --}}
        @if($pengumuman->gambar)
            <div class="w-full h-64 mb-4 rounded overflow-hidden bg-gray-100">
                <img src="{{ asset('storage/' . $pengumuman->gambar) }}" 
                     alt="Gambar {{ $pengumuman->judul }}" 
                     class="w-full h-full object-cover">
            </div>
        @endif

        {{-- Tanggal --}}
        <div class="text-sm text-gray-500 flex items-center gap-1 mb-2">
            📅 {{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('d F Y') }}
        </div>

        {{-- Judul --}}
        <h2 class="text-xl font-semibold text-gray-900 mb-3">
            {{ ucfirst($pengumuman->judul) }}
        </h2>

        {{-- Isi pengumuman --}}
        <p class="text-gray-700 leading-relaxed mb-4">
            {{ $pengumuman->isi }}
        </p>

        {{-- Tombol kembali --}}
        <a href="{{ route('user.pengumuman.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
           ⬅️ Kembali ke Daftar
        </a>
    </div>
</div>
@endsection
