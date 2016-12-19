<?php
include "koneksi.php";
date_default_timezone_set("Asia/Jakarta");
	   		    $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				$bulanku = date('m');
				$wkt = date('H:i:s'); 

$q = $_POST['q'];
$qty = $_POST['qty'];
$accid = $_POST['accid'];
$aksi = $_POST['aksi'];
if($_SERVER['REQUEST_METHOD'] == 'POST')  {
switch($aksi){
case "edit":$sql="UPDATE order_kirim_wd set qty  = '$qty',
                                        periode2 = '$yearku-$bulanku-$accid',
                                       tgl_upload = '$tgl $wkt'                                                           
                                       WHERE   id = '$q'";break;
case "delete":$sql="DELETE FROM order_kirim_wd WHERE id = '$q'";break;
}
}
$kueri = mysqli_query($mysqli, $sql);
if($kueri)
{
echo "Berhasil";
}
else
{
echo "Gagal";
}


?>