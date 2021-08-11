<?php 
include 'config.php';
if($_GET['del'])
	{
		$id=(int)$_GET['del'];
        $q1="select p_id from prestasi where pre_id=$id";
        $result=mysqli_query($conn, $q1);
        list($photo)=mysqli_fetch_array($result);
		$queri1="DELETE FROM prestasi where pre_id=$id";
		mysqli_query($conn, $queri1);
        $queri2="DELETE FROM galery where p_id=$photo";
		mysqli_query($conn, $queri2);
		header("Location:listprestasi.php");
	}
?>
