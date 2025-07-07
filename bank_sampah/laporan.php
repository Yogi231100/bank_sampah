<?php session_start(); if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; } include 'koneksi.php'; // Pastikan file koneksi.php sudah tersedia dan berfungsi ?> <!DOCTYPE html> <html lang="id"> <head> <meta charset="UTF-8"> <title>Laporan Umum - Bank Sampah</title> <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: #f8f9fa;
        padding: 30px;
    }

    h2 {
        text-align: center;
        margin-bottom: 10px;
    }

    .report-date {
        text-align: center;
        margin-bottom: 30px;
        font-size: 0.9em;
        color: #6c757d;
    }

    .box {
        max-width: 1000px;
        margin: auto;
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 12px rgba(0,0,0,0.05);
    }

    .btn-back {
        margin-top: 20px;
    }

    tfoot td {
        font-weight: bold;
        background-color: #e9ecef;
    }

    .section-title {
        margin-top: 40px;
        margin-bottom: 10px;
    }

    .text-end {
        text-align: end;
    }

    .data-timestamp {
        font-size: 0.85em;
        color: #6c757d;
        margin-bottom: 10px;
    }

    .no-print {
        display: block;
    }

    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>
</head> <body> <div class="box" id="laporan-content"> <h2><i class="bi bi-graph-up"></i> Laporan Umum Bank Sampah</h2> <p class="report-date">Laporan per Tanggal: <strong><?php echo date('d F Y'); ?></strong></p>
<div class="text-end mb-3 no-print">
    <button class="btn btn-danger" onclick="downloadPDF()">
        <i class="bi bi-file-earmark-pdf-fill"></i> Download PDF
    </button>
</div>

<h5 class="section-title text-success"><i class="bi bi-recycle"></i> Total Sampah Disetorkan</h5>
<?php
$tanggal_setoran = mysqli_query($koneksi, "SELECT MAX(tanggal) AS terakhir_setor FROM setoran");
$row_setoran = mysqli_fetch_assoc($tanggal_setoran);
?>
<p class="data-timestamp">Data terakhir disetor: <?= $row_setoran['terakhir_setor'] ? date('d F Y', strtotime($row_setoran['terakhir_setor'])) : '-' ?></p>

<table class="table table-bordered table-hover">
    <thead class="table-success">
        <tr>
            <th>Tanggal</th>
            <th>Organik (kg)</th>
            <th>Non-Organik (kg)</th>
            <th>Total Sampah (kg)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query_harian = mysqli_query($koneksi, "SELECT tanggal, SUM(organik) AS organik, SUM(non_organik) AS non_organik FROM setoran GROUP BY tanggal ORDER BY tanggal ASC");
        $total_organik = 0;
        $total_nonorganik = 0;
        while ($row = mysqli_fetch_assoc($query_harian)) {
            $total = $row['organik'] + $row['non_organik'];
            $total_organik += $row['organik'];
            $total_nonorganik += $row['non_organik'];
            echo "<tr>
                <td>" . date('d F Y', strtotime($row['tanggal'])) . "</td>
                <td>" . number_format($row['organik'], 2) . "</td>
                <td>" . number_format($row['non_organik'], 2) . "</td>
                <td><strong>" . number_format($total, 2) . "</strong></td>
            </tr>";
        }
        ?>
        <tr class="table-light">
            <td><strong>Total</strong></td>
            <td><strong><?= number_format($total_organik, 2) ?> kg</strong></td>
            <td><strong><?= number_format($total_nonorganik, 2) ?> kg</strong></td>
            <td><strong><?= number_format($total_organik + $total_nonorganik, 2) ?> kg</strong></td>
        </tr>
    </tbody>
</table>

<h5 class="section-title text-info"><i class="bi bi-cash-coin"></i> Total Penjualan Non-Organik</h5>
<?php
$tanggal_penjualan = mysqli_query($koneksi, "SELECT MAX(tanggal) AS terakhir_jual FROM penjualan");
$row_jual = mysqli_fetch_assoc($tanggal_penjualan);
?>
<p class="data-timestamp">Data terakhir penjualan: <?= $row_jual['terakhir_jual'] ? date('d F Y', strtotime($row_jual['terakhir_jual'])) : '-' ?></p>

<table class="table table-bordered table-hover">
    <thead class="table-warning">
        <tr>
            <th>Tanggal</th>
            <th>Berat Terjual (kg)</th>
            <th>Total Penjualan (Rp)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query_jual = mysqli_query($koneksi, "SELECT tanggal, SUM(berat) AS berat, SUM(total) AS total FROM penjualan GROUP BY tanggal ORDER BY tanggal ASC");
        $berat_total = 0;
        $rupiah_total = 0;
        while ($row = mysqli_fetch_assoc($query_jual)) {
            $berat_total += $row['berat'];
            $rupiah_total += $row['total'];
            echo "<tr>
                <td>" . date('d F Y', strtotime($row['tanggal'])) . "</td>
                <td>" . number_format($row['berat'], 2) . " kg</td>
                <td><strong class='text-success'>Rp " . number_format($row['total'], 0, ',', '.') . "</strong></td>
            </tr>";
        }
        ?>
        <tr class="table-light">
            <td><strong>Total</strong></td>
            <td><strong><?= number_format($berat_total, 2) ?> kg</strong></td>
            <td><strong class="text-success">Rp <?= number_format($rupiah_total, 0, ',', '.') ?></strong></td>
        </tr>
    </tbody>
</table>

<a href="index.php" class="btn btn-secondary btn-back no-print"><i class="bi bi-arrow-left-circle"></i> Kembali ke Menu</a>
</div> <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script> <script> function downloadPDF() { const element = document.getElementById('laporan-content'); const hiddenElements = document.querySelectorAll('.no-print'); hiddenElements.forEach(el => el.style.display = 'none'); const opt = { margin: 0.5, filename: 'Laporan-BankSampah.pdf', image: { type: 'jpeg', quality: 0.98 }, html2canvas: { scale: 2 }, jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' } }; html2pdf().set(opt).from(element).save().then(() => { hiddenElements.forEach(el => el.style.display = 'block'); }); } </script> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> </body> </html>