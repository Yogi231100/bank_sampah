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
    <title>Tambah Penjualan Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h3 class="text-center mb-4">🛒 Tambah Penjualan Sampah</h3>
        <form method="post" action="simpan_penjualan.php">
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Penjualan</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div id="detail-container">
                <div class="row g-2 mb-3 detail-row">
                    <div class="col-md-4">
                        <select name="id_jenis_sampah[]" class="form-select" required>
                            <option value="">Pilih Jenis Sampah</option>
                            <?php
                            $jenis = mysqli_query($koneksi, "SELECT * FROM jenis_sampah");
                            while ($j = mysqli_fetch_array($jenis)) {
                                echo "<option value='{$j['id']}'>{$j['nama']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="berat[]" step="0.01" class="form-control" placeholder="Berat (kg)" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="harga[]" class="form-control" placeholder="Harga/kg" required>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-danger btn-hapus">Hapus</button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-info mb-3" id="tambah-baris">+ Tambah Jenis Sampah</button>
            <br>
            <button type="submit" class="btn btn-success w-100">💾 Simpan Penjualan</button>
            <a href="penjualan.php" class="btn btn-secondary w-100 mt-2">← Kembali</a>
        </form>
    </div>

    <script>
        $('#tambah-baris').click(function() {
            let baris = $('.detail-row:first').clone();
            baris.find('input').val('');
            $('#detail-container').append(baris);
        });

        $(document).on('click', '.btn-hapus', function() {
            if ($('.detail-row').length > 1) {
                $(this).closest('.detail-row').remove();
            }
        });
    </script>
</body>

</html>