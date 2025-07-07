<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$tanggal = $_POST['tanggal'];
$berat = floatval($_POST['berat']);
$harga = intval($_POST['harga']);
$total = $berat * $harga;

// Cek duplikat tanggal
$cek = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE tanggal='$tanggal'");
$duplicate = mysqli_num_rows($cek) > 0;

if (!$duplicate) {
    $query = "INSERT INTO penjualan (tanggal, berat, harga, total) VALUES ('$tanggal', '$berat', '$harga', '$total')";
    $result = mysqli_query($koneksi, $query);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Simpan Penjualan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.05);
            width: 400px;
            text-align: center;
        }

        .btn {
            width: 100%;
            margin-top: 10px;
        }

        .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="box">
    <?php if ($duplicate): ?>
        <div class="text-danger icon">❌</div>
        <h5 class="text-danger">Penjualan untuk tanggal ini sudah ada!</h5>
    <?php elseif ($result): ?>
        <div class="text-success icon">✅</div>
        <h5 class="text-success">Penjualan berhasil disimpan!</h5>
    <?php else: ?>
        <div class="text-danger icon">❌</div>
        <h5 class="text-danger">Gagal menyimpan data</h5>
        <p><?= mysqli_error($koneksi); ?></p>
    <?php endif; ?>

    <a href="laporan.php" class="btn btn-primary">← Halaman laporan </a>
</div>

</body>
</html>
