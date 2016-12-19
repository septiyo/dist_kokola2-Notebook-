<?php
session_start();
//ini_set('display_errors', 1);


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
                    "scrollY": 300,
                    "scrollX": true,
                    /*fixedColumns:   {
                     leftColumns: 1
                     },*/

                    "scrollCollapse": true,
                    "ordering": false,
                    "paging": false
                });
            });


            $(document).ready(function () {
                $('#example2').DataTable({
                    "scrollY": 300,
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

        <style>
            /*th, td { white-space: nowrap; }
            div.dataTables_wrapper {
                width: 800px;
                margin: 0 auto;
            }*/


            .ui-dialog-contain {
                width: 100%;
                max-width: 1000px;
                margin: 10% auto 15px auto;
                padding: 0;
                position: relative;
                top: -90px;
            }

        </style>

    </head>

    <body>

    <div data-role="page" data-dialog="true" class="type-interior" data-theme="f">
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

            $today = date(d) . "-" . date(m) . "-" . date(Y);
            $today_database = date(Y) . "-" . date(m) . "-" . date(d);
            $time = date('H:i:s');


            $month = date(M);

            $_SESSION[BULAN_NOW] = $month;


             $account_id = $_GET[ID];
             $nama = $_GET[NAMA];
             $kota = $_GET[KOTA];
          $user_id = $_GET[USERID];


            echo "<a href='tambah_order.php?ID=$account_id&NAMA=$nama&KOTA=$kota&USERID=$user_id' data-role='button' data-ajax='false' target='_parent' class='ui-btn ui-btn-inline' data-theme='f'>TAMBAH ORDER</a>";
            ?>



            <table id="example" class="stripe row-border order-column" cellspacing="0" width="100%">
                <thead>
                <tr><td align="center" colspan="6"><h2><?php echo $nama." ".$kota;?></h2></td></tr>
                <tr>
                    <th align="center">ITEM</th>
                    <th align="center">HARGA</th>
                    <th align="center">QTY</th>
                    <th align="center">KUBIKASI TOTAL</th>
                    <th align="center">SUBTOTAL</th>
                    <th align="center">EDIT ORDER</th>

                </tr>
                </thead>
                <tbody>
                <?php

                $sql = "SELECT user.NAMA,
            user.`KOTA`,
            user.`ACCOUNT_ID`,
              `m_produk`.`NAMA_PRODUK`,
              `m_produk`.`ITEM_CODE`,
                  `m_produk`.`HARGA`,
                  `kubikasi`.`KUBIK`,
                       SUM(order_kirim_wd.`qty`) AS qty
                           FROM USER,`order_kirim_wd`,`m_produk`,`kubikasi`
                            WHERE `order_kirim_wd`.`periode2` = '$today_database'
                            AND `order_kirim_wd`.`ACCOUNT_ID` = user.`ACCOUNT_ID`
                            AND order_kirim_wd.`item_code` = `m_produk`.`ITEM_CODE`
                            AND `order_kirim_wd`.`ACCOUNT_ID` = '$account_id'
                            AND `kubikasi`.`ITEM_CODE` = `m_produk`.`ITEM_CODE`
                            GROUP BY `m_produk`.`NAMA_PRODUK`";



               /* $sql = "SELECT user.NAMA,
                               user.`KOTA`,
                               `m_produk`.`NAMA_PRODUK`,
                              `m_produk`.`HARGA`,
                               SUM(order_kirim_wd.`qty`) AS qty
                           FROM USER,`order_kirim_wd`,`m_produk`
                            WHERE `order_kirim_wd`.`periode2` = '$today_database'
                            AND `order_kirim_wd`.`ACCOUNT_ID` = user.`ACCOUNT_ID`
                            AND order_kirim_wd.`item_code` = `m_produk`.`ITEM_CODE`
                            AND `order_kirim_wd`.`ACCOUNT_ID` = '$account_id'
                            GROUP BY `m_produk`.`NAMA_PRODUK`";*/


                $hasil = mysqli_query($mysqli, $sql);

                while($data = mysqli_fetch_assoc($hasil)){

                    $subtotal = $data[HARGA] * $data[qty];

                    $kubikasi_total = $data[qty] * $data[KUBIK];

                    $kubikasi_total2 = number_format($kubikasi_total);

                    $harga2 = number_format($data[HARGA]);
                    $qty2   = number_format($data[qty]);
                    $subtotal2   = number_format($subtotal);




                    echo "<tr>";
                    echo "<td align='center'>$data[NAMA_PRODUK]</td>";
                    echo "<td align='center'>$harga2</td>";
                    echo "<td align='center'>$qty2</td>";
                    echo "<td align='center'>$kubikasi_total2</td>";
                    echo "<td align='center'>$subtotal2</td>";
                    echo "<td align='right'><a href='../order/update_order.php?ACCOUNTID=$data[ACCOUNT_ID]' data-role='button' data-ajax='false' target='_parent'>EDIT</a> </td>";
                    echo "</tr>";

                    //echo $qty2;


                   $jumlah_qty = $jumlah_qty + $data[qty];
                   $jumlah_total =  $jumlah_total + $subtotal;
                    $jumlah_kubikasi_total = $jumlah_kubikasi_total + $kubikasi_total2;

                    $jumlah_qty2 = number_format($jumlah_qty);
                    $jumlah_total2 = number_format($jumlah_total);

                    $jumlah_kubikasi_total2 = number_format($jumlah_kubikasi_total);


                }


                ?>


                </tbody>
                <tfoot>
                <tr>
                    <!--th align="center" colspan="3"></th>
                    <th align="center"><?php echo $jumlah_qty2;?></th>
                    <th-- align="center"><?php echo $jumlah_total2;?></th-->

                    <th align="center" colspan="2"></th>
                    <th align="center"><?php echo $jumlah_qty2;?></th>
                    <th align="center"><?php echo $jumlah_kubikasi_total2;?></th>
                    <th align="center"><?php echo $jumlah_total2;?></th>
                    <th align="center">EDIT ORDER</th>
                </tr>
                </tfoot>

            </table>
            <br><br>
                <h3>Tambahan dari Admin Sales</h3>

            <table id="example2" class="stripe row-border order-column" cellspacing="0" width="100%">
                <thead>
                <tr><td align="center" colspan="6"><h2><?php echo $nama." ".$kota;?></h2></td></tr>
                <tr>
                    <th align="center">ITEM</th>
                    <th align="center">HARGA</th>
                    <th align="center">QTY</th>
                    <th align="center">KUBIKASI TOTAL</th>
                    <th align="center">SUBTOTAL</th>
                    <th align="center">EDIT ORDER</th>

                </tr>
                </thead>
                <tbody>
                <?php

                $sql_ambil = "SELECT m_produk.NAMA_PRODUK,
                                 m_produk.HARGA,
                                 order_distributor.ID_ORDER,
                                 order_detail.kubikasi,
                                  order_detail.JML_ORDER          
                                FROM m_produk,order_distributor,order_detail
                                 WHERE order_distributor.TGL = '$today_database'
                                  AND order_detail.ITEM_CODE = m_produk.ITEM_CODE
                                   AND order_distributor.ID_ORDER = order_detail.ID_ORDER
                                   AND order_detail.FLAG = '2'
								   AND order_distributor.ACCOUNT_ID = '$account_id'";
								   
								   //echo $sql_ambil;
								   
					$hasil_ambil = mysqli_query($mysqli, $sql_ambil);
                    while($data_ambil = mysqli_fetch_assoc($hasil_ambil)){
					
					$subtotal_tambahan = $data_ambil[JML_ORDER] * $data_ambil[HARGA];
                      
                    $subtotal_tambahan2 = number_format($subtotal_tambahan);
					
					$kubikasi2 = number_format($data_ambil[kubikasi]);
									
					$qty2 = number_format($data_ambil[JML_ORDER]);
					
					$harga2_tambahan = number_format($data_ambil[HARGA]);
					
					
					 echo "<tr>";
                       echo "<td align='center'>$data_ambil[NAMA_PRODUK]</td>";
					   echo "<td align='center'>$harga2_tambahan</td>";
					   echo "<td align='center'>$qty2</td>";
					   echo "<td align='center'>$kubikasi2</td>";
					   echo "<td align='center'>$subtotal_tambahan2</td>";
					    echo "<td align='right'><a href='../order/update_order.php?ACCOUNTID=$data[ACCOUNT_ID]' data-role='button' data-ajax='false' target='_parent'>EDIT</a> </td>";
					   
					 echo "</tr>";
					   
                    
					  $total_qty_tambahan_put = $total_qty_tambahan_put + $data_ambil[JML_ORDER];
					  $total_qty_tambahan2 = number_format($total_qty_tambahan_put);
					  
					  $total_kubikasi_tambahan = $total_kubikasi_tambahan + $data_ambil[kubikasi];
					  $total_kubikasi_tambahan2 = number_format($total_kubikasi_tambahan);
					  
					  $total_subtotal_tambahan = $total_subtotal_tambahan + $subtotal_tambahan;
					  $total_subtotal_tambahan2 = number_format($total_subtotal_tambahan);
					
					
					}//end while 					
								   
								   
								   
								   


                ?>
                <tfoot>
				   <tr>
                    <th align="center" colspan="2"></th>
                    <th align="center"><?php echo $total_qty_tambahan2;?></th>
                    <th align="center"><?php echo $total_kubikasi_tambahan2;?></th>
                    <th align="center"><?php echo $total_subtotal_tambahan2;?></th>
                    <th align="center">EDIT ORDER</th>

                </tr>
				
                </tfoot>				


                </tbody>

                </table>


        </div><!--end of data role page-->



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