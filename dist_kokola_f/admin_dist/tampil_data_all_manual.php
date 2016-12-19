
<?php
include "../koneksi.php";
 $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				$lanku = date('m');
				$wkt = date('H:i:s');
$uki = $_POST['q'];
$nop = $_POST['no_po'];
$min = $_POST['idku'];
$tuj = $_POST['tujuan'];
$unq = strtoupper(substr(uniqid(),7));


$tgl9 = date('Y').date('m').date('d');
$unq9 = strtoupper(substr(uniqid(),11));
$bol9 = $tgl9."F".$unq9;
				
				foreach ($uki as $item) {
					
					$sql_kj="INSERT INTO order_confirm SET  ACCOUNT_ID  = '$min',
				                                         ITEM_CODE  = '".$item['icod']."',
				                                         JML_ORDER   = '".$item['order']."',
				                                         TGL_CONFIRM  = '$tgl $wkt',
														 TGL_ORDER   = '".$item['tgl_order']."',
														 KUBIKASI = '".$item['kbk']."',
														 NO_PO = '$nop',
														 ID_CONFIRM = '$unq',
														 TUJUAN = '$tuj',
														 ID_ORDER = '$bol9', 
														 FLAG = '1',
														 FESTIVE = '1'";
				    $hasil_input_kj = mysqli_query($mysqli, $sql_kj);
					};
					

	if 	( $hasil_input_kj){
		echo "Simpan data berhasil !";
		} else
		{
			echo "Gagal";}			
														 
?>