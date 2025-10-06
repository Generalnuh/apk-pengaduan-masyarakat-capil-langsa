<?php

if (isset($_GET['url'])) {
    switch ($_GET['url']) {
        case 'tulis-pengaduan':
            include 'tulis-pengaduan.php';
            break;

        case 'lihat-pengaduan';
            include 'lihat-pengaduan.php';
            break;

        case 'detail-pengaduan';
            include 'detail-pengaduan.php';
            break;

        case 'lihat-tanggapan';
            include 'lihat-tanggapan.php';
            break;
        default:
            echo "halaman tidak ditemukan";
            break;
    }
} else {
    echo "selamat datang di aplikasi pelaporan pengaduan masyarakat, dimana aplikasi ini dibuat untuk melaporkan tindakan yang menyimpang dari ketentuan.<br>";
    echo "anda login sebagai : " . $_SESSION['nama'];
}