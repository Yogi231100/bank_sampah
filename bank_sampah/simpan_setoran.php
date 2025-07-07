<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// Ambil dan validasi data dari form
$id_nasaba     = isset($_POST['id_nasaba']) ? $_POST['id_nasaba'] : '';
$tanggal       = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
$organik       = isset($_POST['organik']) ? floatval($_POST['organik']) : 0;
$non_organik   = isset($_POST['non_organik']) ? floatval($_POST['non_organik']) : 0;

// Validasi form
if ($id_nasaba === '' || $tanggal === '' || $organik === '' || $non_organik === '') {
    echo "<div style='color:red; text-align:center;'>❌ Semua field wajib diisi. <br><a href='tambah_setoran.php'>Kembali</a></div>";
    exit;
}

// Simpan ke database
$query = "INSERT INTO setoran (id_nasaba, tanggal, organik, non_organik) 
          VALUES ('$id_nasaba', '$tanggal', '$organik', '$non_organik')";

$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Simpan Setoran</title>
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 450px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="box">
    <?php if ($result): ?>
        <h4 class="text-success">✅ Setoran berhasil disimpan!</h4>
    <?php else: ?>
        <h4 class="text-danger">❌ Gagal menyimpan setoran</h4>
        <p><?= mysqli_error($koneksi); ?></p>
    <?php endif; ?>

    <a href="tambah_setoran.php" class="btn btn-success w-100 mt-3">➕ Tambah Lagi</a>
    <a href="index.php" class="btn btn-secondary w-100 mt-2">← Kembali ke Menu</a>
</div>

</body>
</html>
