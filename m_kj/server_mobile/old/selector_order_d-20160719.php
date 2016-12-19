<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);

/*

Note: Jalan tiap jam 9.00 & 11.00

*/

$sql = "SELECT * FROM order_kirim_wd okw WHERE okw.periode2 = (CURDATE() + INTERVAL 1 DAY) GROUP BY okw.ACCOUNT_ID";
			
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
	//$mess .= $i."-".$acc_id[$i]."\n";
	
	$sqsel = "SELECT * FROM order_distributor od
				WHERE DAY(od.TGL) = DAY(CURDATE() + INTERVAL 1 DAY) 
				AND MONTH(od.TGL) = MONTH(CURDATE() + INTERVAL 1 DAY) 
				AND YEAR(od.TGL) = YEAR(CURDATE() + INTERVAL 1 DAY) 
				AND od.ACCOUNT_ID = '".$acc_id[$i]."';";
	$res = mysql_query($sqsel) or die("Note: " . mysql_error());
	
	if(mysql_num_rows($res) > 0){
		
		//continue;
		
	}else{
		//echo $acc_id[$i];//exit(1);
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
		$result = file_get_contents($url, false, $context);
		
	}
	
}

//echo $mess;
echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

?>