<?php
session_start();
include 'config.php';
$id=$_GET['updt'];
$query="select judul,isi from pengumuman where pe_id='$id'";
$hasil=mysqli_query($conn,$query) or die (mysqli_error($conn));
list($judul,$isi)=mysqli_fetch_array($hasil);
if(isset($_POST['upload']))
{    

    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
	$id=$_GET['updt'];
	$query = "UPDATE pengumuman SET judul='$judul' , isi='$isi' WHERE pe_id=$id";
    mysqli_query($conn, $query) or die('Error, query failed. ' . mysqli_error($conn));
	header("Location: listpengumuman.php");
	exit;
		
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Ubah Pengumuman</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/Logo_PENS.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="mainuser.php">
          <img src="images/Logo_PENS2.png" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="mainuser.php">
          <img src="images/logo-mini.svg" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, <?php echo $_SESSION['nama']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a href="logout.php" class="dropdown-item">
                Sign Out
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="text-wrapper">
                  <p class="profile-name"><?php echo $_SESSION['nama']; ?></p>
                  <div>
                    <small class="designation text-muted"><?php echo $_SESSION['status']; ?></small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="mainuser.php">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="listpengumuman.php">
              <i class="menu-icon mdi mdi-comment-alert-outline"></i>
              <span class="menu-title">Pengumuman</span>
            </a>
          </li>
<?php if(($_SESSION['status'])=='admin') {?>
          <li class="nav-item">
            <a class="nav-link" href="listuser.php">
              <i class="menu-icon mdi mdi-account"></i>
              <span class="menu-title">Dosen</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="listkegiatan.php">
              <i class="menu-icon mdi mdi-newspaper"></i>
              <span class="menu-title">Kegiatan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="listprestasi.php">
              <i class="menu-icon mdi mdi-trophy-variant"></i>
              <span class="menu-title">Prestasi</span>
            </a>
          </li>
                                  <li class="nav-item">
            <a class="nav-link" href="listsaran.php">
              <i class="menu-icon mdi mdi-trophy-variant"></i>
              <span class="menu-title">Saran</span>
            </a>
          </li>
<?php }?>
        </ul>
      </nav>
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Pengumuman</h4>
                  <p class="card-description">
                    Ubah info pengumuman di sini
                  </p>
                  <form action="" class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Judul</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" value="<?php echo $judul?>" name="judul">
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Textarea</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="10" name="isi"><?php echo $isi?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success mr-2" name="upload" value="upload">Simpan</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">copyright ?? 2018 All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">This is made with <i class="mdi mdi-heart-outline text-danger"></i> by Oktavia Citra -Mochammad Aliffiansyah Maulana - Mayshella Ainun
            </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
