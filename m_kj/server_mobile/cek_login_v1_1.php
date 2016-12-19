<?php
require_once("koneksi.php");

$usr  = isset($_REQUEST['USER']) ? $_REQUEST['USER'] : '';
$pass = isset($_REQUEST['PASS']) ? $_REQUEST['PASS'] : '';
$hak = isset($_REQUEST['HAK']) ? $_REQUEST['HAK'] : '';
$app = isset($_REQUEST['APP']) ? $_REQUEST['APP'] : '';
$ver = isset($_REQUEST['VER']) ? $_REQUEST['VER'] : '';

$usr = str_replace("'", "", $usr);
$usr = preg_replace('/[=&\/\\#,+()$~%":*?<>{}]/', '', $usr);
$status = false;
$data   = 0;
if($app == 'S_MKJ' && $hak == 'SALES'){
	
	$sql = mysql_query("SELECT * FROM distributor_kokola.user uu 
						WHERE uu.USER = '".$usr."' 
						AND uu.PASS = '".$pass."'
						AND uu.HAK = 'SALES';");
	if (mysql_num_rows($sql) > 0) {
		$status = true;
		$data   = mysql_fetch_assoc($sql);    
	} else {
		
	}

	$json = array(
		'stat' => $status,
		'mydata' => $data
	);
	echo json_encode($json);
	
}else if($app == 'D_MKJ' && $hak == 'DISTRIBUTOR'){
	
	$sql = mysql_query("SELECT * FROM distributor_kokola.user uu 
						WHERE uu.USER = '".$usr."' 
						AND uu.PASS = '".$pass."'
						AND uu.HAK = 'DISTRIBUTOR';");
	if (mysql_num_rows($sql) > 0) {
		$status = true;
		$data   = mysql_fetch_assoc($sql);    
	} else {
		
	}

	$json = array(
		'stat' => $status,
		'mydata' => $data
	);
	echo json_encode($json);
	
}else{
	$json = array(
		'stat' => $status,
		'mydata' => $data
	);
	echo json_encode($json);
}

?>