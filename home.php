<?php 
session_start();

if (!isset($_SESSION['nama'])) {
  header("Location:index.php");
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
  <link href="img/logo/logo-nex.png" rel="icon">
  <title>Nex - Sistem Pemakaian Inventaris</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "include/sidebar-main.php"; ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php include "include/topbar-main.php"; ?>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Home</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row mb-3">
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card h-100">
                <?php
                include_once('connect.php');
                $barang = mysqli_query($koneksi, "SELECT * FROM tb_brg");
                $jml_brg = $barang->num_rows;
                ?>
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Barang Yang Terdaftar</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jml_brg ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-box fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card h-100">
                <?php
                include_once('connect.php');
                $gudang = mysqli_query($koneksi, "SELECT * FROM tb_gudang
                  WHERE mins > jml_stok");
                $jml_gdg = $gudang->num_rows;
                ?>
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Stok kurang di gudang</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jml_gdg ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-exclamation-triangle fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card h-100">
                <?php
                include_once('connect.php');
                $rstaff = mysqli_query($koneksi, "SELECT * FROM tb_rstaff
                  WHERE stok < 5");
                $jml_rstaff = $rstaff->num_rows;
                ?>
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Barang stok Staff yang akan habis</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jml_rstaff ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-exclamation-triangle fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-12 col-lg-7 mb-4">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Daftar Penggunaan Material</h6>
                  <a class="m-0 float-right btn btn-danger btn-sm" href="form/tampilinputform.php">View More <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="table-responsive p-3">
                  <?php
                  include_once('../connect.php');
                  $result = mysqli_query($koneksi, "SELECT DISTINCT kode_form, subjek, tanggal FROM tb_pemakaian");
                  ?>
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Kode Form</th>
                        <th>Subjek</th>
                        <th>Tanggal input</th>
                        <th>Pilihan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($rows = mysqli_fetch_assoc($result)) {
                        $formcode = $rows['kode_form'];
                        $subject = $rows['subjek'];
                        $date = $rows['tanggal'];

                      ?>
                        <tr>
                          <td><?php echo $formcode; ?></td>
                          <td><?php echo $subject; ?></td>
                          <td><?php echo $date; ?></td>
                          <td>
                            <a href="form/tampildetailform?kode_form=<?php echo $formcode; ?>" class=" btn btn-warning">detail</a>
                            <a href="form/hapus_data?kode_form=<?php echo $itemcode; ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini ?')">Delete</a>
                          </td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>

            <!-- DataTable with Hover -->

          </div>
          <!--Row-->
          <!-- Modal Logout -->

          <?php include "include/modal-logout-main.php"; ?>

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

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>