<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

// Ambil data penjualan berdasarkan filter bulan & tahun
$query = "
    SELECT p.tanggal, j.nama AS jenis, pd.berat, pd.harga, pd.total
    FROM penjualan p
    JOIN penjualan_detail pd ON p.id = pd.id_penjualan
    JOIN jenis_sampah j ON pd.id_jenis_sampah = j.id
    WHERE MONTH(p.tanggal) = '$bulan' AND YEAR(p.tanggal) = '$tahun'
    ORDER BY p.tanggal DESC
";

$result = mysqli_query($koneksi, $query);

// Hitung total keseluruhan
$totalSeluruh = 0;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        h3 {
            color: #28a745;
            font-weight: bold;
        }

        .table th {
            background-color: #28a745;
            color: white;
        }

        .filter-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h3 class="text-center mb-4">📈 Laporan Penjualan Sampah</h3>

        <!-- Filter Bulan dan Tahun -->
        <form method="get" class="filter-bar no-print mb-3">
            <select name="bulan" class="form-select w-auto d-inline">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    $val = str_pad($i, 2, '0', STR_PAD_LEFT);
                    $namaBulan = date('F', mktime(0, 0, 0, $i, 1));
                    $selected = ($val == $bulan) ? 'selected' : '';
                    echo "<option value='$val' $selected>$namaBulan</option>";
                }
                ?>
            </select>

            <select name="tahun" class="form-select w-auto d-inline">
                <?php
                for ($y = 2023; $y <= date('Y'); $y++) {
                    $selected = ($y == $tahun) ? 'selected' : '';
                    echo "<option value='$y' $selected>$y</option>";
                }
                ?>
            </select>

            <button type="submit" class="btn btn-primary">🔍 Tampilkan</button>
            <button type="button" class="btn btn-success" onclick="window.print()">🖨️ Cetak</button>
        </form>

        <table class="table table-bordered table-striped text-center align-middle">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis Sampah</th>
                    <th>Berat (kg)</th>
                    <th>Harga/kg</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)):
                    $totalSeluruh += $row['total'];
                ?>
                    <tr>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['jenis'] ?></td>
                        <td><?= $row['berat'] ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="alert alert-success text-center fw-bold">
            Total Penjualan Bulan <?= date('F', mktime(0, 0, 0, $bulan, 1)) ?> <?= $tahun ?>:
            Rp <?= number_format($totalSeluruh, 0, ',', '.') ?>
        </div>

        <div class="text-center no-print">
            <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Kembali ke Menu</a>
        </div>
    </div>

</body>

</html>