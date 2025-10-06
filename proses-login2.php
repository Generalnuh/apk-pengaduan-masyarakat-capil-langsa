<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Amankan input dari karakter berbahaya
$username = mysqli_real_escape_string($koneksi, $username);
$password = mysqli_real_escape_string($koneksi, $password);

// Query cek ke tabel petugas
$sql = "SELECT * FROM petugas WHERE username='$username' AND password='$password'";
$query = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);

    // Set session sesuai data user
    $_SESSION['nama_petugas'] = $data['nama_petugas'];
    $_SESSION['username']    = $data['username'];
    $_SESSION['level']       = $data['level'];

    if ($data['level'] == "admin") {
        header("Location: admin/admin.php");
        exit;
    } elseif ($data['level'] == "petugas") {
        header("Location: petugas/petugas.php");
        exit;
    }
} else {
    echo "<script>alert('Maaf, Username atau Password salah'); window.location.assign('index.php');</script>";
}
?>
