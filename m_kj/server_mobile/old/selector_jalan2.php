<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);
define('API_ACCESS_KEY', 'AIzaSyBuyhI8NMzOAKBr-rliVwgQrZFXyk1diNI');

/*

Note: Jalan tiap 15min

*/

$sql = "SELECT psj.*, u.NAMA, u.id_apkey FROM push_surat_jalan psj
			LEFT JOIN distributor_kokola.user u
			ON psj.ACCOUNTID = u.ACCOUNT_ID
				WHERE psj.STATUS_NOTIF = '0' 
				AND TGL_KIRIM = CURDATE()
				AND u.id_apkey IS NOT NULL
				AND u.id_apkey <> ''
				GROUP BY psj.SN_NUMBER
				ORDER BY psj.TGL_KIRIM DESC;";
			
$result = mysql_query($sql) or die("Note: " . mysql_error());

$sen = array();
$acd = array();
$tgl_kir = array();

while($row = mysql_fetch_array($result)){
	
	array_push($sen, $row['SN_NUMBER']);
	array_push($acd, $row['ACCOUNTID']);
	array_push($tgl_kir, $row['TGL_KIRIM']);
	
}

for($i=0; $i<count($sen); $i++){
	
	$sqls = "SELECT psj.*, uu.NAMA, uu.id_apkey
					FROM push_surat_jalan psj  
					LEFT JOIN distributor_kokola.user uu 
						ON psj.ACCOUNTID = uu.ACCOUNT_ID 
					WHERE psj.ACCOUNTID = '". $acd[$i] ."' 
					AND psj.SN_NUMBER = '". $sen[$i] ."'
					AND psj.TGL_KIRIM = '". $tgl_kir[$i] ."';";
					
	$result = mysql_query($sqls) or die("Note: " . mysql_error());
	
	$sn = "";
	$tgl_kirim = "";
	$so_n = "";
	$total_kirim = 0;
	$receiver = "";
	$nm_receiver = "";

	while ($row = mysql_fetch_array($result)) {
		
		$sn = $row['SN_NUMBER'];
		$tgl_kirim = $row['TGL_KIRIM'];
		$so_n = $row['SO_NUMBER'];
		$total_kirim += $row['QTY'];
		$receiver = $row['id_apkey'];
		$nm_receiver = $row['NAMA'];
		
	}
	
	$to      = $receiver;
	$title   = "Pengiriman Barang";
	$message = "Kepada: ".$nm_receiver."\nTgl. dikirim: " . date_format(date_create($tgl_kirim),"d-m-Y");
	$message .= "\nSN-Number: ". $sn ."\nTotal Kirim: ".$total_kirim;
	
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
		echo $result;

	$sql_up = "UPDATE push_surat_jalan psj 
					SET psj.STATUS_NOTIF = '1' 
					WHERE psj.SN_NUMBER = '". $sen[$i] ."' 
					AND psj.TGL_KIRIM = '". $tglk[$i] ."' 
					AND psj.ACCOUNTID = '". $ida[$i] ."';";
	$resup = mysql_query($sql_up) or die("Note: " . mysql_error());
		
}

echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

?>