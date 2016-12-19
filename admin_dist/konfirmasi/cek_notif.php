<?php
ini_set('display_errors', 0);
       include "../../koneksi.php";
	   
//echo json_encode('josssss');	  

$max = $_POST['max'];


 $sql2 = "SELECT MAX(TGL)AS max_tgl FROM order_distributor;";

 $hasil2 = mysqli_query($mysqli, $sql2);
 
 $data2 = mysqli_fetch_assoc($hasil2);
 
 $tgl_max = $data2[max_tgl];
 
 
 
 
 if($max != ''){
	 
	 $sql = "SELECT * FROM `order_distributor` WHERE TGL > '$max';";

		 $hasil = mysqli_query($mysqli, $sql);
		 
		 $data = mysqli_fetch_assoc($hasil);
		 
	 
	 
	 
 }
 else{
	 
	    
			$data[TGL] = '0';
			$data[ACCOUNT_ID] = '0';
			 $data[ID_ORDER] = '0';


	 
 }
 
     $results[] = array(
        'TGL'=> $data[TGL],
        'ACC' => $data[ACCOUNT_ID],
		'ID_ORDER' => $data[ID_ORDER],
		'TGL_MAX_DATABASE' => $tgl_max,
		
		//'QTY' => $data[],
       

    );

$json = json_encode($results);

echo $json;

?>