<?php
session_start();
include 'config.php';
$uploaddir = 'C:/xampp/htdocs/prodi/gambar/';
if(isset($_POST['upload'])) 
    {

        $judulpost = $_POST['judul'];
        $isipost = $_POST['isi'];
        $tanggal = date("d-m-Y");
        $filename = $_FILES['userfile']['name']; 
        $tmpname  = $_FILES['userfile']['tmp_name']; 
        $filesize = $_FILES['userfile']['size']; 
        $filetype = $_FILES['userfile']['type']; 

        $filepath = $uploaddir . $filename; 
		$tanggal=date('d-m-Y');
         
        $result    = move_uploaded_file($tmpname, $filepath); 
        //print_r($_SESSION);
        if (!$result)
        { 
            echo "Error uploading file"; 
            exit; 
        } 
                 
        include 'config.php'; 
        
        if(!get_magic_quotes_gpc()) 
        { 
            $filename  = addslashes($filename); 
            $filepath  = addslashes($filepath); 
        }   
        $query2 ="INSERT INTO galery ( p_nama,p_ukuran,p_tipe,p_path) VALUES ('$filename','$filesize','$filetype','$filepath')";
        mysqli_query($conn,$query2) or die('Error, query failed' . mysqli_error($conn));
        $query = "insert into prestasi (judul,deskri,p_id,tanggal) values ('$judulpost','$isipost',LAST_INSERT_ID(),'$tanggal')"; 

        mysqli_query($conn,$query) or die('Error, query failed' . mysqli_error($conn));
        mysqli_close($conn);   

        echo "<br>prestasi uploaded<br>";
        header('Location: listprestasi.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Buat Prestasi baru</title>
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
                    <small class="designation text-muted"><?php echo $_SESSION['nama']; ?></small>
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
        </ul>
      </nav>
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Buat Prestasi Baru</h4>
                  <p class="card-description">
                    Masukkan info Prestasi baru di sini
                  </p>
                  <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Nama Prestasi</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Nama Kegiatan" name="judul">
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Deskripsi</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="10" name="isi"></textarea>
                    </div>
                    <div class="form-group">
                      <label>File upload</label>
                        <div class="input-group col-12">
                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000"><input name="userfile" type="file" class="box" id="userfile"> 
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2" name="upload">Create</button>
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
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">copyright © 2018 All rights reserved.</span>
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
