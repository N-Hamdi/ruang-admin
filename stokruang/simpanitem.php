<?php

// Koneksi Database
include_once "../connect.php";

// Parsing / Menangkap Data
$itemcode = mysqli_real_escape_string($koneksi, $_POST['itemcode']);
$itemname = mysqli_real_escape_string($koneksi, $_POST['itemname']);
$unitname = mysqli_real_escape_string($koneksi, $_POST['unitname']);
$stock = mysqli_real_escape_string($koneksi, $_POST['inputstock']);
$inputdate = mysqli_real_escape_string($koneksi, $_POST['inputdate']);
$inputdatedb = date('Y-m-d', strtotime(str_replace("/", "-", $inputdate)));
$stokgudang = mysqli_query($koneksi, "SELECT jml_stok FROM tb_gudang where kode_brg = '$itemname'");
$deductvalue = $stock;

if($deductvalue="305" && $unitname="METER"){
  $deductvalue = "1";
}

//parsing nomor log
$getdata = "SELECT max(no_log) as kodeMax FROM tb_masuk_str";
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
$logcode = "R$date" . sprintf("%00s", "-$nextKode");

$qry ="INSERT INTO tb_rstaff (kode_inv, kode_brg, satuan, stok, tanggal)
VALUES('$itemcode','$itemname','$unitname','$stock', '$inputdatedb')
ON DUPLICATE KEY UPDATE stok = stok + $stock, tanggal = '$inputdatedb';";
$qry .= "UPDATE tb_gudang SET jml_stok = jml_stok - $deductvalue
WHERE kode_brg = '$itemname';";
$qry .="INSERT INTO tb_masuk_str (no_log, kode_brg, stok_in, tanggal)
VALUES ('$logcode', '$itemname', '$stock', '$inputdatedb')";

// Validasi jika ada data yang kosong



if($itemname == ""){
  echo "<script>alert('Barang Belum Dipilih');window.history.back()</script>";
}elseif($categoryname == "Pilih Kategori" || ""){
  echo "<script>alert('Kategori barang belum dipilih');window.history.back()</script>";
}elseif($unitname == ""){
  echo "<script>alert('Satuan Unit belum dipilih');window.history.back()</script>";
}elseif($stock == ""){
  echo "<script>alert('Jumlah Stok Belum Diisi');window.history.back()</script>";
}elseif(intval($stokgudang) < intval($deductvalue)){
  echo "<script>alert('Stok di gudang tidak cukup. Silahkan melakukan pengecekan');
  window.history.back()</script>";
}elseif($inputdate == "Tanggal/Bulan/Tahun"){
  echo "<script>alert('Tanggal belum dipilih');window.history.back()</script>";
}else{
  // Jika data semua sudah terisi
  $qry_item = mysqli_multi_query($koneksi, $qry);
  echo "<script>alert('Data berhasil tersimpan');window.location='tampilstokrng.php'</script>";
}

// $qry_item = mysqli_query($koneksi, "INSERT INTO tb_ruang VALUES('$itemcode','$itemname','$itemtype','$idcategory','$categoryname','$unitname','$stock','$minstock')");
// echo "<script>alert('Data berhasil tersimpan');window.location='tampilstok.php'</script>";
?>