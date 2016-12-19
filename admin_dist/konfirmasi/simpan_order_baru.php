<?php
date_default_timezone_set("Asia/Jakarta");	
$today          = date('d')."-".date('m')."-".date('Y');
//$today_database = date('Y')."-".date('m')."-".date('d');
$today_database = date('Y-m-d H:i:s');
$time = date('H:i:s');

$qty = isset($_REQUEST['QTY']) ? $_REQUEST['QTY'] : '';
$jumlah_qty   = count($qty);
$account_idne = isset($_REQUEST['ACC']) ? $_REQUEST['ACC'] : '';
$userid       = isset($_REQUEST['USERID']) ? $_REQUEST['USERID'] : '';
$item_code    = isset($_REQUEST['ITEM_CODE']) ? $_REQUEST['ITEM_CODE'] : '';
$kubikasi     = isset($_REQUEST['KUBIKASI2']) ? $_REQUEST['KUBIKASI2'] : '';
$accoun		  = isset($_REQUEST['ACCOUNT']) ? $_REQUEST['ACCOUNT'] : '';
$namaa		  =	isset($_REQUEST['DISTRIBUTOR']) ? $_REQUEST['DISTRIBUTOR'] : '';
$kota		  =	isset($_REQUEST['KOTA_DISTRIBUTOR']) ? $_REQUEST['KOTA_DISTRIBUTOR'] : '';
$userid		  =	isset($_REQUEST['USERID']) ? $_REQUEST['USERID'] : '';

$sqlID = "select ID_ORDER, (substr(ID_ORDER,-3)+1) as NOMOR from order_distributor order by ID_ORDER desc";

$myID = mysqli_query($mysqli, $sqlID);
if ($dataID = mysqli_fetch_assoc($myID)) {
	$id_order = $dataID['NOMOR'];
	if ($id_order < 10) {
		$id_order = date('Ymd').'00'.$id_order;
	}
	elseif ($id_order < 100) {
		$id_order = date('Ymd').'0'.$id_order;
	}
	else {
		$id_order = date('Ymd').$id_order;
	}
}
else {
	$id_order = date('Ymd').'001';
}

/*ini input ke tabel order_distributor*/	
$sql_order = "INSERT INTO order_distributor SET  ID_ORDER = '$id_order',
			 TGL = '$today_database',
			 USERID = '$userid',
			 ACCOUNT_ID = '$account_idne',
			 FLAG = '2'";

$hasil_order = mysqli_query($mysqli, $sql_order);	
/*ini input ke tabel order_detail*/	
$n = 0;
while ($n < $jumlah_qty) {	
	/*Cari produk_id*/	
	$sql_cari_produk_id = "SELECT ID  FROM m_produk WHERE ITEM_CODE = '$item_code[$n]' ";
	$hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
	$data_id = mysqli_fetch_assoc($hasil_cari_produk_id);
	$id_produk = $data_id['ID'];


	if($qty[$n] != "") {	
		 $sql_order_detail = "INSERT INTO order_detail SET  ID_ORDER = '$id_order',
							ID_PRODUK = '$id_produk',
							JML_ORDER = '$qty[$n]',
							ITEM_CODE = '$item_code[$n]',
							KUBIKASI  = '$kubikasi[$n]',
							FLAG = '2'";	
		$hasil_order_detail = mysqli_query($mysqli, $sql_order_detail);	
	}
	$n++;
}

if($hasil_order_detail){
	echo $accoun."<br />";
	echo $namaa."<br />";
	echo $userid."<br />";
	
	
	echo "<script>alert('Tambah Order Berhasil..!');
				  window.location='detail_konfirmasi.php?ID=$account_idne&NAMA=$namaa&KOTA=$kota&USERID=$userid';
				  </script>";	
}
else{
	
	echo "<script>alert('Tambah Order Gagal..!');
	  window.location='detail_konfirmasi.php?ID=$account_idne&NAMA=$namaa&KOTA=$kota&USERID=$userid';
	  </script>";	
}
?>