<?php

session_start();

if (!isset($_SESSION['nama'])) {
  header("Location:../index.php");
}

    // Koneksi database
include_once "../connect.php";

// get id / primary key
$numlog = $_GET['no_log'];
$query = "UPDATE tb_gudang INNER JOIN tb_rstaff on tb_gudang.kode_brg = tb_rstaff.kode_brg INNER JOIN tb_masuk_str on tb_gudang.kode_brg = tb_masuk_str.kode_brg SET tb_gudang.jml_stok = CASE WHEN tb_rstaff.satuan = 'METER' && tb_masuk_str.stok_in = 305 THEN tb_gudang.jml_stok + 1 ELSE tb_gudang.jml_stok = tb_gudang.jml_stok + tb_masuk_str.stok_in END WHERE tb_masuk_str.no_log = '$numlog';";
$query .= "UPDATE tb_rstaff 
INNER JOIN tb_masuk_str on tb_rstaff.kode_brg = tb_masuk_str.kode_brg 
set tb_rstaff.stok = GREATEST (0, tb_rstaff.stok - tb_masuk_str.stok_in) 
where tb_masuk_str.no_log ='$numlog';";
$query .= "DELETE FROM tb_masuk_str WHERE no_log = '$numlog'";


// UPDATE tb_gudang INNER JOIN tb_rstaff on tb_gudang.kode_brg = tb_rstaff.kode_brg INNER JOIN tb_masuk_str on tb_gudang.kode_brg = tb_masuk_str.kode_brg SET tb_gudang.jml_stok = CASE WHEN tb_rstaff.satuan = 'METER' && tb_masuk_str.stok_in = 305 THEN tb_gudang.jml_stok + 1 ELSE tb_gudang.jml_stok = tb_gudang.jml_stok + tb_masuk_str.stok_in END WHERE tb_masuk_str.no_log = 'R072022-1';



// jalankan query

if ($_SESSION['role'] != 'admin') {
    echo"<script>alert('Hanya Admin yang bisa mengakses fitur ini');window.history.back()</script>";
  } else {
    mysqli_multi_query($koneksi, $query);
  }


// redirect halaman
echo "<script>alert('Data berhasil terhapus');window.location='log-gudang.php'</script>";

