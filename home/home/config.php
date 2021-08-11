<?php
// config.php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'prodi';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass); 
if(!$conn){
	die ('Error connecting to mysql');
}	
mysqli_select_db($conn, $dbname);
?>
