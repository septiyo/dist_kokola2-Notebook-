<?php

//Notif 3x -> 2x
/* $dtime = time();
//echo $dtime;exit(1);
$jam_1 = "07:00:00";
$jam_2 = "11:00:00";
$jam_3 = "14:00:00";
//echo strtotime($jam_3);exit(1);
if($dtime >= strtotime($jam_1) && $dtime < strtotime($jam_2)){
	//$icd_kirim = $icd[0];
	echo("1");
}else if($dtime >= strtotime($jam_2) && $dtime < strtotime($jam_3)){
	//$icd_kirim = $icd[1];
	//exit();
	echo("2");
}else{
	//$icd_kirim = $icd[2];
	//$icd_kirim = $icd[1];
	echo("3");
} */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* $dtime = time();
echo date('H:i:s');
//echo $dtime;exit(1);
$jam_1 = "06:45:00";
$jam_2 = "07:15:00";
$jam_3 = "13:45:00";
$jam_4 = "14:15:00";
//echo strtotime($jam_3);exit(1);
if(($dtime >= strtotime($jam_1) && $dtime <= strtotime($jam_2)) || ($dtime >= strtotime($jam_3) && $dtime <= strtotime($jam_4))){
	echo 'true';
}else{
	echo 'false';
	exit("aas");
}
echo 'cc'; */

echo $ss = date('N', time());
echo gettype($ss);
/* 
if("php" == 0){
	echo 'true';
}
if("1php" == 0) {
	echo 'false';
}
 */
/* exec('php -f show_achiev_all.php sales0053', $out, $rv);
var_dump($out); */
/* error_reporting(E_ALL);
ini_set('display_errors', 1);

$url = 'http://10.1.13.54/m_kj/server_mobile/show_achiev_all.php';
$data = array('ACCOUNT_ID' => 'sales0053');
$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data)
	)
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
echo $result; */
?>