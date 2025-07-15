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
    <title>Laporan Setoran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            margin-top: 40px;
        }

        h2 {
            color: #28a745;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .table th {
            background-color: #28a745;
            color: white;
        }

        .total-box {
            margin-top: 20px;
            font-size: 1.1rem;
            font-weight: bold;
            color: #155724;
            background-color: #d4edda;
            padding: 15px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center">📊 Laporan Setoran Nasabah</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Nasabah</th>
                        <th>Jenis Sampah</th>
                        <th>Berat (kg)</th>
                        <th>Harga/Kg</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "
                    SELECT s.tanggal, n.nama AS nasabah, j.nama AS jenis, d.berat, d.harga, d.total
                    FROM setoran s
                    JOIN nasaba n ON s.id_nasaba = n.id
                    JOIN setoran_detail d ON s.id = d.id_setoran
                    JOIN jenis_sampah j ON d.id_jenis_sampah = j.id
                    ORDER BY s.tanggal DESC
                ";
                    $result = mysqli_query($koneksi, $query);
                    $grand_total = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $grand_total += $row['total'];
                        echo "<tr>
                        <td>{$row['tanggal']}</td>
                        <td>{$row['nasabah']}</td>
                        <td>{$row['jenis']}</td>
                        <td>{$row['berat']}</td>
                        <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                        <td>Rp " . number_format($row['total'], 0, ',', '.') . "</td>
                    </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="total-box text-center">
            Total Seluruh Setoran: Rp <?= number_format($grand_total, 0, ',', '.') ?>
        </div>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali ke Menu</a>
        </div>
    </div>

</body>

</html>