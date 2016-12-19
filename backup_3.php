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

//backup tabel order distributor



$sql_dist = "SELECT * FROM order_distributor WHERE DATE(TGL) = '$today_database';";
$hasil_dist = mysqli_query($mysqli, $sql_dist);

//$no=1;
while($data_dist = mysqli_fetch_assoc($hasil_dist)){


    $mysqli2 = mysqli_connect("10.1.13.54","septiyo","uchsun","distributor_kokola_backup", 2272) or die('gagalx');
    //$mysqli2 = mysqli_connect("localhost","root","","distributor_kokola_backup") or die('gagalx');

    $sql_dist2 = "INSERT INTO `order_distributor`
                         SET `TGL` = '$data_dist[TGL]',
                            `USERID` = '$data_dist[USERID]',
                            `CATATAN` = '$data_dist[CATATAN]' ,
                            `ACCOUNT_ID` = '$data_dist[ACCOUNT_ID]',
                              `FLAG` = '$data_dist[FLAG]',
                              `CATATAN2` = '$data_dist[CATATAN2]',
                               `SBG` = '$data_dist[SBG]',
                              `TGL_JADWAL_KIRIM` = '$data_dist[TGL_JADWAL_KIRIM]',
                                `STATUS_APR` = '$data_dist[TGL_JADWAL_KIRIM]',
                                  `TGL_BACKUP` = '$today_database $time'";


    $hasil_dist2 = mysqli_query($mysqli2, $sql_dist2);

    //echo $no." ".$data[ID_ORDER]."<br>";



}

//backup tabel order detail

$sql_detail = "SELECT * FROM `order_detail` WHERE DATE(DATE_INSERT) = '$today_database';";
$hasil_detail = mysqli_query($mysqli, $sql_detail);

//$no=1;
while($data_detail = mysqli_fetch_assoc($hasil_detail)){


    $mysqli2 = mysqli_connect("10.1.13.54","septiyo","uchsun","distributor_kokola_backup", 2272) or die('gagalx');
    //$mysqli2 = mysqli_connect("localhost","root","","distributor_kokola_backup") or die('gagalx');



    $sql_detail2 = "INSERT INTO `order_detail` SET
                           `ID_ORDER` = '$data_detail[ID_ORDER]',
                          `ID_PRODUK` = '$data_detail[ID_PRODUK]',
                          `JML_KJ` = '$data_detail[JML_KJ]',
                          `JML_REAL` = '$data_detail[JML_REAL]',
                          `JML_SISA` = '$data_detail[JML_SISA]',
                          `JML_ORDER` = '$data_detail[JML_ORDER]',
                          `ITEM_CODE` = '$data_detail[ITEM_CODE]',
                          `KUBIKASI` = '$data_detail[KUBIKASI]',
                          `FLAG` = '$data_detail[FLAG]',
                          `STS` = '$data_detail[STS]',
                          `DATE_INSERT` = '$data_detail[DATA_INSERT]',
                          `TGL_BACKUP` = '$today_database $time'";


    $hasil_detail2 = mysqli_query($mysqli2, $sql_detail2);

    //echo $no." ".$data[ID_ORDER]."<br>";



}

?>