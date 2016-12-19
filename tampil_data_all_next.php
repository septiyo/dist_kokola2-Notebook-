
<?php
include "koneksi.php";
//ini_set("memory_limit","750M");
//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
 $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				//$lanku = date('m');
				$wkt = date('H:i:s');
$uki = $_POST['q'];
$min = $_POST['idku'];
$lanku = $_POST['blnx'];				
				foreach ($uki as $item) {
					
					$sql_kj="INSERT INTO order_kirim_wd SET  account_id  = '$min',
				                                         item_code  = '".$item['produk']."',
				                                         qty        = '".$item['order']."',
				                                         periode1   = '$yearku-$lanku-01',
														 periode2   = '".$item['tgld']."',
				                                         tgl_upload = '$tgl $wkt'";
														 $hasil_input_kj = mysqli_query($mysqli, $sql_kj);
					};
					

	if 	( $hasil_input_kj){
		echo "Berhasil";
		//echo $sql_kj;
		} else
		{
			echo "Gagal";}			
														 
?>