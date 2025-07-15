<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Ambil daftar nasabah dan jenis sampah
$nasabah = mysqli_query($koneksi, "SELECT * FROM nasaba ORDER BY nama ASC");
$jenis_sampah = mysqli_query($koneksi, "SELECT * FROM jenis_sampah ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Setoran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .form-container {
            max-width: 650px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
            color: #28a745;
        }

        .btn-success {
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>🧾 Form Setoran</h2>
        <form action="simpan_setoran.php" method="POST">
            <div class="mb-3">
                <label for="nasaba" class="form-label">Nama Nasabah</label>
                <select name="id_nasaba" class="form-select" required>
                    <option value="">-- Pilih Nasabah --</option>
                    <?php while ($n = mysqli_fetch_assoc($nasabah)): ?>
                        <option value="<?= $n['id'] ?>"><?= $n['nama'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Setoran</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <hr>
            <h5 class="text-muted mb-3">Detail Setoran Sampah:</h5>
            <?php while ($j = mysqli_fetch_assoc($jenis_sampah)): ?>
                <div class="mb-3">
                    <label class="form-label"><?= $j['nama'] ?> (<?= $j['harga'] ?> /kg)</label>
                    <input type="number" step="0.01" name="sampah[<?= $j['id'] ?>]" class="form-control" placeholder="Berat (kg)">
                </div>
            <?php endwhile; ?>

            <button type="submit" class="btn btn-success mt-3">
                💾 Simpan Setoran
            </button>
            <a href="index.php" class="btn btn-secondary w-100 mt-2">← Kembali ke Menu</a>
        </form>
    </div>

</body>

</html>