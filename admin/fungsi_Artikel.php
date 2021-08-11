<?php
function tampilArtikel()
{
	global $conn;
	
	$query = "SELECT k.ke_id, k.tanggal, k.judul, k.deskri, g.p_nama FROM kegiatan k, galery g WHERE k.p_id = g.p_id order by k.ke_id desc";
	$res = mysqli_query($conn, $query);
	
	$row = [];
	
	while($rows = mysqli_fetch_array($res)){
		$row[] = $rows;
	}
	
	return $row;
}
function detailArtikel($idArtikel)
{
	global $conn;
	
	$query= "SELECT k.ke_id, k.judul, k.deskri, k.tanggal, g.p_nama FROM kegiatan k, galery g WHERE k.p_id = g.p_id AND k.ke_id = '$idArtikel' ";
	
	$res = mysqli_query($conn, $query);
	
	$row=mysqli_fetch_array($res);
	
	return $row;
}

/*function postArtikel($data)
{
	global $conn;
	
	$judul = $data['judul'];
	$isi = $data['isi'];
	$tanggal = date("d-m-Y");
	$filename = $_FILES['userfile']['name']; 
	$tmpname  = $_FILES['userfile']['tmp_name']; 
	$filesize = $_FILES['userfile']['size']; 
	$filetype = $_FILES['userfile']['type']; 
			
	$filepath = $uploaddir . $filename; 
         
	$result    = move_uploaded_file($tmpname, $filepath); 
	//print_r($_SESSION);
	if (!$result)
	{ 
		echo "Error uploading file"; 
		exit; 
	} 
	if(!get_magic_quotes_gpc()) 
	{ 
		$filename  = addslashes($filename); 
		$filepath  = addslashes($filepath); 
	}   
	
	$query2 ="INSERT INTO galery ( p_nama,p_ukuran,p_tipe,p_path) VALUES ('$filename','$filesize','$filetype','$filepath')";
    mysqli_query($conn,$query2) or die('Error, query failed' . mysqli_error($conn));
	
	$query = "INSERT INTO kegiatan VALUES ('', '$judul', '$isi', LAST_INSERT_ID(), '$tanggal') ";
	
	if(mysqli_query($conn, $query)){
		echo "Sukses Simpan Data";
	}
		
}*/

function editArtikel($data, $idArtikel)
{
	global $conn;
	
	$judul = $data['judul'];
	$isi = $data['isi'];
	
	$query="UPDATE kegiatan SET judul = '$judul', deskri = '$isi' WHERE ke_id = '$idArtikel' ";
	
	if(mysqli_query($conn, $query)){
		//echo "Sukses Update Data";
	}
}

function hapusArtikelKomen($idArtikel)
{
	global $conn;
	
	$query = "DELETE kegiatan.* , komentar.*, galery.* FROM kegiatan, komentar, galery WHERE kegiatan.ke_id = '$idArtikel'
	    AND komentar.artikel = '$idArtikel' AND kegiatan.p_id=galery.p_id";
		
	if(mysqli_query($conn, $query)){
		echo "SUKSES HAPUS DATA";
	}
}

function hapusArtikel($idArtikel)
{
	global $conn;
	
	$pic ="SELECT p_id FROM kegiatan WHERE ke_id='$idArtikel' ";
	$result=mysqli_query($conn, $pic);
    list($photo)=mysqli_fetch_array($result);
	$query="DELETE FROM galery WHERE p_id='$photo'";
	
	$query2="DELETE FROM kegiatan WHERE ke_id='$idArtikel' ";
	//$query = "DELETE kegiatan.*, galery.* FROM kegiatan, galery WHERE kegitan.ke_id='$idArtikel' AND kegiatan.p_id = gaelry.p_id ";
		
		echo "SUKSES HAPUS DATA";
}
	
function cekkomen($idArtikel){
	global $conn;
	
	$query="SELECT * FROM komentar WHERE artikel = '$idArtikel'";
	$res = mysqli_query($conn, $query);
	
	$cek=mysqli_num_rows($res);
	
	if($cek > 0){
		hapusArtikelKomen($idArtikel);
	}else
		hapusArtikel($idArtikel);
	
}
?>