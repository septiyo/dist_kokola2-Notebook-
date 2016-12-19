<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
require_once("koneksi.php");

$ida = $_REQUEST['ACCOUNT_ID'];

$sql = "SELECT SS.TRIWULAN, 
		SS.ACCOUNT_ID, 
		SS.KJ_BLI, 
		SS.qty2, 
		ROUND((SELECT COUNT(TGL) FROM hari_kerja WHERE TGL <= CURDATE() 
			AND MONTH(TGL) = MONTH(CURDATE())
			AND YEAR(CURDATE()))/(SELECT COUNT(TGL) FROM hari_kerja 
			WHERE MONTH(TGL) = MONTH(CURDATE()) 
			AND YEAR(TGL) = YEAR(CURDATE())) * 100, 2) AS TIME_GONE,
		ROUND((SS.qty2 / SS.KJ_BLI) * 100, 2) AS REALX,
		SS.periode2,
		ROUND((ROUND((SELECT COUNT(TGL) FROM hari_kerja WHERE TGL <= CURDATE() 
			AND MONTH(TGL) = MONTH(CURDATE())
			AND YEAR(CURDATE()))/(SELECT COUNT(TGL) FROM hari_kerja 
			WHERE MONTH(TGL) = MONTH(CURDATE()) 
			AND YEAR(TGL) = YEAR(CURDATE())) * 100, 2) / ((SS.NILAI / SS.KJ_BLI) * 100)), 2) AS NOTIF, 
		uu.nama, 
		uu.ID_APKEY 
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
					END) AND YEAR(TGL)=YEAR (CURDATE())) AS QQ 
				GROUP BY QQ.ITEM_CODE, QQ.ACCOUNT_ID) AS FF) AS VV 
			GROUP BY VV.ACCOUNT_ID) AS KJ_BULAN_INI 
			LEFT JOIN(SELECT ZZ.*, SUM(qty) AS NILAI 
	FROM(SELECT ACCOUNT_ID AS IDX, qty, SUM(qty) AS qty2, flag, periode2 FROM order_kirim 
	WHERE MONTH(periode2) = MONTH(CURDATE()) AND  MONTH(periode1) = MONTH(CURDATE()) 
	AND DAY(periode2) = DAY(CURDATE())
	AND YEAR(periode2) = YEAR(CURDATE()) AND flag = 1  
	GROUP BY ACCOUNT_ID) AS ZZ GROUP BY IDX) AS REAL_KIRIM ON KJ_BULAN_INI.ACCOUNT_ID = REAL_KIRIM.IDX) AS SS
	JOIN distributor_kokola.user uu ON SS.ACCOUNT_ID = uu.ACCOUNT_ID WHERE SS.ACCOUNT_ID = '". $ida ."'"; //44721//A87051

$result = mysql_query($sql) or die("Note: " . mysql_error());

$TRIWULAN = "";
$ACCOUNT_ID = "";
$KJ_BLI = "";
$NILAI = "";
$KJ_BULAN_INI = "";
$TIME_GONE = "";
$REALX = "";
$QTY = "";
$PERIODE2 = "";
$NOTIF = "";
$NAMA = "";
$receiver = "";

while($row = mysql_fetch_array($result)){
	
	$TRIWULAN = $row['TRIWULAN'];
	$ACCOUNT_ID = $row['ACCOUNT_ID'];
	$KJ_BLI = $row['KJ_BLI'];
	$NILAI = $row['qty2'];
	$KJ_BULAN_INI = $row['KJ_BULAN_INI'];
	$TIME_GONE = $row['TIME_GONE'];
	$REALX = $row['REALX'];
	$QTY = $row['qty'];
	$PERIODE2 = $row['periode2'];
	$NOTIF = $row['NOTIF'];
	$NAMA = $row['nama'];
	$receiver = $row['ID_APKEY'];
	
	if($KJ_BLI == "" || $KJ_BLI == null){
		$KJ_BLI = 0;
	}
	if($NILAI == "" || $NILAI == null){
		$NILAI = 0;
	}
	if($REALX == "" || $REALX == null){
		$REALX = 0;
	}
    
}

//exit("1");
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/

if($receiver == null || $receiver == ""){
	//$receiver = 'cBFEEOzACRI:APA91bHyjM1jLQQf3VpakRRtTgNQwpXOFKMtOcA0M7hvQXpfc6LxyIfRoVVF5GpRqEFiY6RGg5PWdxVylbu0c58tJY8_dVw1UbjCyGSTKNMG2mt3MQQ2Dv7GrRd80617rSYR27rT3mSF';
	$receiver = '';
	exit(1);
}

$to      = $receiver;
$title   = "Progress KJ";
$message = "". $NAMA ."";

/* $s = count($produk);
for ($i = 0; $i < $s; $i++) {
    $message .= "\n-" . $produk[$i] . " \nKJ(" . $kj_bulan[$i] . ") Kirim(" . $jml_produk[$i] . ")";
} */

$message .= "\nTotal KJ: " . $KJ_BLI ."\nTotal Kirim: ". $NILAI ."\nTime gone: ". $TIME_GONE ."%\nReal: ".$REALX."%";

sendPush($to, $title, $message);

$n = time();
function sendPush($to, $title, $message){
    // API access key from Google API's Console
    // replace API
    define('API_ACCESS_KEY', 'AIzaSyBuyhI8NMzOAKBr-rliVwgQrZFXyk1diNI');
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
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/
?>
