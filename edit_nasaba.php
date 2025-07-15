<?php
session_start();
include 'koneksi.php';

$id = $_GET['id'];
$q = mysqli_query($koneksi, "SELECT * FROM nasaba WHERE id=$id");
$d = mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Nasabah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #a8ff78, #78ffd6);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .form-box {
            background: white;
            padding: 35px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-box h3 {
            margin-bottom: 25px;
            text-align: center;
            color: #28a745;
        }

        .btn {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h3>Edit Data Nasabah</h3>

    <form action="update_nasaba.php" method="post">
        <input type="hidden" name="id" value="<?= $d['id'] ?>">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?= $d['nama'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $d['alamat'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?= $d['no_hp'] ?>" required>
        </div>

        <button type="submit" class="btn btn-success mb-2">💾 Simpan Perubahan</button>
        <a href="daftar_nasaba.php" class="btn btn-outline-secondary">← Kembali</a>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
