<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
include "../../koneksi.php";

$idorder = $_GET['ID_ORDER'];

echo $idorder;

$sql_1 = "DELETE FROM `order_confirm` WHERE ID_ORDER = '$idorder';";

$hasil  = mysqli_query($mysqli, $sql_1);

$sql_2 = "UPDATE `order_distributor` SET FLAG = '1' WHERE ID_ORDER = '$idorder'";

$hasil2 = mysqli_query($mysqli, $sql_2);

$sql_3 = "UPDATE `order_detail` SET FLAG = '1' WHERE ID_ORDER = '$idorder';";

$hasil3 = mysqli_query($mysqli, $sql_3);

if($hasil && $hasil2 && $hasil3){

  echo "<script>alert('Pengembalian Konfirmasi Berhasil');
                  window.location='konfirmasi_return.php';
       </script>";	
	
}
else{

    echo "<script>alert('Pengembalian Konfirmasi Gagal');
	                  window.location='konfirmasi_return.php';
	     </script>";		
	
}


?>

</body>
</html>