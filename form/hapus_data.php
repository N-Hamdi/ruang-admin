<?php

session_start();

if (!isset($_SESSION['nama'])) {
  header("Location:../index.php");
}


// Koneksi database
include_once "../connect.php";

// get id / primary key
$kode_form = $_GET['kode_form'];
$query ="UPDATE tb_rstaff 
INNER JOIN tb_pemakaian on tb_rstaff.kode_brg = tb_pemakaian.kode_brg 
SET tb_rstaff.stok = tb_rstaff.stok + tb_pemakaian.jumlah 
where tb_pemakaian.kode_form = '$kode_form';";
$query .="DELETE FROM tb_pemakaian WHERE kode_form = '$kode_form';";
$query .="ALTER TABLE tb_pemakaian drop id;";
$query .="ALTER TABLE tb_pemakaian add id int(11) NOT NULL AUTO_INCREMENT
FIRST, ADD PRIMARY KEY (id)";

if ($_SESSION['role'] != 'admin') {
  echo"<script>alert('Hanya Admin yang bisa mengakses fitur ini');window.history.back()</script>";
} else {
// jalankan query
mysqli_multi_query($koneksi, $query);

// redirect halaman
echo "<script>alert('Data berhasil terhapus');window.location='tampilinputform.php'</script>";
}
