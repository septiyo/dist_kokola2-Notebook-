<?php
require_once("koneksi.php");

$usr = isset($_REQUEST['ACCOUNT_ID']) ? $_REQUEST['ACCOUNT_ID'] : '';

$sqsel = "SELECT aa.*, bb.* FROM 
		(SELECT uu.ACCOUNT_ID, uu.NAMA FROM distributor_kokola.user uu
			WHERE uu.ACCOUNT_ID = '".$usr."') aa,
		(SELECT ROUND((SELECT COUNT(TGL) FROM hari_kerja WHERE TGL <= CURDATE() 
			AND MONTH(TGL) = MONTH(CURDATE())
			AND YEAR(CURDATE()))/(SELECT COUNT(TGL) FROM hari_kerja 
			WHERE MONTH(TGL) = MONTH(CURDATE()) 
			AND YEAR(TGL) = YEAR(CURDATE())) * 100, 2) AS TIME_GONE) bb;";
$ress = mysql_query($sqsel) or die("Note: ".mysql_error());
$aa = mysql_fetch_array($ress);

$sql = "SELECT SUM(KJ_BULAN_INI) AS TKJ, SUM(KIRIM_BULAN_INI) AS TKI, 
		ROUND((SUM(KIRIM_BULAN_INI)/SUM(KJ_BULAN_INI)) *100, 2) AS REALX FROM(
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
						WHERE k.ACCOUNT_ID ='". $usr ."' 
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
						WHERE ok.ACCOUNT_ID = '". $usr ."' 
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
						WHERE k.ACCOUNT_ID ='". $usr ."' 
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
						WHERE ok.ACCOUNT_ID = '". $usr ."' 
						AND ok.periode1 = DATE_FORMAT(NOW() ,'%Y-%m-01')
						AND ok.periode2 = CURDATE() 
						AND flag = 1
						GROUP BY ok.item_code) bb
			ON aa.ITEM_CODE = bb.item_code) cc;";
		
$result = mysql_query($sql) or die("Note: " . mysql_error());

while($row = mysql_fetch_array($result)){
	
	$KJ_BLI = $row['TKJ'];
	$NILAI = $row['TKI'];
	$TIME_GONE = $aa['TIME_GONE'];
	$REALX = $row['REALX'];
	
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
//		'TRIWULAN' => $row['TRIWULAN'],
        'ACCOUNT_ID' => $aa['ACCOUNT_ID'],
        'KJ_BLI' => $KJ_BLI,
        'NILAI' => $NILAI,
//		'KJ_BULAN_INI' => $row['KJ_BULAN_INI'],
		'TIME_GONE' => $TIME_GONE,
        'REALX' => $REALX,
//        'QTY' => $row['qty'],
//        'PERIODE2' => $row['periode2'],
//        'NOTIF' => $row['NOTIF'],
		'NAMA' => $aa['NAMA'],
//		'ID_APKEY' => $row['ID_APKEY']
    );
}

$json = json_encode($data);
echo $json;

?>