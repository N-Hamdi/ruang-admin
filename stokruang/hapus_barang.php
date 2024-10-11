<?php

session_start();

if (!isset($_SESSION['nama'])) {
  header("Location:../index.php");
}

// Koneksi database
include_once "../connect.php";

// get id / primary key
$koderstaff = $_GET['kode_inv'];

// jalankan query

if ($_SESSION['role'] != 'admin') {
  echo"<script>alert('Hanya Admin yang bisa mengakses fitur ini');window.history.back()</script>";
} else {
  mysqli_query($koneksi, "DELETE FROM tb_rstaff WHERE kode_inv = '$koderstaff'");
}


// redirect halaman
echo "<script>alert('Data berhasil terhapus');window.location='tampilstokrng.php'</script>";


?>