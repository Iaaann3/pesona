@extends('layouts.user')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
        📢 Daftar Pengumuman
    </h1>

    @if($pengumuman->isEmpty())
        {{-- Jika tidak ada pengumuman --}}
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg shadow-sm">
            <div class="flex items-center">
                <span class="text-2xl mr-3">⚠️</span>
                <p class="text-gray-700">Belum ada pengumuman saat ini.</p>
            </div>
        </div>
    @else
        {{-- Looping pengumuman --}}
        <div class="space-y-4">
            @foreach($pengumuman as $item)
                <div class="flex items-center bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 border border-gray-100 overflow-hidden">

                   

                    {{-- Isi pengumuman --}}
                    <div class="flex-1 p-4">
                        <div class="flex justify-between items-center mb-1">
                            <span class="px-2 py-0.5 bg-red-500 text-black text-xs font-semibold rounded">
                                🔔 Pengumuman
                            </span>
                            <span class="text-gray-500 text-xs flex items-center gap-1">
                                📅 {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                            </span>
                        </div>

                        <h2 class="text-base font-semibold text-gray-900 mb-1">
                            {{ ucfirst($item->judul) }}
                        </h2>

                        <p class="text-gray-600 text-sm mb-2">
                            {{ Str::limit($item->isi, 100) }}
                        </p>

                       <a href="{{ route('user.pengumuman.show', $item->id) }}" 
                        class="text-indigo-600 text-sm font-medium hover:underline flex items-center gap-1">
                            📋 Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $pengumuman->links('pagination::tailwind') }}
        </div>
    @endif
</div>

@endsection
