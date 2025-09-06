@extends('layouts.user')

@section('content')
<div class="mobile-container">
    <!-- Header Section -->
    <div class="header-section">
        <div class="profile-avatar">
            <i class="fas fa-user"></i>
        </div>
        <div class="greeting-text">Selamat datang,</div>
        <h1 class="user-name">{{ Auth::user()->name ?? 'User' }}</h1>

        <!-- Balance Card -->
        <div class="balance-card">
    <div class="balance-info">
        <div>
            <p class="balance-label">Tagihan</p>
            <h2 class="balance-amount">
                Rp {{ number_format($tagihan->total ?? 0, 0, ',', '.') }}
            </h2>
            <a href="{{ route('user.pembayaran.index') }}" class="balance-detail">
                klik & cek riwayat
            </a>
        </div>

        @if($tagihan)
            <button type="button" class="topup-btn bayar-home-btn" data-id="{{ $tagihan->id }}">
                Bayar
            </button>
            <div class="bayar-success-anim d-none mt-2">
                <i class="fas fa-check-circle fa-2x text-success animate__animated animate__bounceIn"></i>
                <span class="text-success ms-2">Pembayaran Berhasil!</span>
            </div>
        @else
            <button class="topup-btn" disabled>
                Tidak ada tagihan
            </button>
        @endif
    </div>
        </div>
    </div>
    <!-- Main Content -->
    <div class="main-content">

        @if($tagihan)
            <a href="{{ route('user.pembayaran.detail', $tagihan->id) }}" class="check-bill-btn">
                <i class="fas fa-file-invoice"></i>
                Cek Tagihan Anda
            </a>
        @endif
        <!-- Services Section -->
        <h3 class="section-title">Info dan Layanan</h3>
        <div class="service-grid">
            <!-- <a href="#" class="service-item">
                <div class="service-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="service-label">Surat</div>
            </a> -->
            <a href="{{ route('user.pengumuman.index') }}" class="service-item">
                <div class="service-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="service-label">Pengumuman</div>
            </a>
            <a href="{{ route('user.saran.index') }}" class="service-item">
                <div class="service-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="service-label">Saran & Kritik</div>
            </a>
            <a href="javascript:;" class="service-item" data-bs-toggle="modal" data-bs-target="#tataTertibModal">
                <div class="service-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="service-label">Tata Tertib</div>
            </a>

            <a href="#" class="service-item">
                <div class="service-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="service-label">Keluhan</div>
            </a>
            <a href="{{ route('user.kegiatan.index') }}" class="service-item">
                <div class="service-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div class="service-label">Kegiatan</div>
            </a>
            <!-- <a href="#" class="service-item" style="grid-column: 2;">
                <div class="service-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="service-label">Bazaar</div>
            </a> -->
        </div>

        <h3 class="section-title">Layanan Populer</h3>
<div class="service-grid">
    <a href="#" class="service-item">
        <div class="service-icon"><i class="fas fa-mobile-alt"></i></div>
        <div class="service-label">Pulsa</div>
    </a>
    <a href="#" class="service-item">
        <div class="service-icon"><i class="fas fa-wifi"></i></div>
        <div class="service-label">Paket Data</div>
    </a>
    <a href="#" class="service-item">
        <div class="service-icon"><i class="fas fa-signal"></i></div>
        <div class="service-label">Roaming</div>
    </a>
    <a href="#" class="service-item">
        <div class="service-icon"><i class="fas fa-receipt"></i></div>
        <div class="service-label">Pascabayar</div>
    </a>
    <a href="#" class="service-item">
        <div class="service-icon"><i class="fas fa-bolt"></i></div>
        <div class="service-label">Token Listrik</div>
    </a>
    <a href="#" class="service-item">
        <div class="service-icon"><i class="fas fa-ticket-alt"></i></div>
        <div class="service-label">TapCash</div>
    </a>
    <a href="#" class="service-item">
        <div class="service-icon"><i class="fab fa-google-pay"></i></div>
        <div class="service-label">Top up GoPay</div>
    </a>
    <a href="#" class="service-item">
        <div class="service-icon"><i class="fas fa-wallet"></i></div>
        <div class="service-label">Top up DANA</div>
    </a>
    <a href="#" class="service-item">
        <div class="service-icon"><i class="fas fa-credit-card"></i></div>
        <div class="service-label">Top up OVO</div>
    </a>
    <a href="#" class="service-item">
        <div class="service-icon"><i class="fas fa-bolt"></i></div>
        <div class="service-label">Tagihan Listrik</div>
    </a>
    <a href="#" class="service-item">
        <div class="service-icon"><i class="fas fa-tv"></i></div>
        <div class="service-label">Internet & TV Kabel</div>
    </a>
</div>

        <!-- News Section -->
       <div class="info-section">
            <div class="info-header">
                <h3 class="section-title">Informasi Terkini</h3>
                <a href="{{ route('user.pengumuman.index') }}" class="view-all-link">Lihat Semua</a>
            </div>

            @forelse($pengumuman as $item)
                <div class="news-item">
                    <div class="news-image">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" 
                                alt="{{ $item->judul }}" 
                                style="width:100%; height:100%; object-fit:cover; border-radius:8px;">
                        @endif
                    </div>
                    <div class="news-content">
                        <h6>{{ $item->judul }}</h6>
                        <p>{{ Str::limit($item->isi, 60, '...') }}</p>
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada pengumuman terbaru.</p>
            @endforelse
        </div>
</div>
@endsection
<!-- Tata Tertib Modal -->
<div class="modal fade" id="tataTertibModal" tabindex="-1" aria-labelledby="tataTertibLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="tataTertibLabel"><i class="fas fa-gavel me-2"></i> Tata Tertib Lingkungan</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>

      <div class="modal-body">
        <p class="mb-3 text-muted">Berikut adalah peraturan dan tata tertib yang harus dipatuhi demi kenyamanan bersama:</p>
        <ol style="padding-left: 20px;">
          <li>Menjaga kebersihan lingkungan dan tidak membuang sampah sembarangan.</li>
          <li>Patuh terhadap jadwal pengangkutan sampah dan gunakan tempat sampah yang disediakan.</li>
          <li>Dilarang melakukan aktivitas yang mengganggu ketertiban umum.</li>
          <li>Kendaraan parkir di tempat yang telah ditentukan dan tidak menghalangi akses.</li>
          <li>Pemilik hewan peliharaan bertanggung jawab atas kebersihan dan perilaku hewan.</li>
          <li>Setiap pemasangan pengumuman/iklan harus seizin pengelola.</li>
          <li>Pelanggaran tata tertib dapat dikenakan sanksi sesuai ketentuan pengelola.</li>
        </ol>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" id="printTataTertibBtn" class="btn btn-success">
          <i class="fas fa-print me-1"></i> Cetak
        </button>
      </div>
    </div>
  </div>
</div>


@push('scripts')
<script>
document.querySelectorAll('.bayar-home-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.dataset.id;
        fetch("{{ url('user/pembayaran') }}/" + id + "/bayar", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                this.classList.add('d-none');
                this.nextElementSibling.classList.remove('d-none');
            }
        });
    });
});

// Print Tata Tertib
document.addEventListener('DOMContentLoaded', function () {
  const printBtn = document.getElementById('printTataTertibBtn');
  if (printBtn) {
    printBtn.addEventListener('click', function () {
      const modalBody = document.querySelector('#tataTertibModal .modal-body');
      const printWindow = window.open('', '_blank', 'width=800,height=600');
      printWindow.document.write('<html><head><title>Tata Tertib</title></head><body>');
      printWindow.document.write(modalBody.innerHTML);
      printWindow.document.write('</body></html>');
      printWindow.document.close();
      setTimeout(() => {
        printWindow.print();
      }, 300);
    });
  }
});
</script>
@endpush


