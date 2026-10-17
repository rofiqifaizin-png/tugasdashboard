<?php
mysqli_report(MYSQLI_REPORT_OFF);
$koneksi = mysqli_connect("localhost", "root", "", "db_tokokita");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function rupiah($angka) {
    return "Rp " . number_format($angka, 0, ",", ".");
}
