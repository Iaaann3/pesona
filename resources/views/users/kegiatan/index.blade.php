@extends('layouts.user')

@section('content')


@if($kegiatan->isEmpty())       
    @include ('layouts.kegiatan.oops')
    @else
        {{-- Looping kegiatan --}}
        <div class="space-y-4">
            @foreach($kegiatan as $item)
                <div class="flex bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 border border-gray-100 overflow-hidden">
                    
                    {{-- Isi kegiatan --}}
                    <div class="flex-1 p-4">
                        <div class="flex justify-between items-center mb-1">
                            <span class="px-2 py-0.5 bg-green-500 text-black text-xs font-semibold rounded">
                                🗓️ Kegiatan
                            </span>
                            <span class="text-gray-500 text-xs flex items-center gap-1">
                                📍 {{ $item->lokasi }}
                            </span>
                        </div>

                        <h2 class="text-base font-semibold text-gray-900 mb-1">
                            {{ ucfirst($item->nama_kegiatan) }}
                        </h2>

                        {{-- Tanggal kegiatan --}}
                        <p class="text-xs text-gray-500 mb-1">
                            🗓️ {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </p>

                        <p class="text-gray-600 text-sm mb-2">
                            {{ Str::limit($item->deskripsi, 100) }}
                        </p>

                        <a href="{{ route('user.kegiatan.show', $item->id) }}" 
                           class="inline-flex items-center gap-1 text-indigo-600 text-sm font-medium hover:underline">
                            📋 Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $kegiatan->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection
