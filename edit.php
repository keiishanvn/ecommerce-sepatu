<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
$d = mysqli_fetch_assoc($query);

if (!$d) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $namaFileBaru = time() . '_' . $gambar;

        if (move_uploaded_file($tmp, "assets/img/" . $namaFileBaru)) {
            if ($d['gambar'] != "" && file_exists("assets/img/" . $d['gambar'])) {
                unlink("assets/img/" . $d['gambar']);
            }

            mysqli_query($conn, "UPDATE produk SET 
                nama='$nama', 
                harga='$harga', 
                deskripsi='$deskripsi', 
                gambar='$namaFileBaru' 
                WHERE id=$id");
        }
    } else {
        mysqli_query($conn, "UPDATE produk SET 
            nama='$nama', 
            harga='$harga', 
            deskripsi='$deskripsi' 
            WHERE id=$id");
    }

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Sepatu Kesayangan | Runora</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body { background: #fcfcfd; font-family: 'Poppins', sans-serif; color: #0f172a; }
        .card-edit { border-radius: 30px; border: 1px solid #f1f5f9; background: #fff; padding: 40px; }
        .form-label { font-weight: 600; font-size: 0.9rem; color: #64748b; }
        .form-control { border-radius: 12px; padding: 12px 15px; border: 1px solid #e2e8f0; }
        .form-control:focus { box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); border-color: #6366f1; }
        .current-img-box { background: #f8fafc; border-radius: 20px; padding: 15px; border: 1px dashed #cbd5e1; }
        .btn-update { background: #000; color: #fff; border-radius: 15px; padding: 14px; font-weight: 700; border: none; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card-edit shadow-sm">
                <div class="mb-4">
                    <h2 class="fw-800 mb-1">Perbarui Detail Produk</h2>
                    <p class="text-muted small">Ubah informasi produk agar pelanggan makin tertarik.</p>
                </div>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nama Sepatu</label>
                        <input class="form-control" type="text" name="nama" value="<?php echo htmlspecialchars($d['nama']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga (Rp)</label>
                        <input class="form-control" type="number" name="harga" value="<?php echo $d['harga']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ceritakan Sepatu Ini</label>
                        <textarea class="form-control" name="deskripsi" rows="4"><?php echo htmlspecialchars($d['deskripsi']); ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tampilan Saat Ini</label>
                        <div class="current-img-box d-flex align-items-center gap-3">
                            <img src="assets/img/<?php echo $d['gambar']; ?>" width="80" class="rounded shadow-sm">
                            <div class="small text-muted">
                                Ingin ganti? Pilih file baru di bawah ini.
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Unggah Foto Baru (Opsional)</label>
                        <input class="form-control" type="file" name="gambar">
                    </div>

                    <button class="btn-update w-100 mb-3" name="submit">Simpan Perubahan</button>
                    <a href="index.php" class="btn btn-link w-100 text-decoration-none text-muted fw-semibold">Batalkan & Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>