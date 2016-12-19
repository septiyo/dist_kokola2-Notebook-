<?php
require_once("koneksi.php");

$usr = isset($_REQUEST['ACCOUNT_ID']) ? $_REQUEST['ACCOUNT_ID'] : '';

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
JOIN distributor_kokola.user uu ON SS.ACCOUNT_ID = uu.ACCOUNT_ID WHERE SS.ACCOUNT_ID = '". $usr ."';";
		
$result = mysql_query($sql) or die("Note: " . mysql_error());

$data = array();
$status = false;
while($row = mysql_fetch_array($result)){
	
	$KJ_BLI = $row['KJ_BLI'];
	$NILAI = $row['NILAI'];
	$TIME_GONE = $row['TIME_GONE'];
	$REALX = $row['REALX'];
	
	if($KJ_BLI == null || $KJ_BLI == ""){
		$KJ_BLI = 0;
	}
	if($NILAI == null || $NILAI == ""){
		$NILAI = 0;
	}
	if($TIME_GONE == null || $TIME_GONE == ""){
		$TIME_GONE = 0;
	}
	if($REALX == null || $REALX == ""){
		$REALX = 0;
	}
	
	$data[] = array(
		'TRIWULAN' => $row['TRIWULAN'],
        'ACCOUNT_ID' => $row['ACCOUNT_ID'],
        'KJ_BLI' => $KJ_BLI,
        'NILAI' => $NILAI,
		'KJ_BULAN_INI' => $row['KJ_BULAN_INI'],
		'TIME_GONE' => $TIME_GONE,
        'REALX' => $REALX,
        'QTY' => $row['qty'],
        'PERIODE2' => $row['periode2'],
        'NOTIF' => $row['NOTIF'],
		'NAMA' => $row['nama'],
		'ID_APKEY' => $row['ID_APKEY']
    );
	$status = true;
}
$json = json_encode($data);
echo $json;

/* $sql = "SELECT SS.TRIWULAN, SS.ACCOUNT_ID, SS.KJ_BLI, SS.qty2, 
		ROUND((DAY(CURDATE()) / (SELECT JUMLAH_HARI FROM hari_kerja WHERE ID = (SELECT MAX(ID) FROM hari_kerja))) * 100, 2) AS TIME_GONE,
		ROUND((SS.qty2 / SS.KJ_BLI) * 100, 2) AS REALX,
		SS.periode2,
		ROUND((ROUND((DAY(CURDATE()) / (SELECT JUMLAH_HARI FROM hari_kerja WHERE ID = (SELECT MAX(ID) FROM hari_kerja))) * 100, 2) / ((SS.NILAI / SS.KJ_BLI) * 100)), 2) AS NOTIF, uu.nama, uu.ID_APKEY 
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
						LEFT JOIN(SELECT ZZ.*, SUM(qty) AS NILAI FROM(SELECT ACCOUNT_ID AS IDX, qty, SUM(qty) AS qty2, flag, periode2 FROM order_kirim 
	WHERE MONTH(periode2) = MONTH(CURDATE()) AND  MONTH(periode1) = MONTH(CURDATE()) 
	AND DAY(periode2) = DAY(CURDATE())
		AND YEAR(periode2) = YEAR(CURDATE()) AND flag = 1  
		GROUP BY ACCOUNT_ID) AS ZZ GROUP BY IDX) AS REAL_KIRIM ON KJ_BULAN_INI.ACCOUNT_ID = REAL_KIRIM.IDX) AS SS
	JOIN distributor_kokola.user uu ON SS.ACCOUNT_ID = uu.ACCOUNT_ID WHERE SS.ACCOUNT_ID = '". $usr ."'"; */
?>

