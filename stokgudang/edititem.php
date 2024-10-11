<?php

session_start();

if (!isset($_SESSION['nama'])) {
  header("Location: index.php");
}

if ($_SESSION['role'] != 'admin') {
  echo"<script>alert('Hanya Admin yang bisa mengakses fitur ini');window.history.back()</script>";
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
  <title>Nex - Gudang Besar</title>
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
            <h1 class="h3 mb-0 text-gray-800">Ubah Data Barang</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Gudang Besar</li>
              <li class="breadcrumb-item active" aria-current="page">Edit Barang</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Ubah Data Barang</h6>
                </div>
                <div class="card-body">
                  <form action="perbarui-item.php" method="POST">
                    <div class="form-group">
                      <label>Kode Barang</label>
                      <?php
                        // koneksi database
                        include '../connect.php';
                        $itemcode = $_GET['kode_gdg'];

                        $data = mysqli_query($koneksi, "SELECT * FROM tb_gudang
                        INNER JOIN tb_brg
                        ON tb_gudang.kode_brg = tb_brg.kode_brg");
                        $d = mysqli_fetch_array($data)
                        ?>

                      <input type="itemcode" class="form-control" aria-describedby="itemcode" name="itemcode" value="<?php echo $itemcode; ?>" readonly>
                      <small id="emailHelp" class="form-text text-muted">terisi otomatis</small>

                    </div>
                    <div class="form-group">
                      <label>Nama Barang</label>
                      <input type="text" class="form-control" placeholder="Input Nama Barang" id="itemname" name="itemname" value="<?php echo $d['nama_brg']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Tipe Barang</label>
                      <input type="text" class="form-control" placeholder="Input Tipe Barang" id="itemtype" name="itemtype" value="<?php echo $d['tipe_brg']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Kategori Barang</label>
                      <input type="text" class="form-control" placeholder="Input Tipe Barang" id="itemcategory" name="itemcategory" value="<?php echo $d['kategori']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Pilih Satuan Unit Barang</label>
                      <select class="form-control" id="unitname">
                      <option value="" selected disabled>Pilih Satuan Unit</option>
                        <?php
                        $getcat = mysqli_query($koneksi, "SELECT * from tb_satuan");
                        while ($optkat = mysqli_fetch_array($getcat)) {
                          $idUNIT = $optkat['id_satuan'];
                          $nmUNIT = $optkat['satuan'];

                        ?>
                          <option value="<?php echo $idUNIT; ?>"><?php echo $nmUNIT; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Stok</label>
                      <input type="text" class="form-control" placeholder="Input Stok" id="stock" name="stock" value="<?php echo $d['jml_stok']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Stok Minimal Barang</label>
                      <input type="text" class="form-control" placeholder="Input Stok Minimal" id="minstock" name="minstock" value="<?php echo $d['mins']; ?>">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                    <input type="reset" class="btn btn-warning" value="Reset">
                  </form>

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
  <!-- Select2 -->
  <script src="../vendor/select2/dist/js/select2.min.js"></script>
  <!-- Bootstrap Datepicker -->
  <script src="../vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap Touchspin -->
  <script src="../vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
  <!-- ClockPicker -->
  <script src="../vendor/clock-picker/clockpicker.js"></script>
  <!-- RuangAdmin Javascript -->
  <script src="../js/ruang-admin.min.js"></script>
  <!-- Javascript for this page -->
  <script>
    $(document).ready(function() {


      $('.select2-single').select2();

      // Select2 Single  with Placeholder
      $('.select2-single-placeholder').select2({
        placeholder: "Select a Province",
        allowClear: true
      });

      // Select2 Multiple
      $('.select2-multiple').select2();

      // Bootstrap Date Picker
      $('#simple-date1 .input-group.date').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,
      });

      $('#simple-date2 .input-group.date').datepicker({
        startView: 1,
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        todayBtn: 'linked',
      });

      $('#simple-date3 .input-group.date').datepicker({
        startView: 2,
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        todayBtn: 'linked',
      });

      $('#simple-date4 .input-daterange').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        todayBtn: 'linked',
      });

      // TouchSpin

      $('#touchSpin1').TouchSpin({
        min: 0,
        max: 100,
        boostat: 5,
        maxboostedstep: 10,
        initval: 0
      });

      $('#touchSpin2').TouchSpin({
        min: 0,
        max: 100,
        decimals: 2,
        step: 0.1,
        postfix: '%',
        initval: 0,
        boostat: 5,
        maxboostedstep: 10
      });

      $('#touchSpin3').TouchSpin({
        min: 0,
        max: 100,
        initval: 0,
        boostat: 5,
        maxboostedstep: 10,
        verticalbuttons: true,
      });

      $('#clockPicker1').clockpicker({
        donetext: 'Done'
      });

      $('#clockPicker2').clockpicker({
        autoclose: true
      });

      let input = $('#clockPicker3').clockpicker({
        autoclose: true,
        'default': 'now',
        placement: 'top',
        align: 'left',
      });

      $('#check-minutes').click(function(e) {
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
      });

    });
  </script>
  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>