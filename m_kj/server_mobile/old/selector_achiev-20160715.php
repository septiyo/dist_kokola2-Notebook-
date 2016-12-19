<?php
require_once("koneksi.php");

ini_set('max_execution_time', 1000);
$starttime = microtime(true);

/*

Note: Jalan tiap jam 7.00 pagi

*/

$sql = "SELECT SS.TRIWULAN, SS.ACCOUNT_ID, SS.KJ_BLI, SS.NILAI,
		SS.KJ_BULAN_INI, ROUND((DAY(CURDATE()) / 25) * 100, 2) AS TIME_GONE,
		ROUND((SS.NILAI / SS.KJ_BLI) * 100, 2) AS REALX,
		SS.qty, SS.periode2,
		ROUND((ROUND((DAY(CURDATE()) / 25) * 100, 2) / ((SS.NILAI / SS.KJ_BLI) * 100)), 2) AS NOTIF, uu.nama, uu.ID_APKEY 
		FROM(SELECT * FROM(SELECT VV.*, SUM(VV.KJ_BULAN_INI) AS KJ_BLI FROM(
			SELECT FF.*FROM(
				SELECT QQ.*FROM(
					SELECT * , (
						CASE WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '1'
						THEN BULAN1 WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '2'
						THEN BULAN2 WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '3'
						THEN BULAN3 WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '4'
						THEN BULAN1 WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '5'
						THEN BULAN2 WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '6'
						THEN BULAN3 WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '7'
						THEN BULAN1 WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '8'
						THEN BULAN2 WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '9'
						THEN BULAN3 WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '10'
						THEN BULAN1 WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '11'
						THEN BULAN2 WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '12'
						THEN BULAN3 ELSE BULAN1 END) AS KJ_BULAN_INI FROM kj WHERE TRIWULAN =
					(
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
						END) AND YEAR(TGL)=YEAR (CURDATE())) AS QQ GROUP BY QQ.ITEM_CODE, QQ.ACCOUNT_ID) AS FF) AS VV GROUP BY VV.ACCOUNT_ID) AS KJ_BULAN_INI 
						LEFT JOIN(SELECT ZZ.*, SUM(qty) AS NILAI FROM(
			SELECT ACCOUNT_ID AS IDX, MAX(ID) AS HASIL, qty,
			SUM(qty) AS qty2, periode2 FROM order_kirim WHERE MONTH(periode2) = MONTH(CURDATE()) AND YEAR(periode2) = YEAR(CURDATE()) 
		GROUP BY ACCOUNT_ID, item_code) AS ZZ GROUP BY IDX) AS REAL_KIRIM ON KJ_BULAN_INI.ACCOUNT_ID = REAL_KIRIM.IDX) AS SS
		JOIN distributor_kokola.user uu ON SS.ACCOUNT_ID = uu.ACCOUNT_ID GROUP BY SS.ACCOUNT_ID;";
			
$result = mysql_query($sql) or die("Note: " . mysql_error());

$acc_id = array();

while($row = mysql_fetch_array($result)){
	
	array_push($acc_id, $row['ACCOUNT_ID']);
	
}

$cc = count($acc_id);
/* echo $cc."\n";$mess = ""; */
for ($i = 0; $i < $cc; $i++) {
	//$mess .= $i."-".$acc_id[$i]."\n";
	
    $url = 'http://10.1.13.54/m_kj/server_mobile/push_notif_achiev.php';
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
	
	/* $note = "";
	if ($result === FALSE) {
		$note .= "Notifikasi gagal dikirimkan";
		echo "<script>alert('Notifikasi gagal dikirimkan');</script>";
	}else{
		$note .= "Notifikasi berhasil dikirimkan";
		echo "<script>alert('Notifikasi berhasil dikirimkan');</script>";
	} */
	
}

//echo $mess;
echo ("Execution time: ".$time_elapsed_secs = microtime(true) - $starttime." seconds");

?>