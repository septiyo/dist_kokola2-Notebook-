<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);
$log_m =  '';
$values = "";
/*

Note: Jalan tiap jam 9.00 & 11.00

*/

//Cek hari minggu?
if(date('N', time()) == 7){
	exit();
}

$sql = "SELECT okw.*, uu.id_apkey FROM order_kirim_wd okw 
			INNER JOIN distributor_kokola.user uu
				ON okw.ACCOUNT_ID = uu.ACCOUNT_ID
			WHERE okw.periode2 = (CURDATE() + INTERVAL 1 DAY) 
			AND okw.ACCOUNT_ID <> 0
			AND okw.ACCOUNT_ID <> ''
			AND uu.id_apkey IS NOT NULL
			AND uu.id_apkey <> ''
			GROUP BY okw.ACCOUNT_ID;";
			
$result = mysql_query($sql) or die("Note: " . mysql_error());

$acc_id = array();

while($row = mysql_fetch_array($result)){
	
	array_push($acc_id, $row['ACCOUNT_ID']);
	
}

$cc = count($acc_id);

for ($i = 0; $i < $cc; $i++) {
	
	$sqsel = "SELECT * FROM order_distributor od
				WHERE DAY(od.TGL) = DAY(CURDATE() + INTERVAL 1 DAY) 
				AND MONTH(od.TGL) = MONTH(CURDATE() + INTERVAL 1 DAY) 
				AND YEAR(od.TGL) = YEAR(CURDATE() + INTERVAL 1 DAY) 
				AND od.ACCOUNT_ID = '".$acc_id[$i]."';";
	$res = mysql_query($sqsel) or die("Note: " . mysql_error());
	
	if(mysql_num_rows($res) > 0){
		
		//continue;
		
	}else{
		
		$url = 'http://10.1.13.54/m_kj/server_mobile/push_notif_order_d.php';
		$data = array('ACCOUNT_ID' => $acc_id[$i]);
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);

		$context  = stream_context_create($options);
		$resulte = file_get_contents($url, false, $context);
		
		$log_m .= '['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$acc_id[$i].']-['.$resulte.']'."\n";
		$deco = json_decode($resulte, true, 512, JSON_BIGINT_AS_STRING);
		
		$stat;
		if($deco['success'] == '1'){
			$stat = 'message_id';
		}else{
			$stat = 'error';
		}
		
		$values .= "(DEFAULT, '".date("Y-m-d h:i:s", time())."', '".$acc_id[$i]."', '".$deco['multicast_id']."', '".$deco['success']."', 
				'".$deco['failure']."', '".$deco['canonical_ids']."', '".$deco['results'][0][$stat]."', 'NOTIF_ORDER_D'),";
	}
	
}

echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

$log_mm = $log_m.'['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$time_elapsed_secs."]\n";

$url = 'http://10.3.3.88/log_mkj/log_writer.php';
$data = array('OPERAND' => 'selector_order_d', 'LOG' => $log_mm);
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