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
  <title>Nex - Daftar Barang</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.css" rel="stylesheet">
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="../vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css" rel="stylesheet">
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
            <h1 class="h3 mb-0 text-gray-800">Daftar Barang</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Daftar Barang</li>
              <li class="breadcrumb-item active" aria-current="page">Daftar Data Barang</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Daftar Barang yang umum digunakan di Nex DC</h6>
                </div>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <a href="tambahbarang" class="btn btn-success">Tambah Item</a>
                </div>
                <div class="table-responsive p-3">
                  <?php
                  include_once('../connect.php');
                  $result = mysqli_query($koneksi, "SELECT * FROM tb_brg");
                  ?>
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Tipe Barang</th>
                        <th>Kategori</th>
                        <th class="datatable-nosort">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($rows = mysqli_fetch_assoc($result)) {
                        $itemcode = $rows['kode_brg'];
                        $itemname = $rows['nama_brg'];
                        $itemtype = $rows['tipe_brg'];
                        $categoryname = $rows['kategori']

                      ?>
                        <tr>
                          <td><?php echo $itemcode; ?></td>
                          <td><?php echo $itemname; ?></td>
                          <td><?php echo $itemtype; ?></td>
                          <td><?php echo $categoryname; ?></td>
                          <td>
                            <?php
                            // if ($_SESSION['role'] != 'admin') {
                            //   echo"<script>alert('Hanya Admin yang bisa mengakses fitur ini');window.history.back()</script>";
                            // }
                            ?>
                            <a href="editbarang?kode_brg=<?php echo $itemcode; ?>" class=" btn btn-warning">Edit</a>
                            <a href="hapusbarang?kode_brg=<?php echo $itemcode; ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini ?')">Delete</a>
                          </td>

                        </tr>
                      <?php
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
  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>


  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover

    });
  </script>

</body>

</html>