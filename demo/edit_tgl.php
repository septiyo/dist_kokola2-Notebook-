<?php
include "koneksi.php";
//date_default_timezone_set("Asia/Jakarta");
	   		    $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				$bulanku = date('m');
				$wkt = date('H:i:s'); 

$q = $_POST['q'];
$qty = $_POST['qty'];
$accid = $_POST['accid'];
$aksi = $_POST['aksi'];


$id_all = explode(",", $qty);
$jumlah_id = count($id_all);

if($_SERVER['REQUEST_METHOD'] == 'POST')  {
	
switch($aksi){
case "edit": 

 
  for($i=0;$i<$jumlah_id;$i++) {
$sql="UPDATE order_kirim_wd set
                                        periode2 = '$yearku-$bulanku-$q',
                                       tgl_upload = '$tgl $wkt'                                                           
                                       WHERE   id = '$id_all[$i]'";
			
			$kueri = mysqli_query($mysqli, $sql);						 
		}
		 break;
case "delete":
for($i=0;$i<$jumlah_id;$i++) {
$sql="DELETE FROM order_kirim_wd WHERE id = '$id_all[$i]'";
$kueri = mysqli_query($mysqli, $sql);
}
break;
}
}

if($kueri)
{
echo "Berhasil";
}
else
{
echo "Gagal";
}

//echo $jumlah_id;

?>