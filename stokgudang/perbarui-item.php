<?php

// Koneksi Database
include_once "../connect.php";

// Parsing / Menangkap Data
$unitname = mysqli_real_escape_string($koneksi, $_POST['unitname']);
$stock = mysqli_real_escape_string($koneksi, $_POST['stock']);
$minstock = mysqli_real_escape_string($koneksi, $_POST['minstock']);


$qry ="UPDATE tb_gudang SET satuan = '$unitname', jml_stok = '$stock', mins = '$minstock' WHERE kode_brg = '$itemcode'"; 
// Validasi jika ada data yang kosong

if($unitname == "Pilih Satuan Unit" || ""){
  echo "<script>alert('Nama barang belum diisi');window.history.back()</script>";
}elseif($stock== ""){
  echo "<script>alert('Tipe barang belum diisi');window.history.back()</script>";
}elseif($minstock == "Pilih Kategori"){
  echo "<script>alert('Nama Kategori belum dipilih');window.history.back()</script>";
}else{
  // Jika data semua sudah terisi
  $qry_item = mysqli_query($koneksi, $qry);
  echo "<script>alert('Data berhasil diperbarui');window.location='tampilstokgdg.php'</script>";
}

// $qry_item = mysqli_query($koneksi, "INSERT INTO tb_ruang VALUES('$itemcode','$itemname','$itemtype','$idcategory','$categoryname','$unitname','$stock','$minstock')");
// echo "<script>alert('Data berhasil tersimpan');window.location='tampilstok.php'</script>";
?>