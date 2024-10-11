<?php

session_start();

if ($_SESSION['nama'] == '') {
    header("location:login.php");
} else {
    header("refresh:5; URL=../home.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">
    <title>Berhasil Login</title>
</head>

<body>
    <div class="container-logout">
        <form action="" method="POST" class="login-email">
            <?php echo "<h1>Selamat Datang, " . $_SESSION['nama'] . "!" . "</h1>"; ?>

            <div class="input-group">
                <a href="logout.php" class="btn">Logout</a>
            </div>
        </form>
    </div>
</body>

</html>