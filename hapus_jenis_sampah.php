<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}
include 'koneksi.php';

$id = intval($_GET['id']);
mysqli_query($koneksi, "DELETE FROM jenis_sampah WHERE id = $id");
header("Location: index.php");
exit;
