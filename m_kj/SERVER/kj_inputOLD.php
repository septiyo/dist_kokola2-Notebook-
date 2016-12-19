<?php
include "../koneksi.php";
error_reporting(0);
ini_set('display_errors', '0');
$acc=$_GET['id'];
$datax 	  = $_POST['q']; 
$triwulan = $_GET['TRI']; 

$month  = date('M');
//$today  = date('d')."-".date('m')."-".date('Y');
$today  = date('Y')."-".date('m')."-".date('d');

$time = date('H:i:s');

//echo $month."-".$today."-".$time;
//echo "<b>".$triwulan."</b>";
//exit;

	foreach($datax as $item) {
					
			
			//if($item['TRIWULAN'] != ""){
				
				if($item['FORECAST'] != ""){
			
								$sql_kj = "INSERT INTO kj SET 
										TGL = '$today $time',
									TRIWULAN = '$triwulan',
									BULAN_INPUT = '$month',
									NAMA_DIST = '$_SESSION[USER]',
									ID_PRODUK = '".$item['item_code']."',
									NAMA_PRODUK = '".$item['ITEM_NAME']."',
									ITEM_CODE = '".$item['item_code']."',
									DAERAH     = '$_SESSION[KOTA]',
									HARGA = '$harga',
									BLN_AKHIR = '".$item['bln_akhir']."',
									FORECAST = '".$item['FORECAST']."',
									PERSEN   = '".$item['PERSEN']."',
									BULAN1   = '".$item['BULAN1']."',
									BULAN2   = '".$item['BULAN2']."',
									BULAN3   = '".$item['BULAN3']."',
									TOTAL_VALUE    = '$total_value[$isi]',
									SET_BLN1 = 'ISI',
									ACCOUNT_ID = '".$acc."'";
								
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
  


 
	





?>