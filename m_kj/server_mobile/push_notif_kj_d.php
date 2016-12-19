<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
require_once("koneksi.php");

$ida = $_REQUEST['ACCOUNT_ID'];

$sql = "SELECT uu.ID_APKEY, CURDATE() AS tgl FROM distributor_kokola.user uu WHERE uu.ACCOUNT_ID = '".$ida."'"; //44721//A87051

$result = mysql_query($sql) or die("Note: " . mysql_error());

$receiver = "";
$tgl = "";

while($row = mysql_fetch_array($result)){
	
	$receiver = $row['ID_APKEY'];
	$tgl = $row['tgl'];
    
}

//exit("1");
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/

if($receiver == null || $receiver == ""){
	//$receiver = 'cBFEEOzACRI:APA91bHyjM1jLQQf3VpakRRtTgNQwpXOFKMtOcA0M7hvQXpfc6LxyIfRoVVF5GpRqEFiY6RGg5PWdxVylbu0c58tJY8_dVw1UbjCyGSTKNMG2mt3MQQ2Dv7GrRd80617rSYR27rT3mSF';
	exit(1);
}

$to      = $receiver;
$title   = "KJ Approval";
$message = "Mohon KJ segera diapprove.";

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
    //echo $result;
	
	$decod = json_decode($result, true);
	echo $decod['success'];
}
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/
?>
