<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 1); */
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);
$log_m =  '';
$values = "";
/*

Note: Jalan tiap jam 9.00, 12.00, 15.00

*/

//Cek hari minggu?
if(date('N', time()) == 7){
	exit();
}

$sql = "SELECT okw.*, pd.SALES_ID, uu.id_apkey 
		FROM order_kirim_wd okw 
			INNER JOIN push_distributor pd 
				ON pd.ACCOUNT_ID = okw.ACCOUNT_ID
			INNER JOIN distributor_kokola.user uu
				ON pd.SALES_ID = uu.ACCOUNT_ID
			WHERE okw.periode2 = CURDATE()
			AND uu.id_apkey IS NOT NULL
			AND uu.id_apkey <> ''
			GROUP BY okw.ACCOUNT_ID
			ORDER BY pd.SALES_ID ASC;";
			
$result = mysql_query($sql) or die("Note: " . mysql_error());

$dist_id = array();
$sal_id = array();

while($row = mysql_fetch_array($result)){
	
	array_push($dist_id, $row['ACCOUNT_ID']);
	array_push($sal_id, $row['SALES_ID']);
	
}

for($i = 0;$i<count($sal_id);$i++){
	
	$sqsel = "SELECT aa.* FROM (
				SELECT od.*, pd.SALES_ID FROM order_distributor od 
					INNER JOIN push_distributor pd 
						ON pd.ACCOUNT_ID = od.ACCOUNT_ID
					WHERE DAY(od.TGL) = DAY(CURDATE()) 
					AND MONTH(od.TGL) = MONTH(CURDATE()) 
					AND YEAR(od.TGL) = YEAR(CURDATE())) aa
				WHERE aa.SALES_ID = '".$sal_id[$i]."' AND aa.ACCOUNT_ID = '".$dist_id[$i]."';";
	$ress = mysql_query($sqsel) or die("Note: " . mysql_error());
	
	if(mysql_num_rows($ress) > 0){
		
		//continue;
		
	}else{
		
		$sql = "SELECT aa.*, bb.* FROM (
					SELECT okw.*, SUM(qty) AS total_order, COUNT(*) AS jenis_item, pd.SALES_ID, pd.ACCOUNT_NAME FROM order_kirim_wd okw 
						INNER JOIN push_distributor pd 
							ON pd.ACCOUNT_ID = okw.ACCOUNT_ID
						WHERE okw.periode2 = CURDATE()
						GROUP BY okw.ACCOUNT_ID)aa,
					(SELECT uu.ID_APKEY FROM distributor_kokola.user uu WHERE uu.ACCOUNT_ID = '".$sal_id[$i]."') bb
				WHERE aa.SALES_ID = '".$sal_id[$i]."' AND aa.ACCOUNT_ID IN ('".$dist_id[$i]."');";

		$result = mysql_query($sql) or die("Note: " . mysql_error());//echo $sql;exit();

		$ACCOUNT_ID = "";
		$periode1 = "";
		$periode2 = ""; 
		$tgl_upload = "";
		$total_order = "";
		$jenis_item = "";
		$NAMA = "";
		$receiver = "";

		$message;

		while($row = mysql_fetch_array($result)){

			$ACCOUNT_ID = $row['ACCOUNT_ID'];
			$periode1 = $row['periode1'];
			$periode2 = $row['periode2']; 
			$tgl_upload = $row['tgl_upload'];
			$total_order = $row['total_order'];
			$jenis_item = $row['jenis_item'];
			$NAMA = $row['ACCOUNT_NAME'];
			$receiver = $row['ID_APKEY'];

			$message = "".$NAMA."";

		}
		
		$to      = $receiver;
		$title   = "Jadwal Order Distributor";
		$message = "Tanggal: ".date_format(date_create($periode2),"d-m-Y")."\n".$message;

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
		//echo $result;
		$log_m .= '['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$sal_id[$i].']-['.$dist_id[$i].']-['.$result.']'."\n";
		$deco = json_decode($result, true, 512, JSON_BIGINT_AS_STRING);
		
		$stat;
		if($deco['success'] == '1'){
			$stat = 'message_id';
		}else{
			$stat = 'error';
		}
		
		$values .= "(DEFAULT, '".date("Y-m-d h:i:s", time())."', '".$sal_id[$i]."', '".$deco['multicast_id']."', '".$deco['success']."', 
				'".$deco['failure']."', '".$deco['canonical_ids']."', '".$deco['results'][0][$stat]."', 'NOTIF_ORDER_S_H'),";
	
	}

}

echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

$log_mm = $log_m.'['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$time_elapsed_secs."]\n";

$url = 'http://10.3.3.88/log_mkj/log_writer.php';
$data = array('OPERAND' => 'selector_order_s_h', 'LOG' => $log_mm);
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
		$ressu = mysql_query($sqlog) or die("Note: ".mysql_error());

?>