<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);

/*

Note: Jalan tiap jam 7.00, 11.00, 14.00

*/

$sql = "SELECT oc.ACCOUNT_ID FROM order_confirm oc GROUP BY oc.ACCOUNT_ID";
			
$result = mysql_query($sql) or die("Note: " . mysql_error());

$acc_id = array();

while($row = mysql_fetch_array($result)){
	
	array_push($acc_id, $row['ACCOUNT_ID']);
	
}

$cc = count($acc_id);
/* echo $cc."\n";$mess = ""; */
for ($i = 0; $i < $cc; $i++) {
	//$mess .= $i."-".$acc_id[$i]."\n";
	
    $url = 'http://10.1.13.54/m_kj/server_mobile/push_notif_promo.php';
	$data = array('ACCOUNT_ID' => $acc_id[$i]);
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);

	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	
	/* $note = "";
	if ($result === FALSE) {
		$note .= "Notifikasi gagal dikirimkan";
		echo "<script>alert('Notifikasi gagal dikirimkan');</script>";
	}else{
		$note .= "Notifikasi berhasil dikirimkan";
		echo "<script>alert('Notifikasi berhasil dikirimkan');</script>";
	} */
	
}

//echo $mess;
echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

?>