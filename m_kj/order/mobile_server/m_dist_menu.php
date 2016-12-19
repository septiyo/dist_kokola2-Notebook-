<?php
error_reporting(0);
require_once("../koneksi.php");

if(isset($_REQUEST['USER'])){
$usr = $_REQUEST['USER'];

/*
$sql = "SELECT ID_ORDER,TGL,STATUS_APR FROM order_distributor "
        . "WHERE DATE_FORMAT(TGL,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d') "
        . "AND USERID='".$usr."' ORDER BY STATUS_APR ASC";
 * 
 */

$sql="SELECT ID_ORDER,TGL,STATUS_APR FROM order_distributor 
WHERE DATE_FORMAT(TGL,'%Y-%m-%d')<=DATE_FORMAT(NOW(),'%Y-%m-%d') 
AND DATE_FORMAT(DATE_SUB(NOW(),INTERVAL 7 DAY),'%Y-%m-%d')<=DATE_FORMAT(TGL,'%Y-%m-%d') 
AND USERID='".$usr."' ORDER BY STATUS_APR ASC, TGL DESC";
$result = mysql_query($sql) or die("Note: " . mysql_error());

$data = array();
$brs=0;
while ($row = mysql_fetch_array($result)) {
    $data[$brs][0]=$row['ID_ORDER'];
    $data[$brs][1]=$row['TGL'];
    $data[$brs][2]=$row['STATUS_APR'];
    $brs++;
}

$kirim = array('data' => $data);
        header('Content-type: application/json');
        echo json_encode($kirim); 
}

if(isset($_GET['id'])){
$usr2 = $_GET['id'];

/*
$sql2 = "SELECT COUNT(USERID) AS jml FROM order_distributor "
        . "WHERE DATE_FORMAT(TGL,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d') "
        . "AND USERID='".$usr2."' AND STATUS_APR='0'";
*/

$sql2="SELECT COUNT(USERID) AS jml FROM order_distributor 
WHERE DATE_FORMAT(TGL,'%Y-%m-%d')<=DATE_FORMAT(NOW(),'%Y-%m-%d') 
AND DATE_FORMAT(DATE_SUB(NOW(),INTERVAL 7 DAY),'%Y-%m-%d')<=DATE_FORMAT(TGL,'%Y-%m-%d') 
AND USERID='".$usr2."' AND STATUS_APR='0'";

$result2 = mysql_query($sql2) or die("Note: " . mysql_error());

$jml="";
while ($row2 = mysql_fetch_array($result2)) {
    
    $jml=$row2['jml'];
}

$kirim = array('jumlah' => $jml);
        header('Content-type: application/json');
        echo json_encode($kirim); 
}

?>

