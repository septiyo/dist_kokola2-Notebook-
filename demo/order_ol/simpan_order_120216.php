<?php
require_once("koneksi.php");
$userid = isset($_REQUEST['USERID']) ? $_REQUEST['USERID'] : '';
$catatan = isset($_REQUEST['CATATAN']) ? $_REQUEST['CATATAN'] : ''; 
$acc_id = isset($_REQUEST['ACCID']) ? $_REQUEST['ACCID'] : ''; 
$id_produk = isset($_REQUEST['PRODUK']) ? $_REQUEST['PRODUK'] : '';
$kj = isset($_REQUEST['KJ']) ? $_REQUEST['KJ'] : '';
$real = isset($_REQUEST['REAL']) ? $_REQUEST['REAL'] : ''; 
$sisa = isset($_REQUEST['SISA']) ? $_REQUEST['SISA'] : '';
$order = isset($_REQUEST['ORDER']) ? $_REQUEST['ORDER'] : '';
$arr = isset($_REQUEST['ARR']) ? $_REQUEST['ARR'] : '';

$sqlID = "select ID_ORDER, (substr(ID_ORDER,-3)+1) as NOMOR, substr(ID_ORDER, 1, 8) from order_distributor
	where substr(ID_ORDER, 1, 8) = date_format(curdate(),'%Y%m%d') order by ID_ORDER desc;";

$myID = mysql_query($sqlID);
if ($dataID = mysql_fetch_assoc($myID)) {
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
$bol = 'false';
$sqlOrder = "insert into order_distributor
	set ID_ORDER = '".$id_order."',
	USERID = '".$userid."',
	TGL = '".date('Y-m-d H:i:s')."',
	CATATAN = '".$catatan."',
	ACCOUNT_ID = '".$acc_id."'";
if ($mysqOrder = mysql_query($sqlOrder)) {
	foreach($arr as $value) {
		$sqlDetail = "insert into order_detail
			set ID_ORDER = '".$id_order."',
			ID_PRODUK = '".$value['produk']."',
			JML_KJ = '".$value['kj']."',
			JML_REAL = '".$value['real']."',
			JML_SISA = '".$value['sisa']."',
			JML_ORDER = '".$value['order']."',
			ITEM_CODE = '".$value['item_code']."',
			KUBIKASI = '".$value['kubik']."';";
		if ($mysqlDet = mysql_query($sqlDetail)) {
			$bol = 'true';
		}
		else {
			if ($bol == true) {
				$bol = 'false';
			}			
		}
	}
	echo "Order telah disimpan..";
}
else {
	echo "Error: ".$sqlOrder;
}

?>