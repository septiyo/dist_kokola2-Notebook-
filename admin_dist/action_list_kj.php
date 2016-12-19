<?php
header('Content-Type: application/json');
include "../koneksi.php";
ini_set('display_errors','0');


//echo json_encode('dari sana');


  $sono = $_GET['DATA'];
  
  $bulan = $sono['bulan'];
  
 /*  echo json_encode($sono);
  exit; */


   $sql = "SELECT push_distributor.ACCOUNT_ID,
       push_distributor.ACCOUNT_NAME,
       push_distributor.PRICEGROUP_CODE,
       push_distributor.CATEGORY_ID,
       kj.BULAN_INPUT,
       SUM(kj.BULAN1)AS BULAN1,
       SUM(kj.BULAN2)AS BULAN2,
       SUM(kj.BULAN3)AS BULAN3
             
       
       FROM 
       push_distributor
       INNER JOIN kj
       ON push_distributor.ACCOUNT_ID=kj.ACCOUNT_ID
       WHERE MONTH(kj.TGL) = '".$bulan."'
       GROUP BY push_distributor.ACCOUNT_ID
       
       ORDER BY 
       push_distributor.ACCOUNT_NAME ASC";
	   
	   
	   $hasil = mysqli_query($mysqli, $sql);
	   
	   //$data = mysqli_fetch_assoc($hasil);
	   
	   foreach($hasil as $row){
		   
		   $jos[] = array(
		              'ACCOUNT_ID' => $row[ACCOUNT_ID],
		              'ACCOUNT_NAME' => $row[ACCOUNT_NAME],
		              'PRICEGROUP_CODE' => $row[PRICEGROUP_CODE],
		              'CATEGORY_ID' => $row[CATEGORY_ID],
		              'BULAN_INPUT' => $row[BULAN_INPUT],
		              'BULAN1' => $row[BULAN1],
		              'BULAN2' => $row[BULAN2],
		              'BULAN3' => $row[BULAN3]
		   
					);
		   
	   };
	   
	   echo json_encode($jos);

	   
	   







?>