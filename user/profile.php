<?php
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location:../index.php");
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
    <title>Nex - Profile</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                                            $username = $_GET['username'];

                                            $data = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
                                            $d = mysqli_fetch_array($data)
                                            ?>

                                            <input type="text" class="form-control" aria-describedby="id" name="id" value="<?php echo $d['id']; ?>" readonly>

                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" placeholder="Masukkan username" id="username" name="username" value="<?php echo $username; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" placeholder="Masukkan nama" id="name" name="name" value="<?php echo $d['nama']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Role</label>
                                            <input type="text" class="form-control" placeholder="Masukkan nama" id="name" name="role" value="<?php echo $d['role']; ?>" readonly>
                                        </div>
                                        <a href="gantipass?id=<?php echo $d['id'];?>&username=<?php echo $d['username'];?>"  class="btn btn-primary">Ganti Password</a>
                                        <a href="../home.php" class="btn btn-danger">Kembali</a>
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