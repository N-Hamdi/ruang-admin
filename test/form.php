<!DOCTYPE html>
<html lang="en">

<?php

include_once "../connect.php";
include_once "../form/get_item.php"

?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="../img/logo/logo-nex.png" rel="icon">
  <title>Nex - Form Pemakaian Material</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <!-- Select2 -->
  <link href="../vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
  <!-- Bootstrap DatePicker -->
  <link href="../vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <!-- Bootstrap Touchspin -->
  <link href="../vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css" rel="stylesheet">
  <!-- ClockPicker -->
  <link href="../vendor/clock-picker/clockpicker.css" rel="stylesheet">
  <!-- RuangAdmin CSS -->
  <link href="../css/ruang-admin.css" rel="stylesheet">
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
            <h1 class="h3 mb-0 text-gray-800">DataTables</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">DataTables</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Form Pemakaian Material</h6>
                </div>
                <div class="card-body">
                  <form action="" method="POST" id="insert_form">
                    <span id="error"></span>
                    <div class="form-group">
                      <label>Form id</label>
                      <?php
                      include_once "../connect.php";
                      // Cari Kode Barang
                      $query = "SELECT max(kode_form) as kodeMax FROM tb_pemakaian";
                      $hasil = mysqli_query($koneksi, $query);
                      $data = mysqli_fetch_array($hasil);
                      $formid = $data['kodeMax'];
                      $nextKode = (int) substr($formid, 9);
                      $nextKode++;
                      $t = time();
                      $date = date("Ymd", $t);
                      $formid = $date . sprintf("%00s", "-$nextKode");
                      ?>

                      <input type="formid" class="form-control formid" aria-describedby="formid" id="formid[]" name="formid[]" value="<?php echo $formid; ?>" readonly>

                      <small id="emailHelp" class="form-text text-muted">terisi otomatis</small>
                    </div>
                    <div class="form-group" id="simple-date1">
                      <label for="simpleDataInput">Tanggal Pemakaian</label>
                      <div class="input-group date">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control inputdate" value="Tanggal/Bulan/Tahun" id="inputdate" name="inputdate">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Subjek Request</label>
                      <input type="text" class="form-control subjek" placeholder="[Tanggal]Subjek Request" id="subjek" name="subjek">
                    </div>
                    <div class="table-responsive">
                      <table class="table table-bordered" id="item_table">
                        <thead>
                          <tr>
                            <th>Pilih Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span>Tambah</button></th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                    <div align="center">
                      <input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Insert" />
                    </div>
                  </form>
                </div>

                <!-- apapun -->
              </div>
            </div>
            <!-- DataTable with Hover -->

          </div>
          <!--Row-->

          <!-- Documentation Link -->
          <div class="row">
            <div class="col-lg-12">
              <p> third party plugin that is used to generate the demo table below. For more information
                about DataTables, please visit the official <a href="https://datatables.net/" target="_blank">DataTables
                  documentation.</a></p>
            </div>
          </div>

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
  <?php
  include_once "../connect.php";
  include_once "getcat.php";
  ?>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
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

      var count = 0;

      function add_input_field(count) {

        var html = '';

        html += '<tr>';

        html += '<td><select name="item_name[]" class="select2-single form-control item_name"><option value="">Select Unit</option><?php echo fill_item($connect); ?></select><input type="hidden" name="form_id[]" class="form-control form_id" /></td>';

        html += '<td><input type="text" name="item_qty[]" class="form-control item_qty" /><input type="hidden" name="input_date[]" class="form-control input_date" /></td>';

        html += '<td><input type="text" name="item_remarks[]" class="form-control item_remarks" /><input type="hidden" name="form_subject[]" class="form-control form_subject" /></td>';

        // html += '<td style="display:none;"><input type="text" name="form_id[]" class="form-control form_id" /></td>';

        // html += '<td style="display:none;"><input type="hidden" name="input_date[]" class="form-control input_date" /></td>';

        // html += '<td style="display:none;"><input type="hidden" name="form_subject[]" class="form-control form_subject" /></td>';
        

        


        var remove_button = '';

        if (count > 0) {
          remove_button = '<button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button>';
        }

        html += '<td>' + remove_button + '</td></tr>';


        return html;

      }

      $('#item_table').append(add_input_field(0));

      $(document).on('click', '.add', function() {

        count++;

        $('#item_table').append(add_input_field(count));
        $('.select2-single').select2();


      });

      $(document).on('click', '.remove', function() {

        $(this).closest('tr').remove();

      });

      $(document).on('change', '.item_name', function() {

        $('.form_id').val($('.formid').val());

        if ($('.inputdate').val() == "Tanggal/Bulan/Tahun") {
          alert("Tolong isi tanggal terlebih dahulu");
        } else {
          $('.input_date').val($('.inputdate').val());
        }

        if ($('.subjek').val() == "") {
          alert("Tolong isi subjek");
        } else {
          $('.form_subject').val($('.subjek').val());
        }
      });

      $('#insert_form').on('submit', function(event) {

        event.preventDefault();

        var error = '';

        count = 1;

        $('.form_id').each(function() {

          count = count + 1;

        });

        count = 1;

        $("select[name='item_name[]']").each(function() {

          if ($(this).val() == '') {

            error += "<li>Select Item name at " + count + " Row</li>";

          }

          count = count + 1;

        });

        count = 1;

        $('.item_qty').each(function() {

          if ($(this).val() == '') {

            error += "<li>Enter Item Quantity at " + count + " Row</li>";

          }

          count = count + 1;

        });

        count = 1;

        $('.item_remarks').each(function() {

          if ($(this).val() == '') {

            error += "<li>Enter Item remarks at " + count + " Row</li>";

          }

          count = count + 1;

        });



        var form_data = $(this).serialize();

        if (error == '') {

          $.ajax({

            url: "insert.php",

            method: "POST",

            data: form_data,

            beforeSend: function() {

              $('#submit_button').attr('disabled', 'disabled');

            },

            success: function(data) {

              if (data == 'ok') {

                alert('Data tersimpan');
                window.location='form.php'
                // $('#formid').val("#formid")
                // $('#inputdate').val("Tanggal/Bulan/Tahun")
                // $('#subjek').val("")

                // $('#item_table').find('tr:gt(0)').remove();

                // $('#error').html('<div class="alert alert-success">Item Details Saved</div>');

                // $('#item_table').append(add_input_field(0));

                // $('#submit_button').attr('disabled', false);
                // $('.select2-single').select2();
              } 

              if (data == 'not ok') {
                alert('Ada kesalahan pada stok');
                window.location='form.php'
              }

            }
          })

        } else {
          $('#error').html('<div class="alert alert-danger"><ul>' + error + '</ul></div>');
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