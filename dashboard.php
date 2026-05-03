<?php
include 'koneksi.php';

// Mengambil data dengan query yang lebih efisien
$query = mysqli_query($conn, "SELECT 
    COUNT(*) as total, 
    AVG(harga) as avg, 
    MAX(harga) as max, 
    MIN(harga) as min 
    FROM produk");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard</title>
    
    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.7);
            --primary-grad: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        }

        body { 
            background: #f1f5f9; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: #1e293b;
        }

        .dashboard-container { padding: 40px 0; }

        .header-section { margin-bottom: 40px; }

        .card-custom {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 24px;
            padding: 25px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 35px -10px rgba(99, 102, 241, 0.2);
            background: #ffffff;
        }

        .icon-shape {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            background: var(--primary-grad);
            color: white;
            font-size: 1.5rem;
        }

        .stat-label { color: #64748b; font-weight: 600; font-size: 0.9rem; }
        .stat-value { font-weight: 800; font-size: 1.6rem; margin: 0; }

        .btn-modern {
            padding: 12px 25px;
            border-radius: 14px;
            font-weight: 600;
            transition: 0.3s;
            border: none;
            background: #1e293b;
            color: white;
        }

        .btn-modern:hover {
            background: #334155;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container dashboard-container">
    <!-- TITLE -->
    <div class="header-section d-flex justify-content-between align-items-end">
        <div>
            <h2 class="fw-800 mb-1">Dashboard Analytics</h2>
            <p class="text-muted mb-0">Pemantauan inventaris produk secara real-time</p>
        </div>
        <a href="index.php" class="btn btn-modern"><i class="bi bi-house-door me-2"></i>Beranda</a>
    </div>

    <!-- CARDS AREA -->
    <div class="row g-4">
        <!-- Total Produk -->
        <div class="col-md-3">
            <div class="card-custom">
                <div class="icon-shape"><i class="bi bi-stack"></i></div>
                <p class="stat-label">Total Inventaris</p>
                <h3 class="stat-value"><?= number_format($data['total']); ?> <span class="fs-6 fw-normal text-muted">Item</span></h3>
            </div>
        </div>

        <!-- Rata-rata -->
        <div class="col-md-3">
            <div class="card-custom">
                <div class="icon-shape" style="background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);"><i class="bi bi-calculator"></i></div>
                <p class="stat-label">Rata-rata Harga</p>
                <h3 class="stat-value">Rp <?= number_format($data['avg'], 0, ',', '.'); ?></h3>
            </div>
        </div>

        <!-- Termahal -->
        <div class="col-md-3">
            <div class="card-custom">
                <div class="icon-shape" style="background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);"><i class="bi bi-graph-up-arrow"></i></div>
                <p class="stat-label">Harga Tertinggi</p>
                <h3 class="stat-value">Rp <?= number_format($data['max'], 0, ',', '.'); ?></h3>
            </div>
        </div>

        <!-- Termurah -->
        <div class="col-md-3">
            <div class="card-custom">
                <div class="icon-shape" style="background: linear-gradient(135deg, #06b6d4 0%, #8b5cf6 100%);"><i class="bi bi-graph-down-arrow"></i></div>
                <p class="stat-label">Harga Terendah</p>
                <h3 class="stat-value">Rp <?= number_format($data['min'], 0, ',', '.'); ?></h3>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>