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
$role = mysqli_real_escape_string($koneksi, $_POST['role']);
$pass = mysqli_real_escape_string($koneksi, $_POST['password']);
$repass = mysqli_real_escape_string($koneksi, $_POST['repassword']);
$checkuname = mysqli_query($koneksi,"SELECT * FROM users WHERE username='$username'");
$checkid = mysqli_query($koneksi,"SELECT * FROM users WHERE id='$id'");
$inspass = md5($pass);


$qry ="INSERT INTO users (id, username, nama, role, password)
VALUES('$id','$username','$name','$role', '$inspass')";
// Validasi jika ada data yang kosong

if($id == ""){
  echo "<script>alert('ID Belum Diisi');window.history.back()</script>";
}elseif(mysqli_num_rows($checkid) > 0){
  echo "<script>alert('id sudah terdaftar');window.history.back()</script>";
}elseif($username== ""){
  echo "<script>alert('username belum diisi');window.history.back()</script>";
}elseif(mysqli_num_rows($checkuname) > 0){
  echo "<script>alert('username sudah terdaftar');window.history.back()</script>";
}elseif($name== ""){
    echo "<script>alert('nama belum diisi');window.history.back()</script>";
}elseif($role == "Pilih role"){
  echo "<script>alert('role user belum dipilih');window.history.back()</script>";
}elseif($pass !== $repass){
    echo "<script>alert('Input ulang password tidak sama');window.history.back()</script>";
}else{
  // Jika data semua sudah terisi
  $qry_item = mysqli_multi_query($koneksi, $qry);
  echo "<script>alert('User berhasil tersimpan');window.location='daftar-user.php'</script>";
}

?>