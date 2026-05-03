<?php
include 'koneksi.php';

$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM produk"));
$mahal = mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(harga) as max FROM produk"));
$murah = mysqli_fetch_assoc(mysqli_query($conn, "SELECT MIN(harga) as min FROM produk"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h3>Dashboard Produk</h3>

<div class="row mt-4">

<div class="col-md-4">
<div class="card p-3 text-center">
<h5>Total Produk</h5>
<h2><?php echo $total['total']; ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card p-3 text-center">
<h5>Harga Tertinggi</h5>
<h2>Rp <?php echo number_format($mahal['max']); ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card p-3 text-center">
<h5>Harga Terendah</h5>
<h2>Rp <?php echo number_format($murah['min']); ?></h2>
</div>
</div>

</div>

</div>

</body>
</html>