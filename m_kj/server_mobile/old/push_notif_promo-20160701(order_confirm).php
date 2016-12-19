<?php
require_once("koneksi.php");

$ida = $_REQUEST['ACCOUNT_ID'];
//$icd = $_REQUEST['ITEM_CODE'];

/*Cron job*/
$sqsel = "SELECT oc.ITEM_CODE, COUNT(1) AS 'jumlah_order', mp.nama_produk, tp.URL FROM order_confirm oc
		INNER JOIN m_produk mp ON oc.ITEM_CODE = mp.ITEM_CODE
		INNER JOIN tb_produk tp ON oc.ITEM_CODE = tp.ITEM_CODE
		WHERE oc.ACCOUNT_ID = '". $ida ."' GROUP BY oc.ITEM_CODE ORDER BY 2, oc.ITEM_CODE ASC LIMIT 3";
$res = mysql_query($sqsel) or die("Note: " . mysql_error());

$icd_kirim = "";
$icd = array();
while($row = mysql_fetch_array($res)){
	
	array_push($icd, $row['ITEM_CODE']);
	
}

$dtime = time();
//echo $time;exit(1);
$jam_1 = "07:00:00";
$jam_2 = "11:00:00";
$jam_3 = "14:00:00";
//echo strtotime($jam_3);exit(1);
if($dtime >= strtotime($jam_1) && $dtime < strtotime($jam_2)){
	$icd_kirim = $icd[0];
}else if($dtime >= strtotime($jam_2) && $dtime < strtotime($jam_3)){
	$icd_kirim = $icd[1];
}else{
	$icd_kirim = $icd[2];
}
//echo $icd_kirim;exit(1);
//echo count($icd);print_r($icd);exit(1);
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/

$sql = "SELECT aa.*, bb.* FROM (SELECT ID_APKEY FROM distributor_kokola.user WHERE ACCOUNT_ID = '". $ida ."') aa, 
		(SELECT tp.nama_produk, tp.item_code, tp.url FROM tb_produk tp WHERE item_code = '". $icd_kirim ."') bb";
		
$result = mysql_query($sql) or die("Note: " . mysql_error());

$receiver = "";
$nama_produk = "";
$url = "";

while ($row = mysql_fetch_array($result)) {
    
    $receiver = $row['ID_APKEY'];
	$nama_produk = $row['nama_produk'];
	//119.252.168.10:388/m_kj
	$u = $row['url'];
	if($u == null || $u == ""){
		$url = "http://119.252.168.10:388/m_kj/server_mobile/images/default.png";	
	}else{
		$url = $u;
	}
    
}

$url = str_replace(' ', '%20', $url);

//exit(1);
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/

if($receiver == null || $receiver == ""){
	//$receiver = "cBFEEOzACRI:APA91bHyjM1jLQQf3VpakRRtTgNQwpXOFKMtOcA0M7hvQXpfc6LxyIfRoVVF5GpRqEFiY6RGg5PWdxVylbu0c58tJY8_dVw1UbjCyGSTKNMG2mt3MQQ2Dv7GrRd80617rSYR27rT3mSF";
	$receiver = '';
	exit(1);
}

$to      = $receiver;
$title   = "Segera order produk";
$message = "". $nama_produk ."";

sendPush($to, $title, $message);

function sendPush($to, $title, $message){
	
	global $url;
	global $nama_produk;
	
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
        'soundname' => 'default',
        'notId' => time(),
		'style' => 'picture',
        'picture' => $url,
        'summaryText' => $nama_produk,
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
