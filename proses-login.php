<?php
session_start();

$nik = $_POST['nik'];
$password = $_POST['password'];

include 'koneksi.php';

// Amankan input dari karakter berbahaya
$nik = mysqli_real_escape_string($koneksi, $nik);
$password = mysqli_real_escape_string($koneksi, $password);

$sql = "SELECT * FROM masyarakat WHERE nik='$nik' AND password='$password'";
$query = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);
    $_SESSION['nik'] = $data['nik'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['username'] = $data['username'];

    header("Location: masyarakat.php");
    exit;
} else {
    echo "<script>alert('Maaf Anda Gagal Login'); window.location.assign('index.php');</script>";
}
