<?php
session_start();
//ini_set('display_errors', 1);
include "../koneksi.php";


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
                    "dom": '<"toolbar">frtip',
                    "scrollY": 400,
                    "scrollX": true,
                    /*fixedColumns:   {
                     leftColumns: 1
                     },*/

                    "scrollCollapse": true,
                    "ordering": false,
                    "paging": false,
                    "filter":false
                });


                $("div.toolbar").html('<b><input type="text" id="cari" placeholder="Cari"></b>');
                $("#cari").keyup(function(e) {
                    cari_table();
                });



            });//end ready function

            function cari_table() {
                var value = $("#cari").val();
                $("table tbody tr").each(function(index, element) {
                    if (index >= 0) {
                        $row = $(this);
                        var id = $row.find("td:eq(0)").text().toLowerCase();
                        if (id.indexOf(value) < 0) {
                            $row.hide();
                        }
                        else {
                            $row.show();
                        }
                    }
                });
            }

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


    <?php

    if(isset($_POST[SAVE])){


        date_default_timezone_set("Asia/Jakarta");

        $today          = date(d)."-".date(m)."-".date(Y);
        $today_database = date(Y)."-".date(m)."-".date(d);
        $time = date('H:i:s');

        $qty          = $_POST[QTY];
        $jumlah_qty   = count($qty);
        $account_idne = $_POST[ACC];
        $userid       = $_POST[USERID];
        $item_code    = $_POST[ITEM_CODE];
		$kubikasi     = $_POST[KUBIKASI2];






        $sqlID = "select ID_ORDER, (substr(ID_ORDER,-3)+1) as NOMOR from order_distributor order by ID_ORDER desc";

        $myID = mysqli_query($mysqli, $sqlID);
        if ($dataID = mysqli_fetch_assoc($myID)) {
            $id_order = $dataID['NOMOR'];
            if ($id_order < 10) {
                $id_order = date('Ymd').'00'.$id_order;
            }
            elseif ($id_order < 100) {
                $id_order = date('Ymd').'0'.$id_order;
            }
            else {
                $id_order = date('Ymd').$id_order;
            }
        }
        else {
            $id_order = date('Ymd').'001';
        }


        /*ini input ke tabel order_distributor*/

    $sql_order = "INSERT INTO order_distributor SET  ID_ORDER = '$id_order',
                                                     TGL = '$today_database',
                                                     USERID = '$userid',
                                                     ACCOUNT_ID = '$account_idne',
                                                     FLAG = '2'";

    $hasil_order = mysqli_query($mysqli, $sql_order);



/*ini input ke tabel order_detail*/

        $n = 0;
        while ($n < $jumlah_qty) {

               /*Cari produk_id*/

            $sql_cari_produk_id = "SELECT ID  FROM m_produk WHERE ITEM_CODE = '$item_code[$n]' ";
            $hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
            $data_id = mysqli_fetch_assoc($hasil_cari_produk_id);
            $id_produk = $data_id[ID];


            if($qty[$n] != "") {

                 $sql_order_detail = "INSERT INTO order_detail SET  ID_ORDER = '$id_order',
                                                                    ID_PRODUK = '$id_produk',
                                                                    JML_ORDER = '$qty[$n]',
                                                                    ITEM_CODE = '$item_code[$n]',
																	KUBIKASI  = '$kubikasi[$n]',
                                                                    FLAG = '2'";

                $hasil_order_detail = mysqli_query($mysqli, $sql_order_detail);



            }
            $n++;
        }

        if($hasil_order_detail){

            echo "<script>alert('Tambah Order Berhasil..!');
                          window.location='jadwal_kirim.php';
                          </script>";

        }
        else{

            echo "<script>alert('Tambah Order Gagal..!');
                          window.location='jadwal_kirim.php';
                          </script>";

        }


    }//end isset


    $account_id = $_GET[ID];
    $nama = $_GET[NAMA];
    $kota = $_GET[KOTA];
    $user_id = $_GET[USERID];




    ?>

    <div data-role="page" data-dialog="true" class="type-interior" data-theme="f">
        <div data-role="header">
            <h1>Tambah Order FORM </h1>

            <h2>Kokola Admin 2.5</h2>
        </div>

        <div data-role="content">
            <form id="formx" method="post" action="tambah_order.php" data-ajax="false">
                <table>
                    <tr>
                        <td align="center" colspan="9">
                            <h3>Order  : <?php echo $nama; ?></h3>
                            <input type="hidden" value="<?php echo $_SESSION['TRIWULAN']; ?>" name="TRIWULAN">
                        </td>
                    </tr>
                    <!--tr>
                        <th colspan="9" align="center">Nama Distributor : <?php echo $_SESSION['USER']; ?></th>
                    </tr-->
                </table>

                <!--table border="1" cellpadding="1" cellspacing="0" align="center"-->
                <table id="example"  class="order-column display stripe" cellspacing="0" width="100%">
                    <thead>
                    <tr bgcolor="#7fffd4">
                        <th width="100">Nama Produk</th>
                        <th width="30">Harga</th>
                        <th width="50">Qty</th>
                        <th width="50">Total Kubikasi</th>
                        <th width="100" class="TOTAL_VALUE">Total Value</th>

                    </tr>
                    </thead>


                    <tbody>
                    <?php
                    //$sql_produk = "SELECT * FROM m_produk WHERE HARGA <> 0  ORDER BY NAMA_PRODUK ASC";

                    $sql_produk = "SELECT m_produk.`NAMA_PRODUK`,
                                    m_produk.`HARGA`,
                                    m_produk.`ITEM_CODE`,
                                   `kubikasi`.`KUBIK`
                                    FROM `m_produk`,`kubikasi`
                                      WHERE m_produk.`ITEM_CODE` = `kubikasi`.`ITEM_CODE`
                                      AND   m_produk.`HARGA` <> 0
                                   ORDER BY `m_produk`.`NAMA_PRODUK` ASC";

                    $hasil_produk = mysqli_query($mysqli, $sql_produk);

                    while ($data_produk = mysqli_fetch_assoc($hasil_produk)) {
                        echo "<tr>";
                        echo "<td align='left'> $data_produk[NAMA_PRODUK] <input type='hidden' value='$data_produk[ITEM_CODE]' name='ITEM_CODE[]'>


                              </td>";
                        echo "<td><div class='HARGA' align='center'>$data_produk[HARGA]</div><input type='hidden' value='$data_produk[HARGA]' name='HARGA[]'></td>";
                        echo "<td align='left'><input type='text' name='QTY[]' id='QTY' class='QTY' placeholder='...' ></td>";
                        echo "<td align='center'><div class='KUBIKASI'></div><input type='hidden' name='KUBIKASI[]' value='$data_produk[KUBIK]' id='KUBIKASI' readonly>
                                           <input type='hidden' name='KUBIKASI2[]' id='KUBIKASI2' readonly>
                             </td>";
                        echo "<td align='center'><div class='TOTAL'></div><input type='hidden' name='TOTAL[]' id='TOTAL' readonly></td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr bgcolor="#7fffd4">
                        <th width="100">Nama Produk</th>
                        <th width="30">Harga</th>
                        <th width="50"><div id="jumlah_total_qty">0</div></th>
                        <th width="50"><div id="kubikasi_total"></div></th>
                        <th width="100"><div id="total_total_value"></div> </th>

                    </tr>
                    </tfoot>
                </table>

                <table align="center" width="300">
                    <tr>
                        <td colspan="5" align="center">
                            <input type="hidden" name="ACC" value="<?php echo $account_id;?>">
                            <input type="hidden" name="USERID" value="<?php echo $user_id;?>">
                            <input type="submit" value="SAVE" name="SAVE" id="SAVE">
                            <!--a-- href="syarat.php" class="ui-shadow ui-btn ui-corner-all ui-btn-inline" data-transition="pop" id="SYARAT">SYARAT</a-->
                            <!--a-- href="dist.php" data-ajax="false" data-role="button">Back</a-->
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <!--end content-->


        <!--emnd role-content-->

        <div data-role="footer">

            <h2>Kokola Web Developer Department, 2016</h2>
        </div>


    </div>
    <!--end role page-->


    <script>

        $("tr td .QTY").on("change", function(){
            var harga     = Number($(this).parents('tr').find('.HARGA').html());
            var kubikasi  = Number($(this).parents('tr').find('#KUBIKASI').val());
            var qty       = Number($(this).val());

            var total_value =  Math.round(Number((harga * qty)));
            var total_kubikasi = Math.round(Number((kubikasi * qty)));

           // var kolom_lain =  Math.round(Number((forcast - bulan1) ));
            /*alert(harga);
            alert(kubikasi);
            alert(qty);*/

            $(this).parents('tr').find('#TOTAL').val(total_value);
            $(this).parents('tr').find('.TOTAL').html(total_value);


            $(this).parents('tr').find('#KUBIKASI2').val(total_kubikasi);
            $(this).parents('tr').find('.KUBIKASI').html(total_kubikasi);

            //$(this).parents('tr').find('.BULAN3').val(kolom_lain);
            hitung_total();
        });



        function hitung_total() {
            var qty_total = 0;
            var kubikasi = 0;
            var jumlah_total_value = 0;


            $(".QTY").each(function(index, element) {
                qty_total = (Number($(element).val()) + qty_total);

            });

            $(".KUBIKASI").each(function(index, element) {
                kubikasi = (Number($(element).html()) + kubikasi);
            });

            $(".TOTAL").each(function(index, element) {
                jumlah_total_value = (Number($(element).html()) + jumlah_total_value);
            });


            $("#jumlah_total_qty").html(format_digit(qty_total));
            $("#kubikasi_total").html(format_digit(kubikasi));
            $("#total_total_value").html(format_digit(jumlah_total_value));

        }

        function format_digit( toFormat ) {
            return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        };


    </script>

    </body>
    </html>
    <?php
}
else{
    echo "Anda tidak berhak..!";
}
?>