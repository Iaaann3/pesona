
<div class="max-w-4xl mx-auto px-4 py-8">

    @if($pengumuman->isEmpty())
        {{-- Jika kosong tampilkan oops --}}
        @include('layouts.pengumuman.oops')
    @else

    <div class="header shadow-sm bg-white px-3 py-2 position-fixed top-0 start-0 end-0" style="z-index:1030;">
    <div class="row align-items-center no-gutters">
        <!-- Logo -->
        <div class="col-auto d-flex align-items-center">
            <img src="{{ asset('assets/images/big/pesona1.jpg') }}" 
                 alt="Logo" 
                 class="rounded-circle border border-2 border-primary me-2" 
                 style="width:40px; height:40px; object-fit:cover;">
        </div>

        <!-- Title -->
        <div class="col text-center">
            <span class="fw-bold text-dark" style="font-size: 15px; letter-spacing:0.5px;">
                Pesona Prima 8 Banjaran
            </span>
        </div>

        <!-- Actions -->
        <div class="col-auto d-flex align-items-center gap-1">
            <!-- Notification -->
            <button class="btn btn-light rounded-circle shadow-sm me-2" 
                    data-bs-toggle="modal" 
                    data-bs-target="#notifications" 
                    style="width:36px; height:36px; display:flex; align-items:center; justify-content:center;">
                <i class="fas fa-bell text-primary"></i>
            </button>

            <!-- Dropdown -->
            <div class="dropdown">
                <button class="btn btn-light rounded-circle shadow-sm" 
                        data-bs-toggle="dropdown" 
                        style="width:36px; height:36px; display:flex; align-items:center; justify-content:center;">
                    <i class="fas fa-bars text-dark"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end mt-2 shadow-sm rounded-3" style="font-size:13px;">
                    <li>
                        <a class="dropdown-item text-dark px-3 py-2" href="#">
                            <i class="fas fa-image text-primary me-2"></i> Pasang Iklan
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="dropdown-item text-dark px-3 py-2" 
                           data-bs-toggle="modal" 
                           data-bs-target="#modal-kritik-saran">
                            <i class="fas fa-envelope-open-text text-success me-2"></i> Kritik & Saran
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger px-3 py-2">
                                <i class="fas fa-power-off me-2"></i> Log out
                            </button>
                        </form>
                    </li>               
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- Tambahkan padding agar konten tidak ketutup navbar -->
<div style="padding-top:65px;"></div>

        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            📢 Daftar Pengumuman
        </h1>

        {{-- Looping pengumuman --}}
        <div class="space-y-4">
            @foreach($pengumuman as $item)
                <div class="flex items-center bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 border border-gray-100 overflow-hidden">
                    
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

<div class="bottom-nav d-flex justify-content-between align-items-center bg-white shadow-sm border-top fixed-bottom" style="z-index: 1030; padding: 6px 0;">
    <!-- Home -->
    <a href="{{ route('user.home.index') }}" 
       class="flex-fill text-center py-2 {{ request()->routeIs('user.home.index') ? 'text-success fw-bold' : 'text-muted' }}">
        <i class="fas fa-home fa-lg"></i>
    </a>

    <!-- Kegiatan -->
    <a href="{{ route('user.kegiatan.index') }}" 
       class="flex-fill text-center py-2 {{ request()->routeIs('user.kegiatan.index') ? 'text-success fw-bold' : 'text-muted' }}">
        <i class="fas fa-flag fa-lg"></i>
    </a>

    <!-- Payment History -->
    <a href="{{ route('user.pembayaran.index') }}" 
       class="flex-fill text-center py-2 {{ request()->routeIs('user.pembayaran.index') ? 'text-success fw-bold' : 'text-muted' }}">
        <i class="fas fa-history fa-lg"></i>
    </a>

    <!-- Pengumuman -->
    <a href="{{ route('user.pengumuman.index') }}" 
       class="flex-fill text-center py-2 {{ request()->routeIs('user.pengumuman.index') ? 'text-success fw-bold' : 'text-muted' }}">
        <i class="fas fa-bullhorn fa-lg"></i>
    </a>

    <!-- Profile -->
    <a href="{{ route('user.profile.index') }}" 
       class="flex-fill text-center py-2 {{ request()->routeIs('user.profile.index') ? 'text-success fw-bold' : 'text-muted' }}">
        <i class="fas fa-user fa-lg"></i>
    </a>
</div>

<style>
.bottom-nav a {
    transition: color 0.2s;
}
.bottom-nav a:hover {
    color: #16a34a; /* Hijau sesuai tema */
}
</style>

