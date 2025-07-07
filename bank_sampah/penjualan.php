<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Ambil tanggal yang sudah pernah digunakan
$usedDates = [];
$res = mysqli_query($koneksi, "SELECT DISTINCT tanggal FROM penjualan");
while ($r = mysqli_fetch_array($res)) {
    $usedDates[] = $r['tanggal'];
}

// Ambil total berat non-organik dari tabel setoran
$totalNonOrganik = 0;
$q = mysqli_query($koneksi, "SELECT SUM(non_organik) as total FROM setoran");
if ($row = mysqli_fetch_assoc($q)) {
    $totalNonOrganik = $row['total'] ?: 0;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penjualan Sampah Harian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        const usedDates = <?= json_encode($usedDates) ?>;
        function checkDate(input) {
            if (usedDates.includes(input.value)) {
                alert("Tanggal ini sudah dipakai untuk penjualan!");
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
    <div class="card p-4 shadow">
        <h3 class="text-center">📦 Form Penjualan Sampah Harian</h3>

        <form action="simpan_penjualan.php" method="post">
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" onchange="checkDate(this)" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Berat Sampah Non-Organik (kg)</label>
                <select name="berat" id="berat" class="form-select" onchange="hitungTotal()" required>
                    <option value="">-- Pilih Berat --</option>
                    <?php
                    // Bagi total berat menjadi pilihan kelipatan 1 kg
                    for ($i = 1; $i <= floor($totalNonOrganik); $i++) {
                        echo "<option value='{$i}'>{$i} kg</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga per Kg (Rp)</label>
                <input type="number" name="harga" id="harga" class="form-control" value="2000" onchange="hitungTotal()" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Total Penjualan (Rp)</label>
                <input type="number" id="total" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-success w-100">💾 Simpan Penjualan</button>
        </form>

        <a href="index.php" class="btn btn-secondary w-100 mt-3">← Kembali ke Menu</a>
    </div>
</div>

</body>
</html>
