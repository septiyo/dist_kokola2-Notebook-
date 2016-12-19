<?php
include "../koneksi.php";

if(isset($_GET['id'])){
$id=$_GET['id'];

$tri_sekrang="";    
$lanku=date('m');     
if($lanku == "01")
{  $tri_sekrang = 'Jan-Feb-Mar'; }
elseif ($lanku == "02")
{  $tri_sekrang = 'Jan-Feb-Mar'; }
elseif ($lanku == "03")
{  $tri_sekrang = 'Jan-Feb-Mar'; }
elseif ($lanku == "04")
{  $tri_sekrang = 'Apr-May-Jun'; }
elseif ($lanku == "05")
{  $tri_sekrang = 'Apr-May-Jun'; }
elseif ($lanku == "06")
{  $tri_sekrang = 'Apr-May-Jun'; }
elseif ($lanku == "07")
{  $tri_sekrang = 'Jul-Aug-Sep'; }
elseif ($lanku == "08")
{  $tri_sekrang = 'Jul-Aug-Sep'; }
elseif ($lanku == "09")
{  $tri_sekrang = 'Jul-Aug-Sep'; }
elseif ($lanku == "10")
{  $tri_sekrang = 'Oct-Nov-Dec'; }
elseif ($lanku == "11")
{  $tri_sekrang = 'Oct-Nov-Dec'; }
elseif ($lanku == "12")
{  $tri_sekrang = 'Oct-Nov-Dec'; }

if($_GET['op']='lihat'){
$sql = "SELECT TGL,TRIWULAN, COUNT(TRIWULAN) as JUMLAH,STATUS_APR FROM kj WHERE NAMA_DIST = '".$id."' AND STR_TO_DATE(TGL, '%Y')=STR_TO_DATE(NOW(), '%Y') and publish='1' GROUP BY TRIWULAN ORDER BY ID DESC";
$hasil = mysqli_query($mysqli, $sql);

$data=array();
$brs=0;
foreach($hasil as $row){
    $data[$brs][0]=$row['TGL'];
    $data[$brs][1]=$row['TRIWULAN'];
    $data[$brs][2]=$row['JUMLAH'];
    $data[$brs][3]=$row['STATUS_APR'];
    
    $brs++;
}


$kirim = array('data' => $data,
               'tri_now'=>$tri_sekrang);
        header('Content-type: application/json');
        echo json_encode($kirim);

//echo $is
}
}
?>



