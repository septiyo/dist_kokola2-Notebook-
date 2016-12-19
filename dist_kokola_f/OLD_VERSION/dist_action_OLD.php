<?php
session_start();
include "koneksi.php";


  //$produk = $_POST[PRODUK];
//$produk = $_POST[PRODUK];
  //$bulan_akhir   = $_POST[bln_akhir];
  $forecast      = $_POST[FORECAST];
  $total_value   = $_POST['TOTAL_VALUE'];

  $jumlah_forecast = count($forecast);
  //$jumlah_komitmen = count($komitmen);

  echo $jumlah_forecast;


  //var_dump($_POST);
  //print_r($_POST);

  //$P1_BLN1 = $_POST[P1_BLN1];
 // echo $P1_BLN1;



    /*$n=1;
    while($n<=$jumlah){

        echo "Forecast".$forecast[$n]."<br>";
        echo "3_bulanakhir : ".$3_bulan_akhir[$n]."<br>";
        echo "total_value  : ".$total_value[$n]."<br>";
    }*/

?>