<?php
session_start();
/*ini_set('display_errors', 1);*/
/*error_reporting(E_ALL|E_STRICT);*/
include "koneksi.php";
include "bantuan.class.php";

$bantuan = new bantuan();
$tanggal = $bantuan->tgl_indo("datetime");

//echo $_SESSION[BULAN_NOW];


//$bantuan = new bantuan();
//  $tanggal = $bantuan->tgl_indo("datetime");


if($_SESSION[USER]) {
    ?>

    <html>


    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <script src="jqm2/jquery-2.1.4.min.js"></script>
        <script src="jqm2/jquery.mobile-1.4.5.min.js"></script>
        <script src="jqtable/jquery.dataTables.min.js"></script>
        <script src="jqtable/dataTables.fixedColumns.min.js"></script>


        <script src="validation/jquery.validate.js"></script>
        <link rel="stylesheet" href="themes/9septi_season.min.css"/>
        <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css"/>
        <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
        <link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>
        <link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">
        <link rel="stylesheet" href="jqtable/fixedColumns.dataTables.min.css">



        <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    "scrollY": 300,
                    "scrollX": true,
                    "paging": false,
                    "fixedColumns": {
                        leftColumns: 2
                    }
                } );
            } );

        </script>

        <style>
            .ui-corner-all{
                border-radius: 0!important;

            }

        </style>


    </head>
    <body>




    <div data-role="page" class="type-interior" data-dialog="true"  data-theme="b">
        <div data-role="header">
            <h1>Forcast FORM </h1>

            <h2>Kokola Distributor 1.5</h2>
        </div>
        <!--end header-->

        <div data-role="content">


            <!--form-- method="post" action="syarat.php" data-ajax="false">
                 Mohon Untuk Input Password anda sekali lagi untuk Validasi Terakhir sebelum SAVE..!
                <input type = "password" name="PASS">
                <input type = "submit" name="SAVE" value="SAVE">
            </form-->
          <div style="text-align: center;">
            Sudah Yakin akan di SAVE ?<br>
            Karena setelah data di simpan, yang bisa diREVISI hanya nilainya saja, <br><br> UNTUK FORECAST DAN BARANG tidak bisa DiREVISI

              <a href="dist_forcast.php" data-ajax="false" data-role="button">OK</a>
          </div>


            <?php

            /*if(isset($_POST[SAVE])){

               $pass = $_POST[PASS];

               $cek = "SELECT * FROM user WHERE USER = '$_SESSION[USER]' AND PASS = '$pass'";
               $hasil = mysqli_query($mysqli, $cek);
               $data - mysqli_fetch_assoc($hasil);

               $jumlah = mysqli_fetch_row($hasil);

                if($jumlah != ""){


                }

            }*/




            ?>


        </div>
        <!--end content-->
        <br><br>


        <div data-role="footer">
            <h2>Kokola Web Developer Department, 2016</h2>
        </div>
        <!--end of content-->


    </body>
    </html>
    <?php
}
else{

    echo "Anda tidak Berhak";
}


?>