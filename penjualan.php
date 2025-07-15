<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Ambil tanggal yang sudah digunakan
$usedDates = [];
$res = mysqli_query($koneksi, "SELECT DISTINCT tanggal FROM penjualan");
while ($r = mysqli_fetch_array($res)) {
    $usedDates[] = $r['tanggal'];
}

// Ambil jenis sampah dan stok yang tersedia
$jenisList = [];
$q = mysqli_query($koneksi, "
    SELECT js.id, js.nama,
           IFNULL(SUM(ds.berat), 0) - IFNULL((
                SELECT SUM(p.berat)
                FROM penjualan p
                WHERE p.id_jenis = js.id
           ), 0) AS sisa
    FROM jenis_sampah js
    LEFT JOIN setoran_detail ds ON ds.id_jenis_sampah = js.id
    GROUP BY js.id, js.nama
");
while ($row = mysqli_fetch_assoc($q)) {
    $jenisList[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Penjualan Berdasarkan Jenis Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        const usedDates = <?= json_encode($usedDates) ?>;

        function checkDate(input) {
            if (usedDates.includes(input.value)) {
                alert("❗ Tanggal ini sudah dipakai untuk penjualan!");
                input.value = '';
            }
        }

        function hitungTotal() {
            const berat = parseFloat(document.getElementById('berat').value) || 0;
            const harga = parseFloat(document.getElementById('harga').value) || 0;
            document.getElementById('total').value = berat * harga;
        }
    </script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h3 class="text-center mb-4">📦 Penjualan Berdasarkan Jenis Sampah</h3>

            <form action="simpan_penjualan.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" onchange="checkDate(this)" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Sampah</label>
                    <select name="id_jenis" class="form-select" required>
                        <option value="">-- Pilih Jenis Sampah --</option>
                        <?php foreach ($jenisList as $item): ?>
                            <option value="<?= $item['id'] ?>">
                                <?= $item['nama'] ?> (Sisa: <?= number_format($item['sisa'], 2) ?> kg)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Berat (kg)</label>
                    <input type="number" name="berat" id="berat" class="form-control" min="0.01" step="0.01" onchange="hitungTotal()" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga per Kg (Rp)</label>
                    <input type="number" name="harga_per_kg" id="harga" class="form-control" value="2000" onchange="hitungTotal()" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Penjualan (Rp)</label>
                    <input type="number" id="total" class="form-control" readonly>
                </div>

                <button type="submit" class="btn btn-success w-100">💾 Simpan Penjualan</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">← Kembali ke Menu</a>
            </form>
        </div>
    </div>
</body>

</html>