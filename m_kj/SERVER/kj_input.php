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


$jml = 0;
/*
    $sql_cari_isi = "SELECT * FROM kj WHERE TRIWULAN = '" . $triwulan . "' AND NAMA_DIST= '" .$_GET['id']. "' "
            . "AND STR_TO_DATE(TGL, '%Y')=STR_TO_DATE(NOW(), '%Y') AND STATUS_APR='1' and publish='1'";
	*/		
			$sql_cari_isi = "SELECT * FROM kj WHERE TRIWULAN = '" . $triwulan . "' AND NAMA_DIST= '" .$_GET['id']. "' "
            . "AND STR_TO_DATE(TGL, '%Y')=STR_TO_DATE(NOW(), '%Y') AND publish='1'";
			
    $hasilxx = mysqli_query($mysqli, $sql_cari_isi);

    foreach ($hasilxx as $row) {
        $jml++;
    }

if($jml==0){

		$sql_kota="SELECT KOTA FROM user WHERE USER='".$_GET['id']."'";
		$nama_k = mysqli_query($mysqli, $sql_kota);
		$nm_kota=mysqli_fetch_assoc($nama_k);

		//echo $nm_kota['KOTA'];
		//exit(1);
		
		
		mysqli_autocommit($mysqli, false);
		$flag = true;
	/*	
		$luar_if=0;
		$dalam_if=0;
		foreach($datax as $txc) {
			$luar_if++;		
		}
	*/	
		
			foreach($datax as $item) {
							
					
					//if($item['TRIWULAN'] != ""){
						
						if($item['FORECAST'] != ""){
						//$dalam_if++;
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
							
							if (!$hasil_input_kj) {
								$flag = false;
							}
						}	
					//}		
			
			}

			 if($flag){
				//echo "sukses";
				mysqli_commit($mysqli);
				mysqli_autocommit($mysqli, true);
				$response_array['status'] = 'sukses'; 
			}
			else{
				//echo "gagal";
				 mysqli_rollback($mysqli);
				 mysqli_autocommit($mysqli, true);
				 $response_array['status'] = 'gagal'; 
			}
	
}else{
	// $response_array['status'] = 'Akses ditolak, KJ bulan '. $triwulan .' sudah disetujui'; 
	 $response_array['status'] = 'Akses ditolak, KJ bulan '. $triwulan .' sudah ada'; 
}	
	
//header('Content-type: application/json');
echo json_encode($response_array); 
  


 
}





?>