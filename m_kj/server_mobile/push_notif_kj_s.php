<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
require_once("koneksi.php");

$ida = $_REQUEST['ACCOUNT_ID'];
$ids = "";

$sq = "SELECT pd.SALES_ID FROM push_distributor pd WHERE ACCOUNT_ID = '".$ida."'";
$re = mysql_query($sq) or die("Note: " . mysql_error());
while($ro = mysql_fetch_array($re)){
	
	$ids = $ro['SALES_ID'];
    
}

$sql = "SELECT aa.*, bb.* FROM
		(SELECT uu.nama, CURDATE() AS tgl_confirm FROM distributor_kokola.user uu WHERE uu.ACCOUNT_ID = '".$ida."')aa,
		(SELECT uu.ID_APKEY FROM distributor_kokola.user uu WHERE uu.ACCOUNT_ID = '".$ids."')bb"; //44721//A87051

$result = mysql_query($sql) or die("Note: " . mysql_error());

$receiver = "";
$tgl = "";
$nama = "";

while($row = mysql_fetch_array($result)){
	
	$receiver = $row['ID_APKEY'];
	$tgl = $row['tgl_confirm'];
	$nama = $row['nama'];
    
}

//exit("1");
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/

if($receiver == null || $receiver == ""){
	//$receiver = 'cBFEEOzACRI:APA91bHyjM1jLQQf3VpakRRtTgNQwpXOFKMtOcA0M7hvQXpfc6LxyIfRoVVF5GpRqEFiY6RGg5PWdxVylbu0c58tJY8_dVw1UbjCyGSTKNMG2mt3MQQ2Dv7GrRd80617rSYR27rT3mSF';
	exit(1);
}

$to      = $receiver;
$title   = "KJ Approval";
$message = "".$nama." telah menyetujui KJ Anda.";



/*--------------------------------------------------------------------------------------------------------------------------------------------------*/
$resultadmin = mysql_query("SELECT uu.USER, uu.id_apkey FROM distributor_kokola.user uu WHERE uu.HAK = 'ADMIN'") or die("Note: " . mysql_error());
$cc = array();

while($bar = mysql_fetch_array($resultadmin)){
	
	if($bar['id_apkey'] == null || $bar['id_apkey'] == ""){
		
	}else{
		array_push($cc, $bar['USER']);
	}
	
}

for ($i = 0; $i < count($cc); $i++) {
	
    $url = 'http://10.1.13.54/m_kj/server_mobile/push_notif_kj_sp.php';
	$data = array('ACCOUNT_ID' => $cc[$i], 'DIST' => $nama);
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);

	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	
}
/*--------------------------------------------------------------------------------------------------------------------------------------------------*/

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
