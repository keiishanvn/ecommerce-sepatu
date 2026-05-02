<?php
include 'koneksi.php';

$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM produk WHERE nama LIKE '%$search%' OR deskripsi LIKE '%$search%'";
} else {
    $query = "SELECT * FROM produk";
}

$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Runora ga ORI - Katalog Sepatu</title>
    
    <!-- Bootstrap & Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .navbar { border-radius: 0 0 16px 16px; }
        .card { border: none; border-radius: 16px; transition: 0.3s; overflow: hidden; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
        .card img { height: 200px; object-fit: cover; }
        .btn { border-radius: 10px; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Runora ga ORI </a>
    <a href="tambah.php" class="btn btn-dark">
        <i class="bi bi-plus"></i> Tambah
    </a>
  </div>
</nav>

<!-- HERO -->
<div class="container mt-4">
  <div class="p-5 bg-dark text-white rounded-4 shadow">
    <h2 class="fw-bold">Find Your Perfect Running Shoes</h2>
    <p class="mb-0 text-white-50">Comfort. Speed. Style.</p>
  </div>
</div>

<!-- SEARCH BAR -->
<div class="container mt-4">
  <form method="GET" class="d-flex">
    <input 
      type="text" 
      name="search" 
      class="form-control me-2 shadow-sm" 
      placeholder="Cari sepatu..."
      value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
    >
    <button type="submit" class="btn btn-dark shadow-sm">
      <i class="bi bi-search"></i>
    </button>
  </form>
</div>

<!-- INFO HASIL -->
<?php if (isset($_GET['search']) && $_GET['search'] != '') : ?>
  <div class="container mt-3">
    <p class="text-muted">
      Menampilkan hasil untuk: <strong>"<?php echo htmlspecialchars($_GET['search']); ?>"</strong>
    </p>
  </div>
<?php endif; ?>

<!-- PRODUK -->
<div class="container mt-4">
    <div class="row g-4">
        <?php if (mysqli_num_rows($data) > 0) : ?>
            <?php while($row = mysqli_fetch_assoc($data)) : ?>
            <div class="col-md-4 col-sm-6">
                <div class="card shadow-sm h-100">
                    <!-- Tambahkan default image jika gambar kosong -->
                    <img src="assets/img/<?php echo $row['gambar']; ?>" 
                         alt="<?php echo $row['nama']; ?>"
                         onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'" 
                         class="card-img-top">
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-semibold text-capitalize"><?php echo htmlspecialchars($row['nama']); ?></h5>
                        <p class="text-muted small flex-grow-1">
                            <?php echo htmlspecialchars($row['deskripsi']); ?>
                        </p>
                        <p class="fw-bold text-dark fs-5">
                            Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                        </p>
                        <div class="d-flex gap-2">
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm flex-grow-1 text-white">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="hapus.php?id=<?php echo $row['id']; ?>" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                               class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-box-seam display-1 text-muted"></i>
                <p class="mt-3 text-muted">Produk tidak ditemukan.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<footer class="text-center mt-5 mb-4 text-muted">
  <hr class="container">
  <small>© 2026 Runora ga ORI - Kualitas Terjamin</small>
</footer>

</body>
</html>