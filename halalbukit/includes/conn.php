<?php
$koneksi = mysqli_connect("localhost", "root", "", "penyewaan");

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
