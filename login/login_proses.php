<?php
$username   = $_POST['username'];
$pass       = md5($_POST['password']);

include '../connect.php';

$user = mysqli_query($koneksi,"SELECT * FROM users WHERE username='$username' AND password='$pass'");
$chek = mysqli_num_rows($user);

if(($username == "" && $_POST['password'] == "")){
    echo "<script>alert('Username dan password belum diisi');window.history.back()</script>";
}
elseif($username == "") {
    echo "<script>alert('Username belum diisi');window.history.back()</script>";
}elseif($_POST['password'] == "") {
    echo "<script>alert('Password belum diisi');window.history.back()</script>";
}

if($chek>0)
{
    session_start();
    $row = mysqli_fetch_array($user);
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['username'] = $row['username'];
    header("location:welcome.php");
}else
{
    echo "<script>alert('Username atau Password salah');window.history.back()</script>";
}
?>