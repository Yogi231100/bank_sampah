<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$id_nasaba = $_POST['id_nasaba'];
$tanggal = $_POST['tanggal'];
$sampah = $_POST['sampah']; // array: id_jenis => berat

// Simpan ke tabel setoran
mysqli_query($koneksi, "INSERT INTO setoran (id_nasaba, tanggal) VALUES ('$id_nasaba', '$tanggal')");
$id_setoran = mysqli_insert_id($koneksi);

// Simpan ke tabel setoran_detail
foreach ($sampah as $id_jenis => $berat) {
    $berat = floatval($berat);
    if ($berat > 0) {
        $qHarga = mysqli_query($koneksi, "SELECT harga FROM jenis_sampah WHERE id = '$id_jenis'");
        $harga = mysqli_fetch_assoc($qHarga)['harga'];
        $total = $harga * $berat;

        mysqli_query($koneksi, "INSERT INTO setoran_detail 
            (id_setoran, id_jenis_sampah, berat, harga, total)
            VALUES ('$id_setoran', '$id_jenis', '$berat', '$harga', '$total')");
    }
}

header("Location: laporan.php");
exit;
