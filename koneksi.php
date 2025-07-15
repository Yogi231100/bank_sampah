<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_bank_sampah");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
