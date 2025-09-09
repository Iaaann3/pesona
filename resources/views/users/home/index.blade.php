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
            <button type="button" 
        class="topup-btn bayar-home-btn" 
        data-id="{{ $tagihan->id }}" 
        data-bs-toggle="modal" 
        data-bs-target="#pembayaranModal">
    Bayar
</button>
            <!-- <div class="bayar-success-anim d-none mt-2">
                <i class="fas fa-check-circle fa-2x text-success animate__animated animate__bounceIn"></i>
                <span class="text-success ms-2">Pembayaran Berhasil!</span>
            </div> -->
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

        <!-- Iklan Carousel Section -->
        @if(isset($iklan) && $iklan->count() > 0)
        <div style="overflow: hidden; width: 100%; margin-bottom: 20px;">
            <div style="display: flex; animation: scrollCarousel {{ $iklan->count() * 3 }}s linear infinite; width: max-content;">
                @foreach($iklan as $item)
                    <div style="flex-shrink: 0; margin-right: 15px; min-width: 300px;">
                        <div style="background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%); border-radius: 12px; padding: 0; color: white; position: relative; box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3); cursor: pointer; overflow: hidden;">
                            <!-- Badge IKLAN -->
                            <div style="position: absolute; top: 8px; right: 8px; background: rgba(255, 255, 255, 0.9); color: #333; padding: 4px 8px; border-radius: 12px; font-size: 10px; font-weight: bold; z-index: 2;">IKLAN</div>
                            
                            @if($item->gambar)
                                <!-- Dengan Gambar -->
                                <div style="position: relative;">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" 
                                         alt="{{ $item->judul }}" 
                                         style="width: 100%; height: 120px; object-fit: cover;">
                                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); padding: 15px 15px 10px;">
                                        <h6 style="margin: 0; font-size: 14px; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.5);">{{ $item->judul }}</h6>
                                        <p style="margin: 3px 0 0 0; font-size: 11px; opacity: 0.9; text-shadow: 0 1px 1px rgba(0,0,0,0.5);">{{ Str::limit($item->deskripsi, 50) }}</p>
                                    </div>
                                </div>
                            @else
                                <!-- Tanpa Gambar -->
                                <div style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="font-size: 24px; opacity: 0.9;">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                        <div>
                                            <h6 style="margin: 0; font-size: 14px; font-weight: 600; line-height: 1.3;">{{ $item->judul }}</h6>
                                            <p style="margin: 3px 0 0 0; font-size: 11px; opacity: 0.8; line-height: 1.3;">{{ Str::limit($item->deskripsi, 60) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                <!-- Duplicate untuk seamless loop -->
                @foreach($iklan as $item)
                    <div style="flex-shrink: 0; margin-right: 15px; min-width: 300px;">
                        <div style="background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%); border-radius: 12px; padding: 0; color: white; position: relative; box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3); cursor: pointer; overflow: hidden;">
                            <!-- Badge IKLAN -->
                            <div style="position: absolute; top: 8px; right: 8px; background: rgba(255, 255, 255, 0.9); color: #333; padding: 4px 8px; border-radius: 12px; font-size: 10px; font-weight: bold; z-index: 2;">IKLAN</div>
                            
                            @if($item->gambar)
                                <!-- Dengan Gambar -->
                                <div style="position: relative;">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" 
                                         alt="{{ $item->judul }}" 
                                         style="width: 100%; height: 120px; object-fit: cover;">
                                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); padding: 15px 15px 10px;">
                                        <h6 style="margin: 0; font-size: 14px; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.5);">{{ $item->judul }}</h6>
                                        <p style="margin: 3px 0 0 0; font-size: 11px; opacity: 0.9; text-shadow: 0 1px 1px rgba(0,0,0,0.5);">{{ Str::limit($item->deskripsi, 50) }}</p>
                                    </div>
                                </div>
                            @else
                                <!-- Tanpa Gambar -->
                                <div style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="font-size: 24px; opacity: 0.9;">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                        <div>
                                            <h6 style="margin: 0; font-size: 14px; font-weight: 600; line-height: 1.3;">{{ $item->judul }}</h6>
                                            <p style="margin: 3px 0 0 0; font-size: 11px; opacity: 0.8; line-height: 1.3;">{{ Str::limit($item->deskripsi, 60) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <style>
            @keyframes scrollCarousel {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
        </style>
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
        <div class="service-icon"><i class="fas fa-receipt"></i></div>
        <div class="service-label">Pascabayar</div>
    </a>
    <a href="#" class="service-item">
        <div class="service-icon"><i class="fas fa-bolt"></i></div>
        <div class="service-label">Token Listrik</div>
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

<!-- Modal Pembayaran -->
<div class="modal fade" id="pembayaranModal" tabindex="-1" aria-labelledby="pembayaranLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="formPembayaran" action="{{ route('user.bayar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="pembayaranLabel">
            <i class="fas fa-credit-card me-2"></i> Konfirmasi Pembayaran
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id_tagihan" id="id_tagihan">

            <div class="mb-3">
                <label class="form-label">Pilih Rekening Tujuan</label>
                <select class="form-select" id="rekeningSelect" name="rekening_id" required>
                    <option value="">Pilih Bank</option>
                    @foreach($rekenings as $rek)
                        <option value="{{ $rek->id }}" data-number="{{ $rek->number }}">
                            {{ $rek->bank_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Rekening</label>
                <input type="text" id="noRekening" class="form-control" readonly>
            </div>

          <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Upload Bukti Transfer</label>
            <input type="file" class="form-control" name="bukti_pembayaran" accept="image/*" required>
            <small class="text-muted">Format: JPG/PNG, max 2MB</small>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Kirim</button>
        </div>
      </form>
    </div>
  </div>
</div>


@push('styles')
<style>
/* Carousel Styles */
.info-carousel-container {
    overflow: hidden;
    width: 100%;
    position: relative;
}

.info-carousel {
    overflow: hidden;
    width: 100%;
}

.carousel-track {
    display: flex;
    animation: scroll 20s linear infinite;
    width: max-content;
}

.carousel-item {
    flex-shrink: 0;
    margin-right: 15px;
    min-width: 280px;
}

.member-card {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border-radius: 12px;
    padding: 15px;
    color: white;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    transition: transform 0.3s ease;
    cursor: pointer;
}

.member-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
}

.member-card.promo-card {
    background: linear-gradient(135deg, #fd7e14 0%, #ffc107 100%);
    box-shadow: 0 4px 15px rgba(253, 126, 20, 0.3);
}

.member-card.info-card {
    background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
}

.member-card.event-card {
    background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
}

.member-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: rgba(255, 255, 255, 0.2);
    padding: 5px 10px;
    border-radius: 0 12px 0 12px;
    font-size: 10px;
    font-weight: bold;
    letter-spacing: 1px;
}

.promo-badge {
    background: rgba(255, 255, 255, 0.25);
}

.info-badge {
    background: rgba(255, 255, 255, 0.25);
}

.event-badge {
    background: rgba(255, 255, 255, 0.25);
}

.member-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.member-icon {
    font-size: 24px;
    opacity: 0.9;
}

.member-text h6 {
    margin: 0;
    font-size: 14px;
    font-weight: 600;
    line-height: 1.2;
}

.member-text p {
    margin: 2px 0 0 0;
    font-size: 11px;
    opacity: 0.8;
    line-height: 1.2;
}

/* Carousel Animation */
@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

/* Pause animation on hover */
.carousel-track:hover {
    animation-play-state: paused;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .carousel-item {
        min-width: 250px;
        margin-right: 12px;
    }
    
    .member-card {
        padding: 12px;
    }
    
    .member-text h6 {
        font-size: 13px;
    }
    
    .member-text p {
        font-size: 10px;
    }
}
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const selectBank = document.querySelector('select[name="rekening_id"]');
    const noRekening = document.getElementById("noRekening");

    selectBank.addEventListener("change", function () {
      const selectedOption = this.options[this.selectedIndex];
      const number = selectedOption.getAttribute("data-number");
      noRekening.value = number ? number : "";
    });
  });

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
document.addEventListener('DOMContentLoaded', function () {
    const bayarBtns = document.querySelectorAll('.bayar-home-btn');
    const formPembayaran = document.getElementById('formPembayaran');
    const tagihanInput = document.getElementById('id_tagihan');

    bayarBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            tagihanInput.value = id;
        });
    });
});


// Carousel click handlers (optional)
document.addEventListener('DOMContentLoaded', function() {
    const memberCards = document.querySelectorAll('.member-card');
    
    memberCards.forEach(card => {
        card.addEventListener('click', function() {
            const cardType = this.classList.contains('promo-card') ? 'promo' :
                           this.classList.contains('info-card') ? 'info' :
                           this.classList.contains('event-card') ? 'event' : 'member';
            
            // You can add specific actions here based on card type
            console.log('Clicked on:', cardType);
            
            // Example: Show different modals or navigate to different pages
            switch(cardType) {
                case 'promo':
                    // Handle promo card click
                    break;
                case 'info':
                    // Handle info card click  
                    break;
                case 'event':
                    // Handle event card click
                    break;
                default:
                    // Handle member card click
                    break;
            }
        });
    });
});
</script>
@endpush