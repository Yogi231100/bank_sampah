<?php
session_start();
include 'koneksi.php';

$id     = $_POST['id'];
$nama   = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_hp  = $_POST['no_hp'];

$query = "UPDATE nasaba SET nama='$nama', alamat='$alamat', no_hp='$no_hp' WHERE id=$id";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Update Nasabah</title>
    <meta http-equiv="refresh" content="2;url=daftar_nasaba.php">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .box {
            background: white;
            padding: 30px 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }

        .box h4 {
            color: #28a745;
            margin-bottom: 15px;
        }

        .btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="box">
    <?php if ($result): ?>
        <h4><i class="bi bi-check-circle-fill text-success"></i> Data nasabah berhasil diperbarui!</h4>
        <p>Anda akan diarahkan kembali ke daftar nasabah...</p>
        <a href="daftar_nasaba.php" class="btn btn-outline-success">← Kembali Sekarang</a>
    <?php else: ?>
        <h4 class="text-danger">❌ Gagal memperbarui data</h4>
        <p><?= mysqli_error($koneksi); ?></p>
        <a href="daftar_nasaba.php" class="btn btn-outline-danger">← Kembali</a>
    <?php endif; ?>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
