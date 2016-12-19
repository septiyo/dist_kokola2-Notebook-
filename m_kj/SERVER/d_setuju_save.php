<?php
include "../koneksi.php";

if(isset($_POST['id'])){
$id=$_POST['id'];

$tri_post=$_POST['tri'];

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


//$sql = "UPDATE kj SET STATUS_APR='1' WHERE TRIWULAN = '".$tri_sekrang."' AND NAMA_DIST= '".$id."' AND STR_TO_DATE(TGL, '%Y')=STR_TO_DATE(NOW(), '%Y')";
$sql = "UPDATE kj SET STATUS_APR='1' WHERE TRIWULAN = '".$tri_post."' AND NAMA_DIST= '".$id."' AND STR_TO_DATE(TGL, '%Y')=STR_TO_DATE(NOW(), '%Y')";
$hasil = mysqli_query($mysqli, $sql);

if($hasil){
$data="sukses";
}else{
$data="gagal";	
}


$kirim = array('data' => $data);
        header('Content-type: application/json');
        echo json_encode($kirim);

//echo $is
}
?>



