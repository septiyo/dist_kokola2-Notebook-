<?php

require_once("koneksi.php");
define('API_ACCESS_KEY', 'AIzaSyBuyhI8NMzOAKBr-rliVwgQrZFXyk1diNI');

$acc = $_REQUEST['ACCOUNT_ID'];
$sql = "SELECT uu.id_apkey FROM distributor_kokola.user uu
			WHERE uu.ACCOUNT_ID = '".$acc."';";
			
$res = mysql_query($sql);
$aa = mysql_fetch_array($res);

$to      = $aa['id_apkey'];
$title   = "Judul Notifikasi";
$message = "Pesan Notifikasi";

sendPush($to, $title, $message);

function sendPush($to, $title, $message){
    $registrationIds = array(
        $to
    );
    $msg = array(
        'message' => $message,
        'title' => $title,
        'vibrate' => 1,
        'soundname' => "default",
        'notId' => time()
		
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

?>