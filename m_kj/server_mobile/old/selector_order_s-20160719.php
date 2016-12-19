<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);

/*

Note: Jalan tiap jam 9.00, 12.00, 15.00

*/

$sql = "SELECT okw.*, pd.SALES_ID FROM order_kirim_wd okw 
		INNER JOIN push_distributor pd 
		ON pd.ACCOUNT_ID = okw.ACCOUNT_ID 
		WHERE okw.periode2 = (CURDATE() + INTERVAL 1 DAY)
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
					WHERE DAY(od.TGL) = DAY(CURDATE() + INTERVAL 1 DAY) 
					AND MONTH(od.TGL) = MONTH(CURDATE() + INTERVAL 1 DAY) 
					AND YEAR(od.TGL) = YEAR(CURDATE() + INTERVAL 1 DAY)) aa
				WHERE aa.SALES_ID = '".$sal_id[$i]."' AND aa.ACCOUNT_ID = '".$dist_id[$i]."';";
	$ress = mysql_query($sqsel) or die("Note: " . mysql_error());
	//echo $sqsel;exit();
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
		$result = file_get_contents($url, false, $context);
		
	}
	
}

echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

?>