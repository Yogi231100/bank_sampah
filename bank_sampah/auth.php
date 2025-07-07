<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']); // Cocokkan dengan format di database

$query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $_SESSION['admin'] = $username;
    header("Location: index.php");
} else {
    header("Location: login.php?error=1");
}
?>
