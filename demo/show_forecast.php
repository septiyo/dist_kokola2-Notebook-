<?php
session_start();
error_reporting(0);
/*ini_set('display_errors', 1);*/
/*error_reporting(E_ALL|E_STRICT);*/
include "koneksi.php";
include "bantuan.class.php";

$bantuan = new bantuan();
$tanggal = $bantuan->tgl_indo("datetime");

if($_SESSION['USER']) {
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
        <link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>

        <link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">
        <link rel="stylesheet" href="jqtable/fixedColumns.dataTables.min.css">

        <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    /*"language": {
                        "thousands": "'"
                    }, not work*/
                    "scrollY": 300,
                    "scrollX": true,
                    "paging": false,
                    "fixedColumns": {
                        leftColumns: 2
                    },
                    "rowCallback": function( row, data, index ) {
                        // Bold the grade for all 'A' grade browsers
                        $('td:eq(0)', row).html( format_digit(data[1]) );
                        $('td:eq(1)', row).html( format_digit(data[2]) );
                        $('td:eq(2)', row).html( format_digit(data[3]) );
                        $('td:eq(3)', row).html( format_digit(data[4]) );
                        $('td:eq(4)', row).html( format_digit(data[5]) );
                        $('td:eq(5)', row).html( format_digit(data[6]) );
                        $('td:eq(6)', row).html( format_digit(data[7]) );
                        $('td:eq(7)', row).html( format_digit(data[8]) );
                    },
                } );
            } );

        </script>

        <style>
            .ui-corner-all{
                border-radius: 0!important;

            }
            .input-disabled{
                background-color:#EBEBE4;
                border:1px solid #ABADB3;
                padding:2px 1px;
            }


        </style>


    </head>
    <body>


    <?php
    if(isset($_POST['EDIT'])) {

        $produk      = $_POST['PRODUK'];
        $harga       = $_POST['HARGA'];
        $bulan_akhir = $_POST['bln_akhir'];
        $forecast    = $_POST['FORECAST'];
        $persen      = $_POST['PERSEN'];
        $bulan1      = $_POST['BULAN1'];
        $bulan2      = $_POST['BULAN2'];
        $bulan3      = $_POST['BULAN3'];
        $total_value = $_POST['TOTAL_VALUE'];


        /*$set_bln1 = $_POST[SET_BLN1];
         $set_bln2 = $_POST[SET_BLN2];
        $set_bln3 = $_POST[SET_BLN3];*/

        //print_r($_POST);

        $jumlah_forcast = count($forecast);
        $jumlah_total_value = count($total_value);


//echo $jumlah_forcast;


        $n = 0;
        while ($n <= $jumlah_total_value) {

            if ($total_value[$n] != "") {



                /*cari produk*/
                /*$sql_cari_produk_id = "SELECT ID FROM m_produk WHERE NAMA_PRODUK = '$produk[$n]'";
                $hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
                $data_id = mysqli_fetch_assoc($hasil_cari_produk_id);

                $id = $data_id[ID];*/





                $sql_kj = "UPDATE  kj SET   TGL = '$tanggal',
                                        BULAN_INPUT = '$_SESSION[BULAN_NOW]',

                                       BULAN1   = '$bulan1[$n]',
                                       BULAN2   = '$bulan2[$n]',
                                       BULAN3   = '$bulan3[$n]'

                                 WHERE TRIWULAN = '$_SESSION[TRIWULAN]'
                                  AND NAMA_DIST = '$_SESSION[USER]'
                                  AND NAMA_PRODUK = '$produk[$n]'";

                //echo $sql_kj;

                $hasil_input_kj = mysqli_query($mysqli, $sql_kj);

            }
            $n++;
        }

        if ($hasil_input_kj) {

            //echo "input Barhasil";
            echo "<script>alert('Edit Barhasil');
                            window.location='dist.php';
                  </script>";

            // header("Location: dist_forcest_next.php?TRI=$_SESSION[TRIWULAN]");


        } else {
            //echo "input gagal";
            echo "<script>alert('Edit Gagal, Harap Coba lagi..!');window.location='dist_forcast.php';</script>";

        }


    }//end isset edit

    $month = date('M');

    $_SESSION['BULAN_NOW'] = $month;

    $tri = $_GET['TRI'];
    $locked = $_GET['LOCKED'];


    $pecah = explode("-", $tri);

    echo $pecah[0] . "<br>" . $pecah[1] . "<br>" . $pecah[2];

    date_default_timezone_set("Asia/Jakarta");


    //$sql_cari_isi = "SELECT SET_BLN1, SET_BLN2, SET_BLN2 FROM kj WHERE TRIWULAN = '$tri' AND NAMA_DIST= '$_SESSION[USER]' ";
    $sql_cari_isi = "SELECT * FROM kj WHERE TRIWULAN = '$tri' AND NAMA_DIST= '$_SESSION[USER]'";
    $hasil_isi = mysqli_query($mysqli, $sql_cari_isi);
    $data_isi = mysqli_fetch_assoc($hasil_isi);


    echo "<h2 style='text-align: center'>Forecast Bulan : " . $tri . "</h2>";
   // echo "<h1>KUNAM  ".$_SESSION[TRIWULAN]."   ".$_SESSION[BULAN_NOW]."</h1>";

    ?>
    <div data-role="page" class="type-interior" data-theme="a">
        <div data-role="header">
            <h1>Edit Forcast FORM </h1>

            <h2>Kokola Distributor 2.5</h2>
        </div>
        <!--end header-->

        <div data-role="content">


            <form method="post" action="edit_forcast.php" data-ajax="false">
                <table>
                    <tr>
                        <td align="center" colspan="9">
                            <h3>Forecast : <?php echo $tri; ?></h3>
                            <input type="hidden" value="<?php echo $tri; ?>" name="TRIWULAN">
                        </td>

                    </tr>
                    <tr>
                        <th colspan="9" align="center">Nama Distributor : <?php echo $_SESSION[USER]; ?></th>
                    </tr>
                </table>
 <!--th width="30">Harga</th-->
                <!--table border="1" cellpadding="1" cellspacing="0" align="center"-->
                <table id="example"  class="order-column cell-border display" cellspacing="0" width="100%">
                    <thead>

                    <tr bgcolor="#7fffd4">
                        <th width="400" align='center'>Nama Produk</th>
                        <th width="100" align='center' class="header-lastmonth">Last 3 Month</th>
                        <th width="100" align='center' class="header-forecast">Forecast 3 Month</th>
                        <th width="100" align='center' class="header-persen"> % </th>
                        <th width="100" align='center' class="header-bulan1"><?php echo $pecah[0];?></th>
                        <th width="100" align='center' class="header-bulan2"><?php echo $pecah[1];?></th>
                        <th width="100" align='center' class="header-bulan3"><?php echo $pecah[2];?></th>
                     </tr>
                    </thead>

                    <tbody>

                    <?php

                  /*  $sql_produk = "SELECT m_produk.`NAMA_PRODUK`,
                                          m_produk.SATUAN,
                                          m_produk.HARGA,
                                                kj.`BLN_AKHIR`,
                                                kj.`FORECAST`,
                                                kj.`PERSEN`,
                                                kj.`BULAN1`,
                                                kj.`BULAN2`,
                                                kj.`BULAN3`,
                                                kj.`TOTAL_VALUE`,
                                                kj.SET_BLN1,
                                                kj.SET_BLN2,
                                                kj.SET_BLN3
                                 FROM m_produk
                                 LEFT JOIN kj
                                 ON m_produk.`NAMA_PRODUK` = kj.`NAMA_PRODUK` AND kj.TRIWULAN = '$tri' AND kj.NAMA_DIST = '$_SESSION[USER]'  ORDER BY NAMA_PRODUK ASC";*/

                      $sql_produk = "SELECT * FROM kj WHERE NAMA_DIST = '$_SESSION[USER]' AND TRIWULAN = '$tri' ORDER BY NAMA_PRODUK ASC";

                    $hasil_produk = mysqli_query($mysqli, $sql_produk);

                    while ($data_produk = mysqli_fetch_assoc($hasil_produk)) {



                        echo "<tr>";
                        echo "<th align='left' width='350'>$data_produk[NAMA_PRODUK]</th>";

                        //echo "<td align='right' class='harga'> $data_produk[HARGA]</td>";
                        echo "<td align='right' width='100' class='bln_akhir'>$data_produk[BLN_AKHIR]</td>";
                        echo "<td align='right' width='100' class='FORECAST'>$data_produk[FORECAST]</td>";
                        echo "<td align='right' width='100'>$data_produk[PERSEN]</td>";
                        echo "<td align='right' width='100' class='BULAN1'>$data_produk[BULAN1]</td>";
                        echo "<td align='right' width='100' class='BULAN2'>$data_produk[BULAN2]</td>";
                        echo "<td align='right' width='100' class='BULAN3'>$data_produk[BULAN3]</td>";
                        //echo "<td align='right' class='TOTAL_VALUE'>$data_produk[TOTAL_VALUE]<!--input type='text' name='TOTAL_VALUE[]' style='min-width: 100px' id='TOTAL_VALUE' class='TOTAL_VALUE' value='$data_produk[TOTAL_VALUE]' placeholder='...' --></td>";
                        echo "</tr>";


                        $jml_bln_akhir = $jml_bln_akhir + $data_produk[BLN_AKHIR];
                        $jml_forecast  = $jml_forecast  + $data_produk[FORECAST];
                        $bulan1  = $bulan1  + $data_produk[BULAN1];
                        $bulan2  = $bulan2  + $data_produk[BULAN2];
                        $bulan3  = $bulan3  + $data_produk[BULAN3];
                        $total_value  = $total_value  + $data_produk[TOTAL_VALUE];


                    }//end while

                    ?>
                    </tbody>
                    <tfoot>
                    <tr bgcolor="#7fffd4">
                        <th width="300">&nbsp;</th>
                        <!--th width="30">&nbsp;</th-->
                        <th width="100" class="footer-lastmonth" align="Right"><?php echo number_format($jml_bln_akhir);?></th>
                        <th width="100" class="footer-forecast" align="Right"><?php echo number_format($jml_forecast);?></th>
                        <!--th width="50"></th-->
                        <th width="100" class="footer-bulan1" align="Right"><?php echo number_format($bulan1);?></th>
                        <th width="100" class="footer-bulan2" align="Right"><?php echo number_format($bulan2);?></th>
                        <th width="100" class="footer-bulan3" align="Right"><?php echo number_format($bulan3);?></th>
                        <!--th width="100" class="footer-total-value" align="Right"><?php echo number_format($total_value);?></th-->
                        <!--th-- width="100">ID PRODUK</th-->
                        <!--th>Growth</th-->
                    </tr>
                    </tfoot>

                </table>
                <table align="center" width="300">
                    <tr>
                        <td colspan="5" align="center">
                            <!--input type="submit" value="EDIT" name="EDIT"-->
                            <!--a-- href="dist_forcest_next.php" data-ajax="false" data-role="button">Next</a-->
                            <a href="dist.php" data-ajax="false" data-role="button">Back</a>
                        </td>

                    </tr>
                </table>

            </form>
        </div>
        <!--end content-->
        <br><br>


        <div data-role="footer">
            <h2>Kokola Web Developer Department, 2016</h2>
        </div>
        <!--end of content-->

        <script>



            /*untuk disable inputan saat tidak boleh edit*/

            function format_digit( toFormat ) {
                return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            };

            $( document ).ready(function() {


                var kunci = '<?php echo $kunci;?>';

                //alert(kunci);
                if(kunci == 'KUNCI_0'){

                    $(".header-forecast").addClass('input-disabled');
                    $(".header-lastmonth").addClass('input-disabled');
                    $("tr td .FORECAST").prop('readOnly', true);
                    $("tr td .bln_akhir").prop('readOnly', true);


                }
                if(kunci == 'KUNCI_1'){

                    //$("input").prop('disabled', true);

                    $("tr td .BULAN1").prop('readOnly', true);
                    $("tr td .FORECAST").prop('readOnly', true);
                    $("tr td .bln_akhir").prop('readOnly', true);
                    $("tr td .TOTAL_VALUE").prop('readOnly', true);
                    $(".header-bulan1").addClass('input-disabled');
                    $(".header-forecast").addClass('input-disabled');
                    $(".header-lastmonth").addClass('input-disabled');
                    $(".header-persen").addClass('input-disabled');


                }
                else if(kunci == 'KUNCI_2') {

                    $("tr td .BULAN1").prop('readOnly', true);
                    $("tr td .BULAN2").prop('readOnly', true);
                    $("tr td .FORECAST").prop('readOnly', true);
                    $("tr td .bln_akhir").prop('readOnly', true);
                    $("tr td .TOTAL_VALUE").prop('readOnly', true);
                    $(".header-bulan1").addClass('input-disabled');
                    $(".header-bulan2").addClass('input-disabled');
                    $(".header-forecast").addClass('input-disabled');
                    $(".header-lastmonth").addClass('input-disabled');
                    $(".header-persen").addClass('input-disabled');

                    //alert(kunci);
                    //$("input").prop('disabled', false);
                }
                else if(kunci == 'KUNCI_3') {

                    $("tr td .BULAN1").prop('readOnly', true);
                    $("tr td .BULAN2").prop('readOnly', true);
                    $("tr td .BULAN3").prop('readOnly', true);
                    $("tr td .FORECAST").prop('readOnly', true);
                    $("tr td .bln_akhir").prop('readOnly', true);
                    $("tr td .TOTAL_VALUE").prop('readOnly', true);
                    $(".header-bulan1").addClass('input-disabled');
                    $(".header-bulan2").addClass('input-disabled');
                    $(".header-bulan3").addClass('input-disabled');
                    $(".header-forecast").addClass('input-disabled');
                    $(".header-lastmonth").addClass('input-disabled');
                    $(".header-persen").addClass('input-disabled');
                    $(".header-totalvalue").addClass('input-disabled');

                    /*  $("tr td .BULAN1").prop('readOnly', true);
                     $("tr td .BULAN2").prop('readOnly', true);
                     $("tr td .BULAN3").prop('readOnly', true);
                     $("tr td .FORECAST").prop('readOnly', true);
                     $("tr td .bln_akhir").prop('readOnly', true);
                     $("tr td .TOTAL_VALUE").prop('readOnly', true);
                     $(".header-bulan1").addClass('input-disabled');
                     $(".header-bulan2").addClass('input-disabled');
                     $(".header-bulan3").addClass('input-disabled');
                     $(".header-forecast").addClass('input-disabled');
                     $(".header-lastmonth").addClass('input-disabled');
                     $(".header-persen").addClass('input-disabled');*/

                    //alert(kunci);
                    //$("input").prop('disabled', false);
                }
                else if(kunci == 'LOCKED'){

                    $("tr td .BULAN1").prop('readOnly', true);
                    $("tr td .BULAN2").prop('readOnly', true);
                    $("tr td .BULAN3").prop('readOnly', true);
                    $("tr td .FORECAST").prop('readOnly', true);
                    $("tr td .bln_akhir").prop('readOnly', true);
                    $("tr td .TOTAL_VALUE").prop('readOnly', true);
                    $(".header-bulan1").addClass('input-disabled');
                    $(".header-bulan2").addClass('input-disabled');
                    $(".header-bulan3").addClass('input-disabled');
                    $(".header-forecast").addClass('input-disabled');
                    $(".header-lastmonth").addClass('input-disabled');
                    $(".header-persen").addClass('input-disabled');
                    $(".header-totalvalue").addClass('input-disabled');
                }



                /*Untuk Total*/

             /*  var sum = 0;
               var forecast = 0;
               var bulan1 = 0;
               var bulan2 = 0;
               var bulan3 = 0;
               var total_value = 0;
                //var total_bln_akhir = 0;
                $('.bln_akhir').each(function(index, element){


                    if($(element).text() != ""){

                        sum = (Number($(element).text()) + sum);
                    }
                    //alert(sum);
                    $('.footer-lastmonth').text(format_digit(sum));
                });

                $('.FORECAST').each(function(index, element){


                    if($(element).text() != ""){

                        forecast = (Number($(element).text()) + forecast);
                    }
                    //alert(sum);
                    $('.footer-forecast').text(format_digit(forecast));
                });

                $('.BULAN1').each(function(index, element){


                    if($(element).text() != ""){

                        bulan1 = (Number($(element).text()) + bulan1);
                    }
                    //alert(sum);
                    $('.footer-bulan1').text(format_digit(bulan1));
                });

                $('.BULAN2').each(function(index, element){


                    if($(element).text() != ""){

                        bulan2 = (Number($(element).text()) + bulan2);
                    }
                    //alert(sum);
                    $('.footer-bulan2').text(format_digit(bulan2));
                });

                $('.BULAN3').each(function(index, element){


                    if($(element).text() != ""){

                        bulan3 = (Number($(element).text()) + bulan3);
                    }
                    //alert(sum);
                    $('.footer-bulan3').text(format_digit(bulan3));
                });

                $('.TOTAL_VALUE').each(function(index, element){


                    if($(element).text() != ""){

                        total_value = (Number($(element).text()) + total_value);
                    }
                    //alert(sum);
                    $('.footer-total-value').text(format_digit(total_value));
                });*/



                function format_digit( toFormat ) {
                    return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                };



            });//document ready


            /*ini untuko menhitungn Total value*/
            $("tr td .FORECAST").on("keyup", function () {
                var hasil = Number($(this).val()) * Number($(this).parents('tr').find('.HARGA').html());
                $(this).parents('tr').find('.TOTAL_VALUE').val(hasil);


            });

            /*untuk hitung persen*/

            $("tr td .FORECAST").on("change", function () {

                var forcast   = Number($(this).val());
                var bln_akhir = Number($(this).parents('tr').find('.bln_akhir').val());
                //var bulan1    = Number($(this).parents('tr').find('.BULAN1').val());
                //var bulan1    = 0;
                var bulan2    = 0;
                var bulan3    = 0;

                var persen = Math.round((forcast - bln_akhir) / bln_akhir * 100);
                $(this).parents('tr').find('.PERSEN').val(persen);

                if(persen < 20){

                    alert('Prosentase tidak boleh kurang dari 20%');
                    $(this).parents('tr').find('.FORECAST').focus();

                }

                /*if((bulan1 == "0") && (bulan2 == "0") && (bulan3 == "0")){

                 var bagi_3 = Math.round(Number(forcast / 3));
                 }*/


                $(this).parents('tr').find('.BULAN1').val(forcast);
                $(this).parents('tr').find('.BULAN2').val(bulan2);
                $(this).parents('tr').find('.BULAN3').val(bulan3);

                /*alert(bulan1);
                 alert(bulan2);
                 alert(bulan3);*/
            });

            $("tr td .BULAN1").on("keyup", function(){

                var forcast   = Number($(this).parents('tr').find('.FORECAST').val());
                var bulan1    = Number($(this).val());

                //var kolom_lain =  Math.round(Number((forcast - bulan1) / 2));
                var kolom_lain =  Math.round(Number((forcast - bulan1) ));
                //alert(kolom_lain);

                $(this).parents('tr').find('.BULAN2').val(kolom_lain);
                //$(this).parents('tr').find('.BULAN3').val(kolom_lain);


            });

            $("tr td .BULAN2").on("keyup", function(){

                var forcast   = Number($(this).parents('tr').find('.FORECAST').val());
                var bulan1    = Number($(this).parents('tr').find('.BULAN1').val());
                var bulan2    = Number($(this).val());

                var kolom_lain =  Math.round(Number((forcast - bulan1) - bulan2));

                //alert(kolom_lain);

                $(this).parents('tr').find('.BULAN3').val(kolom_lain);



            });



            function format_digit( toFormat ) {
                return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            };

            $('#formx').submit(function( event ) {
                var bol = false;

                $(".PERSEN").each(function(index, element) {
                    if ($(this).val() != "") {
                        bol = true;
                        if ($(this).val() < 20) {
                            alert( "Harus diatas 20%" );
                            event.preventDefault();
                            return false;
                        }
                    }
                });
                if (bol == false) {
                    alert( "Data harus diisi" );
                    event.preventDefault();
                    return false;
                }
            });



            /*ini untuk menghitung growth*/
            /*$("tr td .3bln_akhir").on("keyup",function() {
             var hasil = (Number($(this).parents('tr').find('.FORECAST').val()) - Number($(this).val())) / Number($(this).val());
             $(this).parents('tr').find('.GROWTH').val(hasil);
             });*/

        </script>
       </div>
    </body>
    </html>
    <?php
}
else{

    echo "Anda tidak Berhak";
}


?>