<?php
session_start();


		   
		   
if($_SESSION['USER']) {
    ?>
    <html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">        
    <link rel="stylesheet" href="themes/9septi_season.min.css"/>
    <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css"/>
    <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
    <link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>
    <!--<link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">-->
    <link rel="stylesheet" href="jqtable/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="jqtable/dataTables.jqueryui.min.css">
    <script src="jqm2/jquery-2.1.4.min.js"></script>
    <script src="jqm2/jquery.mobile-1.4.5.min.js"></script>
    <script src="jqtable/jquery.dataTables.min.js"></script>
    <script src="jqtable/dataTables.jqueryui.min.js"></script>
    <!--<script type="text/javascript" src="jqtable/fixedColumns.dataTables.min.css"></script>-->
    <script type="text/javascript" src="jqtable/dataTables.fixedColumns.min.js"></script>
    <script src="validation/jquery.validate.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "scrollY": 300,
                "scrollX": true,
                /*"scrollY":        "400px",
                 "scrollCollapse": true,*/
                "ordering": false,
                "paging": false,
				"scrollCollapse": true,
				"fixedColumns": {
					"leftColumns": 2
				},
            });
        });

    </script>
    </head>

    <body>

    <div data-role="page" class="type-interior" data-theme="f">
        <div data-role="header" data-position="fixed" data-tap-toggle="false">        	
        	<a href="home.php" data-icon="arrow-l" data-role="button" data-rel="back">Back</a>
            <h1>Forecast FORM</h1>
            <!--<a href="logout.php" style="text-align: center" data-role="button" data-icon="power" target="_parent" data-ajax="false" class="ui-btn-right">Log Out</a>-->
            <h2 style="width:90%;margin:auto;">Kokola Distributor 2.5</h2>
			<?php   echo $_SESSION[USER]."<br>";
		   echo $_SESSION[NAMA]."<br>";
		   ?>
        </div>

        <div data-role="content">
            <div align="center" style="text-shadow:none;">
            	<div style="font-weight:bold;">KJ / FORECAST</div>
				<div><?php echo "<i>".$_SESSION['NAMA']."</i>";?></div>
            </div>
            <?php
            //error_reporting(0);
            include "koneksi.php";


            date_default_timezone_set("Asia/Jakarta");

            $today = date('d') . "-" . date('m') . "-" . date('Y');
            $today_database = date('Y') . "-" . date('m') . "-" . date('d');
            $time = date('H:i:s');

            $month = date('M');

            //echo "<h2>".$month."</h2>";

            $_SESSION['BULAN_NOW'] = $month;

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

            $_SESSION['TRIWULAN'] = $bulan_big;

            //echo $_SESSION[ACCOUNT_ID];


           // $cek_block = (($month !== "Mar") || ($month !== "Jun") || ($month !== "Sep") || ($month !== "Dec"));


            //echo "<h1> ini cek block = ".$cek_block."</h1>";

            /***************************************/

            // echo $_SESSION[TRIWULANX];


            ?>

            <table border="0" cellpadding="1" cellspacing="0" align="left">
                <tr>
                    <td><?php echo "<a href='dist_forcast.php?BULAN=$_SESSION[TRIWULAN]' data-role='button' data-ajax='false' target='_parent'>Add Forecast</a>"; ?></td>
                    <!--<td><?php echo "<a href='order/form_distributor.php' data-role='button' data-ajax='false' target='_parent'>Order</a>"; ?></td>-->
                </tr>
            </table>
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <td align="center">TRIWULAN</td>
                    <td align="center">TANGGAL INPUT</td>
                    <td align="center">SHOW FORECAST</td>
                    <td align="center">REVISI</td>
                    <td align="center">JADWAL KIRIM</td>                    
                    <td align="center">ORDER</td>
                </tr>
                </thead>
                <?php

                $sql_kj = "SELECT * FROM kj WHERE NAMA_DIST = '$_SESSION[USER]' GROUP BY TRIWULAN ORDER BY ID DESC";
                $hasil_kj = mysqli_query($mysqli, $sql_kj);

                while ($data_kj = mysqli_fetch_array($hasil_kj)) {

                    $triwulan = $data_kj['TRIWULAN'];
                    $tgl = $data_kj['TGL'];
					$bln = $data_kj['BULAN_INPUT'];
                    //$ins = $data_kj['WKT_INSERT'];

                    echo "<tr>";
                    echo "<td align='center'><b>$triwulan</b></td>";
                    echo "<td align='center'>$tgl</td>";
                    echo "<td align='center'>
						<a href='show_forecast.php?TRI=$triwulan'
						data-role='button' target='_parent' data-ajax='false'>Show</a></td>";
                         
						 
						 
                     if ($_SESSION['TRIWULAN'] == $triwulan) {

                        //if ( !in_array($month, array('Mar','Jun','Sep','Dec'), true ) ) {
                            echo "<td><a href='edit_forcast.php?TRI=$triwulan'
								data-role='button' data-ajax='false' target='_parent'>REVISI</a></td>";
                        //}
						}
                        else{
                            echo "<td align='center'>LOCKED</td>";
                        }

                    //}
                    //if ($_SESSION['TRIWULAN'] != $triwulan) {
                        //echo "<td align='center'>LOCKED</td>";
                    //}
                    echo "<td align='center'><a href='pilih_pengiriman.php'
						data-role='button' target='_parent' data-ajax='false'>Jadwal Kirim</a> </td>";
					
					//$sqlOrder = "select ACCOUNT_ID from order_kirim_wd
						//where flag = 1
						//and date_format(periode1, '%Y %m 1') = date_format(now(), '%Y %m 1')
						//and date_format(periode2, '%Y %m %d') = date_format(now(), '%Y %m %d')";						
					//$myOrder = mysqli_query($mysqli, $sqlOrder);
					//$jmlOrder = mysqli_num_rows($myOrder);
					//if ($jmlOrder > 0) {
					//	$sqlOrderhari = "select ID_ORDER from order_distributor
							//where date_format(TGL, '%Y %m %d') = date_format(now(), '%Y %m %d')
							//and USERID = '".$_SESSION['USER']."'";
						//$myOrderhari = mysqli_query($mysqli, $sqlOrderhari);
					//	$jmlOrderhari = mysqli_num_rows($myOrderhari);
						//if ($jmlOrderhari == 0) {
							echo "<td align='center'><a href='order/form_distributor.php'
								data-role='button' data-ajax='false' target='_parent'>Order</a></td>";
					//	}
						//else {
							//echo "<td align='center'>Order sudah disimpan</td>";
						//}
					//}
					//else {
						//echo "<td align='center'>Belum ada jadwal kirim</td>";
					//}
                    echo "</tr>";
					
                }//end of while
                ?>


            </table>
            <tr>
            <tr>


        </div>
        <!--emnd role-content-->

        <div data-role="footer" data-position="fixed" data-tap-toggle="false">
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


