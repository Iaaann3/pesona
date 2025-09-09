@extends('layouts.user')

@section('content')
    <style>
        /* General Styling */
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        /* Profile Header */
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #6012adff 100%);
            padding: 40px;
            border-radius: 10px 10px 20px 20px;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before, .profile-header::after {
            content: '';
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .profile-header::before {
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
        }

        .profile-header::after {
            bottom: -30%;
            left: -10%;
            width: 150px;
            height: 150px;
            animation-duration: 8s;
            animation-direction: reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-20px) scale(1.1); }
        }

        .profile-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: relative;
            z-index: 2;
        }

        .profile-info h1 {
            color: white;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .profile-info .house-number {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            font-weight: 500;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #076b06ff, #054b04ff);
            border: 4px solid rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
        }
        
        /* Profile Details Section */
        .profile-details {
            padding: 40px;
            background: #f8f9ff;
        }

        .detail-item {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-left: 4px solid #667eea;
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
        }

        .detail-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .detail-item:last-child {
            margin-bottom: 0;
        }

        .detail-value {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .detail-label {
            font-size: 14px;
            color: #718096;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Dashboard Section */
        .dashboard-section {
            padding: 40px;
            text-align: center;
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .dashboard-subtitle {
            color: #718096;
            font-size: 16px;
            margin-bottom: 40px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            align-items: start;
        }

        /* Main Card - Prospek */
        .main-card {
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
            border-radius: 20px;
            padding: 40px;
            color: white;
            position: relative;
            overflow: hidden;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
            animation-delay: 0.4s;
        }

        .main-number {
            font-size: 72px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .main-label {
            font-size: 20px;
            font-weight: 500;
            opacity: 0.9;
        }

        /* Stats Cards */
        .stats-cards {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
        }

        .stat-card:nth-child(1) { animation-delay: 0.5s; }
        .stat-card:nth-child(2) { animation-delay: 0.6s; }
        .stat-card:nth-child(3) { animation-delay: 0.7s; }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .stat-icon.green { background: linear-gradient(135deg, #48bb78, #38a169); }
        .stat-icon.blue { background: linear-gradient(135deg, #4299e1, #3182ce); }
        .stat-icon.purple { background: linear-gradient(135deg, #9f7aea, #805ad5); }

        .stat-content {
            flex: 1;
            text-align: right;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            line-height: 1;
        }

        .stat-label {
            font-size: 14px;
            color: #718096;
            font-weight: 500;
            margin-top: 5px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .dashboard-grid { grid-template-columns: 1fr; }
            .stats-cards { flex-direction: row; flex-wrap: wrap; }
            .stat-card { flex: 1; min-width: 250px; }
        }

        @media (max-width: 768px) {
            .container { margin: 10px; border-radius: 15px; }
            .profile-header { padding: 30px 20px; }
            .profile-top { flex-direction: column; text-align: center; gap: 20px; }
            .profile-info h1 { font-size: 28px; }
            .profile-details, .dashboard-section { padding: 30px 20px; }
            .main-card { padding: 30px 20px; }
            .main-number { font-size: 60px; }
            .stats-cards { flex-direction: column; }
            .stat-card { min-width: auto; }
        }

        @media (max-width: 480px) {
            .profile-info h1 { font-size: 24px; }
            .main-number { font-size: 48px; }
            .stat-card { padding: 20px 15px; }
            .stat-number { font-size: 24px; }
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 16px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.2s;
            z-index: 10;
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.35);
            transform: translateX(-3px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    
    <div class="container">
        <div class="profile-header">            
            <div class="profile-top">
                <div class="profile-info">
                    <h1>{{ $user->name }}</h1>
                    <div class="house-number">No. Rumah : {{ $user->no_rumah }}</div>
                </div>
                <!-- <div class="profile-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div> -->
            </div>
        </div>
        <div class="profile-details">
            <div class="detail-item">
                <div class="detail-value">{{ $user->no_tlp ?? '-' }}</div>
                <div class="detail-label">No. Telp</div>
            </div>

            <div class="detail-item">
                <div class="detail-value">{{ $user->email }}</div>
                <div class="detail-label">E-mail</div>
            </div>

            <div class="detail-item">
                <div class="detail-value">{{ $user->alamat ?? '-' }}</div>
                <div class="detail-label">Alamat</div>
            </div>
        </div>

        <div class="dashboard-section">
            <h2 class="dashboard-title">YOUR DASHBOARD</h2>
            <p class="dashboard-subtitle">A quick overview of your activities</p>

            <div class="dashboard-grid">
                <div class="main-card">
                    <div class="main-number" id="prospekNumber">0</div>
                    <div class="main-label">Prospek</div>
                </div>
                
                <div class="stats-cards">
                    <div class="stat-card">
                        <div class="stat-icon green">👥</div>
                        <div class="stat-content">
                            <div class="stat-number">{{ $iklanCount }}</div>
                            <div class="stat-label">Iklan Saya</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon blue">📧</div>
                        <div class="stat-content">
                            <div class="stat-number" id="ticketsNumber">0</div>
                            <div class="stat-label">Tickets</div>
                        </div>
                    </div>

                    <a href="{{ route('user.saran.index') }}" class="stat-card">
                        <div class="stat-icon purple">💬</div>
                        <div class="stat-content">
                            <div class="stat-number">{{ $kritikCount }}</div>
                            <div class="stat-label">Kritik/Saran</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to animate numbers
            function animateNumber(elementId, targetNumber) {
                const element = document.getElementById(elementId);
                if (!element) return;
                
                const startNumber = 0;
                const duration = 2000;
                let startTime = null;

                const step = (timestamp) => {
                    if (!startTime) startTime = timestamp;
                    const progress = timestamp - startTime;
                    const currentNumber = Math.min(progress / duration, 1) * targetNumber;
                    element.textContent = Math.floor(currentNumber);

                    if (progress < duration) {
                        window.requestAnimationFrame(step);
                    } else {
                        element.textContent = targetNumber;
                    }
                };

                window.requestAnimationFrame(step);
            }

            // Animate numbers on page load
            animateNumber('prospekNumber', 0);
            animateNumber('ticketsNumber', 0);

            // Fetch dynamic counts (optional, if you use a separate endpoint)
            // Example:
            // fetch('/api/user/dashboard-data')
            //     .then(response => response.json())
            //     .then(data => {
            //         animateNumber('prospekNumber', data.prospek);
            //         animateNumber('ticketsNumber', data.tickets);
            //     });
        });
    </script>
@endpush