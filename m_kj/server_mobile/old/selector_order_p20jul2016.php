<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);

/*

Note: Jalan tiap jam 8.00

*/

$sql = "SELECT * FROM order_kirim_wd okw WHERE okw.periode2 = (CURDATE() + INTERVAL 1 DAY) GROUP BY okw.ACCOUNT_ID;";
			
$result = mysql_query($sql) or die("Note: " . mysql_error());

$acc_id = array();

while($row = mysql_fetch_array($result)){
	
	if($row['ACCOUNT_ID'] == 0 || $row['ACCOUNT_ID'] == ""){
		continue;
	}else{
		array_push($acc_id, $row['ACCOUNT_ID']);
	}
	
}

$cc = count($acc_id);
//echo $cc;exit(1);
for ($i = 0; $i < $cc; $i++) {
	
		//echo $acc_id[$i];//exit(1);
		/* $url = 'http://10.1.13.54/m_kj/server_mobile/push_notif_order_d.php';
		$data = array('ACCOUNT_ID' => $acc_id[$i]);
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);

		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context); */
		
		$sql = "SELECT aa.*, bb.* FROM
				(SELECT *, SUM(qty) AS total_order, COUNT(*) AS jenis_item 
					FROM order_kirim_wd okw 
					WHERE okw.periode2 = (CURDATE() + INTERVAL 1 DAY) AND okw.ACCOUNT_ID = '".$acc_id[$i]."')aa,
				(SELECT uu.NAMA, uu.ID_APKEY 
					FROM distributor_kokola.user uu 
					WHERE uu.ACCOUNT_ID = '".$acc_id[$i]."') bb;"; //44721//A87051

		$result = mysql_query($sql) or die("Note: " . mysql_error());

		$ACCOUNT_ID = "";
		$periode1 = "";
		$periode2 = ""; 
		$tgl_upload = "";
		$total_order = "";
		$jenis_item = "";
		$NAMA = "";
		$receiver = "";

		while($row = mysql_fetch_array($result)){
			
			$ACCOUNT_ID = $row['ACCOUNT_ID'];
			$periode1 = $row['periode1'];
			$periode2 = $row['periode2']; 
			$tgl_upload = $row['tgl_upload'];
			$total_order = $row['total_order'];
			$jenis_item = $row['jenis_item'];
			$NAMA = $row['NAMA'];
			$receiver = $row['ID_APKEY'];
			
		}

		//exit("1");
		/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/

		if($receiver == null || $receiver == ""){
			//$receiver = 'cBFEEOzACRI:APA91bHyjM1jLQQf3VpakRRtTgNQwpXOFKMtOcA0M7hvQXpfc6LxyIfRoVVF5GpRqEFiY6RGg5PWdxVylbu0c58tJY8_dVw1UbjCyGSTKNMG2mt3MQQ2Dv7GrRd80617rSYR27rT3mSF';
			//exit(1);
			continue;
		}

		$to      = $receiver;
		$title   = "Jadwal Order Distributor";
		$message = "". $NAMA ."";

		/* $s = count($produk);
		for ($i = 0; $i < $s; $i++) {
			$message .= "\n-" . $produk[$i] . " \nKJ(" . $kj_bulan[$i] . ") Kirim(" . $jml_produk[$i] . ")";
		} */

		$message .= "\nTanggal: ". date_format(date_create($periode2),"d-m-Y") ."\nTotal Order: ". $total_order."";

		sendPush($to, $title, $message);

		$n = time();
		function sendPush($to, $title, $message){
			// API access key from Google API's Console
			// replace API
			define('API_ACCESS_KEY', 'AIzaSyBuyhI8NMzOAKBr-rliVwgQrZFXyk1diNI');
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
		}
		
}

//echo $mess;
echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

?>