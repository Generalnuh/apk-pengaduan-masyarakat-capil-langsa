<?php
session_start();

$tgl_pengaduan = $_POST['tgl_pengaduan'];
$nik = $_SESSION['nik'];
$isi_laporan = $_POST['isi_laporan'];
$lokasi_foto = $_FILES['foto']['tmp_name'];
$nama_foto = $_FILES['foto']['name'];
$status = 0;

if (!file_exists('foto')) {
    mkdir('foto', 0777, true);
}

// Validasi file upload
$allowed_ext = ['jpg', 'jpeg', 'png'];
$ext = strtolower(pathinfo($nama_foto, PATHINFO_EXTENSION));

if (!in_array($ext, $allowed_ext)) {
    echo "<script>alert('Hanya file JPG/PNG yang diizinkan!'); window.location.assign('masyarakat.php?url=tulis-pengaduan');</script>";
    exit;
}

if (move_uploaded_file($lokasi_foto, 'foto/' . $nama_foto)) {
    include 'koneksi.php';

    $sql = "INSERT INTO pengaduan(tgl_pengaduan, nik, isi_laporan, foto, status)
            VALUES('$tgl_pengaduan','$nik','$isi_laporan','$nama_foto','$status')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Pengaduan Sudah Tersimpan');
        window.location.assign('masyarakat.php');</script>";
    } else {
        echo "<script>alert('Pengaduan Gagal Tersimpan');
        window.location.assign('masyarakat.php?url=tulis-pengaduan');</script>";
    }
} else {
    echo "<script>alert('Upload Foto Gagal!');
    window.location.assign('masyarakat.php?url=tulis-pengaduan');</script>";
}
