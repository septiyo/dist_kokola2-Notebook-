<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);
$log_m =  '';
$values = "";
/*

Note: Jalan tiap jam 7.00, 11.00, 14.00

*/

//Cek hari minggu?
if(date('N', time()) == 7){
	exit();
}

//Notif 3x -> 2x
$dtime = time();
//echo $dtime;exit(1);
$jam_1 = "06:45:00";
$jam_2 = "07:15:00";
$jam_3 = "13:45:00";
$jam_4 = "14:15:00";
//echo strtotime($jam_3);exit(1);
if(($dtime >= strtotime($jam_1) && $dtime <= strtotime($jam_2)) || ($dtime >= strtotime($jam_3) && $dtime <= strtotime($jam_4))){
	


$sql = "SELECT k.ACCOUNT_ID, u.HAK,(
			CASE WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '1'
				THEN BULAN1 
			WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '2'
				THEN BULAN2 
			WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '3'
				THEN BULAN3 
			WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '4'
				THEN BULAN1 
			WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '5'
				THEN BULAN2 
			WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '6'
				THEN BULAN3 
			WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '7'
				THEN BULAN1 
			WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '8'
				THEN BULAN2 
			WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '9'
				THEN BULAN3 
			WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '10'
				THEN BULAN1 
			WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '11'
				THEN BULAN2 
			WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '12'
				THEN BULAN3 
			ELSE BULAN1 END) AS KJ_BULAN_INI, u.id_apkey
			FROM kj k
			INNER JOIN distributor_kokola.user u
			ON k.ACCOUNT_ID = u.ACCOUNT_ID
			WHERE k.TRIWULAN = (
				CASE WHEN MONTH(CURDATE()) = '1'
					THEN 'Jan-Feb-Mar'
					WHEN MONTH(CURDATE()) = '2'
					THEN 'Jan-Feb-Mar'
					WHEN MONTH(CURDATE()) = '3'
					THEN 'Jan-Feb-Mar'
					WHEN MONTH(CURDATE()) = '4'
					THEN 'Apr-May-Jun'
					WHEN MONTH(CURDATE()) = '5'
					THEN 'Apr-May-Jun'
					WHEN MONTH(CURDATE()) = '6'
					THEN 'Apr-May-Jun'
					WHEN MONTH(CURDATE()) = '7'
					THEN 'Jul-Aug-Sep'
					WHEN MONTH(CURDATE()) = '8'
					THEN 'Jul-Aug-Sep'
					WHEN MONTH(CURDATE()) = '9'
					THEN 'Jul-Aug-Sep'
					WHEN MONTH(CURDATE()) = '10'
					THEN 'Oct-Nov-Dec'
					WHEN MONTH(CURDATE()) = '11'
					THEN 'Oct-Nov-Dec'
					WHEN MONTH(CURDATE()) = '12'
					THEN 'Oct-Nov-Dec'
					ELSE ''
					END)
			AND u.HAK = 'DISTRIBUTOR'
			AND u.id_apkey IS NOT NULL
			AND u.id_apkey <> ''
		GROUP BY k.ACCOUNT_ID;";
			
$result = mysql_query($sql) or die("Note: " . mysql_error());

$acc_id = array();

while($row = mysql_fetch_array($result)){
	array_push($acc_id, $row['ACCOUNT_ID']);
}

$cc = count($acc_id);

for ($i = 0; $i < $cc; $i++) {
	
    $url = 'http://10.1.13.54/m_kj/server_mobile/push_notif_promo.php';
	$data = array('ACCOUNT_ID' => $acc_id[$i]);
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);

	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	
	$log_m .= '['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$acc_id[$i].']-['.$result.']'."\n";
	$deco = json_decode($result, true, 512, JSON_BIGINT_AS_STRING);
	
	$stat;
	if($deco['success'] == '1'){
		$stat = 'message_id';
	}else{
		$stat = 'error';
	}
	
	$values .= "(DEFAULT, '".date("Y-m-d h:i:s", time())."', '".$acc_id[$i]."', '".$deco['multicast_id']."', '".$deco['success']."', 
			'".$deco['failure']."', '".$deco['canonical_ids']."', '".$deco['results'][0][$stat]."', 'NOTIF_PROMO'),";
	
}

echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

$log_mm = $log_m.'['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$time_elapsed_secs."]\n";

$url = 'http://10.3.3.88/log_mkj/log_writer.php';
$data = array('OPERAND' => 'selector_promo', 'LOG' => $log_mm);
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

		
		
}else{
	exit('false');
}
?>