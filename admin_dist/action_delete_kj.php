<?php
include "../koneksi.php";

    if(isset($_GET['TRI'])){
	$tri = $_GET['TRI'];
    $dist = $_GET['DIST'];
	
	/* echo $dist;
	exit; */
	
	
	$sql_update = "UPDATE forecast SET publish = '0' WHERE NAMA_DIST = '$dist'
	               AND TRIWULAN = '$tri'";
	
	$hasil_update = mysqli_query($mysqli, $sql_update);
	
	if($hasil_update){
		
		header('Location: admin_kj.php');
		
	/* 	echo "<script>";
		echo "window.location='admin_kj.php'";
		echo "location.replace('admin_kj.php')";
		echo "</script>";
		 */
	}
	else{
		
		header('Location: detail_kj_admin.php');
		
	}
	
	}//end isset




?>