<?php

include "../../koneksi.php";	

$idod = $_REQUEST['idod'];
$acid = $_REQUEST['acid'];
$status = false;
$squp = "UPDATE order_distributor od SET od.FLAG = '0'
			WHERE od.ID_ORDER = '". $idod ."'
			AND od.ACCOUNT_ID = '". $acid ."';/*flag 1*/";
$squp .= "UPDATE order_detail odet SET odet.FLAG = '0'
			WHERE odet.ID_ORDER = '". $idod ."';/*flag 1*/";

$result = mysqli_multi_query($mysqli, $squp);
//echo $result;
if ($result == '1') {
	$status = true;
}else {
	$status = false;
}

$json = array(
	'stat' => $status
);
echo json_encode($json);

?>