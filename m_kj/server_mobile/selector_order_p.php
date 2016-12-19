<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);
$log_m =  '';
/*

Note: Jalan tiap jam 8.00

*/

//Cek hari minggu?
if(date('N', time()) == 7){
	exit();
}

$receiver = array();
$sqrec = "SELECT uu.ACCOUNT_ID, uu.id_apkey FROM distributor_kokola.user uu
				WHERE uu.HAK = 'ADMIN'
				AND uu.id_apkey <> ''
				AND uu.id_apkey IS NOT NULL;";
				
$ress = mysql_query($sqrec) or die("Note: ".mysql_error());
while($row = mysql_fetch_array($ress)){
	array_push($receiver, $row['id_apkey']);
}
//echo count($receiver);exit(1);
$sql = "SELECT COUNT(*) AS JML_DIST, SUM(aa.JML_ORDER) AS TOT_ORDER, aa.periode2 AS TGL_ORDER FROM(
			SELECT okw.*, SUM(qty) AS JML_ORDER FROM order_kirim_wd okw 
				WHERE okw.periode2 = (CURDATE() + INTERVAL 1 DAY)
				AND okw.ACCOUNT_ID <> 0
				GROUP BY okw.ACCOUNT_ID)aa;";
			
$result = mysql_query($sql) or die("Note: " . mysql_error());
$aa = mysql_fetch_array($result);

$to      = $receiver;
$title   = "Jadwal Order Distributor";
$message = "Tanggal: ". date_format(date_create($aa['TGL_ORDER']),"d-m-Y")."\n";
$message .= "Jumlah Distributor: ".$aa['JML_DIST']."\n";
$message .= "Total Order: ".$aa['TOT_ORDER']."";//var_dump($to);exit(1);
/*-------------------------------------------------------------------------------------*/
// API access key from Google API's Console
// replace API
define('API_ACCESS_KEY', 'AIzaSyBuyhI8NMzOAKBr-rliVwgQrZFXyk1diNI');
$registrationIds = $to;
$msg = array(
	'message' => $message,
	'title' => $title,
	'vibrate' => 1,
	'soundname' => "default",
	'notId' => time(),
	'icon' => 'kokola'
	
	// you can also add images, additionalData
);

$fields = array(
	'registration_ids' => $registrationIds,
	'data' => $msg
);

$headers = array(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
curl_close($ch);
//echo $result;
$log_m .= '['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$result.']'."\n";
/*-------------------------------------------------------------------------------------*/

echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");
//file_put_contents ($dir.'/log_selector_order_p.txt', $log_m.'['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$time_elapsed_secs."]\n", FILE_APPEND);
$log_mm = $log_m.'['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$time_elapsed_secs."]\n";

$url = 'http://10.3.3.88/log_mkj/log_writer.php';
$data = array('OPERAND' => 'selector_order_p', 'LOG' => $log_mm);
$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data)
	)
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
?>