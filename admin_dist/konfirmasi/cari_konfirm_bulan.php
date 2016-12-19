<?php
include "../../koneksi.php";
ini_set('display_errors', '0');
//date_default_timezone_set("Asia/Jakarta");

$today = date('d') . "-" . date('m') . "-" . date('Y');
$today_database = date('Y') . "-" . date('m') . "-" . date('d');
$time = date('H:i:s');
//$mon = date('m');


$bulanx = $_POST['bulanx'];
$sql = "SELECT  order_confirm.Id,
	         order_confirm.TGL_ORDER,
	         order_confirm.TGL_CONFIRM,
			 DATE(order_confirm.TGL_CONFIRM)AS TGL_D,
	        order_confirm.ACCOUNT_ID,
			order_confirm.ID_ORDER,
	        `user`.NAMA,
	        `user`.KOTA,
	        order_confirm.SBG,
	       SUM(order_confirm.JML_ORDER)AS jml_confirm,
	       order_confirm.CATATAN2 
	       FROM order_confirm
                INNER JOIN `user` ON `user`.ACCOUNT_ID = order_confirm.ACCOUNT_ID
              
                AND MONTH(order_confirm.TGL_CONFIRM) = '$bulanx'	       
	        GROUP BY order_confirm.ACCOUNT_ID,order_confirm.CATATAN2 ORDER BY order_confirm.Id DESC LIMIT 1000;";			



$hasil = mysqli_query($mysqli, $sql);
$jumlah_total = 0;
$jumlah_total2 = 0;


$results = array();

foreach($hasil as $row){

    $results[] = array(
        'TGL_CONFIRM'=> $row[TGL_CONFIRM],
        'NAMA' => $row[NAMA],
        'KOTA' => $row[KOTA],
        'SBG' => $row[SBG],
        'CATATAN2' => $row[CATATAN2],
        'ID_ORDER' => $row[ID_ORDER],
        'ACC_ID' => $row[ACCOUNT_ID],
        'TGL_ORDER' => $row[TGL_ORDER],
        'total' => $row[total],
        'USERID' => $row[USERID],
        'FLAG' => $row[FLAG],
        'jml_confirm' => $row[jml_confirm],
        'ID_ORDER' => $row[ID_ORDER],
		'TGL_D'=> $row[TGL_D],



    );
}

$json = json_encode($results);

echo $json;


//echo json_encode($bulanx);


?>