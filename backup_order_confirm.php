<?php
include "koneksi.php";

// date_default_timezone_set("Asia/Jakarta");

$today_database = date('Y')."-".date('m')."-".date('d');
$time = date('H:i:s');

$sql = "SELECT * FROM order_confirm WHERE DATE(TGL_CONFIRM) = '$today_database';";
$hasil = mysqli_query($mysqli, $sql);

//$no=1;
while($data = mysqli_fetch_assoc($hasil)){


   $mysqli2 = mysqli_connect("10.1.13.54","septiyo","uchsun","distributor_kokola_backup", 2272) or die('gagalx');
    //$mysqli2 = mysqli_connect("localhost","root","","distributor_kokola_backup") or die('gagalx');

    $sql_backup = "INSERT INTO order_confirm SET Id = '$data[Id]',
                                                 ID_ORDER = '$data[ID_ORDER]',
                                                 ID_CONFIRM = '$data[ID_CONFIRM]',
                                                 TGL_ORDER = '$data[TGL_ORDER]',
                                                 TGL_CONFIRM = '$data[TGL_CONFIRM]',
                                                 ACCOUNT_ID = '$data[ACCOUNT_ID]',
                                                 ITEM_CODE = '$data[ITEM_CODE]',
                                                 JML_ORDER = '$data[JML_ORDER]',
                                                 KUBIKASI = '$data[ID_CONFIRM]',
                                                 FLAG = '$data[FLAG]',
                                                 FLAG2 = '$data[FLAG2]',
                                                 CATATAN2 = '$data[CATATAN2]',
                                                 SBG = '$data[ID_CONFIRM]',
                                                 TGL_BACKUP = '$today_database $time'";

    $hasil_backup = mysqli_query($mysqli2, $sql_backup);

    //echo $no." ".$data[ID_ORDER]."<br>";



}


//$sql = "SELECT * FROM order_distributor WHERE DATE(TGL) = '$today_database';";
//$hasil = mysqli_query($mysqli, $sql);
//
////$no=1;
//while($data = mysqli_fetch_assoc($hasil)){
//
//
//    $mysqli2 = mysqli_connect("10.1.13.54","septiyo","uchsun","distributor_kokola_backup", 2272) or die('gagalx');
//    //$mysqli2 = mysqli_connect("localhost","root","","distributor_kokola_backup") or die('gagalx');
//
//    $sql_backup = "INSERT INTO order_confirm SET Id = '$data[Id]',
//                                                 ID_ORDER = '$data[ID_ORDER]',
//                                                 ID_CONFIRM = '$data[ID_CONFIRM]',
//                                                 TGL_ORDER = '$data[TGL_ORDER]',
//                                                 ACCOUNT_ID = '$data[ACCOUNT_ID]',
//                                                 ITEM_CODE = '$data[ITEM_CODE]',
//                                                 JML_ORDER = '$data[JML_ORDER]',
//                                                 KUBIKASI = '$data[ID_CONFIRM]',
//                                                 TGL_CONFIRM = '$data[TGL_CONFIRM]',
//                                                 FLAG = '$data[FLAG]',
//                                                 FLAG2 = '$data[FLAG2]',
//                                                 CATATAN2 = '$data[CATATAN2]',
//                                                 SBG = '$data[ID_CONFIRM]'";
//    $hasil_backup = mysqli_query($mysqli2, $sql_backup);
//
//    //echo $no." ".$data[ID_ORDER]."<br>";
//
//
//
//}



?>