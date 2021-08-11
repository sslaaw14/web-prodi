<?php 
include 'config.php';
if($_GET['id'])
	{
		
		$id=(int)$_GET['id'];
		$queri="DELETE FROM komentar where ko_id=$id";
		mysqli_query($conn, $queri);
		echo "<script>alert('Sukses');</script>";
		header ('Location:listkegiatan.php');
	}
?>
