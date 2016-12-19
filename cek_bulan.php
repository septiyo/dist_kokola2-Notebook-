<?php
 session_start();
 include "koneksi.php";
$tahun_now = date('Y');

//$test = "oke";

$bulane = $_POST['bulane'];

   $sql = "SELECT TRIWULAN, TGL FROM kj WHERE `ACCOUNT_ID` = '$_SESSION[ACCOUNT_ID]' 
			AND YEAR(TGL) = '$tahun_now' AND `publish` = '1' AND TRIWULAN = '$bulane';";
			
	$hasil = mysqli_query($mysqli, $sql);
	
	$row = mysqli_num_rows($hasil);
	
	//echo json_encode($row);
	
	if($row >= 1){
	
	    $response_array['status'] = 'ada'; 
    }
    else{

		 $response_array['status'] = 'tidak'; 
	
	}		


echo json_encode($response_array);



?>