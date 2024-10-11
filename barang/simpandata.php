<?php 
session_start();

if (!isset($_SESSION['nama'])) {
  header("Location:../index.php");
}
?>
<?php

// Koneksi Database
include_once "../connect.php";

// Parsing / Menangkap Data
$itemcode = mysqli_real_escape_string($koneksi, $_POST['itemcode']);
$itemname = mysqli_real_escape_string($koneksi, $_POST['itemname']);
$itemtype = mysqli_real_escape_string($koneksi, $_POST['itemtype']);
$categoryname = mysqli_real_escape_string($koneksi, $_POST['categoryname']);


$qry ="INSERT INTO tb_brg (kode_brg, nama_brg, tipe_brg, kategori)
VALUES('$itemcode','$itemname','$itemtype','$categoryname')";
// Validasi jika ada data yang kosong

if($itemname == ""){
  echo "<script>alert('Nama barang belum diisi');window.history.back()</script>";
}elseif($itemtype== ""){
  echo "<script>alert('Tipe barang belum diisi');window.history.back()</script>";
}elseif($categoryname == "Pilih Kategori"){
  echo "<script>alert('Nama Kategori belum dipilih');window.history.back()</script>";
}else{
  // Jika data semua sudah terisi
  $qry_item = mysqli_multi_query($koneksi, $qry);
  echo "<script>alert('Data berhasil tersimpan');window.location='tampildatabarang.php'</script>";
}

// $qry_item = mysqli_query($koneksi, "INSERT INTO tb_ruang VALUES('$itemcode','$itemname','$itemtype','$idcategory','$categoryname','$unitname','$stock','$minstock')");
// echo "<script>alert('Data berhasil tersimpan');window.location='tampilstok.php'</script>";
?>