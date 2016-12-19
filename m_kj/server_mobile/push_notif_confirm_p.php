<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
require_once("koneksi.php");
// API access key from Google API's Console
// replace API
define('API_ACCESS_KEY', 'AIzaSyBuyhI8NMzOAKBr-rliVwgQrZFXyk1diNI');

$ida = $_REQUEST['ACCOUNT_ID'];
$ids = "";

$sq = "SELECT pd.SALES_ID FROM push_distributor pd WHERE ACCOUNT_ID = '".$ida."'";
$re = mysql_query($sq) or die("Note: " . mysql_error());
while($ro = mysql_fetch_array($re)){
	
	$ids = $ro['SALES_ID'];
    
}

$sql = "SELECT  CURDATE() AS tgl, uu.nama AS nama_dis, uu.ID_APKEY AS key_dis FROM distributor_kokola.user uu WHERE uu.ACCOUNT_ID = '".$ida."'";
$result = mysql_query($sql) or die("Note: " . mysql_error());

$receiver_dis = "";
$nama_dis = "";
$tgl = "";

while($row = mysql_fetch_array($result)){
	
	$receiver_dis = $row['key_dis'];
	$nama_dis = $row['nama_dis'];
	$tgl = $row['tgl'];
    
}

$sql3 = "SELECT uu.nama AS nama_sal, uu.ID_APKEY AS key_sal FROM distributor_kokola.user uu WHERE uu.ACCOUNT_ID = '".$ids."'";
$result3 = mysql_query($sql3) or die("Note: " . mysql_error());

$receiver_sal = "";
$nama_sal = "";

while($row3 = mysql_fetch_array($result3)){
	
	$receiver_sal = $row3['key_sal'];
	$nama_sal = $row3['nama_sal'];
    
}

//exit("1");
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/

if($receiver_dis == null && $receiver_sal == null){
	//$receiver = 'cBFEEOzACRI:APA91bHyjM1jLQQf3VpakRRtTgNQwpXOFKMtOcA0M7hvQXpfc6LxyIfRoVVF5GpRqEFiY6RGg5PWdxVylbu0c58tJY8_dVw1UbjCyGSTKNMG2mt3MQQ2Dv7GrRd80617rSYR27rT3mSF';
	exit(1);
}

$to      = $receiver_dis;
$title   = "Order Pusat";
$message = "Tanggal: ".date_format(date_create($tgl),"d-m-Y")."\nTelah diorderkan oleh pusat.";

$to2      = $receiver_sal;
$title2   = "Order Pusat";
$message2 = "Tanggal: ".date_format(date_create($tgl),"d-m-Y")."\n".$nama_dis." telah diorderkan oleh pusat.";

sendPush($to, $title, $message);
sendPush($to2, $title2, $message2);

function sendPush($to, $title, $message){
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
