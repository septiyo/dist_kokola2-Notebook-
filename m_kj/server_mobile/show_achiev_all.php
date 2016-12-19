<?php
require_once("koneksi.php");
ini_set('max_execution_time', 1000);

$usr = isset($_REQUEST['ACCOUNT_ID']) ? $_REQUEST['ACCOUNT_ID'] : '';

$sql = "SELECT aa.*, bb.* FROM 
		(SELECT pd.ACCOUNT_ID, pd.ACCOUNT_NAME FROM push_distributor pd WHERE pd.SALES_ID = '".$usr."')aa,
		(SELECT ROUND((SELECT COUNT(TGL) FROM hari_kerja WHERE TGL <= CURDATE() 
			AND MONTH(TGL) = MONTH(CURDATE())
			AND YEAR(CURDATE()))/(SELECT COUNT(TGL) FROM hari_kerja 
			WHERE MONTH(TGL) = MONTH(CURDATE()) 
			AND YEAR(TGL) = YEAR(CURDATE())) * 100, 2) AS TIME_GONE)bb;";
$result = mysql_query($sql) or die("Note: " . mysql_error());

if(mysql_num_rows($result) == 0){
	exit();
}

$dist = array();
$distname = array();
$TIME_GONE;
while ($row = mysql_fetch_array($result)){
	array_push($dist, $row['ACCOUNT_ID']);
	array_push($distname, $row['ACCOUNT_NAME']);
	$TIME_GONE = $row['TIME_GONE'];
}//print_r ($dist);echo count($dist); exit(1);//sales0001 sales0028 sales0036 sales0052 Bardi

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
		
		$ACCOUNT_ID = $dist[$j];
		$KJ_BLI = $row['TKJ'];
		$NILAI = $row['TKI'];
		$REALX = $row['REALX'];
		$NAMA = $distname[$j];
		
		if($KJ_BLI == null || $KJ_BLI == ""){
			$KJ_BLI = 0;
		}
		if($NILAI == null || $NILAI == ""){
			$NILAI = 0;
		}
		if($REALX == null || $REALX == ""){
			$REALX = 0;
		}
		
		$data[] = array(
			//'TRIWULAN' => $row['TRIWULAN'],
			'ACCOUNT_ID' => $ACCOUNT_ID,
			'KJ_BLI' => $KJ_BLI,
			'NILAI' => $NILAI,
			//'KJ_BULAN_INI' => $row['KJ_BULAN_INI'],
			'TIME_GONE' => $TIME_GONE,
			'REALX' => $REALX,
			//'QTY' => $row['qty'],
			//'PERIODE2' => $row['periode2'],
			//'NOTIF' => $row['NOTIF'],
			'NAMA' => $NAMA,
			//'ID_APKEY' => $row['ID_APKEY']
		);
		
	}
	
}

$json = json_encode($data);
echo $json;

?>