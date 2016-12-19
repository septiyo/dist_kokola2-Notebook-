<?php
session_start();
if($_SESSION[HAK] == "ADMIN") {
    ?>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <script src="../jqm2/jquery-2.1.4.min.js"></script>
        <script src="../jqm2/jquery.mobile-1.4.5.min.js"></script>
        <script src="../jqtable/jquery.dataTables.min.js"></script>
        <script src="../jqtable/dataTables.jqueryui.min.js"></script>


        <script src="../validation/jquery.validate.js"></script>
        <link rel="stylesheet" href="../themes/9septi_season.min.css"/>
        <link rel="stylesheet" href="../themes/jquery.mobile.icons.min.css"/>
        <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
        <link rel="stylesheet" href="../jqm2/jqmobile.structure-1.4.5.min.css"/>
        <!--<link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">-->
        <link rel="stylesheet" href="../jqtable/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="../jqtable/dataTables.jqueryui.min.css">
        <style>
            .okl {
                font: bold 15px Arial;
                text-decoration: none;
                background-color: #EEEEEE;
                color: #333333;
                padding: 2px 6px 2px 6px;
                border-top: 1px solid #CCCCCC;
                border-right: 1px solid #333333;
                border-bottom: 1px solid #333333;
                border-left: 1px solid #CCCCCC;
            }
        </style>
        <script>
            $(document).ready(function () {


            });

        </script>
    </head>

    <body>

    <div data-role="page" class="type-interior" data-theme="a">
        <div data-role="header">


            <h2>Kokola Festive 2.5</h2>
        </div>

        <div data-role="content">

            <div align="center"><strong>ADMIN</strong></div>

            <ul data-role="listview" data-inset="true">
                <li><a href="admin_mproduk.php" target="_parent">Produk</a></li>
                <li><a href="admin_user.php" target="_parent">User</a></li>
                <li><a href="admin_kj.php" target="_parent">Hasil KJ / FORECAST</a></li>
                <!--li><a href="kirim_now.php" target="_parent">Jadwal Kirim Hari ini</a></li-->
                <!--li><a href="set_banner.php" target="_parent">Set Banner</a></li-->
                <li><a href="order_distributor.php" target="_parent">Input KJ Modern Outlet</a></li>
                <li><a href="laporan_festive.php" target="_parent">Laporan Festive</a></li>
                <!--li><a href="konfirmasi/konfirmasi_order.php" target="_parent">Konfirmasi Order Hari ini</a></li-->
                <!--li><a href="list_total_order_distributor.php" target="_parent">Total Order Distributor</a></li-->
                <!--li><a href="list_jadwal_kirim.php" target="_parent">Total Jadwal Kirim</a></li-->
                <li><a href="../logout.php" target="_parent">Log Out</a></li>

            </ul>

        </div>
        <!--emnd role-content-->

        <div data-role="footer">
            <h2>Kokola Web Developer Department, 2016</h2>
        </div>


    </div>
    <!--end role page-->
    </body>
    </html>
    <?php
}
else{

    echo "Anda tidak berhak..!";
}
    ?>