<?php
include "../koneksi.php";
//error_reporting(0);

if(isset($_GET['id'])){
$datax 	  = $_POST['q']; 


$month  = date('M');
//$today  = date('d')."-".date('m')."-".date('Y');
$today  = date('Y')."-".date('m')."-".date('d');

$time = date('H:i:s');

	foreach($datax as $item) {
					
			
			//if($item['TRIWULAN'] != ""){
				
				if($item['ID'] != ""){
			
                            $sql_kj = "UPDATE kj SET " 
                                    ."TGL = '".$today." ".$time."',"                                    
                                    ."BULAN1   = '".$item['BULAN1']."',"
                                    ."BULAN2   = '".$item['BULAN2']."',"
                                    ."BULAN3   = '".$item['BULAN3']."' "
                                    ."WHERE ID = '".$item['ID']."'";
								
								//echo json_encode($sql_kj);
					$hasil_input_kj = mysqli_query($mysqli, $sql_kj);
				}	
			//}		
	
    }

     if($hasil_input_kj){
        //echo "sukses";
	    $response_array['status'] = 'sukses'; 
    }
    else{
        //echo "gagal";
		 $response_array['status'] = 'gagal'; 
    }
header('Content-type: application/json');
echo json_encode($response_array); 
  


 
}





?>