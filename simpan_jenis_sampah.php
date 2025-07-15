<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
$harga  = floatval($_POST['harga']);

$query = "INSERT INTO jenis_sampah (nama, harga) VALUES ('$nama','$harga')";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Simpan jenis_sampah</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .box {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 450px;
            text-align: center;
        }

        .btn {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="box">
        <?php if ($result): ?>
            <h4 class="text-success">✅ Jenis Sampah berhasil ditambahkan!</h4>
        <?php else: ?>
            <h4 class="text-danger">❌ Gagal menambahkan jenis sampah</h4>
            <p><?= mysqli_error($koneksi); ?></p>
        <?php endif; ?>

        <a href="index.php" class="btn btn-primary">← Kembali ke Menu Utama</a>
        <a href="tambah_jenis_sampah.php" class="btn btn-success">➕ Tambah Lagi</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>