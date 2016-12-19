<?php

require_once("koneksi.php");
//require_once("koneksi_ol.php");

$ida = $_REQUEST['ACCOUNT_ID'];
$icd = $_REQUEST['ITEM_CODE'];

/*Cron job*/


$sql = "SELECT ID_APKEY FROM user WHERE ACCOUNT_ID = '". $ida ."'"; //44721//A87051
$sql2 = "SELECT tp.nama_produk, tp.item_code, tp.url FROM tb_produk tp WHERE item_code = '". $icd ."'";

$result = mysql_query($sql) or die("Note: " . mysql_error());
$result2 = mysql_query($sql2) or die("Note: " . mysql_error());

$receiver      = "";
$nama_produk = "";
$url = "";

while ($row = mysql_fetch_array($result)) {
    
    $receiver = $row['ID_APKEY'];
    
}

while ($row2 = mysql_fetch_array($result2)) {
    
    $nama_produk = $row2['nama_produk'];
	$url = $row2['url'];
    
}

//exit("1");

/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/

if($receiver == null || $receiver == ""){
	//$receiver = "fec3Wc-64cY:APA91bFXC_wBZc95-kJqqk9jDe9vI1P-u7jE_8grgdaUlx_TmEVJh_Xs-tsafSJo82iM2WxMOFbzqdYEwxGc6s-GbccGPrqNDLIWw1G201AHPje7FbQrnL03QILbxCJLIqKrG2_VCZ2z";
	$receiver = '';
}

$to      = $receiver;
$title   = "Segera order produk";
$message = '<div data-role="header"><h5>Segera order produk</h5></div>'.
			'<div class="col uib_col_2 single-col" data-uib="layout/col" data-ver="0">'.
			  '<div id="rev" class="widget-container content-area vertical-col" style="padding-left:15px;padding-right:15px;padding-bottom:15px;">'.
				'<p>'. $nama_produk .'</p>'.
				'<img src="'. $url .'" style="width:100%;height:auto;max-width:512px" />'.
				'<a class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b ui-btn-icon-left ui-icon-delete" data-rel="back" '.
				'style="background: #d80b0b; color: white;border: none;">Close</a>'.
			  '</div>'.
			'</div>';

sendPush($to, $title, $message);

$n = time();

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
