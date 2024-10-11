<?php

session_start();

if (!isset($_SESSION['nama'])) {
    header("Location:../index.php");
}

// Koneksi Database
include_once "../connect.php";

// Parsing / Menangkap Data
$ID = mysqli_real_escape_string($koneksi, $_POST['id']);
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$name = mysqli_real_escape_string($koneksi, $_POST['name']);
$role = mysqli_real_escape_string($koneksi, $_POST['role']);
$pass = mysqli_real_escape_string($koneksi, $_POST['password']);
$repass = mysqli_real_escape_string($koneksi, $_POST['repassword']);
$inspass = md5($pass);



$qry = "UPDATE users SET nama = '$name', role = '$role', password = '$inspass' WHERE username = '$username'";
// Validasi jika ada data yang kosong

if ($name == "") {
    echo "<script>alert('nama belum diisi');window.history.back()</script>";
} elseif ($role == "Pilih role") {
    echo "<script>alert('role user belum dipilih');window.history.back()</script>";
} elseif ($pass !== $repass) {
    echo "<script>alert('Input ulang password tidak sama');window.history.back()</script>";
} else {
    // Jika data semua sudah terisi
    $qry_item = mysqli_multi_query($koneksi, $qry);
    echo "<script>alert('User berhasil tersimpan');window.location='daftar-user.php'</script>";
}

// $qry_item = mysqli_query($koneksi, "INSERT INTO tb_ruang VALUES('$itemcode','$itemname','$itemtype','$idcategory','$categoryname','$unitname','$stock','$minstock')");
// echo "<script>alert('Data berhasil tersimpan');window.location='tampilstok.php'</script>";
