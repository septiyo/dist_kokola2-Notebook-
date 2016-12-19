<?php
include "../koneksi.php";

       $today = date(d)."-".date(m)."-".date(Y);
        $today_database = date(Y)."-".date(m)."-".date(d);
        $time = date('H:i:s');
	    $bulan = date('M');


$target  = $_POST['KOPLAK'];
$acon_id = $_POST['ACON_ID'];

	  /*delete dulu*/
	  
	    $sql_delete = "DELETE FROM kj_f WHERE ACCOUNT_ID = '$acon_id'";
	    $hasil_delete = mysqli_query($mysqli, $sql_delete);
        
		
		


  foreach($target as $key=>$value){
	  

	  $item_name = $_POST['ITEM_NAME'][$key];
	  $item_code = $_POST['ITEM_CODE'][$key];
	  


		  if(!empty($value)){
			
			
			   $sql = "INSERT INTO kj_f SET TGL = '$today_database $time',
			                              BULAN_INPUT = '$bulan',
										  NAMA_DIST = '".$acon_id."',
										  NAMA_PRODUK = '".$item_name."',
										  ITEM_CODE = '".$item_code."',
										  ACCOUNT_ID = '".$acon_id."',
										  TARGET = '".$value."'";
			
			   //echo json_encode($sql);
			
			   $hasil = mysqli_query($mysqli, $sql);
			   
			   //exit;
			}
	}
	
	
	
   if($hasil){
       
	    $response_array['status'] = 'sukses'; 
    }
    else{
        
		 $response_array['status'] = 'gagal'; 
    }
header('Content-type: application/json');
echo json_encode($response_array);
	
	
	
	




?>