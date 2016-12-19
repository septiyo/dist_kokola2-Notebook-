    <?php
    session_start();
    ini_set('display_errors', 1);


    if($_SESSION[HAK] == "ADMIN") {

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
            <!--link rel="stylesheet" href="../themes/9septi_season.min.css" />
            <link rel="stylesheet" href="../themes/jquery.mobile.icons.min.css" /-->
            <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
            <link rel="stylesheet" href="../jqm2/jqmobile.structure-1.4.5.min.css"/>
            <link rel="stylesheet" href="../jqtable/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../jqtable/fixedColumns.dataTables.min.css">
            <link rel="stylesheet" href="../jqtable/themes/smoothness/jquery-ui.css">

            <script>
                $(document).ready(function () {
                    $('#example').DataTable({
                        "scrollY": 300,
                        "scrollX": true,
                        "fixedColumns": true, /*{
                         leftColumns: 2
                         },*/
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

                <h2>Kokola Admin 2.5</h2>
            </div>

            <div data-role="content">

                <h2 align="center">JADWAL KIRIM HARI INI<br><!--?php echo "<i>".$_SESSION[USER]."</i>";?--></h2>

                <?php
                error_reporting(0);
                include "../koneksi.php";


                date_default_timezone_set("Asia/Jakarta");

                $today = date(d) . "-" . date(m) . "-" . date(Y);
                $today_database = date(Y) . "-" . date(m) . "-" . date(d);
                $time = date('H:i:s');


                $month = date(M);

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

                /*
                 * PUENTTING OJO SAMPE LALI OPO KEHAPUS
                 * */

                $_SESSION[TRIWULAN] = $bulan_big;

                /***************************************/

                // echo $_SESSION[TRIWULANX];


                ?>

                <table border="0" cellpadding="1" cellspacing="0" align="left">
                    <!--tr>
                        <td><?php echo "<a href='dist_forcast.php?BULAN=$_SESSION[TRIWULAN]' data-role='button' data-ajax='false' target='_parent'>Add Forecast</a>"; ?></td>


                    </tr-->

                </table>
                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th align="center">ITEM</th>
                        <?php
                           $sql_header = "SELECT user.USER,
                                                  user.KOTA
                                          FROM order_kirim_wd, USER
                                           WHERE user.`ACCOUNT_ID` = `order_kirim_wd`.`ACCOUNT_ID`
                                           AND order_kirim_wd.`periode2` = '$today_database'";



                          $hasil_header = mysqli_query($mysqli, $sql_header);

                          while($data_header = mysqli_fetch_assoc($hasil_header)){

                              echo "<th>$data_header[USER] ($data_header[KOTA])</th>";

                          }

                        ?>

                    </tr>
                    </thead>
                    <?php


                  /*  $sql_kj = "SELECT user.USER,
                                      `m_produk`.`NAMA_PRODUK`,
                                      `order_kirim_wd`.qty

                                       FROM USER,`order_kirim_wd`,m_produk
                                       WHERE user.`ACCOUNT_ID` = `order_kirim_wd`.`ACCOUNT_ID`
                                       AND `m_produk`.`ITEM_CODE` = `order_kirim_wd`.`item_code`
                                       AND order_kirim_wd.`periode2` = '$today_database'";*/

                            /*ini untuk looping produk kebawah*/

                           $sql_produk = "SELECT  `m_produk`.NAMA_PRODUK,
                                                     m_produk.ITEM_CODE
                                                          FROM USER,`order_kirim_wd`,m_produk
                                                           WHERE user.`ACCOUNT_ID` = `order_kirim_wd`.`ACCOUNT_ID`
                                                           AND `m_produk`.`ITEM_CODE` = `order_kirim_wd`.`item_code`
                                                           AND order_kirim_wd.`periode2` = '$today_database'
                                                           GROUP BY m_produk.NAMA_PRODUK";




                    $hasil_produk = mysqli_query($mysqli, $sql_produk);

                    while ($data_produk = mysqli_fetch_array($hasil_produk)) {

                        echo "<tr>";
                           echo "<td align='center'><b>$data_produk[NAMA_PRODUK]</b></td>";

                           /*yang ini untuk looping kesamping*/

                           $sql_qty = "SELECT `order_kirim_wd`.qty
                                          FROM order_kirim_wd

                                           WHERE `order_kirim_wd`.`item_code` = '$data_produk[ITEM_CODE]'
                                           AND order_kirim_wd.periode2 = '$today_database'
                                           AND `order_kirim_wd`.`ACCOUNT_ID` = 47975";



                        echo "</tr>";
                    }
                    ?>


                </table>

            </div>

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