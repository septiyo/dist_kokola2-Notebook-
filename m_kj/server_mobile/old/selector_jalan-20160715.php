<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);

/*

Note: Jalan tiap 15min

*/

$sql = "SELECT * FROM push_surat_jalan psj WHERE psj.STATUS_NOTIF = '0' AND TGL_KIRIM = CURDATE() 
		GROUP BY psj.SN_NUMBER, psj.ACCOUNTID, psj.TGL_KIRIM ORDER BY psj.TGL_KIRIM DESC";
			
$result = mysql_query($sql) or die("Note: " . mysql_error());

$sen = array();
$acd = array();
$tgl_kir = array();

while($row = mysql_fetch_array($result)){
	
	array_push($sen, $row['SN_NUMBER']);
	array_push($acd, $row['ACCOUNTID']);
	array_push($tgl_kir, $row['TGL_KIRIM']);
	
}

$cc = count($sen);
/* echo $cc."\n";$mess = ""; */
for ($i = 0; $i < $cc; $i++) {
	//$mess .= $i."-".$acc_id[$i]."\n";
	
    $url = 'http://10.1.13.54/m_kj/server_mobile/push_notif_jalan.php';
	$data = array('ACCOUNT_ID' => $acd[$i], 'SN_NUMBER' => $sen[$i], 'TGL_KIRIM' => $tgl_kir[$i]);
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