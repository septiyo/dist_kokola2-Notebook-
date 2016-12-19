<?php
header('Content-Type: application/json');
include "../koneksi.php";
ini_set('display_errors','0');


//echo json_encode('dari sana');


  $sono = $_GET['DATA'];
  
  //$bulan = $sono['bulan'];
  
 /*  echo json_encode($sono);
  exit;  */



	   
//	   $sql = "SELECT
//       SUM(kj.BULAN1)AS BULAN1,
//       SUM(kj.BULAN2)AS BULAN2,
//       SUM(kj.BULAN3)AS BULAN3
//
//
//       FROM kj
//       LEFT JOIN m_produk
//       ON m_produk.ITEM_CODE=kj.ITEM_CODE
//
//       WHERE MONTH(kj.TGL) = '".$sono."'
//       AND kj.`publish` = '1'
//
//       ORDER BY m_produk.NAMA_PRODUK ASC;";



$sql = "SELECT
       SUM(forecast.BULAN1)AS BULAN1,
       SUM(forecast.BULAN2)AS BULAN2,
       SUM(forecast.BULAN3)AS BULAN3


       FROM forecast


       WHERE `TRIWULAN` = '$sono'
       AND forecast.`publish` = '1';";
	   
	   
	   
	   
	   
	   
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