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
  <title>Nex - Tambah Stok Baru</title>
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
            <h1 class="h3 mb-0 text-gray-800">Tambah atau Update Stok Barang</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Ruang Staff</li>
              <li class="breadcrumb-item active" aria-current="page">Tambah Barang</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tambah Barang</h6>
                </div>
                <div class="card-body">
                  <form action="simpanitem.php" method="POST">
                    <div class="form-group" id="simple-date1">
                      <label for="simpleDataInput">Tanggal Masuk</label>
                      <div class="input-group date">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" value="Tanggal/Bulan/Tahun" id="inputdate" name="inputdate">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Kode Barang</label>
                      <?php
                      include_once "../connect.php";
                      // Cari Kode Barang
                      $query = "SELECT max(kode_inv) as kodeMax FROM tb_rstaff";
                      $hasil = mysqli_query($koneksi, $query);
                      $data = mysqli_fetch_array($hasil);
                      $itemcode = $data['kodeMax'];
                      $nextKode = (int) substr($itemcode, 2, 2);
                      $nextKode++;
                      $char = "R";
                      $itemcode = $char . sprintf("%03s", $nextKode);
                      ?>

                      <input type="itemcode" class="form-control" aria-describedby="itemcode" name="itemcode" value="<?php echo $itemcode; ?>" readonly>
                      <small id="emailHelp" class="form-text text-muted">terisi otomatis</small>
                    </div>
                    <div class="form-group">
                      <label>Category</label>
                      <select class="form-control" id="category" style="width: 400px;">
                        <option value="">Pilih Kategori</option>
                        <?php
                        require_once "../connect.php";
                        $getcat = mysqli_query($koneksi, "SELECT * from tb_kategori");
                        while ($optkat = mysqli_fetch_array($getcat)) {
                          $nmCAT = $optkat['kategori'];

                        ?>
                          <option value="<?php echo $nmCAT; ?>"><?php echo $nmCAT; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Nama Item</label>
                      <select style="width: 400px;" class="form-control" id="itemname" name="itemname">
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Pilih Satuan Unit Barang</label>
                      <select class="form-control" id="unitname" name="unitname">
                        <option value="" selected disabled>Pilih Satuan Unit</option>
                        <?php
                        $getU = mysqli_query($koneksi, "SELECT * from tb_satuan");
                        while ($optU = mysqli_fetch_array($getU)) {
                          $idUNIT = $optU['id_satuan'];
                          $nmUNIT = $optU['satuan'];

                        ?>
                          <option value="<?php echo $nmUNIT; ?>"><?php echo $nmUNIT; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Jumlah yang akan dipindah dari gudang</label>
                      <br>
                      <input type="text" class="form-control" placeholder="Input Stok" id="inputstock" name="inputstock">
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
  <link href="../vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <script src="../vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <!-- ClockPicker -->
  <script src="../vendor/clock-picker/clockpicker.js"></script>
  <!-- Javascript for this page -->
  <script>
    $(document).ready(function() {
      $('#category').on('change', function() {
        var category_id = this.value;
        $.ajax({
          url: "get_item.php",
          type: "POST",
          data: {
            category_id: category_id
          },
          cache: false,
          success: function(result) {
            $("#itemname").html(result);
          }
        });
      });

      $("#unitname").on('change', function(){
        if($(this).val() == "METER"){
          $("#inputstock").val("305").attr('readonly', true);          
        }else{
          $("#inputstock").val("").attr('readonly', false); 
        }
      });

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

    });
  </script>

</body>

</html>