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
    <title>Daftar Jenis Sampah - Bank Sampah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            margin-top: 60px;
        }

        h2 {
            margin-bottom: 30px;
            color: #28a745;
            font-weight: bold;
        }

        .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .table th {
            background-color: #28a745;
            color: white;
        }

        .btn-kembali {
            margin-top: 20px;
        }

        .action-icons a {
            margin-right: 10px;
            text-decoration: none;
        }

        .action-icons .edit {
            color: #17a2b8;
        }

        .action-icons .hapus {
            color: #dc3545;
        }

        .action-icons a:hover {
            opacity: 0.8;
        }

        .btn-tambah {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center">♻️ Daftar Jenis Sampah</h2>

        <div class="text-end btn-tambah">
            <a href="tambah_jenis_sampah.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Jenis Sampah
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th>Jenis Sampah</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = mysqli_query($koneksi, "SELECT * FROM jenis_sampah");
                    while ($d = mysqli_fetch_array($data)) {
                        echo "<tr>
                        <td>{$d['nama']}</td>
                        <td>{$d['harga']}</td>
                        <td class='action-icons'>
                            <a href='edit_jenis_sampah.php?id={$d['id']}' class='edit'><i class='bi bi-pencil-square'></i> Edit</a>
                            <a href='hapus_jenis_sampah.php?id={$d['id']}' class='hapus' onclick=\"return confirm('Yakin ingin menghapus?');\"><i class='bi bi-trash'></i> Hapus</a>
                        </td>
                    </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <a href="index.php" class="btn btn-primary btn-kembali">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Menu
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>