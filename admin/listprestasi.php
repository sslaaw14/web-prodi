<?php
session_start();
include 'config.php';
   $rowsPerPage = 2;
    $pageNum = 1;
    if(isset($_GET['page']))
    {
        $pageNum = $_GET['page'];
    }
    $offset = ($pageNum - 1) * $rowsPerPage;
    $query="select pre_id,judul,deskri,tanggal from prestasi order by pre_id desc limit $offset, $rowsPerPage";
    $result = mysqli_query($conn,$query) or die('Error, query failed2'. mysqli_error($conn));
$query2   = "SELECT COUNT(pre_id) AS numrows FROM prestasi";
$result2  = mysqli_query($conn, $query2) or die('Error, query failed');
$row     = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$numrows = $row['numrows'];

// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

// print the link to access each page
$self = $_SERVER['PHP_SELF'];
$nav = '';
for($page = 1; $page <= $maxPage; $page++)
{
    if ($page == $pageNum)
    {
        $nav .= " $page ";   // no need to create a link to current page
    }
    else
    {
        $nav .= " <a href=\"$self?page=$page\">$page</a> ";
    }        
}

// creating previous and next link
// plus the link to go straight to
// the first and last page

if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = " <a href=\"$self?page=$page\">[Prev]</a> ";
    
    $first = " <a href=\"$self?page=1\">[First Page]</a> ";
} 
else
{
    $prev  = '&nbsp;'; // we're on page one, don't print previous link
    $first = '&nbsp;'; // nor the first page link
}

if ($pageNum < $maxPage)
{
    $page = $pageNum + 1;
    $next = " <a href=\"$self?page=$page\">[Next]</a> ";
    
    $last = " <a href=\"$self?page=$maxPage\">[Last Page]</a> ";
} 
else
{
    $next = '&nbsp;'; // we're on the last page, don't print next link
    $last = '&nbsp;'; // nor the last page link
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Prestasi</title>
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
        </ul>
      </nav>
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List Prestasi</h4>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Judul</th>
                          <th>Deskripsi</th>
                          <th>Tanggal</th>
                          <th>Edit</th>
                          <th>Hapus</th>
                        </tr>
                      </thead>
                      <tbody>
            <?php while(list($id,$judul,$isi,$tanggal)=mysqli_fetch_array($result)){?>
                        <tr>
                          <td><?php echo $judul?></td>
                          <td><?php echo $isi?></td>
                          <td><?php echo $tanggal?></td>
                          <td><a href="updateprestasi.php?updt=<?php echo $id?>"><button type="button" class="btn btn-light"><i class="menu-icon mdi mdi-table-edit"></i></button></a> </td>
                          <td><a href="deleteprestasi.php?del=<?php echo $id?>" onclick="return confirm('Yakin Ingin menghapus?')"><button type="button" class="btn btn-danger"><i class="menu-icon mdi mdi-delete"></i></button></a></td>
                        </tr>
                    <?php } ?>
                      </tbody>                        
                        <?php
                        echo "$first "." $prev "." $nav "." $next "." $last"; ?>
                    </table>
                      <a href="newprestasi.php"><button type="button" class="btn btn-icons btn-inversed btn-success"><i class="menu-icon mdi  mdi-trophy-variant"></i></button></a>
                  </div>
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
