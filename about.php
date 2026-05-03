<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kisah Di Balik Runora</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
    .hero-run {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                    url('https://images.unsplash.com/photo-1530143311094-34d807799e8f?q=80&w=2000&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        background-attachment: fixed; 
        border-radius: 40px;
        margin-bottom: 50px;
    }

    .hero-title {
        font-weight: 350;
        text-shadow: 2px 4px 10px rgba(0,0,0,0.3);
        letter-spacing: -1.5px;
    }

    .shadow-text {
        text-shadow: 1px 2px 4px rgba(0,0,0,0.5);
        max-width: 700px;
        margin: 0 auto;
    }
        
        .feature-box {
            border: 1px solid #eee;
            border-radius: 24px;
            padding: 40px 30px;
            height: 100%;
            transition: 0.3s;
        }

        .feature-box:hover {
            border-color: #000;
            background: #fafafa;
        }

        .dev-story {
            background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
            color: #fff;
            border-radius: 32px;
            padding: 60px 40px;
        }

        .badge-pill {
            background: rgba(255,255,255,0.1);
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 0.75rem;
            margin: 5px;
            display: inline-block;
        }

        .btn-runora {
            background: #979595;
            color: #fff;
            padding: 16px 40px;
            border-radius: 100px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-runora:hover {
            background: #333;
            color: #fff;
            transform: scale(1.02);
        }
    </style>
</head>
<body>

<div class="container py-5">

<!-- HERO SECTION -->
<section class="hero-run">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10">
                <h1 class="hero-title display-3 mb-3 text-white">
                    Lari Bukan Sekadar Gerak,<br>Tapi Tentang Kebebasan.
                </h1>
                <p class="lead text-white-50 shadow-text">
                    <span class="fw-bold">Runora lahir dari ide sederhana: teknologi terbaik harus bisa</span> dinikmati siapa saja yang berani melangkah.
                </p>
            </div>
        </div>
    </div>
</section>


    <!-- FEATURES-->
 <div class="row g-4">
    <div class="col-md-4">
        <div class="feature-box text-center">
            <i class="bi bi-wind fs-1 mb-3"></i>
            <h5 class="fw-bold">Ringan Seperti Angin</h5>
            <p class="text-muted small">Desain ringan untuk performa maksimal tanpa beban.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="feature-box text-center">
            <i class="bi bi-shield-check fs-1 mb-3"></i>
            <h5 class="fw-bold">Pelindung Setia</h5>
            <p class="text-muted small">Bantalan empuk menjaga kaki tetap aman di setiap langkah.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="feature-box text-center">
            <i class="bi bi-stars fs-1 mb-3"></i>
            <h5 class="fw-bold">Gaya Tanpa Batas</h5>
            <p class="text-muted small">Tetap stylish dari lintasan hingga hangout.</p>
        </div>
     </div>
</div>

    <!-- DEV STORY -->
    <div class="dev-story mt-5 shadow-lg">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h2 class="fw-bold mb-4">Catatan di Balik Layar</h2>
                <p class="opacity-75 mb-4">
                    Runora awalnya hanyalah tumpukan baris kode untuk memenuhi tugas <strong>UTP Teknologi Website 2026</strong>. Namun, ini adalah bukti bahwa belajar pemrograman bukan hanya soal logika, tapi soal membangun solusi yang rapi dan fungsional.
                </p>
                <div class="mb-2">
                <span class="badge-pill">PHP & MySQL</span>
                <span class="badge-pill">CRUD System</span>
                <span class="badge-pill">Bootstrap UI</span>
                <span class="badge-pill">Student Project</span>
                </div>
            </div>
            <div class="col-lg-5 text-center mt-4 mt-lg-0">
                <div class="p-4 border border-secondary rounded-4">
                    <h5 class="mb-1 text-uppercase small opacity-50">Status Proyek</h5>
                    <h3 class="fw-bold mb-0 text-success">Ready! ^^</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="text-center mt-5 pt-4">
        <a href="index.php" class="btn-runora">
            Cek Koleksi Sepatu <i class="bi bi-arrow-right ms-2"></i>
        </a>
    </div>

</div>

</body>
</html>