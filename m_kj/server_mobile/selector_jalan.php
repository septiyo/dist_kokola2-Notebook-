<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);
define('API_ACCESS_KEY', 'AIzaSyBuyhI8NMzOAKBr-rliVwgQrZFXyk1diNI');

/*

Note: Jalan tiap 15min

*/

//Cek hari minggu?
if(date('N', time()) == 7){
	exit();
}

$sql = "SELECT psj.*, u.NAMA, u.id_apkey FROM push_surat_jalan psj
			LEFT JOIN distributor_kokola.user u
			ON psj.ACCOUNTID = u.ACCOUNT_ID
				WHERE psj.STATUS_NOTIF = '0' 
				AND TGL_KIRIM = CURDATE()
				AND u.id_apkey IS NOT NULL
				AND u.id_apkey <> ''
				GROUP BY psj.ACCOUNTID
				ORDER BY psj.TGL_KIRIM DESC;";
			
$result = mysql_query($sql) or die("Note: " . mysql_error());

//$sen = array();
$acd = array();
$tgl_kir = array();
$log_m =  '';
$values = "";

while($row = mysql_fetch_array($result)){
	
	//array_push($sen, $row['SN_NUMBER']);
	array_push($acd, $row['ACCOUNTID']);
	array_push($tgl_kir, $row['TGL_KIRIM']);
	
}

for($i=0; $i<count($acd); $i++){
	
	$sqls = "SELECT aa.NAMA, aa.TGL_KIRIM, SUM(aa.QTY) AS TK, aa.id_apkey FROM(		
				SELECT psj.*, u.NAMA, u.id_apkey FROM push_surat_jalan psj
					LEFT JOIN distributor_kokola.user u
					ON psj.ACCOUNTID = u.ACCOUNT_ID
						WHERE psj.STATUS_NOTIF = '0' 
						AND TGL_KIRIM = CURDATE()
						AND u.id_apkey IS NOT NULL
						AND u.id_apkey <> ''
						ORDER BY psj.TGL_KIRIM DESC)aa 
				WHERE aa.ACCOUNTID = '".$acd[$i]."';";
					
	$result = mysql_query($sqls) or die("Note: " . mysql_error());
	
	//$sn = "";
	$tgl_kirim = "";
	//$so_n = "";
	$total_kirim = 0;
	$receiver = "";
	$nm_receiver = "";

	while ($row = mysql_fetch_array($result)) {
		
		//$sn = $row['SN_NUMBER'];
		$tgl_kirim = $row['TGL_KIRIM'];
		//$so_n = $row['SO_NUMBER'];
		$total_kirim = $row['TK'];
		$receiver = $row['id_apkey'];
		$nm_receiver = $row['NAMA'];
		
	}
	
	$to      = $receiver;
	$title   = "Pengiriman Barang";
	$message = "Kepada: ".$nm_receiver."\nTgl. dikirim: " . date_format(date_create($tgl_kirim),"d-m-Y");
	$message .= "\nTotal Kirim: ".$total_kirim;
	
	//Send notif function
		$registrationIds = array(
			$to
		);
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

	$sql_up = "UPDATE push_surat_jalan psj 
					SET psj.STATUS_NOTIF = '1' 
					WHERE psj.TGL_KIRIM = '". $tgl_kir[$i] ."' 
					AND psj.ACCOUNTID = '". $acd[$i] ."';";
	$resup = mysql_query($sql_up) or die("Note: " . mysql_error());
	
	$log_m .= '['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$acd[$i].']-['.$result.']'."\n";
	$deco = json_decode($result, true, 512, JSON_BIGINT_AS_STRING);
	
	$stat;
	if($deco['success'] == '1'){
		$stat = 'message_id';
	}else{
		$stat = 'error';
	}
	
	$values .= "(DEFAULT, '".date("Y-m-d h:i:s", time())."', '".$acd[$i]."', '".$deco['multicast_id']."', '".$deco['success']."', 
			'".$deco['failure']."', '".$deco['canonical_ids']."', '".$deco['results'][0][$stat]."', 'NOTIF_JALAN'),";
	
		
}

echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

$log_mm = $log_m.'['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$time_elapsed_secs."]\n";

$url = 'http://10.3.3.88/log_mkj/log_writer.php';
$data = array('OPERAND' => 'selector_jalan', 'LOG' => $log_mm);
$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data)
	)
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

$values = rtrim($values, ",");
$values .= ";";
$sqlog = "INSERT INTO distributor_kokola.log_notif 
		(NOs, DATE_TIME, ACCOUNT_ID, MULTICAST_ID, SUCCESS, FAILURE, CANONICAL_IDS, RESULTS, CODE_N) 
		VALUES ".$values;
		$ress = mysql_query($sqlog ) or die("Note: ".mysql_error());

?>