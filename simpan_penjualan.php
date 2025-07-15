<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$tanggal = $_POST['tanggal'];
$id_jenis = intval($_POST['id_jenis']);
$berat = floatval($_POST['berat']);
$harga = intval($_POST['harga_per_kg']);
$total = $berat * $harga;

mysqli_query($koneksi, "INSERT INTO penjualan (tanggal, id_jenis, berat, harga_per_kg, total)
                        VALUES ('$tanggal', '$id_jenis', '$berat', '$harga', '$total')");

header("Location: penjualan.php");
exit;
