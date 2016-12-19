<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);
define('API_ACCESS_KEY', 'AIzaSyBuyhI8NMzOAKBr-rliVwgQrZFXyk1diNI');
$log_m =  '';
$values = "";

/*

Note: Jalan tiap jam 7.00 pagi

*/

$sqla = "SELECT aa.*, bb.* FROM
		(SELECT uu.ACCOUNT_ID, uu.id_apkey FROM distributor_kokola.user uu
			WHERE uu.id_apkey IS NOT NULL 
			AND uu.id_apkey <> '' 
			AND uu.HAK = 'SALES')aa,
		(SELECT ROUND((SELECT COUNT(TGL) FROM hari_kerja WHERE TGL <= CURDATE() 
			AND MONTH(TGL) = MONTH(CURDATE())
			AND YEAR(CURDATE()))/(SELECT COUNT(TGL) FROM hari_kerja 
			WHERE MONTH(TGL) = MONTH(CURDATE()) 
			AND YEAR(TGL) = YEAR(CURDATE())) * 100, 2) AS TIME_GONE)bb;";
			
$resulta = mysql_query($sqla) or die("Note: " . mysql_error());

$sal_id = array();
$sal_key = array();
$TIME_GONE;

while($row = mysql_fetch_array($resulta)){
	array_push($sal_id, $row['ACCOUNT_ID']);
	array_push($sal_key, $row['id_apkey']);
	$TIME_GONE = $row['TIME_GONE'];
}

$cc = count($sal_id);//echo $cc;exit();

for ($i = 0; $i < $cc; $i++) {
	
    $sql = "SELECT pd.ACCOUNT_ID FROM push_distributor pd 
			WHERE pd.SALES_ID = '". $sal_id[$i] ."';";
	$result = mysql_query($sql) or die("Note: " . mysql_error());

	if(mysql_num_rows($result) == 0){
		continue;
	}
	
	$dist = array();
	while ($row = mysql_fetch_array($result)){
		array_push($dist, $row['ACCOUNT_ID']);
	}//echo $i.")".$sal_id[$i]."-".count($dist)."</br>";//exit();

	$ACCOUNT_ID = "";
	$NAMA = "";
	$TKJ = 0;
	$TKI = 0;
	$REALX = 0;
	
	for($j=0; $j < count($dist); $j++){
		$sqlsel = "SELECT  dd.ACCOUNT_ID, dd.NAMA, SUM(KJ_BULAN_INI) AS TKJ, SUM(KIRIM_BULAN_INI) AS TKI, 
					ROUND((SUM(KIRIM_BULAN_INI)/SUM(KJ_BULAN_INI)) *100, 2) AS REALX, dd.id_apkey FROM(
						SELECT aa.ITEM_CODE, aa.KJ_BULAN_INI, bb.KIRIM_BULAN_INI, aa.NAMA_PRODUK FROM(
							SELECT k.ITEM_CODE,(
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
									ELSE BULAN1 END) AS KJ_BULAN_INI,mp.NAMA_PRODUK FROM kj k
								INNER JOIN m_produk mp ON k.ITEM_CODE = mp.ITEM_CODE
									WHERE k.ACCOUNT_ID ='". $dist[$j] ."' 
									AND k.TRIWULAN = (
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
									GROUP BY k.ITEM_CODE) aa
						 LEFT JOIN (SELECT ok.item_code,ok.qty AS KIRIM_BULAN_INI,mp.NAMA_PRODUK FROM order_kirim ok 
								INNER JOIN m_produk mp ON ok.item_code = mp.ITEM_CODE
									WHERE ok.ACCOUNT_ID = '". $dist[$j] ."' 
									AND ok.periode1 = DATE_FORMAT(NOW() ,'%Y-%m-01')
									AND ok.periode2 = CURDATE() 
									AND flag = 1
									GROUP BY ok.item_code) bb
						ON aa.ITEM_CODE = bb.item_code
						UNION
						SELECT bb.ITEM_CODE, aa.KJ_BULAN_INI, bb.KIRIM_BULAN_INI, bb.NAMA_PRODUK FROM(
							SELECT k.ITEM_CODE,(
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
									ELSE BULAN1 END) AS KJ_BULAN_INI,mp.NAMA_PRODUK FROM kj k
								INNER JOIN m_produk mp ON k.ITEM_CODE = mp.ITEM_CODE
									WHERE k.ACCOUNT_ID ='". $dist[$j] ."' 
									AND k.TRIWULAN = (
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
									GROUP BY k.ITEM_CODE) aa
						 RIGHT JOIN (SELECT ok.item_code,ok.qty AS KIRIM_BULAN_INI,mp.NAMA_PRODUK FROM order_kirim ok 
								INNER JOIN m_produk mp ON ok.item_code = mp.ITEM_CODE
									WHERE ok.ACCOUNT_ID = '". $dist[$j] ."' 
									AND ok.periode1 = DATE_FORMAT(NOW() ,'%Y-%m-01')
									AND ok.periode2 = CURDATE() 
									AND flag = 1
									GROUP BY ok.item_code) bb
						ON aa.ITEM_CODE = bb.item_code) cc,
						(SELECT u.ACCOUNT_ID, u.NAMA, u.id_apkey FROM distributor_kokola.user u 
							WHERE u.ACCOUNT_ID = '". $dist[$j] ."') dd;";
								
		$res = mysql_query($sqlsel) or die("Note: " . mysql_error());
		
		while($row = mysql_fetch_array($res)){
			
			$ACCOUNT_ID = $row['ACCOUNT_ID'];
			$NAMA = $row['NAMA'];
			$TKJs = $row['TKJ'];
			$TKIs = $row['TKI'];
			$REALX = $row['REALX'];
			
			if($TKJs == "" || $TKJs == null){
				$TKJs = 0;
			}
			if($TKIs == "" || $TKIs == null){
				$TKIs = 0;	
			}
			if($REALX == "" || $REALX == null){
				$REALX = 0;
			}
			
			$TKJ += $TKJs;
			$TKI += $TKIs;
			
		}
		
	}

	$to = $sal_key[$i];
	$title = "Progress KJ";
	$message = "Total KJ: " . $TKJ ."\nTotal Kirim: ". $TKI ."\nTime gone: ". $TIME_GONE ."%\nReal: ".round(($TKI/$TKJ*100), 2)."%";
	//echo $sal_id[$i]."-\n".$message."</br>";

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
		
		//you can also add images, additionalData
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
	
	$log_m .= '['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$sal_id[$i].']-['.$result.']'."\n";
	$deco = json_decode($result, true, 512, JSON_BIGINT_AS_STRING);
	
	$stat;
	if($deco['success'] == '1'){
		$stat = 'message_id';
	}else{
		$stat = 'error';
	}
	
	$values .= "(DEFAULT, '".date("Y-m-d h:i:s", time())."', '".$sal_id[$i]."', '".$deco['multicast_id']."', '".$deco['success']."', 
			'".$deco['failure']."', '".$deco['canonical_ids']."', '".$deco['results'][0][$stat]."', 'NOTIF_ACHIEV_S'),";
	
}

echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

$log_mm = $log_m.'['.date("Y-m-d", time()).']-['.date("h:i:s A", time()).']-['.$time_elapsed_secs."]\n";

$url = 'http://10.3.3.88/log_mkj/log_writer.php';
$data = array('OPERAND' => 'selector_achiev_s', 'LOG' => $log_mm);
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