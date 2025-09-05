<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PP8B')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
    /* Paste semua CSS dari dashboard di sini, tanpa diubah sama sekali */
    .mobile-container { max-width: 1200px; margin: 0 auto; background: white; min-height: 100vh; position: relative; overflow: hidden; }
    .header-section { background: linear-gradient(135deg, #029e48ff 0%, #023914ff 100%); color: white; padding: 40px 30px 140px 30px; position: relative; border-radius: 30px 30px 0 0; }
    .profile-avatar { position: absolute; top: 30px; right: 30px; width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255,255,255,0.3); }
    .profile-avatar i { font-size: 24px; color: white; }
    .greeting-text { font-size: 16px; opacity: 0.9; margin-bottom: 8px; }
    .user-name { font-size: 28px; font-weight: 700; margin: 0; }
    .balance-card { position: absolute; bottom: -70px; left: 30px; right: 30px; background: white; border-radius: 20px; padding: 25px; box-shadow: 0 12px 40px rgba(0,0,0,0.12); }
    .balance-info { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .balance-label { font-size: 14px; color: #6b7280; margin: 0 0 5px 0; }
    .balance-amount { font-size: 32px; font-weight: 700; color: #111827; margin: 0; }
    .balance-detail { font-size: 12px; color: #3ad61eff; text-decoration: none; font-weight: 500; }
    .topup-btn { background: #079813ff; color: white; border: none; border-radius: 14px; padding: 12px 24px; font-size: 16px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
    .check-bill-btn { background: #058022ff; color: white; border: none; border-radius: 18px; padding: 18px; font-size: 18px; font-weight: 600; width: 100%; margin: 40px 0; display: flex; align-items: center; justify-content: center; gap: 12px; }
    .main-content { padding: 90px 30px 30px 30px; }
    .section-title { font-size: 22px; font-weight: 700; color: #111827; margin-bottom: 25px; }
    .service-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 25px; margin-bottom: 40px; max-width: 1200px; }
    .service-item { text-align: center; text-decoration: none; color: inherit; }
    .service-icon { width: 64px; height: 64px; background: #18af45ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px auto; color: white; font-size: 24px; }
    .service-label { font-size: 15px; font-weight: 600; color: #374151; }
    .info-section { margin-top: 30px; }
    .info-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .view-all-link { color: #3b82f6; font-size: 14px; font-weight: 600; text-decoration: none; }
    .news-item { display: flex; gap: 12px; padding: 10px 0; }
    .news-image { width: 70px; height: 70px; border-radius: 8px; background: #e5e7eb; flex-shrink: 0; }
    .news-content h6 { font-size: 15px; font-weight: 600; color: #111827; margin: 0 0 4px 0; line-height: 1.3; }
    .news-content p { font-size: 13px; color: #6b7280; margin: 0; line-height: 1.3; }

    /* Media Queries tetap sama persis */
    @media (max-width: 768px) {
        .mobile-container { max-width: 400px; }
        .header-section { padding: 30px 20px 120px 20px; }
        .profile-avatar { top: 20px; right: 20px; width: 50px; height: 50px; }
        .profile-avatar i { font-size: 20px; }
        .greeting-text { font-size: 14px; margin-bottom: 5px; }
        .user-name { font-size: 22px; }
        .balance-card { bottom: -60px; left: 20px; right: 20px; padding: 20px; border-radius: 16px; }
        .balance-amount { font-size: 24px; }
        .topup-btn { padding: 10px 20px; font-size: 14px; border-radius: 12px; gap: 8px; }
        .check-bill-btn { border-radius: 16px; padding: 16px; font-size: 16px; margin: 30px 0; gap: 10px; }
        .main-content { padding: 80px 20px 20px 20px; }
        .section-title { font-size: 18px; margin-bottom: 20px; }
        .service-grid { grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .service-icon { width: 56px; height: 56px; margin-bottom: 12px; font-size: 20px; }
        .service-label { font-size: 13px; }
        .news-image { width: 60px; height: 60px; }
        .news-content h6 { font-size: 13px; }
        .news-content p { font-size: 11px; }

        
    }

        @yield('styles')
    </style>

</head>
<body>
    @include('layouts.components.header')
    @yield('content')
        @stack('scripts')
    @include('layouts.components.bottomnav')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
