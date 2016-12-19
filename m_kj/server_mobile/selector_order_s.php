<?php
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

$sql = "SELECT okw.*, pd.SALES_ID, uu.NAMA, uu.id_apkey 
		FROM order_kirim_wd okw 
			INNER JOIN push_distributor pd 
				ON pd.ACCOUNT_ID = okw.ACCOUNT_ID
			INNER JOIN distributor_kokola.user uu
				ON pd.SALES_ID = uu.ACCOUNT_ID
			WHERE okw.periode2 = (CURDATE() + INTERVAL 1 DAY)
			AND uu.id_apkey IS NOT NULL
			AND uu.id_apkey <> ''
			GROUP BY okw.ACCOUNT_ID
			ORDER BY pd.SALES_ID;";
			
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
					WHERE DAY(od.TGL) = DAY(CURDATE() + INTERVAL 1 DAY) 
					AND MONTH(od.TGL) = MONTH(CURDATE() + INTERVAL 1 DAY) 
					AND YEAR(od.TGL) = YEAR(CURDATE() + INTERVAL 1 DAY)) aa
				WHERE aa.SALES_ID = '".$sal_id[$i]."' AND aa.ACCOUNT_ID = '".$dist_id[$i]."';";
	$ress = mysql_query($sqsel) or die("Note: " . mysql_error());
	
	if(mysql_num_rows($ress) > 0){
		
		//continue;
		
	}else{
		
		$url = 'http://10.1.13.54/m_kj/server_mobile/push_notif_order_s.php';
		$data = array('SALES' => $sal_id[$i], 'DIST' => $dist_id[$i]);
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);

		$context  = stream_context_create($options);
		$resulte = file_get_contents($url, false, $context);
		
		$log_m .= '['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$sal_id[$i].']-['.$dist_id[$i].']-['.$resulte.']'."\n";
		$deco = json_decode($resulte, true, 512, JSON_BIGINT_AS_STRING);
		
		$stat;
		if($deco['success'] == '1'){
			$stat = 'message_id';
		}else{
			$stat = 'error';
		}
		
		$values .= "(DEFAULT, '".date("Y-m-d h:i:s", time())."', '".$sal_id[$i]."', '".$deco['multicast_id']."', '".$deco['success']."', 
				'".$deco['failure']."', '".$deco['canonical_ids']."', '".$deco['results'][0][$stat]."', 'NOTIF_ORDER_S'),";
		
		
	}
	
}

echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

$log_mm = $log_m.'['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$time_elapsed_secs."]\n";

$url = 'http://10.3.3.88/log_mkj/log_writer.php';
$data = array('OPERAND' => 'selector_order_s', 'LOG' => $log_mm);
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