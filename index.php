<?php
include 'koneksi.php';

// Mengatur charset agar karakter spesial aman
mysqli_set_charset($conn, "utf8mb4");

// Inisialisasi variabel pencarian
$search = "";
$is_searching = false;

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $is_searching = true;
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    // Algoritma Linear Search: mencari kesamaan pada nama atau deskripsi
    $query = "SELECT * FROM produk WHERE nama LIKE '%$search%' OR deskripsi LIKE '%$search%' ORDER BY id DESC";
} else {
    $query = "SELECT * FROM produk ORDER BY id DESC";
}

$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Runora | Langkah Masa Depan</title>
    
    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            --accent: #6366f1;
            --dark: #0f172a;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #fcfcfd; 
            color: var(--dark);
        }

        .navbar { 
            backdrop-filter: blur(10px); 
            background: rgba(255,255,255,0.8) !important;
            border-bottom: 1px solid #f1f5f9;
        }

        .hero-card {
            background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
            border-radius: 32px;
            padding: 60px 40px;
            overflow: hidden;
            position: relative;
        }

        .product-card { 
            border: none; 
            border-radius: 24px; 
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: #fff;
            border: 1px solid #f1f5f9;
            position: relative;
        }
        
        .product-card:hover { 
            transform: translateY(-10px); 
            box-shadow: 0 20px 40px rgba(0,0,0,0.05); 
            border-color: var(--accent);
        }

        .img-container {
            border-radius: 20px;
            margin: 12px;
            overflow: hidden;
            height: 220px;
            position: relative;
        }

        .product-card img { 
            width: 100%;
            height: 100%;
            object-fit: cover; 
            transition: 0.5s;
        }
        
        .product-card:hover img { transform: scale(1.1); }

        .price-tag { color: var(--accent); font-weight: 800; font-size: 1.25rem; }

        .btn-action { border-radius: 12px; padding: 8px 16px; font-weight: 600; }

        .fab-add {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--dark);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            z-index: 1000;
            transition: 0.3s;
            text-decoration: none;
        }
        .fab-add:hover { transform: scale(1.1); color: white; }
    </style>
</head>
<body>

<!-- NAVIGATION -->
<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container">
    <a class="navbar-brand fw-800 fs-4" href="index.php">
      </i> RUNORA
    </a>

    <div class="ms-auto d-flex gap-2">
      <a href="dashboard.php" class="btn btn-light btn-action" title="Data Analytics">
        <i class="bi bi-graph-up"></i>
      </a>
      <a href="about.php" class="btn btn-light btn-action">Kisah Kami</a>
      <a href="tambah.php" class="btn btn-dark btn-action d-none d-md-inline-block">
        <i class="bi bi-plus-lg me-1"></i> Tambah Sepatu
      </a>
    </div>
  </div>
</nav>

<!-- HERO SECTION  -->
<div class="container mt-4">
  <div class="hero-card text-white shadow-lg">
    <div class="row align-items-center">
        <div class="col-md-7">
            <h1 class="display-4 fw-800 mb-3">Temukan Langkah Terhebatmu.</h1>
            <p class="lead opacity-75">Bukan sekadar alas kaki, ini adalah teman perjalanan menuju versi terbaik dirimu.</p>
        </div>
    </div>
  </div>
</div>

<!-- SEARCH BAR  -->
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
        <form method="GET" class="input-group input-group-lg shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <span class="input-group-text bg-white border-0 ps-4">
                <i class="bi bi-search text-muted"></i>
            </span>
            <input 
              type="text" 
              name="search" 
              class="form-control border-0 py-3" 
              placeholder="Lagi cari sepatu apa hari ini?"
              value="<?php echo htmlspecialchars($search); ?>"
            >
            <button type="submit" class="btn btn-dark px-4">Cari</button>
        </form>
        
        <?php if ($is_searching) : ?>
          <div class="mt-3 ps-2">
            <p class="text-muted small">
              Menemukan hasil untuk: <span class="badge bg-light text-dark fw-normal">"<?= htmlspecialchars($search); ?>"</span>
              <a href="index.php" class="ms-2 text-decoration-none text-danger">Hapus Pencarian</a>
            </p>
          </div>
        <?php endif; ?>
    </div>
  </div>
</div>

<!-- CATALOG SECTION -->
<div class="container mt-5 pb-5">
    <div class="row g-4">

    <?php if (mysqli_num_rows($data) > 0) : ?>
        <?php while($row = mysqli_fetch_assoc($data)) : ?>
        <div class="col-lg-4 col-md-6">
          <div class="product-card h-100 d-flex flex-column">
            
            <a href="detail.php?id=<?= $row['id']; ?>" class="text-decoration-none">
                <div class="img-container">
                    <!-- Status Stok Otomatis  -->
                    <div class="position-absolute m-3" style="z-index: 10;">
                        <?php if ($row['id'] % 2 == 0) : ?>
                            <span class="badge bg-danger rounded-pill px-3 shadow-sm">Stok Terbatas</span>
                        <?php else : ?>
                            <span class="badge bg-success rounded-pill px-3 shadow-sm">Tersedia</span>
                        <?php endif; ?>
                    </div>

                    <img src="assets/img/<?= $row['gambar']; ?>" 
                         alt="<?= htmlspecialchars($row['nama']); ?>"
                         onerror="this.src='https://via.placeholder.com/400x300?text=Runora+Shoes'">
                </div>

                <div class="card-body pt-2">
                    <h5 class="fw-bold text-dark mb-2 text-capitalize">
                        <?= htmlspecialchars($row['nama']); ?>
                    </h5>
                    <!-- Abstraksi Deskripsi  -->
                    <p class="text-muted small mb-3">
                        <?= (strlen($row['deskripsi']) > 80) ? substr(htmlspecialchars($row['deskripsi']), 0, 80) . '...' : htmlspecialchars($row['deskripsi']); ?>
                    </p>
                    <p class="price-tag mb-0">
                        Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                    </p>
                </div>
            </a>

            <!-- ACTIONS -->
            <div class="p-4 pt-0 mt-auto">
                <div class="d-flex gap-2">
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-outline-secondary btn-sm flex-grow-1 btn-action">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>
                    <a href="hapus.php?id=<?= $row['id']; ?>" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus kenangan ini?')"
                       class="btn btn-outline-danger btn-sm btn-action">
                        <i class="bi bi-trash"></i>
                    </a>
                </div>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
    <?php else : ?>
        <!-- State Kosong  -->
        <div class="col-12 text-center py-5">
          <div class="opacity-25 mb-3">
            <i class="bi bi-clouds-fill display-1"></i>
          </div>
          <h4 class="fw-bold text-muted">Yah, sepatunya nggak ketemu...</h4>
          <p class="text-muted">Mungkin dia lagi lari bareng yang lain. Coba cari kata kunci lain?</p>
          <a href="index.php" class="btn btn-outline-dark btn-action mt-2">Lihat Semua Produk</a>
        </div>
    <?php endif; ?>

    </div>
</div>

<!-- FOOTER-->
<footer class="text-center py-5 bg-white border-top">
  <p class="fw-bold small">© 2026 Runora | Langkahmu, Ceritamu.</p>
</footer>

<!-- Floating Action Button -->
<a href="tambah.php" class="fab-add shadow-lg" title="Tambah Produk Baru">
    <i class="bi bi-plus-lg fs-3"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>