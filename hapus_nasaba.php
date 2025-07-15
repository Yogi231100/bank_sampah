<?php
session_start();
include 'koneksi.php';

$id = $_GET['id'] ?? null;
$success = false;

// Cek apakah ID valid dan numerik
if ($id && is_numeric($id)) {
    $delete = mysqli_query($koneksi, "DELETE FROM nasaba WHERE id=$id");
    $success = $delete;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Nasabah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($success): ?>
        <meta http-equiv="refresh" content="2;url=daftar_nasaba.php">
    <?php endif; ?>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
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
            max-width: 400px;
        }

        .btn {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="box">
    <?php if ($success): ?>
        <h4 class="text-success"><i class="bi bi-check-circle-fill"></i> Nasabah berhasil dihapus</h4>
        <p>Anda akan dialihkan ke daftar nasabah...</p>
        <a href="daftar_nasaba.php" class="btn btn-outline-success">← Kembali Sekarang</a>
    <?php else: ?>
        <h4 class="text-danger"><i class="bi bi-exclamation-circle-fill"></i> Gagal menghapus nasabah</h4>
        <p>ID tidak valid atau terjadi kesalahan.</p>
        <a href="daftar_nasaba.php" class="btn btn-outline-danger">← Kembali</a>
    <?php endif; ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
