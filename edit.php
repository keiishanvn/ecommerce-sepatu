<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
$d = mysqli_fetch_assoc($data);
$size = $_FILES['gambar']['size'];

if (isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    if ($_FILES['gambar']['name'] != "") {

        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        $namaFileBaru = time() . '_' . $gambar;

        move_uploaded_file($tmp, "assets/img/" . $namaFileBaru);

        mysqli_query($conn, "UPDATE produk SET
            nama='$nama',
            harga='$harga',
            deskripsi='$deskripsi',
            gambar='$namaFileBaru'
        WHERE id=$id");

    } else {

        mysqli_query($conn, "UPDATE produk SET
            nama='$nama',
            harga='$harga',
            deskripsi='$deskripsi'
        WHERE id=$id");
    }

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Produk</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background: #f8f9fa; }
.card { border-radius: 16px; }
img { border-radius: 10px; }
</style>
</head>

<body>

<div class="container mt-5">
<div class="col-md-6 mx-auto">

<div class="card shadow-sm p-4">

<h4 class="mb-4 fw-bold">Edit Produk</h4>

<form method="POST" enctype="multipart/form-data">
  <input class="form-control mb-3" type="text" name="nama" value="<?php echo $d['nama']; ?>" required>
  <input class="form-control mb-3" type="number" name="harga" value="<?php echo $d['harga']; ?>" required>
  <textarea class="form-control mb-3" name="deskripsi"><?php echo $d['deskripsi']; ?></textarea>
  <p class="mb-1">Gambar saat ini:</p>
  <img src="assets/img/<?php echo $d['gambar']; ?>" width="100" class="mb-3">
  <input class="form-control mb-3" type="file" name="gambar">

  <button class="btn btn-dark w-100" name="submit">Update</button>

  <a href="index.php" class="btn btn-outline-secondary w-100 mt-2">Kembali</a>

</form>

</div>
</div>
</div>

</body>
</html>