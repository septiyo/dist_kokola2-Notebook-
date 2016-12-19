<?php

require_once("koneksi.php");

$ida = $_REQUEST['ACCOUNT_ID'];

$sql = "SELECT aa.*, bb.* FROM
		(SELECT *, SUM(qty) AS total_order, COUNT(*) AS jenis_item 
			FROM order_kirim_wd okw 
			WHERE okw.periode2 = (CURDATE() + INTERVAL 1 DAY) AND okw.ACCOUNT_ID = '".$ida."')aa,
		(SELECT uu.NAMA, uu.ID_APKEY 
			FROM distributor_kokola.user uu 
			WHERE uu.ACCOUNT_ID = '".$ida."') bb;"; //44721//A87051

$result = mysql_query($sql) or die("Note: " . mysql_error());

$ACCOUNT_ID = "";
$periode1 = "";
$periode2 = ""; 
$tgl_upload = "";
$total_order = "";
$jenis_item = "";
$NAMA = "";
$receiver = "";

while($row = mysql_fetch_array($result)){
	
	$ACCOUNT_ID = $row['ACCOUNT_ID'];
	$periode1 = $row['periode1'];
	$periode2 = $row['periode2']; 
	$tgl_upload = $row['tgl_upload'];
	$total_order = $row['total_order'];
	$jenis_item = $row['jenis_item'];
	$NAMA = $row['NAMA'];
	$receiver = $row['ID_APKEY'];
    
}

$to      = $receiver;
$title   = "Jadwal Order";
$message = "". $NAMA ."";
$message .= "\nTanggal: ". date_format(date_create($periode2),"d-m-Y") ."\nTotal Order: ". $total_order."";

/* sendPush($to, $title, $message);
function sendPush($to, $title, $message){ */
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
//}
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/
?>
