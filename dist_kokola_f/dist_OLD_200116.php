<?php
session_start();
if($_SESSION[USER]) {

    ?>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <script src="jqm2/jquery-2.1.4.min.js"></script>
        <script src="jqm2/jquery.mobile-1.4.5.min.js"></script>
        <script src="jqtable/jquery.dataTables.min.js"></script>
        <script src="jqtable/dataTables.jqueryui.min.js"></script>


        <script src="validation/jquery.validate.js"></script>
        <link rel="stylesheet" href="themes/9septi_season.min.css"/>
        <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css"/>
        <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
        <link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>
        <!--<link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">-->
        <link rel="stylesheet" href="jqtable/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="jqtable/dataTables.jqueryui.min.css">

        <script>
            $(document).ready(function () {
                $('#example').DataTable({
                    "scrollY": 300,
                    "scrollX": true,
                    /*"scrollY":        "400px",
                     "scrollCollapse": true,*/
                    "ordering": false,
                    "paging": false
                });
            });

        </script>
    </head>

    <body>

    <div data-role="page" class="type-interior" data-theme="f">
        <div data-role="header">
            <h1>Forcast FORM </h1>

            <h2>Kokola Distributor 2.5</h2>
        </div>

        <div data-role="content">

            <h2 align="center">KJ / FORECAST<br><?php echo "<i>".$_SESSION[USER]."</i>";?></h2>

            <?php
            error_reporting(0);
            include "koneksi.php";


            date_default_timezone_set("Asia/Jakarta");

            $today = date(d) . "-" . date(m) . "-" . date(Y);
            $today_database = date(Y) . "-" . date(m) . "-" . date(d);
            $time = date('H:i:s');

            $month = date(M);

            //echo "<h2>".$month."</h2>";

            $_SESSION[BULAN_NOW] = $month;

            if ($month == "Jan" || $month == "Feb" || $month == "Mar") {

                $bulan_mini = "JFM";
                $bulan_big = "Jan-Feb-Mar";

            }
            if ($month == "Apr" || $month == "May" || $month == "Jun") {

                $bulan_mini = "AMJ";
                $bulan_big = "Apr-May-Jun";
            }
            if ($month == "Jul" || $month == "Aug" || $month == "Sep") {

                $bulan_mini = "JAS";
                $bulan_big = "Jul-Aug-Sep";

            }
            if ($month == "Oct" || $month == "Nov" || $month == "Dec") {

                $bulan_mini = "OND";
                $bulan_big = "Oct-Nov-Dec";
            }
            /*if ($month == "Mar" || $month == "Nov" || $month == "Dec") {

                $bulan_mini = "OND";
                $bulan_big = "Oct-Nov-Dec";
            }*/

            /*
             * PUENTTING OJO SAMPE LALI OPO KEHAPUS
             * */

            $_SESSION[TRIWULAN] = $bulan_big;


            $cek_block = (($month != "Mar") || ($month != "Jun") || ($month != "Sep") || ($month != "Dec"));

            //echo "<h1> ini cek block = ".$cek_block."</h1>";

            /***************************************/

            // echo $_SESSION[TRIWULANX];


            ?>

            <table border="0" cellpadding="1" cellspacing="0" align="left">
                <tr>
                    <td><?php echo "<a href='dist_forcast.php?BULAN=$_SESSION[TRIWULAN]' data-role='button' data-ajax='false' target='_parent'>Add Forecast</a>"; ?></td>


                </tr>

            </table>
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <td align="center">TRIWULAN</td>
                    <td align="center">TANGGAL INPUT</td>
                    <td align="center">SHOW FORECAST</td>
                    <td align="center">REVISI</td>
                </tr>
                </thead>
                <?php

                $sql_kj = "SELECT * FROM kj WHERE NAMA_DIST = '$_SESSION[USER]' GROUP BY TRIWULAN ORDER BY ID DESC";
                $hasil_kj = mysqli_query($mysqli, $sql_kj);

                while ($data_kj = mysqli_fetch_array($hasil_kj)) {

                    $triwulan = $data_kj['TRIWULAN'];
                    $tgl = $data_kj['TGL'];
                    $ins = $data_kj['WKT_INSERT'];

                    echo "<tr>";
                    echo "<td align='center'><b>$triwulan</b></td>";
                    echo "<td align='center'>$tgl</td>";
                    echo "<td align='center'><a href='show_forecast.php?TRI=$triwulan' data-role='button' target='_parent' data-ajax='false'>Show</a> </td>";



                    if (($_SESSION[TRIWULAN] == $triwulan) && ($cek_block == true)) {

                        echo "<td><a href='edit_forcast.php?TRI=$triwulan' data-role='button' data-ajax='false' target='_parent'>REVISI</a></td>";



                    }
                    if (($_SESSION[TRIWULAN] == $triwulan) && ($cek_block == false)) {

                        echo "<td align='center'>LOCKED</td>";



                    }
                    if ($_SESSION[TRIWULAN] != $triwulan) {

                        echo "<td align='center'><!--a href='edit_forcast.php?TRI=$triwulan&LOCKED=YES' data-role='button' data-ajax='false' target='_parent'-->LOCKED<!--/a--></td>";

                    } /*else if ($month == "Mar" || $month == "Jun" || $month == "Sep" || $month == "Dec") {

                        echo "<td align='center'>LOCKED</td>";

                    }*/

                    echo "</tr>";
                }//end of while
                ?>


            </table>
            <tr>
            <tr>


        </div>
        <!--emnd role-content-->

        <div data-role="footer">
            <table align="center">
                <tr>
                    <td align="center">
                        <a href="logout.php" style="text-align: center" data-role="button" data-icon="power"
                           target="_parent" data-ajax="false">Sign Out</a>
                    </td>
                </tr>
            </table>
            <h2>Kokola Web Developer Department, 2016</h2>
        </div>


    </div>
    <!--end role page-->
    </body>
    </html>
    <?php
}
else{
}
?>