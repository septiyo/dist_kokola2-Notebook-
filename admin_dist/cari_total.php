<?php
header('Content-Type: application/json');
include "../koneksi.php";
ini_set('display_errors','0');


//echo json_encode('dari sana');


  $bulanx = $_GET['BULAN'];
  $tahunx = $_GET['TAHUN'];
  
  //echo json_encode($tahunx);
  //exit;
  
  
/*  $sql = "SELECT
       SUM(forecast.BULAN1)AS BULAN1,
       SUM(forecast.BULAN2)AS BULAN2,
       SUM(forecast.BULAN3)AS BULAN3
       FROM forecast
       WHERE forecast.`TRIWULAN` = '$bulanx'
       AND forecast.`publish` = '1';";*/
  
   //echo json_encode($sql);
  
  if($tahunx == "2016"){
	  
	  
$sql = "SELECT
       SUM(forecast.BULAN1)AS BULAN1,
       SUM(forecast.BULAN2)AS BULAN2,
       SUM(forecast.BULAN3)AS BULAN3
       FROM forecast
       WHERE `TRIWULAN` = '$bulanx'
       AND forecast.`publish` = '1';";
	   
	  
	}
	else{
		
	$sql = "SELECT
       SUM(forecast.BULAN1)AS BULAN1,
       SUM(forecast.BULAN2)AS BULAN2,
       SUM(forecast.BULAN3)AS BULAN3
       FROM forecast
       WHERE `TRIWULAN` = '$bulanx'
       AND forecast.`publish` = '1'
	   AND forecast.TAHUN_INPUT = '$tahunx';";
			

	}

	   
	   
	   
	   $hasil = mysqli_query($mysqli, $sql);
	   
	   //$data = mysqli_fetch_assoc($hasil);
	   
	   foreach($hasil as $row){
		   
		   $jos[] = array(
		       
		              'BULAN1' => $row[BULAN1],
		              'BULAN2' => $row[BULAN2],
		              'BULAN3' => $row[BULAN3]
		   
					);
		   
	   };
	   
	   echo json_encode($jos);

	   
	   







?>