<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    $namaFileBaru = time() . '_' . $gambar;
    $path = "assets/img/" . $namaFileBaru;

    if (move_uploaded_file($tmp, $path)) {

        echo "Upload berhasil"; 

        mysqli_query($conn, "INSERT INTO produk 
        (nama, harga, deskripsi, gambar)
        VALUES ('$nama', '$harga', '$deskripsi', '$namaFileBaru')");

    } else {

        echo "Upload gagal";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Produk</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background: #f8f9fa; }
.card { border-radius: 16px; }
</style>
</head>

<body>

<div class="container mt-5">
<div class="col-md-6 mx-auto">

<div class="card shadow-sm p-4">

<h4 class="mb-4 fw-bold">Tambah Produk</h4>

<form method="POST" enctype="multipart/form-data">
  <input class="form-control mb-3" type="text" name="nama" placeholder="Nama Sepatu" required>
  <input class="form-control mb-3" type="number" name="harga" placeholder="Harga" required>
  <textarea class="form-control mb-3" name="deskripsi" placeholder="Deskripsi"></textarea>
  <input class="form-control mb-3" type="file" name="gambar" required>
  <button class="btn btn-dark w-100" name="submit">Simpan</button>
  <a href="index.php" class="btn btn-outline-secondary w-100 mt-2">Kembali</a>
</form>

</div>
</div>
</div>

</body>
</html>