<?php

session_start();

if (!isset($_SESSION['nama'])) {
  header("Location:../index.php");
}

// Koneksi Database
include_once "../connect.php";

// Parsing / Menangkap Data
$itemcode = mysqli_real_escape_string($koneksi, $_POST['itemcode']);
$itemname = mysqli_real_escape_string($koneksi, $_POST['itemname']);
$itemtype = mysqli_real_escape_string($koneksi, $_POST['itemtype']);
$categoryname = mysqli_real_escape_string($koneksi, $_POST['categoryname']);


$qry ="UPDATE tb_brg SET nama_brg = '$itemname', tipe_brg = '$itemtype', kategori = '$categoryname' WHERE kode_brg = '$itemcode'"; 
// Validasi jika ada data yang kosong

if($itemname == ""){
  echo "<script>alert('Nama barang belum diisi');window.history.back()</script>";
}elseif($itemtype== ""){
  echo "<script>alert('Tipe barang belum diisi');window.history.back()</script>";
}elseif($categoryname == "Pilih Kategori"){
  echo "<script>alert('Nama Kategori belum dipilih');window.history.back()</script>";
}else{
  // Jika data semua sudah terisi
  $qry_item = mysqli_query($koneksi, $qry);
  echo "<script>alert('Data berhasil diperbarui');window.location='tampildatabarang.php'</script>";
}

// $qry_item = mysqli_query($koneksi, "INSERT INTO tb_ruang VALUES('$itemcode','$itemname','$itemtype','$idcategory','$categoryname','$unitname','$stock','$minstock')");
// echo "<script>alert('Data berhasil tersimpan');window.location='tampilstok.php'</script>";
?>