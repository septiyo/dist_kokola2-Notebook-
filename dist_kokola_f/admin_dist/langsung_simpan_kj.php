<?php 

include "../koneksi.php";
	

$koplak=$_POST['KOPLAK'];

        $today = date(d)."-".date(m)."-".date(Y);
        $today_database = date(Y)."-".date(m)."-".date(d);
        $time = date('H:i:s');
	    $bulan = date('M');

	 	 //$datax = $_POST['KOPLAK']; 
		 //echo ($koplak[0].$koplak[1]);
		 
		 
		foreach($koplak as $jos=>$nilai){
			
			$acon_id = $_POST['ACON_ID'][$jos];
			$item_code = $_POST['ITEM_CODE'][$jos];
			$item_name = $_POST['ITEM_NAME'][$jos];
			//$target = $nilai;
			
			
			if(!empty($nilai)){
			
			
			   $sql = "INSERT INTO kj_f SET TGL = '$today_database $time',
			                              BULAN_INPUT = '$bulan',
										  NAMA_DIST = '".$acon_id."',
										  NAMA_PRODUK = '".$item_name."',
										  ITEM_CODE = '".$item_code."',
										  ACCOUNT_ID = '".$acon_id."',
										  TARGET = '".$nilai."'";
			
			   //echo json_encode($sql);
			
			   $hasil = mysqli_query($mysqli, $sql);
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