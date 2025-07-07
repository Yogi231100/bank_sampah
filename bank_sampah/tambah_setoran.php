<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Setoran - Bank Sampah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #a8ff78, #78ffd6);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .form-box {
            background: #fff;
            padding: 35px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }

        h4 {
            text-align: center;
            margin-bottom: 25px;
            color: #28a745;
            font-weight: 600;
        }

        label {
            font-weight: 500;
        }

        .btn {
            width: 100%;
            padding: 10px;
        }

        .form-label i {
            margin-right: 6px;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h4><i class="bi bi-journal-plus"></i> Tambah Setoran Sampah</h4>

    <form action="simpan_setoran.php" method="post">
        <!-- Pilih Nasabah -->
        <div class="mb-3">
            <label for="id_nasaba" class="form-label"><i class="bi bi-person"></i> Pilih Nasabah</label>
            <select name="id_nasaba" id="id_nasaba" class="form-select" required>
                <option value="">-- Pilih Nasabah --</option>
                <?php
                $nasaba = mysqli_query($koneksi, "SELECT * FROM nasaba");
                while ($n = mysqli_fetch_array($nasaba)) {
                    echo "<option value='{$n['id']}'>{$n['nama']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Tanggal Setor -->
        <div class="mb-3">
            <label class="form-label"><i class="bi bi-calendar-date"></i> Tanggal Setor</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <!-- Organik -->
        <div class="mb-3">
            <label class="form-label"><i class="bi bi-recycle"></i> Sampah Organik (kg)</label>
            <input type="number" name="organik" step="0.01" min="0" class="form-control" required>
        </div>

        <!-- Non Organik -->
        <div class="mb-3">
            <label class="form-label"><i class="bi bi-trash3"></i> Sampah Non-Organik (kg)</label>
            <input type="number" name="non_organik" step="0.01" min="0" class="form-control" required>
        </div>

        <!-- Tombol Aksi -->
        <button type="submit" class="btn btn-success mb-2"><i class="bi bi-check-circle-fill"></i> Simpan Setoran</button>
        <a href="index.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left-circle"></i> Kembali ke Menu</a>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
