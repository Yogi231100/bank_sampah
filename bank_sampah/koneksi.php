<?php
$koneksi = mysqli_connect("localhost", "root", "", "bank_sampah");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
