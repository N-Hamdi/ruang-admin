<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../home">
    <div class="sidebar-brand-icon">
      <img src="../img/logo/logo-nex.png">
    </div>
    <div class="sidebar-brand-text mx-3">Nex</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item">
    <a class="nav-link" href="../home.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Features
  </div>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGudang" aria-expanded="true" aria-controls="collapseGudang">
      <i class="fas fa-fw fa-warehouse"></i>
      <span>Gudang Besar</span>
    </a>
    <div id="collapseGudang" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="../stokgudang/tampilstokgdg.php">Stok Gudang Besar</a>
        <a class="collapse-item" href="../stokgudang/log-gudang.php">Log Masuk Barang</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRStaff" aria-expanded="true" aria-controls="collapseRStaff">
      <i class="fas fa-fw fa-box-open"></i>
      <span>Ruang Staff</span>
    </a>
    <div id="collapseRStaff" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="../stokruang/tampilstokrng.php">Stok Ruang Staff</a>
        <a class="collapse-item" href="../stokruang/log-ruang.php">Log Masuk Barang</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true" aria-controls="collapseTable">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Form</span>
    </a>
    <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="../form/form_pemakaian">Submit Form</a>
        <a class="collapse-item" href="../form/tampilinputform">Lihat Form</a>
        <a class="collapse-item" href="../form/pemakaian">Jumlah Pemakaian</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="../barang/tampildatabarang.php">
      <i class="fas fa-fw fa-boxes"></i>
      <span>Daftar Barang</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <?php 
  if ($_SESSION['role'] == 'admin') { ?>
    <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true" aria-controls="collapsePage">
      <i class="fas fa-fw fa-columns"></i>
      <span>Menu Admin</span>
    </a>
    <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="../user/daftar-user.php">Daftar User</a>
        <a class="collapse-item" href="../user/add-user.php">Register</a>
      </div>
    </div>
  </li>
  <?php } 
  
  ?>
  <hr class="sidebar-divider">
  <div class="version" id="version-ruangadmin"></div>
</ul>