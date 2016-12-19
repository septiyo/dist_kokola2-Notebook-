<?php
require_once('koneksi.php');

$acc_id = isset($_REQUEST['ACCID']) ? $_REQUEST['ACCID'] : '';
$arr = isset($_REQUEST['ARR']) ? $_REQUEST['ARR'] : '';

$sqlHapus = "delete from order_draft_f where ACCOUNT_ID = '".$acc_id."'";
$mysqlDet = mysql_query($sqlHapus);
foreach($arr as $value) {
	if ($value['order'] === '') {
		$jml = 'NULL';
		/*$sqlDetail = "insert into order_draft
		set ACCOUNT_ID = '".$acc_id."',
		ID_PRODUK = '".$value['produk']."',
		ITEM_CODE = '".$value['item_code']."',
		JML_ORDER = NULL;";*/
	}
	else {
		$jml = $value['order'];
		/*$sqlDetail = "insert into order_draft
		set ACCOUNT_ID = '".$acc_id."',
		ID_PRODUK = '".$value['produk']."',
		ITEM_CODE = '".$value['item_code']."',
		JML_ORDER = '".$jml."';";*/
	}
	$sqlDetail = "insert into order_draft_f
		set ACCOUNT_ID = '".$acc_id."',
		ID_PRODUK = '".$value['produk']."',
		ITEM_CODE = '".$value['item_code']."',
		JML_ORDER = ".$jml.";";
	if ($mysqlDet = mysql_query($sqlDetail)) {
		$bol = 'true';
	}
	else {
		$bol = 'false';
	}
}
?>