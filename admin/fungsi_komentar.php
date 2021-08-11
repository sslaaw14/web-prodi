<?php 
function jumlahkomentar($idArtikel)
{
	global $conn;
	
	$query = "SELECT * FROM komentar WHERE artikel= '$idArtikel' ";
	$res = mysqli_query($conn, $query);
	
	$row = mysqli_num_rows($res);
	
	return $row;
}

function tampilkomentar($idArtikel)
{
	global $conn;
	
	$query = "SELECT * FROM komentar WHERE artikel= '$idArtikel' ";
	$res = mysqli_query($conn, $query);
	
	$row = [];
	
	while($rows = mysqli_fetch_array($res)){
		$row[] = $rows;
	}
	
	return $row;
}

function postkomentar($data, $idArtikel)
{
	global $conn;
	
	$nama = $data['name'];
	$isi = $data['isi'];
	$tanggal = date("d-m-Y");
	
	$query = "INSERT INTO komentar VALUES('','$idArtikel', '$nama', '$isi', '$tanggal') ";
	
	if(mysqli_query($conn, $query)){
		echo "<div class='alert alert-success'>Sukses</div>";
	}
}
?>