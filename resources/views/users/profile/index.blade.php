
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Dashboard - Hingki Zulfikar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        /* Header Section */
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .profile-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite reverse;
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
            background: linear-gradient(135deg, #667eea, #764ba2);
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
        }

        .main-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.05) 50%, transparent 70%);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
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
        }

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

        .stat-icon.green {
            background: linear-gradient(135deg, #48bb78, #38a169);
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #4299e1, #3182ce);
        }

        .stat-icon.purple {
            background: linear-gradient(135deg, #9f7aea, #805ad5);
        }

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
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-cards {
                flex-direction: row;
                flex-wrap: wrap;
            }
            
            .stat-card {
                flex: 1;
                min-width: 250px;
            }
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .profile-header {
                padding: 30px 20px;
            }

            .profile-top {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .profile-info h1 {
                font-size: 28px;
            }

            .profile-details,
            .dashboard-section {
                padding: 30px 20px;
            }

            .main-card {
                padding: 30px 20px;
            }

            .main-number {
                font-size: 60px;
            }

            .stats-cards {
                flex-direction: column;
            }

            .stat-card {
                min-width: auto;
            }
        }

        @media (max-width: 480px) {
            .profile-info h1 {
                font-size: 24px;
            }

            .main-number {
                font-size: 48px;
            }

            .stat-card {
                padding: 20px 15px;
            }

            .stat-number {
                font-size: 24px;
            }
        }

        /* Loading Animation */
        .loading {
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
        }

        .loading:nth-child(1) { animation-delay: 0.1s; }
        .loading:nth-child(2) { animation-delay: 0.2s; }
        .loading:nth-child(3) { animation-delay: 0.3s; }
        .loading:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-top">
                <div class="profile-info">
                    <h1>{{ $user->name }}</h1>
                    <div class="house-number">No. Rumah : {{ $user->no_rumah }}</div>
                </div>
                <div class="profile-avatar">
                    {{ strtoupper(substr($user->name,0,1)) }}
                </div>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="profile-details">
            <!-- <div class="detail-item loading">
                <div class="detail-value">{{ $user->phone ?? '-' }}</div>
                <div class="detail-label">No. Telp</div>
            </div> -->

            <div class="detail-item loading">
                <div class="detail-value">{{ $user->email }}</div>
                <div class="detail-label">E-mail</div>
            </div>

            <!-- <div class="detail-item loading">
                <div class="detail-value">{{ $user->alamat ?? '-' }}</div>
                <div class="detail-label">Alamat</div>
            </div> -->
        </div>

        <!-- Dashboard Section -->
        <div class="dashboard-section">
            <h2 class="dashboard-title">YOUR DASHBOARD</h2>
            <p class="dashboard-subtitle">Coming Soon</p>

            <div class="dashboard-grid">
                <!-- Main Prospek Card -->
                

                <!-- Stats Cards -->
                <div class="stats-cards">
                    <div class="stat-card loading">
                        <div class="stat-icon green">👥</div>
                        <div class="stat-content">
                            <div class="stat-number">{{ $iklanCount }}</div>
                            <div class="stat-label">Iklan Saya</div>
                        </div>
                    </div>

                    <a href="{{ route('user.saran.index') }}" class="stat-card loading block">
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

    <script>
        // Animate numbers on page load
        function animateNumber(elementId, targetNumber, duration = 2000) {
            const element = document.getElementById(elementId);
            const startNumber = 0;
            const increment = targetNumber / (duration / 16); // 60fps
            let currentNumber = startNumber;

            const timer = setInterval(() => {
                currentNumber += increment;
                if (currentNumber >= targetNumber) {
                    currentNumber = targetNumber;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(currentNumber);
            }, 16);
        }

        // Initialize animations when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading classes for stagger animation
            const loadingElements = document.querySelectorAll('.loading');
            loadingElements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });

            // Animate numbers after delay
            setTimeout(() => {
                animateNumber('prospekNumber', 0, 1000);
                animateNumber('iklanNumber', 0, 1200);
                animateNumber('ticketsNumber', 0, 1400);
                animateNumber('kritikNumber', 0, 1600);
            }, 800);

            // Add hover effects to cards
            const cards = document.querySelectorAll('.detail-item, .stat-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                });
            });

            // Add click effects
            const clickableCards = document.querySelectorAll('.stat-card, .main-card');
            clickableCards.forEach(card => {
                card.addEventListener('click', function() {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });
        });

        // Update profile data (you can call this function with real data)
        function updateProfileData(data) {
            if (data.prospek !== undefined) {
                animateNumber('prospekNumber', data.prospek);
            }
            if (data.iklanSaya !== undefined) {
                animateNumber('iklanNumber', data.iklanSaya);
            }
            if (data.tickets !== undefined) {
                animateNumber('ticketsNumber', data.tickets);
            }
            if (data.kritikSaran !== undefined) {
                animateNumber('kritikNumber', data.kritikSaran);
            }
        }

        // Example of updating data:
        // updateProfileData({
        //     prospek: 5,
        //     iklanSaya: 12,
        //     tickets: 3,
        //     kritikSaran: 8
        // });
    </script>
</body>
</html>


