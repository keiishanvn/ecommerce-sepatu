<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
$d = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
<title>Detail Produk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
<div class="row">

<div class="col-md-6">
    <img src="assets/img/<?php echo $d['gambar']; ?>" class="img-fluid rounded">
</div>

<div class="col-md-6">
    <h3><?php echo $d['nama']; ?></h3>
    <h4 class="text-success">Rp <?php echo number_format($d['harga']); ?></h4>
    <p><?php echo $d['deskripsi']; ?></p>

    <a href="index.php" class="btn btn-secondary">Kembali</a>
</div>

</div>
</div>

</body>
</html>