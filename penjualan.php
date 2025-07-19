<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Penjualan Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h3 class="text-center mb-4">📦 Daftar Penjualan Sampah</h3>

        <a href="tambah_penjualan.php" class="btn btn-success mb-3">+ Tambah Penjualan</a>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Total Item</th>
                    <th>Total Penjualan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT p.tanggal, COUNT(pd.id) AS item, SUM(pd.total) AS total
                  FROM penjualan p
                  JOIN penjualan_detail pd ON pd.id_penjualan = p.id
                  GROUP BY p.id
                  ORDER BY p.tanggal DESC";
                $result = mysqli_query($koneksi, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <td>{$row['tanggal']}</td>
                    <td>{$row['item']}</td>
                    <td>Rp " . number_format($row['total'], 0, ',', '.') . "</td>
                </tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="index.php" class="btn btn-secondary">← Kembali ke Menu</a>
    </div>
</body>

</html>