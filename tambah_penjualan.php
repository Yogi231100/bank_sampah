<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $total_non_organik = floatval($_POST['total_non_organik']);
    $harga_per_kg = intval($_POST['harga_per_kg']);
    $total_penjualan = $total_non_organik * $harga_per_kg;

    mysqli_query($koneksi, "INSERT INTO penjualan (tanggal, total_non_organik, harga_per_kg, total_penjualan)
                            VALUES ('$tanggal', '$total_non_organik', '$harga_per_kg', '$total_penjualan')");
    header("Location: penjualan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Tambah Data Penjualan</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Berat Non-Organik (kg)</label>
                <input type="number" name="total_non_organik" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga per Kg</label>
                <input type="number" name="harga_per_kg" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="penjualan.php" class="btn btn-secondary">← Kembali</a>
        </form>
    </div>
</body>
</html>
