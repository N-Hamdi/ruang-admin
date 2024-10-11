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
    <title>Nex - Daftar Form Pemakaian</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="../vendor/datatables/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../vendor/datatables/buttons.dataTables.min.css" rel="stylesheet">
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
                        <h1 class="h3 mb-0 text-gray-800">Pemakaian Material - Jumlah</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item">Form</li>
                            <li class="breadcrumb-item active" aria-current="page">Pemakaian Material</li>
                        </ol>
                    </div>

                    <!-- Row -->
                    <div class="row">
                        <!-- Datatables -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Hitung Jumlah Pemakaian</h6>
                                </div>
                                <form action="" method="GET">
                                    <div class="card-header py-3">
                                        <label for="dateRangePicker">Range Select</label>
                                        <div class="input-daterange input-group">
                                            <input type="date" name="from_date" value="<?php if (isset($_GET['from_date'])) {
                                                                                            echo $_GET['from_date'];
                                                                                        } ?>" class="form-control">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">to</span>
                                            </div>
                                            <input type="date" name="to_date" value="<?php if (isset($_GET['to_date'])) {
                                                                                            echo $_GET['to_date'];
                                                                                        } ?>" class="form-control">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Filter Berdasarkan jangka waktu</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Subjek</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include_once('../connect.php');
                                            if (isset($_GET['from_date']) && isset($_GET['to_date'])) {

                                                $from_date = $_GET['from_date'];
                                                $to_date = $_GET['to_date'];

                                                $queryd = "SELECT 
                                                YEAR(tanggal) as tahun, monthname(tanggal) as nmbulan, subjek
                                                FROM tb_pemakaian INNER JOIN tb_brg 
                                                ON tb_pemakaian.kode_brg = tb_brg.kode_brg
                                                WHERE tanggal BETWEEN '$from_date' AND '$to_date'
                                                ORDER BY tanggal ASC";
                                                $query_drun = mysqli_query($koneksi, $queryd);

                                                if (mysqli_num_rows($query_drun) > 0) {


                                                    while ($drow = mysqli_fetch_assoc($query_drun)) {
                                            ?>
                                                        <tr>
                                                            <td><?php echo $drow['nmbulan'], ' ', $drow['tahun']; ?></td>
                                                            <td><?php echo $drow['subjek']; ?></td>
                                                        </tr>
                                            <?php
                                                    }
                                                } else {
                                                    echo "No Record Found";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        </tbody>
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Barang Yang Terpakai</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include_once('../connect.php');

                                            if (isset($_GET['from_date']) && isset($_GET['to_date'])) {

                                                $from_date = $_GET['from_date'];
                                                $to_date = $_GET['to_date'];

                                                $query = "SELECT tanggal, tb_brg.nama_brg, subjek, SUM(jumlah) as total 
                                                FROM tb_pemakaian INNER JOIN tb_brg 
                                                ON tb_pemakaian.kode_brg = tb_brg.kode_brg
                                                WHERE tanggal BETWEEN '$from_date' AND '$to_date'
                                                GROUP BY nama_brg
                                                ORDER BY tanggal";
                                                $query_run = mysqli_query($koneksi, $query);

                                                if (mysqli_num_rows($query_run) > 0) {

                                                    $itemname = $row['nama_brg'];
                                                    $qty = $row['jumlah'];
                                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                            ?>
                                                        <tr>
                                                            <td><?php echo $row['nama_brg']; ?></td>
                                                            <td><?php echo $row['total']; ?></td>
                                                        </tr>
                                            <?php
                                                    }
                                                } else {
                                                    echo "No Record Found";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- DataTable with Hover -->

                    </div>
                    <!--Row-->

                    <!-- Documentation Link -->

                    <!-- Modal Logout -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to logout?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                    <a href="login.html" class="btn btn-primary">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>

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
    <!-- Page level plugins -->
    <script src="../vendor/jquery/jquery-3.5.1.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/ruang-admin.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../vendor/datatables/dataTables.rowsGroup.js"></script>
    <script src="../vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <script src="../vendor/datatables/dataTables.buttons.min.js"></script>
    <script src="../vendor/datatables/buttons.print.min.js"></script>
    <script src="../vendor/datatables/buttons.html5.min.js"></script>
    <script src="../vendor/ajax/jszip.min.js"></script>
    <script src="../vendor/ajax/pdfmake.min.js"></script>
    <script src="../vendor/ajax/vfs_fonts.js"></script>



    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {

            var table = $('#dataTable').DataTable({
                'rowsGroup': [0, 1],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]

            });

            $('#dataTable').DataTable(); // ID From dataTable 
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
            $('#simple-date4 .input-daterange').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                todayBtn: 'linked',
            });
        });
    </script>

</body>

</html>