<?php

session_start();

if (!isset($_SESSION['nama'])) {
  header("Location: index.php");
}

    // Koneksi database
include_once "../connect.php";

// get id / primary key
$kodegudang = $_GET['kode_gdg'];

// jalankan query

if ($_SESSION['role'] != 'admin') {
    echo"<script>alert('Hanya Admin yang bisa mengakses fitur ini');window.history.back()</script>";
  } else {
    mysqli_query($koneksi, "DELETE FROM tb_gudang WHERE kode_gdg = '$kodegudang'");
  }


// redirect halaman
echo "<script>alert('Data berhasil terhapus');window.location='tampilstokgdg.php'</script>";

