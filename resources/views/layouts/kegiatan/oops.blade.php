<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oops... - Tidak Ada Kegiatan</title>
    <style>
        /* Semua CSS kamu tetap */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e8f4f8 0%, #f0f8ff 50%, #e6f3ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        /* Floating decorative elements */
        .floating-shapes { position: absolute; width: 100%; height: 100%; overflow: hidden; z-index: 1; }
        .shape { position: absolute; animation: float 6s ease-in-out infinite; }
        .shape-1 { top: 15%; left: 20%; width: 40px; height: 40px; background: linear-gradient(45deg, #ff9a9e, #fecfef); border-radius: 50% 20% 50% 20%; animation-delay: 0s; }
        .shape-2 { top: 25%; right: 15%; width: 35px; height: 35px; background: linear-gradient(45deg, #a8edea, #fed6e3); border-radius: 20% 50% 20% 50%; animation-delay: 2s; }
        .shape-3 { bottom: 20%; left: 15%; width: 30px; height: 30px; background: linear-gradient(45deg, #d299c2, #fef9d7); border-radius: 50%; animation-delay: 4s; }
        .shape-4 { top: 60%; right: 25%; width: 25px; height: 25px; background: linear-gradient(45deg, #89f7fe, #66a6ff); border-radius: 20%; animation-delay: 1s; }
        .shape-5 { bottom: 40%; right: 10%; width: 20px; height: 20px; background: linear-gradient(45deg, #ffecd2, #fcb69f); border-radius: 50%; animation-delay: 3s; }
        @keyframes float { 0%, 100% { transform: translateY(0px) rotate(0deg); } 25% { transform: translateY(-15px) rotate(90deg); } 50% { transform: translateY(-10px) rotate(180deg); } 75% { transform: translateY(-20px) rotate(270deg); } }
        .container { text-align: center; z-index: 10; position: relative; }
        .phone-stack { position: relative; display: inline-block; margin-bottom: 40px; }
        .phone { width: 200px; height: 350px; border-radius: 25px; position: relative; box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1); overflow: hidden; border: 3px solid #6c7ce0; }
        .phone-main { background: linear-gradient(135deg, #ffc0cb, #ffb3e6); z-index: 3; position: relative; }
        .phone-left { background: linear-gradient(135deg, #a8f0c8, #7fefb3); position: absolute; left: -60px; top: 20px; z-index: 2; transform: rotate(-15deg); }
        .phone-right { background: linear-gradient(135deg, #b3d9ff, #9bc9ff); position: absolute; right: -60px; top: -20px; z-index: 1; transform: rotate(15deg); }
        .phone-header { height: 60px; background: rgba(255, 255, 255, 0.3); display: flex; align-items: center; justify-content: center; border-bottom: 1px solid rgba(255, 255, 255, 0.2); }
        .header-dots { display: flex; gap: 6px; }
        .dot { width: 8px; height: 8px; background: rgba(255, 255, 255, 0.8); border-radius: 50%; }
        .phone-content { padding: 30px 25px; height: calc(100% - 60px); display: flex; flex-direction: column; align-items: center; justify-content: center; }
        .search-icon { width: 50px; height: 50px; background: rgba(255, 255, 255, 0.4); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; font-size: 24px; color: #6c7ce0; }
        .content-lines { width: 100%; margin-bottom: 30px; }
        .line { height: 8px; background: rgba(255, 255, 255, 0.4); border-radius: 4px; margin-bottom: 8px; }
        .line:nth-child(1) { width: 80%; margin: 0 auto 8px; }
        .line:nth-child(2) { width: 60%; margin: 0 auto 8px; }
        .line:nth-child(3) { width: 90%; margin: 0 auto 8px; }
        .line:nth-child(4) { width: 40%; margin: 0 auto 8px; }
        .side-numbers { position: absolute; font-size: 60px; font-weight: bold; color: rgba(255, 255, 255, 0.9); top: 50%; transform: translateY(-50%); }
        .number-left { left: 30px; color: #2d8f5f; }
        .number-right { right: 30px; color: #4a90e2; }
        .error-text { margin-top: 40px; }
        .oops-title { font-size: 48px; font-weight: 300; color: #8e9aaf; margin-bottom: 15px; animation: fadeInUp 1s ease-out; }
        .error-message { font-size: 18px; color: #a8b2c8; margin-bottom: 30px; animation: fadeInUp 1s ease-out 0.2s both; }
        .back-button { display: inline-flex; align-items: center; gap: 10px; padding: 12px 30px; background: linear-gradient(135deg, #6c7ce0, #8e94f2); color: white; text-decoration: none; border-radius: 25px; font-weight: 500; transition: all 0.3s ease; box-shadow: 0 8px 20px rgba(108, 124, 224, 0.3); animation: fadeInUp 1s ease-out 0.4s both; }
        .back-button:hover { transform: translateY(-2px); box-shadow: 0 12px 25px rgba(108, 124, 224, 0.4); }
        .back-button:active { transform: translateY(0); }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .phone-stack { animation: phoneFloat 4s ease-in-out infinite; }
        @keyframes phoneFloat { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-15px); } }
        .phone-main .content-lines .line { animation: contentPulse 2s ease-in-out infinite; }
        .phone-main .content-lines .line:nth-child(2) { animation-delay: 0.3s; }
        .phone-main .content-lines .line:nth-child(3) { animation-delay: 0.6s; }
        .phone-main .content-lines .line:nth-child(4) { animation-delay: 0.9s; }
        @keyframes contentPulse { 0%, 100% { opacity: 0.4; } 50% { opacity: 0.8; } }
        .heart { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); color: rgba(255, 255, 255, 0.6); font-size: 20px; animation: heartbeat 2s ease-in-out infinite; }
        @keyframes heartbeat { 0%, 100% { transform: translateX(-50%) scale(1); } 50% { transform: translateX(-50%) scale(1.2); } }
        @media (max-width: 768px) { .phone { width: 160px; height: 280px; } .phone-left, .phone-right { width: 160px; height: 280px; } .side-numbers { font-size: 40px; } .oops-title { font-size: 36px; } .error-message { font-size: 16px; padding: 0 20px; } }
        @media (max-width: 480px) { .phone { width: 140px; height: 240px; } .phone-left, .phone-right { width: 140px; height: 240px; } .side-numbers { font-size: 30px; } .number-left { left: 15px; } .number-right { right: 15px; } .oops-title { font-size: 32px; } }
    </style>
</head>
<body>
    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phones = document.querySelectorAll('.phone');
            phones.forEach(phone => {
                phone.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => { this.style.transform = ''; }, 150);
                });
            });
            document.addEventListener('mousemove', function(e) {
                const shapes = document.querySelectorAll('.shape');
                const mouseX = e.clientX / window.innerWidth;
                const mouseY = e.clientY / window.innerHeight;
                shapes.forEach((shape, index) => {
                    const speed = (index + 1) * 0.5;
                    const x = (mouseX - 0.5) * speed * 20;
                    const y = (mouseY - 0.5) * speed * 20;
                    shape.style.transform = `translate(${x}px, ${y}px)`;
                });
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    document.querySelector('.back-button').click();
                }
                if (e.key === 'Escape') {
                    history.back();
                }
            });
        });
    </script>
</body>
</html>