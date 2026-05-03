<?php
include 'koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id'");

if (mysqli_num_rows($query) == 0) {
    die("<div class='container mt-5 text-center'><h3>Maaf, sepatu yang kamu cari sudah lari ke tempat lain.. 🏃‍♂️</h3><a href='index.php' class='btn btn-dark mt-3'>Kembali ke Katalog</a></div>");
}

$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($row['nama']); ?> | Detail Runora</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #ffffff; 
            color: #0f172a;
        }

        .back-link {
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .back-link:hover { color: #000; }

        .product-img-wrapper {
            background: #f8fafc;
            border-radius: 40px;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 400px;
            position: sticky;
            top: 20px;
        }

        .product-img-wrapper img {
            max-width: 100%;
            height: auto;
            border-radius: 20px;
            transform: rotate(-5deg);
            transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .product-img-wrapper:hover img {
            transform: rotate(0deg) scale(1.05);
        }

        .price-badge {
            display: inline-block;
            background: #f1f5f9;
            color: #6366f1;
            padding: 10px 20px;
            border-radius: 100px;
            font-weight: 800;
            font-size: 1.4rem;
            margin-bottom: 20px;
        }

        .btn-buy {
            background: #000;
            color: #fff;
            padding: 18px 40px;
            border-radius: 20px;
            font-weight: 700;
            border: none;
            transition: 0.3s;
            width: 100%;
        }

        .btn-buy:hover {
            background: #334155;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .info-item {
            border-bottom: 1px solid #f1f5f9;
            padding: 15px 0;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <!-- Navigasi -->
    <div class="mb-5">
        <a href="index.php" class="back-link"><i class="bi bi-arrow-left me-2"></i>Kembali ke Koleksi</a>
    </div>

    <div class="row g-5">
        <!-- Visual Produk -->
        <div class="col-lg-6">
            <div class="product-img-wrapper shadow-sm">
                <img src="assets/img/<?= $row['gambar']; ?>" 
                     alt="<?= htmlspecialchars($row['nama']); ?>"
                     onerror="this.src='https://via.placeholder.com/600x400?text=Runora+Premium'">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="ps-lg-4">
                <span class="badge bg-dark mb-3 px-3 py-2 rounded-pill">Koleksi Terlaris ⚡</span>
                <h1 class="display-4 fw-800 mb-4 text-capitalize"><?= htmlspecialchars($row['nama']); ?></h1>
                
                <div class="price-badge">
                    Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                </div>

                <div class="mb-5">
                    <h5 class="fw-bold mb-3">Tentang Sepatu Ini</h5>
                    <p class="text-muted lh-lg">
                        <?= nl2br(htmlspecialchars($row['deskripsi'])); ?>
                    </p>
                </div>

                <div class="mb-5">
                    <div class="info-item d-flex justify-content-between">
                        <span class="text-muted">Kondisi</span>
                        <span class="fw-semibold">100% Baru & Original</span>
                    </div>
                    <div class="info-item d-flex justify-content-between">
                        <span class="text-muted">Kategori</span>
                        <span class="fw-semibold text-capitalize">Running Gear</span>
                    </div>
                    <div class="info-item d-flex justify-content-between">
                        <span class="text-muted">Status</span>
                        <span class="fw-semibold text-success">Tersedia di Gudang Pakuan</span>
                    </div>
                </div>

                <!-- Action -->
                <div class="d-flex gap-3">
                    <button class="btn-buy" onclick="alert('Pesananmu sudah masuk ke sistem! Tunggu admin Runora hubungi kamu ya 😊')">
                        Beli Sekarang <i class="bi bi-cart-plus ms-2"></i>
                    </button>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-outline-secondary d-flex align-items-center rounded-4 px-4">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </div>
                
                <p class="text-center text-muted small mt-4">
                    <i class="bi bi-shield-check me-1"></i> Transaksi Aman & Terenkripsi 
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>