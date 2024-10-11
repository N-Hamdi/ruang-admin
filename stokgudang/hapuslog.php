<?php

session_start();

if (!isset($_SESSION['nama'])) {
  header("Location: index.php");
}

    // Koneksi database
include_once "../connect.php";

// get id / primary key
$numlog = $_GET['no_log'];
$query = "UPDATE tb_gudang 
INNER JOIN tb_masuk_gdg on tb_gudang.kode_brg = tb_masuk_gdg.kode_brg 
set tb_gudang.jml_stok = GREATEST (0, tb_gudang.jml_stok - tb_masuk_gdg.stok_in) 
where tb_masuk_gdg.no_log ='$numlog';";
$query .= "DELETE FROM tb_masuk_gdg WHERE no_log = '$numlog'";



// jalankan query

if ($_SESSION['role'] != 'admin') {
    echo"<script>alert('Hanya Admin yang bisa mengakses fitur ini');window.history.back()</script>";
  } else {
    mysqli_multi_query($koneksi, $query);
  }


// redirect halaman
echo "<script>alert('Data berhasil terhapus');window.location='log-gudang.php'</script>";

