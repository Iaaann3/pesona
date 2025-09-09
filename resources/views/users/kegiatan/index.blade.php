@extends('layouts.user')
@section('content')
<style>
    /* Background dan body styling */
    body {
        background: linear-gradient(135deg, #e8f4f8 0%, #f0f8ff 50%, #e6f3ff 100%);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    /* Floating background shapes */
    .floating-shapes { 
        position: fixed; 
        width: 100%; 
        height: 100%; 
        overflow: hidden; 
        z-index: 1; 
        top: 0;
        left: 0;
        pointer-events: none;
    }
    
    .shape { 
        position: absolute; 
        animation: float 6s ease-in-out infinite; 
        opacity: 0.7;
    }
    
    .shape-1 { 
        top: 15%; 
        left: 20%; 
        width: 40px; 
        height: 40px; 
        background: linear-gradient(45deg, #ff9a9e, #fecfef); 
        border-radius: 50% 20% 50% 20%; 
        animation-delay: 0s; 
    }
    
    .shape-2 { 
        top: 25%; 
        right: 15%; 
        width: 35px; 
        height: 35px; 
        background: linear-gradient(45deg, #a8edea, #fed6e3); 
        border-radius: 20% 50% 20% 50%; 
        animation-delay: 2s; 
    }
    
    .shape-3 { 
        bottom: 20%; 
        left: 15%; 
        width: 30px; 
        height: 30px; 
        background: linear-gradient(45deg, #d299c2, #fef9d7); 
        border-radius: 50%; 
        animation-delay: 4s; 
    }
    
    .shape-4 { 
        top: 60%; 
        right: 25%; 
        width: 25px; 
        height: 25px; 
        background: linear-gradient(45deg, #89f7fe, #66a6ff); 
        border-radius: 20%; 
        animation-delay: 1s; 
    }
    
    .shape-5 { 
        bottom: 40%; 
        right: 10%; 
        width: 20px; 
        height: 20px; 
        background: linear-gradient(45deg, #ffecd2, #fcb69f); 
        border-radius: 50%; 
        animation-delay: 3s; 
    }

    .shape-6 { 
        top: 40%; 
        left: 10%; 
        width: 28px; 
        height: 28px; 
        background: linear-gradient(45deg, #a8c8ec, #7faaff); 
        border-radius: 30% 70% 30% 70%; 
        animation-delay: 1.5s; 
    }

    .shape-7 { 
        top: 70%; 
        left: 30%; 
        width: 32px; 
        height: 32px; 
        background: linear-gradient(45deg, #ffc3a0, #ffab7d); 
        border-radius: 40% 60% 40% 60%; 
        animation-delay: 2.5s; 
    }

    .shape-8 { 
        bottom: 60%; 
        right: 40%; 
        width: 22px; 
        height: 22px; 
        background: linear-gradient(45deg, #c3a8ff, #b399f5); 
        border-radius: 50%; 
        animation-delay: 3.5s; 
    }
    
    @keyframes float { 
        0%, 100% { 
            transform: translateY(0px) rotate(0deg); 
            opacity: 0.7;
        } 
        25% { 
            transform: translateY(-15px) rotate(90deg); 
            opacity: 0.9;
        } 
        50% { 
            transform: translateY(-10px) rotate(180deg); 
            opacity: 0.6;
        } 
        75% { 
            transform: translateY(-20px) rotate(270deg); 
            opacity: 0.8;
        } 
    }

    /* Content wrapper dengan z-index lebih tinggi */
    .content-wrapper {
        position: relative;
        z-index: 10;
        min-height: 100vh;
        padding: 20px 0;
    }

    /* Header dengan animasi */
    .page-header {
        text-align: center;
        margin-bottom: 40px;
        animation: fadeInDown 1s ease-out;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #6c7ce0, #8e94f2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
        animation: slideInUp 1.2s ease-out;
    }

    .page-subtitle {
        font-size: 1.1rem;
        color: #6b7280;
        animation: slideInUp 1.4s ease-out;
    }

    /* Grid layout dengan animasi */
    .activities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        padding: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Card styling dengan animasi hover yang lebih smooth */
    .announcement-item {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(240, 240, 240, 0.8);
        transition: all 0.4s ease;
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
        position: relative;
    }

    .announcement-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(135deg, #34d399, #059669);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .announcement-item:hover::before {
        transform: scaleX(1);
    }

    .announcement-item:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        border-color: rgba(199, 231, 199, 0.8);
        background: rgba(255, 255, 255, 0.98);
    }

    /* Stagger animation untuk cards */
    .announcement-item:nth-child(1) { animation-delay: 0.1s; }
    .announcement-item:nth-child(2) { animation-delay: 0.2s; }
    .announcement-item:nth-child(3) { animation-delay: 0.3s; }
    .announcement-item:nth-child(4) { animation-delay: 0.4s; }
    .announcement-item:nth-child(5) { animation-delay: 0.5s; }
    .announcement-item:nth-child(6) { animation-delay: 0.6s; }
    .announcement-item:nth-child(7) { animation-delay: 0.7s; }
    .announcement-item:nth-child(8) { animation-delay: 0.8s; }
    .announcement-item:nth-child(9) { animation-delay: 0.9s; }

    /* Badge dengan animasi pulse */
    .badge {
        display: inline-block;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 20px;
        background: linear-gradient(135deg, #34d399, #059669);
        color: white;
        box-shadow: 0 3px 6px rgba(52, 211, 153, 0.3);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 3px 6px rgba(52, 211, 153, 0.3);
        }
        50% {
            box-shadow: 0 5px 15px rgba(52, 211, 153, 0.5);
        }
    }

    /* Title dengan hover effect yang lebih smooth */
    .announcement-item h2 {
        font-size: 1.1rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 6px;
        transition: all 0.3s ease;
        position: relative;
    }

    .announcement-item:hover h2 {
        color: #4f46e5;
        transform: translateX(5px);
    }

    /* Date dengan icon animasi */
    .date {
        font-size: 0.85rem;
        color: #6b7280;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: color 0.3s ease;
    }

    .announcement-item:hover .date {
        color: #4b5563;
    }

    /* Description dengan smooth transition */
    .desc {
        font-size: 0.9rem;
        color: #374151;
        line-height: 1.5;
        margin-bottom: 12px;
        transition: color 0.3s ease;
    }

    .announcement-item:hover .desc {
        color: #1f2937;
    }

    /* Link dengan animasi yang lebih menarik */
    .detail-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #4f46e5;
        transition: all 0.3s ease;
        text-decoration: none;
        position: relative;
        padding: 8px 16px;
        border-radius: 20px;
        background: rgba(79, 70, 229, 0.1);
    }

    .detail-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: #4f46e5;
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .detail-link:hover {
        color: #1e3a8a;
        background: rgba(79, 70, 229, 0.15);
        transform: translateY(-2px);
    }

    .detail-link:hover::after {
        width: 80%;
    }

    /* Pagination styling */
    .pagination-wrapper {
        margin-top: 60px;
        display: flex;
        justify-content: center;
        animation: fadeInUp 1s ease-out;
        position: relative;
        z-index: 10;
    }

    /* Keyframes untuk animasi */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .activities-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px 15px;
        }

        .page-title {
            font-size: 2rem;
        }

        .page-subtitle {
            font-size: 1rem;
            padding: 0 20px;
        }

        .shape {
            opacity: 0.4;
        }

        .shape-1, .shape-2, .shape-3, .shape-4, .shape-5, .shape-6, .shape-7, .shape-8 {
            width: 20px;
            height: 20px;
        }
    }

    @media (max-width: 480px) {
        .activities-grid {
            grid-template-columns: 1fr;
            padding: 15px 10px;
        }

        .page-title {
            font-size: 1.8rem;
        }
    }

    /* Mouse follow effect untuk shapes */
    .shape.interactive {
        transition: transform 0.3s ease;
    }
</style>

<!-- Background Floating Shapes -->
<div class="floating-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    <div class="shape shape-4"></div>
    <div class="shape shape-5"></div>
    <div class="shape shape-6"></div>
    <div class="shape shape-7"></div>
    <div class="shape shape-8"></div>
</div>

<div class="content-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title"> Kegiatan Terbaru</h1>
        <p class="page-subtitle">Temukan berbagai kegiatan menarik yang tersedia</p>
    </div>

    @if($kegiatan->isEmpty())       
        @include ('layouts.kegiatan.oops')
    @else
        {{-- Grid kegiatan --}}
        <div class="activities-grid">
            @foreach($kegiatan as $item)
                <div class="announcement-item">
                    <div class="p-5">
                        <div class="flex justify-between items-center mb-2">
                            <span class="badge">
                                🗓️ Kegiatan
                            </span>
                            <span class="text-gray-500 text-xs flex items-center gap-1 italic">
                                📍 {{ $item->lokasi }}
                            </span>
                        </div>
                        <h2>
                            {{ ucfirst($item->nama_kegiatan) }}
                        </h2>
                        {{-- Tanggal kegiatan --}}
                        <p class="date">
                            🗓️ {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </p>
                        <p class="desc">
                            {{ Str::limit($item->deskripsi, 110) }}
                        </p>
                        <a href="{{ route('user.kegiatan.show', $item->id) }}" class="detail-link">
                            📋 Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="pagination-wrapper">
            {{ $kegiatan->links('pagination::tailwind') }}
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Interactive mouse follow effect untuk shapes
    document.addEventListener('mousemove', function(e) {
        const shapes = document.querySelectorAll('.shape');
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;
        
        shapes.forEach((shape, index) => {
            const speed = (index + 1) * 0.3;
            const x = (mouseX - 0.5) * speed * 15;
            const y = (mouseY - 0.5) * speed * 15;
            shape.style.transform += ` translate(${x}px, ${y}px)`;
        });
    });

    // Intersection Observer untuk animasi on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.transform = 'translateY(0) scale(1)';
                entry.target.style.opacity = '1';
            }
        });
    }, observerOptions);

    // Observe semua cards
    document.querySelectorAll('.announcement-item').forEach(card => {
        observer.observe(card);
    });

    // Smooth scroll untuk pagination links
    document.querySelectorAll('a[href*="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.includes('#')) {
                e.preventDefault();
                const target = document.querySelector(href.split('#')[1]);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // Add loading animation effect
    window.addEventListener('load', function() {
        document.body.classList.add('loaded');
    });
});
</script>

@endsection