<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Nasabah - Bank Sampah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #d4fc79, #96e6a1);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .form-container {
            background: white;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 600;
            color: #28a745;
        }

        label {
            font-weight: 500;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-secondary {
            border: none;
        }

        .btn-secondary:hover {
            background-color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>➕ Tambah Jenis Sampah</h2>
        <form action="simpan_jenis_sampah.php" method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama </label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama jenis sampah" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga per Kg </label>
                <input type="number" name="harga" id="harga" class="form-control" placeholder="Masukkan harga jenis sampah" required>
            </div>
            <button type="submit" class="btn btn-success w-100">💾 Simpan Jenis Sampah</button>
            <a href="index.php" class="btn btn-secondary w-100 mt-2">← Kembali ke Menu</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>