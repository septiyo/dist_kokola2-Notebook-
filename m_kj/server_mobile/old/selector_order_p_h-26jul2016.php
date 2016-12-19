<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);

/*

Note: Jalan tiap jam 8.00

*/

$receiver = array();
$sqrec = "SELECT uu.ACCOUNT_ID, uu.id_apkey FROM distributor_kokola.user uu
				WHERE uu.HAK = 'ADMIN'
				AND uu.id_apkey <> ''
				AND uu.id_apkey IS NOT NULL;";
				
$ress = mysql_query($sqrec) or die("Note: ".mysql_error());
while($row = mysql_fetch_array($ress)){
	array_push($receiver, $row['id_apkey']);
}

$sql = "SELECT COUNT(*) AS JML_DIST, SUM(aa.JML_ORDER) AS TOT_ORDER, aa.periode2 AS TGL_ORDER FROM(
			SELECT okw.*, SUM(qty) AS JML_ORDER FROM order_kirim_wd okw 
				WHERE okw.periode2 = CURDATE()
				AND okw.ACCOUNT_ID <> 0
				GROUP BY okw.ACCOUNT_ID)aa;";
			
$result = mysql_query($sql) or die("Note: " . mysql_error());
$aa = mysql_fetch_array($result);
		
$to      = $receiver;
$title   = "Jadwal Order Distributor";
$message = "Tanggal: ". date_format(date_create($aa['TGL_ORDER']),"d-m-Y")."\n";
$message .= "Jumlah Distributor: ".$aa['JML_DIST']."\n";
$message .= "Total Order: ".$aa['TOT_ORDER']."";

sendPush($to, $title, $message);

function sendPush($to, $title, $message){
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
	echo $result;
}
//echo $mess;
echo ("<br/>Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

?>