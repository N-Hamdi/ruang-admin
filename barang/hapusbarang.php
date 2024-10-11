<?php

session_start();

if (!isset($_SESSION['nama'])) {
  header("Location:../index.php");
}

// Koneksi database
include_once "../connect.php";

// get id / primary key
$kodebarang = $_GET['kode_brg'];

if ($_SESSION['role'] != 'admin') {
  echo"<script>alert('Hanya Admin yang bisa mengakses fitur ini');window.history.back()</script>";
} else {
// jalankan query
mysqli_query($koneksi, "DELETE FROM tb_brg WHERE kode_brg = '$kodebarang'");

// redirect halaman
echo "<script>alert('Data berhasil terhapus');window.location='tampildatabarang.php'</script>";
}
