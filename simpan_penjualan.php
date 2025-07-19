<?php
session_start();
include 'koneksi.php';

$tanggal = $_POST['tanggal'];
$id_jenis_sampah = $_POST['id_jenis_sampah'];
$berat = $_POST['berat'];
$harga = $_POST['harga'];

mysqli_begin_transaction($koneksi);

try {
    mysqli_query($koneksi, "INSERT INTO penjualan (tanggal) VALUES ('$tanggal')");
    $id_penjualan = mysqli_insert_id($koneksi);

    for ($i = 0; $i < count($id_jenis_sampah); $i++) {
        $id_jenis = $id_jenis_sampah[$i];
        $b = $berat[$i];
        $h = $harga[$i];
        $total = $b * $h;

        mysqli_query($koneksi, "INSERT INTO penjualan_detail (id_penjualan, id_jenis_sampah, berat, harga, total)
                                VALUES ('$id_penjualan', '$id_jenis', '$b', '$h', '$total')");
    }

    mysqli_commit($koneksi);
    header("Location: penjualan.php");
} catch (Exception $e) {
    mysqli_rollback($koneksi);
    echo "Gagal menyimpan penjualan: " . $e->getMessage();
}
