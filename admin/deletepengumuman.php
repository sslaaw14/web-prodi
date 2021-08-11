<?php include 'config.php';
if($_GET['del'])
	{
		$id=(int)$_GET['del'];
		$queri="DELETE FROM pengumuman where pe_id=$id";
		mysqli_query($conn, $queri);
		header("Location:listpengumuman.php");
	}
?>
