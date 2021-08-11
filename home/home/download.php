<?php
include 'config.php';
	$id      = $_GET['id']; 
    $query   = "SELECT f_nama, f_ukuran, f_tipe, f_path FROM pengumuman WHERE pe_id = '$id'"; 
    $result  = mysqli_query($conn,$query) or die('Error, query failed'); 
    list($name, $size, $type, $filePath) = mysqli_fetch_array($result); 

    header("Content-Disposition: attachment; filename=$name"); 
    header("Content-length: $size"); 
    header("Content-type: $type"); 
     
    readfile($filePath); 

    mysqli_close($conn);  
     
    exit; 
	?>