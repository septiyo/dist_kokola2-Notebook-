
<?php
include "koneksi.php";
 $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				$lanku = date('m');
				$wkt = date('H:i:s');
$uki = $_POST['q'];
$min = $_POST['idku'];				
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
		} else
		{
			echo "Gagal";}			
														 
?>