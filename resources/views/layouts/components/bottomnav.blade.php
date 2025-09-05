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
