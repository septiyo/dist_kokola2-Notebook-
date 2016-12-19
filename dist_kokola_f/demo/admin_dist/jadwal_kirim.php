    <?php
    session_start();
    //ini_set('display_errors', 1);


    if($_SESSION['HAK'] == "ADMIN") {

        ?>
        <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
            <script src="../jqm2/jquery-2.1.4.min.js"></script>
            <script src="../jqm2/jquery.mobile-1.4.5.min.js"></script>
            <script src="../jqtable/jquery.dataTables.min.js"></script>
            <script src="../jqtable/dataTables.fixedColumns.min.js"></script>
            <script src="../jqtable/dataTables.jqueryui.min.js"></script>


            <script src="../validation/jquery.validate.js"></script>
            <link rel="stylesheet" href="../themes/9septi_season.min.css" />
            <link rel="stylesheet" href="../themes/jquery.mobile.icons.min.css" />
            <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
            <link rel="stylesheet" href="../jqm2/jqmobile.structure-1.4.5.min.css"/>
            <link rel="stylesheet" href="../jqtable/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../jqtable/fixedColumns.dataTables.min.css">
            <link rel="stylesheet" href="../jqtable/themes/smoothness/jquery-ui.css">

            <script>
                $(document).ready(function () {
                    $('#example').DataTable({
                        "scrollY": 450,
                        "scrollX": true,
                        /*fixedColumns:   {
                            leftColumns: 1
                        },*/

                         "scrollCollapse": true,
                        "ordering": false,
                        "paging": false
                    });
                });

            </script>

            <!--style>
                /*th, td { white-space: nowrap; }
                div.dataTables_wrapper {
                    width: "80vh";
                    margin: 0 auto;
                }*/

            <!--/style-->

        </head>

        <body>

        <div data-role="page" class="type-interior" data-theme="f">
            <div data-role="header">
                <h1>Forcast FORM </h1>

                <h2>Kokola Admin 2.5</h2>
            </div>

            <div data-role="content">

                <h2 align="center">JADWAL KIRIM HARI INI<br><!--?php echo "<i>".$_SESSION[USER]."</i>";?--></h2>

                <?php
               // error_reporting(0);
                include "../koneksi.php";


                date_default_timezone_set("Asia/Jakarta");

                $today = date('d') . "-" . date('m') . "-" . date('Y');
                $today_database = date('Y') . "-" . date('m') . "-" . date('d');
                $time = date('H:i:s');
                $month = date('M');

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

                /*
                 * PUENTTING OJO SAMPE LALI OPO KEHAPUS
                 * */

                $_SESSION['TRIWULAN'] = $bulan_big;

                /***************************************/

                // echo $_SESSION[TRIWULANX];


                ?>

                <table border="0" cellpadding="1" cellspacing="0" align="left" width="100%">
                    <!--tr>
                        <td><?php echo "<a href='dist_forcast.php?BULAN=$_SESSION[TRIWULAN]' data-role='button' data-ajax='false' target='_parent'>Add Forecast</a>"; ?></td>


                    </tr-->

                </table>


 <br><br>                <table id="example" class="stripe row-border order-column" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th align="center">Distributor</th>
                        <th align="center">Kota</th>
                        <th align="center">Jumlah Kirim Hari Ini</th>
                        <th align="center">ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $sql = "SELECT user.NAMA, user.`KOTA`, user.USER, order_kirim_wd.ACCOUNT_ID, SUM(`order_kirim_wd`.`qty`)AS total
                                       FROM USER,`order_kirim_wd`WHERE `order_kirim_wd`.`periode2` = '$today_database' AND `order_kirim_wd`.`ACCOUNT_ID` = user.`ACCOUNT_ID`
                                       GROUP BY `order_kirim_wd`.`ACCOUNT_ID` ORDER BY `user`.NAMA ASC";


                    $hasil = mysqli_query($mysqli, $sql);

                    while($data = mysqli_fetch_assoc($hasil)){

                        echo "<tr>";
                        echo "<td align='center'>$data[NAMA]</td>";
                        echo "<td align='center'>$data[KOTA]</td>";
                        echo "<td align='center'>$data[total]</td>";
                        echo "<td align='right'><a href='detail_kirim.php?ID=$data[ACCOUNT_ID]&NAMA=$data[NAMA]&KOTA=$data[KOTA]&USERID=$data[USER]' data-role='button' data-ajax='false' target='_parent'>DETAIL</a> </td>";
                        echo "</tr>";

                    }


                    ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th align="center">Distributor</th>
                        <th align="center">Kota</th>
                        <th align="center">Jumlah Kirim Hari Ini</th>
                        <th align="center">ACTION</th>
                    </tr>
                    </tfoot>

                </table>

            </div><!--end of data role page-->

            <a href="home_admin.php" data-role="button" data-ajax="false" target="_parent">Back</a>

            <!--emnd role-content-->

            <div data-role="footer">
                <table align="center">
                    <tr>
                        <td align="center">
                            <a href="../logout.php" style="text-align: center" data-role="button" data-icon="power"
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
        echo "Anda tidak berhak..!";
    }
    ?>