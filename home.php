<?php
error_reporting (0);
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
<style>
/*.ui-btn {
    width: 200px !important;
}*/
</style>
        <script>
           

        </script>
    </head>

    <body>

    <div data-role="page" class="type-interior" data-theme="f">
        <div data-role="header">
            <h1>Forcast FORM </h1>

            <h2>Kokola Distributor 2.5</h2>
        </div>

        <div data-role="content">

           

            <?php
            error_reporting(0);
            include "koneksi.php";


            date_default_timezone_set("Asia/Jakarta");

            $today = date(d) . "-" . date(m) . "-" . date(Y);
            $today_database = date(Y) . "-" . date(m) . "-" . date(d);
            $time = date('H:i:s');

           echo $_SESSION[USER]."<br>";
		   echo $_SESSION[NAMA]."<br>";

            ?>
<div style="text-align:center">
          <a href="dist.php" target="_parent" data-ajax='false' class="ui-btn ui-btn-inline" style="width: 200px ;background:#D9E6F8 !important;" >Input Forecast</a>
          <a href="#" class="ui-btn ui-icon-arrow-r ui-btn-icon-notext ui-btn-inline" style="background:#D13B3E;">No text</a>
          <a href="pilih_pengiriman.php" target="_parent" class="ui-btn ui-btn-inline" style="width: 200px ;background:#D9E6F8 !important;">Jadwal Kirim</a>
          <a href="#" class="ui-btn ui-icon-arrow-r ui-btn-icon-notext ui-btn-inline" style="background:#D13B3E;">No text</a>
          <a href="order/form_distributor.php" target="_parent" class="ui-btn ui-btn-inline" style="width: 200px ;background:#D9E6F8 !important;">Order</a>
          <!-- <a href="#" class="ui-btn ui-icon-check ui-btn-icon-notext ui-btn-inline" style="background:#D13B3E;">No text</a>-->
           
           <!--<a href="order/form_tanpa_kj.php" target="_parent" class="ui-btn ui-btn-inline" style="width: 200px ;background:#D9E6F8 !important;">Order Tanpa KJ</a>-->
           <a href="#" class="ui-btn ui-icon-check ui-btn-icon-notext ui-btn-inline" style="background:#D13B3E;">No text</a>  
</div>            


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