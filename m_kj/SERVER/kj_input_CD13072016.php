<?php
include "../koneksi.php";
error_reporting(0);

if(isset($_GET['id'])){
$datax 	  = $_POST['q']; 
$triwulan = $_GET['TRI']; 

$month  = date('M');
//$today  = date('d')."-".date('m')."-".date('Y');
$today  = date('Y')."-".date('m')."-".date('d');

$time = date('H:i:s');

//echo $month."-".$today."-".$time;
//echo "<b>".$triwulan."</b>";
//exit;
$sql_kota="SELECT KOTA FROM user WHERE USER='".$_GET['id']."'";
$nama_k = mysqli_query($mysqli, $sql_kota);
$nm_kota=mysqli_fetch_assoc($nama_k);

//echo $nm_kota['KOTA'];
//exit(1);
	foreach($datax as $item) {
					
			
			//if($item['TRIWULAN'] != ""){
				
				if($item['FORECAST'] != ""){
			
                            $sql_kj = "INSERT INTO kj SET 
                                            TGL = '".$today." ".$time."',
                                    TRIWULAN = '".$triwulan."',
                                    BULAN_INPUT = '".$month."',
                                    NAMA_DIST = '".$_GET['id']."',
                                    ID_PRODUK = '".$item['item_code']."',
                                    NAMA_PRODUK = '".$item['ITEM_NAME']."',
                                    ITEM_CODE = '".$item['item_code']."',
                                    DAERAH     = '".$nm_kota['KOTA']."',
                                    HARGA = '$harga',
                                    BLN_AKHIR = '".$item['bln_akhir']."',
                                    FORECAST = '".$item['FORECAST']."',
                                    PERSEN   = '".$item['PERSEN']."',
                                    BULAN1   = '".$item['BULAN1']."',
                                    BULAN2   = '".$item['BULAN2']."',
                                    BULAN3   = '".$item['BULAN3']."',
                                    TOTAL_VALUE    = '0',
                                    SET_BLN1 = 'ISI',
                                    STATUS_APR = '0',
                                    ACCOUNT_ID = '".$_GET['id']."'";
								
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
//header('Content-type: application/json');
echo json_encode($response_array); 
  


 
}





?>