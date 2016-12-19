<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);
define('API_ACCESS_KEY', 'AIzaSyBuyhI8NMzOAKBr-rliVwgQrZFXyk1diNI');

/*

Note: Jalan tiap jam 7.00 pagi

*/

$sql = "SELECT * FROM distributor_kokola.user 
		WHERE user.id_apkey IS NOT NULL 
		AND user.id_apkey <> '' 
		AND user.HAK = 'distributor';";
			
$result = mysql_query($sql) or die("Note: " . mysql_error());

$acc_id = array();

while($row = mysql_fetch_array($result)){
	
	array_push($acc_id, $row['ACCOUNT_ID']);
	
}

$cc = count($acc_id);
//echo $cc."\n";exit(1);
for ($i = 0; $i < $cc; $i++) {
	//$mess .= $i."-".$acc_id[$i]."\n";
	
    $sql2 = "SELECT  dd.ACCOUNT_ID, dd.NAMA, SUM(KJ_BULAN_INI) AS TKJ, SUM(KIRIM_BULAN_INI) AS TKI, 
			ee.TIME_GONE, ROUND((SUM(KIRIM_BULAN_INI)/SUM(KJ_BULAN_INI)) *100, 2) AS REALX, dd.id_apkey FROM(
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
							WHERE k.ACCOUNT_ID ='". $acc_id[$i] ."' 
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
							WHERE ok.ACCOUNT_ID = '". $acc_id[$i] ."' 
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
							WHERE k.ACCOUNT_ID ='". $acc_id[$i] ."' 
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
							WHERE ok.ACCOUNT_ID = '". $acc_id[$i] ."' 
							AND ok.periode1 = DATE_FORMAT(NOW() ,'%Y-%m-01')
							AND ok.periode2 = CURDATE() 
							AND flag = 1
							GROUP BY ok.item_code) bb
				ON aa.ITEM_CODE = bb.item_code) cc,
				(SELECT u.ACCOUNT_ID, u.NAMA, u.id_apkey FROM distributor_kokola.user u 
					WHERE u.ACCOUNT_ID = '". $acc_id[$i] ."') dd,
				(SELECT ROUND((SELECT COUNT(TGL) FROM hari_kerja WHERE TGL <= CURDATE() 
						AND MONTH(TGL) = MONTH(CURDATE())
						AND YEAR(CURDATE()))/(SELECT COUNT(TGL) FROM hari_kerja 
						WHERE MONTH(TGL) = MONTH(CURDATE()) 
						AND YEAR(TGL) = YEAR(CURDATE())) * 100, 2) AS TIME_GONE) ee;";

		$result2 = mysql_query($sql2) or die("Note: " . mysql_error());
		
		$ACCOUNT_ID = "";
		$NAMA = "";
		$TKJ = "";
		$TKI = "";
		$TIME_GONE = "";
		$REALX = "";
		$receiver = "";

		while($row = mysql_fetch_array($result2)){
			
			$ACCOUNT_ID = $row['ACCOUNT_ID'];
			$NAMA = $row['NAMA'];
			$TKJ = $row['TKJ'];
			$TKI = $row['TKI'];
			$TIME_GONE = $row['TIME_GONE'];
			$REALX = $row['REALX'];
			$receiver = $row['id_apkey'];
			
			if($TKJ == "" || $TKJ == null){
				$TKJ = 0;
			}
			if($TKI == "" || $TKI == null){
				$TKI = 0;
			}
			if($REALX == "" || $REALX == null){
				$REALX = 0;
			}
			
		}
		
		$to      = $receiver;
		$title   = "Progress KJ";
		$message = "". $NAMA ."";

		/* $s = count($produk);
		for ($i = 0; $i < $s; $i++) {
			$message .= "\n-" . $produk[$i] . " \nKJ(" . $kj_bulan[$i] . ") Kirim(" . $jml_produk[$i] . ")";
		} */

		$message .= "\nTotal KJ: " . $TKJ ."\nTotal Kirim: ". $TKI ."\nTime gone: ". $TIME_GONE ."%\nReal: ".$REALX."%";

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
	
}

//echo $mess;
echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

?>