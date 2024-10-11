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
$id = mysqli_real_escape_string($koneksi, $_POST['id']);
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$name = mysqli_real_escape_string($koneksi, $_POST['name']);
$oldpass = mysqli_real_escape_string($koneksi, $_POST['oldpassword']);
$newpass = mysqli_real_escape_string($koneksi, $_POST['newpassword']);
$repass = mysqli_real_escape_string($koneksi, $_POST['repassword']);
$oldmd5 = md5($oldpass);
$inspass = md5($newpass);
$checkpw = mysqli_query($koneksi,"SELECT * FROM users WHERE password='$oldmd5'");


$qry = "UPDATE users SET password = '$inspass' WHERE username = '$username'";
// Validasi jika ada data yang kosong

if(mysqli_num_rows($checkpw) == 0){
    echo "<script>alert('Password lama salah');window.history.back()</script>";
}elseif($newpass !== $repass){
    echo "<script>alert('Input ulang password tidak sama');window.history.back()</script>";
}else{
  // Jika data semua sudah terisi
  $qry_item = mysqli_multi_query($koneksi, $qry);
  echo "<script>alert('Password berhasil diganti');window.location='profile.php'</script>";
}

?>