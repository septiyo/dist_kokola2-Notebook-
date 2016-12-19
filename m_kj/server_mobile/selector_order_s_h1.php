<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);
exit(1);

/*

Note: Jalan tiap jam 9.00, 12.00, 15.00

*/

$sql = "SELECT okw.*, pd.SALES_ID FROM order_kirim_wd okw 
		INNER JOIN push_distributor pd 
		ON pd.ACCOUNT_ID = okw.ACCOUNT_ID 
		WHERE okw.periode2 = (CURDATE() - INTERVAL 1 DAY) 
		GROUP BY okw.ACCOUNT_ID;";
			
$result = mysql_query($sql) or die("Note: " . mysql_error());

$dist_id = array();
$sal_id = array();

while($row = mysql_fetch_array($result)){
	
	array_push($dist_id, $row['ACCOUNT_ID']);
	array_push($sal_id, $row['SALES_ID']);
	
}

for($i=0;$i<count($sal_id);$i++){
	
	$sqsel = "SELECT aa.* FROM (
				SELECT od.*, pd.SALES_ID FROM order_distributor od 
					INNER JOIN push_distributor pd 
					ON pd.ACCOUNT_ID = od.ACCOUNT_ID
					WHERE DAY(od.TGL) = DAY(CURDATE() - INTERVAL 1 DAY) 
					AND MONTH(od.TGL) = MONTH(CURDATE() - INTERVAL 1 DAY) 
					AND YEAR(od.TGL) = YEAR(CURDATE() - INTERVAL 1 DAY)) aa
				WHERE aa.SALES_ID = '".$sal_id[$i]."' AND aa.ACCOUNT_ID = '".$dist_id[$i]."';";
	$ress = mysql_query($sqsel) or die("Note: " . mysql_error());
	//echo $sqsel;exit();
	if(mysql_num_rows($ress) > 0){
		
		//continue;
		
	}else{
		
		/* $url = 'http://10.1.13.54/m_kj/server_mobile/push_notif_order_s.php';
		$data = array('SALES' => $sal_id[$i], 'DIST' => $dist_id[$i]);
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);

		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context); */
		
		$sql = "SELECT aa.*, bb.* FROM (
					SELECT okw.*, SUM(qty) AS total_order, COUNT(*) AS jenis_item, pd.SALES_ID, pd.ACCOUNT_NAME FROM order_kirim_wd okw 
						INNER JOIN push_distributor pd 
						ON pd.ACCOUNT_ID = okw.ACCOUNT_ID
						WHERE okw.periode2 = (CURDATE() - INTERVAL 1 DAY)
						GROUP BY okw.ACCOUNT_ID)aa,
					(SELECT uu.ID_APKEY FROM distributor_kokola.user uu WHERE uu.ACCOUNT_ID = '".$sal_id[$i]."') bb
				WHERE aa.SALES_ID = '".$sal_id[$i]."' AND aa.ACCOUNT_ID IN ('".$dist_id[$i]."');"; //44721//A87051

		$result = mysql_query($sql) or die("Note: " . mysql_error());//echo $sql;exit();

		$ACCOUNT_ID = "";
		$periode1 = "";
		$periode2 = ""; 
		$tgl_upload = "";
		$total_order = "";
		$jenis_item = "";
		$NAMA = "";
		$receiver = "";

		$message = "";

		while($row = mysql_fetch_array($result)){

			$ACCOUNT_ID = $row['ACCOUNT_ID'];
			$periode1 = $row['periode1'];
			$periode2 = $row['periode2']; 
			$tgl_upload = $row['tgl_upload'];
			$total_order = $row['total_order'];
			$jenis_item = $row['jenis_item'];
			$NAMA = $row['ACCOUNT_NAME'];
			$receiver = $row['ID_APKEY'];

			$message .= "-".$NAMA."\n";

		}

		//exit("1");
		/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/

		if($receiver == null || $receiver == ""){
			//$receiver = 'cBFEEOzACRI:APA91bHyjM1jLQQf3VpakRRtTgNQwpXOFKMtOcA0M7hvQXpfc6LxyIfRoVVF5GpRqEFiY6RGg5PWdxVylbu0c58tJY8_dVw1UbjCyGSTKNMG2mt3MQQ2Dv7GrRd80617rSYR27rT3mSF';
			exit(1);
		}

		$to      = $receiver;
		$title   = "Jadwal Order Distributor";
		$message = "Tanggal: ".date_format(date_create($periode2),"d-m-Y")."\n".$message;

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
	
}

echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

?>