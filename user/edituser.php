<?php
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location:../index.php");
}

if ($_SESSION['role'] != 'admin') {
    echo "<script>alert('Hanya Admin yang bisa mengakses fitur ini');window.history.back()</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../img/logo/logo-nex.png" rel="icon">
    <title>Nex - Edit data user</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include "../include/sidebar.php"; ?>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <?php include "../include/topbar.php"; ?>
                <!-- Topbar -->
                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Menu admin</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item">Menu Admin</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                        </ol>
                    </div>

                    <!-- Row -->
                    <div class="row">
                        <!-- Datatables -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Data User</h6>
                                </div>
                                <div class="card-body">
                                    <form action="perbarui-user" method="POST">
                                        <div class="form-group">
                                            <label>User ID</label>
                                            <?php
                                            // koneksi database
                                            include '../connect.php';
                                            $ID = $_GET['id'];

                                            $data = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$ID'");
                                            $d = mysqli_fetch_array($data)
                                            ?>

                                            <input type="itemcode" class="form-control" aria-describedby="itemcode" name="itemcode" value="<?php echo $ID; ?>" readonly>

                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" placeholder="Masukkan username" id="username" name="username" value="<?php echo $d['username']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" placeholder="Masukkan nama" id="name" name="name" value="<?php echo $d['nama']; ?>">
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label for="exampleFormControlSelect1">Pilih Role User</label>
                                            <select class="form-control" id="role" name="role">
                                                <option value="" selected disabled>Pilih role</option>
                                                <option>admin</option>
                                                <option>staff</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Tolong masukkan password
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Repeat Password</label>
                                            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Repeat Password">
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Tolong ketik ulang password
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary" value="Simpan">
                                        <input type="reset" class="btn btn-warning" value="Reset">
                                        <a href="daftar-user" class="btn btn-danger">Kembali</a>

                                    </form>

                                </div>

                            </div>
                        </div>
                        <!-- DataTable with Hover -->

                    </div>
                    <!--Row-->

                    <!-- Documentation Link -->

                    <!-- Modal Logout -->
                    <?php include "../include/modal-logout.php"; ?>

                </div>
                <!---Container Fluid-->
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy; <script>
                                document.write(new Date().getFullYear());
                            </script> - developed by
                            <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/ruang-admin.min.js"></script>

</body>

</html>