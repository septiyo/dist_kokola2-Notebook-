<?php
session_start();
/*ini_set('display_errors', 1);*/
/*error_reporting(E_ALL|E_STRICT);*/
include "koneksi.php";
include "bantuan.class.php";

$bantuan = new bantuan();
$tanggal = $bantuan->tgl_indo("datetime");

echo $_SESSION[BULAN_NOW];


//$bantuan = new bantuan();
//  $tanggal = $bantuan->tgl_indo("datetime");


if($_SESSION[USER]) {
    ?>

    <html>


    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <script src="jqm2/jquery-2.1.4.min.js"></script>
        <script src="jqm2/jquery.mobile-1.4.5.min.js"></script>
        <!--script-- src="jqtable/jquery.dataTables.min.js"></script-->
        <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
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
               "fixedColumns": true /*{
                        leftColumns: 2
                    },*/
               /*"columnDefs":[
                    {
                       "targets": [ 10 ],
                        "visible": false

                    }
                 ],*/
                });


            } );

        </script>

<style>
   .ui-corner-all{
       border-radius: 0!important;

   }

</style>


    </head>
    <body>


    <?php




    if (isset($_POST[SAVE])) {


//$produk = $_POST[PRODUK];
       // $id_jos      = $_POST[ID_JOS];
        $produk      = $_POST[PRODUK];
        $harga       = $_POST[HARGA];
        $bulan_akhir = $_POST[bln_akhir];
        $forecast    = $_POST[FORECAST];
        $persen      = $_POST[PERSEN];
        $bulan1      = $_POST[BULAN1];
        $bulan2      = $_POST[BULAN2];
        $bulan3      = $_POST[BULAN3];
        $total_value = $_POST[TOTAL_VALUE];

        $jumlah_forcast = count($forecast);





//echo $jumlah_forcast;


        $n = 0;
        while ($n <= $jumlah_forcast) {

            if($forecast[$n] != "") {


                date_default_timezone_set("Asia/Jakarta");

                $month = date(M);


              /*cari produk*/
                $sql_cari_produk_id = "SELECT ID FROM m_produk WHERE NAMA_PRODUK = '$produk[$n]'";
                $hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
                $data_id = mysqli_fetch_assoc($hasil_cari_produk_id);

                $id = $data_id[ID];




                $sql_kj = "INSERT INTO kj SET  TGL = '$tanggal',
                                              TRIWULAN = '$_SESSION[TRIWULAN]',
                                              BULAN_INPUT = '$month',
                                             NAMA_DIST = '$_SESSION[USER]',
                                             ID_PRODUK = '$id',
                                           NAMA_PRODUK = '$produk[$n]',
                                                 HARGA = '$harga[$n]',
                                             BLN_AKHIR = '$bulan_akhir[$n]',
                                              FORECAST = '$forecast[$n]',
                                              PERSEN   = '$persen[$n]',
                                              BULAN1   = '$bulan1[$n]',
                                              BULAN2   = '$bulan2[$n]',
                                              BULAN3   = '$bulan3[$n]',
                                        TOTAL_VALUE    = '$total_value[$n]',
                                           SET_BLN1 = 'ISI'";

                  //echo $sql_kj."<br>";

                $hasil_input_kj = mysqli_query($mysqli, $sql_kj);

            }
            $n++;
        }

        if ($hasil_input_kj) {

            //echo "input Barhasil";
            echo "<script>alert('Input Barhasil');
                            window.location='dist.php';
                  </script>";

           // header("Location: dist_forcest_next.php?TRI=$_SESSION[TRIWULAN]");


        } else {
            //echo "input gagal";
            echo "<script>alert('Input Gagal, Harap Coba lagi..!');window.location='dist_forcast.php';</script>";

        }


    }



    $bulan = $_GET[BULAN];

   // echo $bulan;

    /*switch ($bulan) {
        case "JFM":
            $bulan = "Jan, Feb, Mar";
            break;
        case "AMJ":
            $bulan = "Apr, May, Jun";
            break;
        case "JAS":
            $bulan = "Jul, Aug, Sep";
            break;
        case "OND":
            $bulan = "Oct, Nov, Dec";
            break;
    }*/


    $pecah = explode("-", $bulan);

    echo $pecah[0] . "" . $pecah[1] . "" . $pecah[2];

    echo $_SESSION[TRIWULAN];


    echo "<h2 style='text-align: center'>Forecast Bulan : " . $bulan . "</h2>";


    /* ini untuk mencari apakah triwulan ini sudah ada di database, jika sudah maka dilarang masuk */
    $sql_block = "SELECT TRIWULAN,NAMA_DIST FROM kj WHERE NAMA_DIST = '$_SESSION[USER]' GROUP BY TRIWULAN ORDER BY ID DESC";
    $hasil_block = mysqli_query($mysqli, $sql_block);

    while($data_block = mysqli_fetch_assoc($hasil_block)){

       if($data_block[TRIWULAN] == $_SESSION[TRIWULAN]){

           ?>

             <script>
                       alert('<?php echo "Anda sudah pernah membuat Forecast triwulan  $_SESSION[TRIWULAN] , anda hannya bisa me Revisinya"; ?>');
                       window.location='dist.php';

             </script>


           <?php


       }

    }//end while








    ?>
    <div data-role="page" class="type-interior" data-theme="a">
        <div data-role="header">
            <h1>Forcast FORM </h1>

            <h2>Kokola Distributor 2.5</h2>
        </div>
        <!--end header-->

        <div data-role="content">


            <form method="post" action="dist_forcast.php" data-ajax="false">
   <table>
                <tr>
                    <td align="center" colspan="9">
                        <h3>Forecast : <?php echo $_SESSION[TRIWULAN]; ?></h3>
                        <input type="hidden" value="<?php echo $_SESSION[TRIWULAN]; ?>" name="TRIWULAN">
                    </td>

                </tr>
                <tr>
                    <th colspan="9" align="center">Nama Distributor : <?php echo $_SESSION[USER]; ?></th>
                </tr>
    </table>

                <!--table border="1" cellpadding="1" cellspacing="0" align="center"-->
                <table id="example"  class="order-column display" cellspacing="0" width="100%">
                    <thead>

                    <tr bgcolor="#7fffd4">
                        <th width="100">Nama Produk</th>
                        <th width="30">Harga</th>
                        <th width="50">Last 3 Month</th>
                        <th width="50">Forecast 3 Month</th>
                        <th width="50"> % </th>
                        <th width="100"><?php echo $pecah[0];?></th>
                        <th width="100"><?php echo $pecah[1];?></th>
                        <th width="100"><?php echo $pecah[2];?></th>
                        <th width="100">Total Value</th>
                        <!--th-- width="100">ID PRODUK</th-->
                        <!--th>Growth</th-->
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $sql_produk = "SELECT * FROM m_produk ORDER BY NAMA_PRODUK ASC";
                    $hasil_produk = mysqli_query($mysqli, $sql_produk);

                    while ($data_produk = mysqli_fetch_assoc($hasil_produk)) {

                        echo "<tr>";
                        echo "<td align='left'> $data_produk[NAMA_PRODUK] <input type='hidden' value='$data_produk[NAMA_PRODUK]' name='PRODUK[]'></td>";
                        echo "<td><div class='HARGA'>$data_produk[HARGA]</div><input type='hidden' value='$data_produk[HARGA]' name='HARGA[]'>
                                   <!--input type='hidden' name='ID_JOS[]' style='min-width: 100px' id='ID_JOS' class='ID_JOS' value='$data_produk[ID]'-->
                             </td>";
                        echo "<td align='center'><input type='text' name='bln_akhir[]' id='bln_akhir' class='bln_akhir' placeholder='...' ></td>";
                        echo "<td align='center'><input type='text' name='FORECAST[]' id='FORECAST' class='FORECAST' placeholder='...' ></td>";
                        echo "<td align='center'><input type='text' name='PERSEN[]' style='min-width: 30px'   id='PERSEN' class='PERSEN' readonly placeholder='...' ></td>";
                        echo "<td align='center'><input type='text' name='BULAN1[]' style='min-width: 100px'   id='BULAN1' class='BULAN1' placeholder='...'  ></td>";
                        echo "<td align='center'><input type='text' name='BULAN2[]' style='min-width: 100px'   id='BULAN2' class='BULAN2' placeholder='...'  ></td>";
                        echo "<td align='center'><input type='text' name='BULAN3[]' style='min-width: 100px'   id='BULAN3' class='BULAN3' placeholder='...'  ></td>";
                        echo "<td align='center'><input type='text' name='TOTAL_VALUE[]' style='min-width: 100px' id='TOTAL_VALUE' class='TOTAL_VALUE' placeholder='...' ></td>";
                        //echo "<td class='center'><input type='text' name='ID_JOS[]' style='min-width: 100px' id='ID_JOS' class='ID_JOS' value='$data_produk[ID]'></td>";
                        //echo "<td align='center'><input type='text' name='GROWTH[]' id='GROWTH' class='GROWTH' readonly></td>";
                        echo "</tr>";

                    }

                    ?>
                    </tbody>

                </table>
                <table align="center" width="300">
                    <tr>
                        <td colspan="5" align="center">
                            <input type="submit" value="SAVE" name="SAVE" id="SAVE">
                            <!--a-- href="syarat.php" class="ui-shadow ui-btn ui-corner-all ui-btn-inline" data-transition="pop" id="SYARAT">SYARAT</a-->
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

            /*$(document).ready(function(){
                //$(".entah").hide();
                $(this).parents('tr').find('.entah').hide();

            });*/
            /*$(".FORECAST").on("keyup", function() {
             var hasil = $(this).val() * $(this).find('.HARGA').val();
             $(this).find('.TOTAL_VALUE').val(hasil);
             });*/

            /*$(".B").on("keyup", function() {
             var hasil = $(this).val() * $(this).siblings('.A').val();
             $(this).siblings('.C').val(hasil);
             });*/


            /*untuk buka dialog saat save*/

            /*$("#SAVE").on("click", function(){

                $("#SYARAT").trigger('click');
            });*/


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




            /*ini untuk menghitung growth*/
            /*$("tr td .3bln_akhir").on("keyup",function() {
             var hasil = (Number($(this).parents('tr').find('.FORECAST').val()) - Number($(this).val())) / Number($(this).val());
             $(this).parents('tr').find('.GROWTH').val(hasil);
             });*/

        </script>
    </body>
    </html>
<?php
}
else{

    echo "Anda tidak Berhak";
}


 ?>