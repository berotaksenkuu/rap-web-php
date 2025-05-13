<?php
$conn = mysqli_connect("localhost", "root", "", "db_bukittinggi");

// Periksa conn
if (!$conn) {
    die("conn$conn ke database gagal: " . mysqli_connect_error());
}
