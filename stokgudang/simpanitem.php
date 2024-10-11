<?php

// Koneksi Database
include_once "../connect.php";
include_once "get_item.php";

// Parsing / Menangkap Data
$itemcode = mysqli_real_escape_string($koneksi, $_POST['itemcode']);
$itemname = mysqli_real_escape_string($koneksi, $_POST['itemname']);
$unitname = mysqli_real_escape_string($koneksi, $_POST['unitname']);
$stock = mysqli_real_escape_string($koneksi, $_POST['stock']);
$minstock = mysqli_real_escape_string($koneksi, $_POST['minstock']);
$inputdate = mysqli_real_escape_string($koneksi, $_POST['inputdate']);
$inputdatedb = date('Y-m-d', strtotime(str_replace("/", "-", $inputdate)));

//parsing nomor log
$getdata = "SELECT max(no_log) as kodeMax FROM tb_masuk_gdg";
$hasil = mysqli_query($koneksi, $getdata);
$data = mysqli_fetch_array($hasil);
$lognum = $data['kodeMax'];
$fym = substr("$lognum", 1, -2);
$nextKode = (int) substr($lognum, 8);
$t = time();
$date = date("mY", $t);
if ($fym == $date) {
  $nextKode++;
}else{
 $nextKode = 1;
}
$logcode = "G$date" . sprintf("%00s", "-$nextKode");



$qry ="INSERT INTO tb_gudang (kode_gdg, kode_brg, satuan, jml_stok, mins, tanggal)
VALUES('$itemcode','$itemname','$unitname','$stock','$minstock', '$inputdatedb')
ON DUPLICATE KEY UPDATE jml_stok = jml_stok + $stock, tanggal = '$inputdatedb';";
$qry .="INSERT INTO tb_masuk_gdg (no_log, kode_brg, stok_in, tanggal)
VALUES ('$logcode', '$itemname', '$stock', '$inputdate')";
// Validasi jika ada data yang kosong

if($itemname == "Pilih Barang"){
  echo "<script>alert('Kategori barang belum dipilih');window.history.back()</script>";
}elseif($unitname == ""){
  echo "<script>alert('Satuan Unit belum dipilih');window.history.back()</script>";
}elseif($stock == ""){
    echo "<script>alert('Jumlah Stok Belum Diisi');window.history.back()</script>";
}elseif($minstock == ""){
    echo "<script>alert('Jumlah Minimal Stok Belum Diisi');window.history.back()</script>";
}elseif($inputdate == ""){
  echo "<script>alert('Tanggal belum dipilih');window.history.back()</script>";
}else{
  // Jika data semua sudah terisi
  $qry_item = mysqli_multi_query($koneksi, $qry);
  echo "<script>alert('Data berhasil tersimpan');window.location='tampilstokgdg.php'</script>";
}
?>