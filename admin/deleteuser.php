<?php include 'config.php';
if($_GET['del'])
	{
		$id=(int)$_GET['del'];
		$queri="DELETE FROM user where us_id=$id";
		mysqli_query($conn, $queri) or die('Error, query failed2'. mysqli_error($conn));;
		//header("Location:listuser.php");
	}
?>
