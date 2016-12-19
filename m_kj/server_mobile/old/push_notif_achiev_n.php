<?php
//require_once("koneksi.php");
require_once("koneksi_ol.php");

$ida = $_REQUEST['ACCOUNT_ID'];

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
JOIN distributor_kokola.user uu ON SS.ACCOUNT_ID = uu.ACCOUNT_ID WHERE SS.ACCOUNT_ID = '". $ida ."';"; //44721//A87051

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

$status = false;
while($row = mysql_fetch_array($result)){
	
	$TRIWULAN = $row['TRIWULAN'];
	$ACCOUNT_ID = $row['ACCOUNT_ID'];
	$KJ_BLI = $row['KJ_BLI'];
	$NILAI = $row['NILAI'];
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

if($TIME_GONE <= 20){
	
	$TIME_GONE = '<span id="time_gone" style="background-color: green; color: white;">'.$TIME_GONE.'%</span>';
	
}else if($TIME_GONE > 20 && $TIME_GONE <= 70){
	
	$TIME_GONE = '<span id="time_gone" style="background-color: yellow; color: black;">'.$TIME_GONE.'%</span>';
	
}else{
	
	$TIME_GONE = '<span id="time_gone" style="background-color: red; color: blue;">'.$TIME_GONE.'%</span>';
	
}

if($REALX <= 20){
	
	$REALX = '<span id="realx" style="background-color: red; color: blue;">'.$REALX.'%</span>';
	
}else if($REALX > 20 && $REALX <= 70){
	
	$REALX = '<span id="realx" style="background-color: yellow; color: black;">'.$REALX.'%</span>';
	
}else{
	
	$REALX = '<span id="realx" style="background-color: green; color: white;">'.$REALX.'%</span>';
	
}

$KJ_BLI = '<span id="total_kj" style="">'. $KJ_BLI .'</span>';
$NILAI = '<span id="terkirim" style="">'. $NILAI .'</span>';

$to      = $receiver;
$title   = "Progress KJ";
$message = '<div data-role="header"><h5>Progress KJ</h5></div>'.
			'<div class="col uib_col_2 single-col" data-uib="layout/col" data-ver="0">'.
			  '<div id="rev" class="widget-container content-area vertical-col" style="padding-left:15px;padding-right:15px;padding-bottom:15px;">'.
				'<p>'. $NAMA .'<p>'.
				'<p>Total KJ:&nbsp;'. $KJ_BLI .'<p>'.
				'<p>Total Kirim:&nbsp;'. $NILAI .'</p>'.
				'<p>Time Gone:&nbsp;'. $TIME_GONE .'</p>'.
				'<p>Real:&nbsp;'. $REALX .'</p>'.
				'<a class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b ui-btn-icon-left ui-icon-delete" data-rel="back" '.
				'style="background: #d80b0b; color: white;border: none;">Close</a>'.
			  '</div>'.
			'</div>';

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
