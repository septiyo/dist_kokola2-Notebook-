<?php

require_once("koneksi.php");

$usr = isset($_REQUEST['USER']) ? $_REQUEST['USER'] : '';


$sql = "SELECT t1.*,t2.JADWAL
	FROM (SELECT kiri.ACCOUNT_ID, kiri.ACCOUNT_NAME,kanan.STATUS_APR,kanan.Tanggal,kanan.ID_ORDER
	FROM push_distributor AS kiri
	LEFT JOIN (
	SELECT a.ACCOUNT_ID, a.ID_ORDER, a.TGL AS Tanggal, a.STATUS_APR 
	FROM order_distributor a, push_distributor b 
	WHERE a.ACCOUNT_ID=b.ACCOUNT_ID AND b.SALES_ID = '".$usr."' 
	AND DATE_FORMAT(a.TGL,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d')
	) AS kanan
	ON kiri.ACCOUNT_ID=kanan.ACCOUNT_ID WHERE kiri.SALES_ID='".$usr."') AS t1
LEFT JOIN 
		(SELECT kr.ACCOUNT_ID, '1' AS JADWAL
		FROM order_kirim_wd kr
		WHERE kr.periode2=DATE_FORMAT(NOW(),'%Y-%m-%d') GROUP BY kr.ACCOUNT_ID) AS t2
ON t1.ACCOUNT_ID=t2.ACCOUNT_ID ORDER BY t2.jadwal DESC, t1.STATUS_APR ASC";


$result = mysqli_query($mysqli,$sql) or die("Note: " . mysql_error());

$data = array();
while ($row = mysqli_fetch_array($result)) {
    
    $status_no=$row['STATUS_APR'];
    $status_jadwal=$row['JADWAL'];
    $tgl_order=$row['Tanggal'];
    
    if($status_no==null || $status_no=='null'){
        $status_no="2";
    }else{
        $status_no=$row['STATUS_APR'];
    }
    
    if($status_jadwal==null || $status_jadwal=='null'){
        $status_jadwal="2";
    }else{
        $status_jadwal=$row['JADWAL'];
    }
    
     if($tgl_order==null || $tgl_order=='null'){
        $tgl_order="";
    }else{
        $tgl_order="Tanggal Order: ".$row['Tanggal'];
    }
    
    $data[] = array(
        'ACCOUNT_ID' => $row[0],
        'ACCOUNT_NAME' => $row['ACCOUNT_NAME'],
        'STATUS_APR' => $status_no,
        'TGL' => $tgl_order,
        'JADWAL' => $status_jadwal,
        'ID_ORDER'=>$row['ID_ORDER']    
    );
}

$json = json_encode($data);
echo $json;
?>

