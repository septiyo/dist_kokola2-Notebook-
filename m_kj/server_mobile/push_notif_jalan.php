<?php
require_once("koneksi.php");

$ida = $_REQUEST['ACCOUNT_ID'];
$sen = $_REQUEST['SN_NUMBER'];
$tglk = $_REQUEST['TGL_KIRIM'];

$sql = "SELECT psj.*, mp.nama_produk, uu.id_apkey, uu.nama FROM push_surat_jalan psj INNER JOIN m_produk mp ON psj.item_code = mp.item_code 
		INNER JOIN distributor_kokola.user uu ON uu.account_id = psj.accountid WHERE psj.accountid = '". $ida ."' 
		AND psj.sn_number = '". $sen ."'
		AND psj.tgl_kirim = '". $tglk ."'";
$result = mysql_query($sql) or die("Note: " . mysql_error());

$sn = "";
$tgl_kirim = "";
$so_n = "";
$item_code = array();
$nm_produk = array();
$jml_produk = array();
$total_kirim = 0;
$receiver = "";
$nm_receiver = "";

while ($row = mysql_fetch_array($result)) {
    
	$sn = $row['SN_NUMBER'];
    $tgl_kirim = $row['TGL_KIRIM'];
	$so_n = $row['SO_NUMBER'];
	$item_code = $row['ITEM_CODE'];
    array_push($nm_produk, $row['nama_produk']);
    array_push($jml_produk, $row['QTY']);
    $total_kirim += $row['QTY'];
    $receiver = $row['id_apkey'];
	$nm_receiver = $row['nama'];
    
}

//exit("1");
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/

if($receiver == null || $receiver == ""){
	//$receiver = "cBFEEOzACRI:APA91bHyjM1jLQQf3VpakRRtTgNQwpXOFKMtOcA0M7hvQXpfc6LxyIfRoVVF5GpRqEFiY6RGg5PWdxVylbu0c58tJY8_dVw1UbjCyGSTKNMG2mt3MQQ2Dv7GrRd80617rSYR27rT3mSF";
	$receiver = '';
	exit(1);
}

$to      = $receiver;
$title   = "Pengiriman Barang";
$message = "Kepada: ".$nm_receiver."\nTgl. dikirim: " . date_format(date_create($tgl_kirim),"d-m-Y");

/* $s = count($item_code);
for ($i = 0; $i < $s; $i++) {
    $message .= "\n-" . $nm_produk[$i] . " (" . $jml_produk[$i] . ")";
} */
$message .= "\nSN-Number: ". $sn ."\nTotal Kirim: ".$total_kirim;

sendPush($to, $title, $message);

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

$sql_up = "UPDATE push_surat_jalan psj SET psj.STATUS_NOTIF = '1' WHERE psj.sn_number = '". $sen ."' AND psj.tgl_kirim = '". $tglk ."' 
			AND psj.accountid = '". $ida ."'";
$resup = mysql_query($sql_up) or die("Note: " . mysql_error());

/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/
?>
