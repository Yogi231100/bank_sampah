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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        <form method="GET" class="row g-2 mb-3 align-items-end">
            <div class="col-md-4">
                <label for="bulan" class="form-label">Bulan</label>
                <select name="bulan" id="bulan" class="form-select" required>
                    <option value="">-- Pilih Bulan --</option>
                    <?php
                    for ($m = 1; $m <= 12; $m++) {
                        $bulan = str_pad($m, 2, "0", STR_PAD_LEFT);
                        $selected = isset($_GET['bulan']) && $_GET['bulan'] == $bulan ? 'selected' : '';
                        echo "<option value='$bulan' $selected>$bulan</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="tahun" class="form-label">Tahun</label>
                <select name="tahun" id="tahun" class="form-select" required>
                    <option value="">-- Pilih Tahun --</option>
                    <?php
                    $tahun_sekarang = date('Y');
                    for ($y = $tahun_sekarang; $y >= 2020; $y--) {
                        $selected = isset($_GET['tahun']) && $_GET['tahun'] == $y ? 'selected' : '';
                        echo "<option value='$y' $selected>$y</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
            </div>
        </form>

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
                    $bulan = $_GET['bulan'] ?? '';
                    $tahun = $_GET['tahun'] ?? '';
                    $where = '';

                    if ($bulan && $tahun) {
                        $where = "WHERE MONTH(s.tanggal) = '$bulan' AND YEAR(s.tanggal) = '$tahun'";
                    }

                    $query = "SELECT s.tanggal, n.nama AS nasabah, j.nama AS jenis, d.berat, d.harga, d.total FROM setoran s
    JOIN nasaba n ON s.id_nasaba = n.id
    JOIN setoran_detail d ON s.id = d.id_setoran
    JOIN jenis_sampah j ON d.id_jenis_sampah = j.id
    $where
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
        </div>
    </div>

    <script>
        window.print()
    </script>
</body>

</html>