<?php
date_default_timezone_set('Asia/Jakarta'); // mengatur zona waktu
$koneksi = mysqli_connect("localhost", "root", "", "db_inventori"); // variabel untuk menghubungkan ke database

// apabila koneksi gagal 
if (mysqli_connect_errno()) {
    echo "<script>alert('Koneksi database gagal, silahkan kontak admin');</script>";
}
?>