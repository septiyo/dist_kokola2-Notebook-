<?php
//session_start();
require_once("koneksi.php");

$nop = isset($_REQUEST['NOP']) ? $_REQUEST['NOP'] : '';
$nop = mysql_real_escape_string($nop);

$arr = "";
$sql = "select * from test_nop where NOP = '".$nop."';";
$myLog = mysql_query($sql);
if ($dataLog = mysql_fetch_array($myLog)) {
	if ($dataLog["STS_BAYAR"] == "1") {
		$sts = "LUNAS";
	}
	else {
		$sts = "BELUM LUNAS";
	}
	$arr[] = array("NAMA"=>$dataLog["NAMA"],
		"ALAMAT"=>$dataLog["ALAMAT"],
		"STS"=>$sts,
		"LAT"=>$dataLog["LAT"],
		"LON"=>$dataLog["LON"]);
}
echo json_encode($arr);
?>