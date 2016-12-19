<?php
session_start();
include "koneksi.php";

if($_SESSION[USER]) {

?>
    <html>


    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <script src="jqm2/jquery-2.1.4.min.js"></script>
        <script src="jqm2/jquery.mobile-1.4.5.min.js"></script>

        <script src="validation/jquery.validate.js"></script>
        <link rel="stylesheet" href="themes/9septi_season.min.css"/>
        <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css"/>
        <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
        <link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>

    </head>
    <body>


    <?php
    include "koneksi.php";

    if (isset($_POST[SUBMIT])) {

        $tri = $_POST[TRI];

        $persen_1 = $_POST[PERSEN_1];
        $persen_2 = $_POST[PERSEN_2];
        $persen_3 = $_POST[PERSEN_3];

        $p1_bln1  = $_POST[P1_BLN1];
        $p2_bln1  = $_POST[P2_BLN1];
        $p3_bln1  = $_POST[P3_BLN1];
        $p4_bln1  = $_POST[P4_BLN1];
        $p5_bln1  = $_POST[P5_BLN1];

        $p1_bln2  = $_POST[P1_BLN2];
        $p2_bln2  = $_POST[P2_BLN2];
        $p3_bln2  = $_POST[P3_BLN2];
        $p4_bln2  = $_POST[P4_BLN2];
        $p5_bln2  = $_POST[P5_BLN2];

        $p1_bln3  = $_POST[P1_BLN3];
        $p2_bln3  = $_POST[P2_BLN3];
        $p3_bln3  = $_POST[P3_BLN3];
        $p4_bln3  = $_POST[P4_BLN3];
        $p5_bln3  = $_POST[P5_BLN3];



        $update_forecast = "INSERT INTO forecast SET  TRIWULAN = '$tri',
                                                      DIST = '$_SESSION[USER]',
                                                      TRI_BLN1 = '$persen_1',
                                                      TRI_BLN2 = '$persen_2',
                                                      TRI_BLN3 = '$persen_3',
                                                      P1_BLN1  = '$p1_bln1',
                                                      P2_BLN1  = '$p2_bln1',
                                                      P3_BLN1  = '$p3_bln1',
                                                      P4_BLN1  = '$p4_bln1',
                                                      P5_BLN1  = '$p5_bln1',
                                                      P1_BLN2  = '$p1_bln2',
                                                      P2_BLN2  = '$p2_bln2',
                                                      P3_BLN2  = '$p3_bln2',
                                                      P4_BLN2  = '$p4_bln2',
                                                      P5_BLN2  = '$p5_bln2',
                                                      P1_BLN3  = '$p1_bln3',
                                                      P2_BLN3  = '$p2_bln3',
                                                      P3_BLN3  = '$p3_bln3',
                                                      P4_BLN3  = '$p4_bln3',
                                                      P5_BLN3  = '$p5_bln3'";

        $hasil_update_forecast = mysqli_query($mysqli, $update_forecast);

       /*ambil hasil KJ yang baru diinput*/

        $sql_cari = "SELECT * FROM kj WHERE TRIWULAN = '$tri' AND NAMA_DIST = '$_SESSION[USER]'";
        $hasil_cari = mysqli_query($mysqli, $sql_cari);

        while($data_cari = mysqli_fetch_assoc($hasil_cari)){

            $forecast    = $data_cari[FORECAST];
            $nama_produk = $data_cari[NAMA_PRODUK];


            /*hitung Forecast tiap bulan*/

            $hasil_forecast_mentah1 = ($persen_1 * $forecast) / 100;
            $hasil_forecast_mentah2 = ($persen_2 * $forecast) / 100;
            $hasil_forecast_mentah3 = ($persen_3 * $forecast) / 100;

            $hasil_forecast1 = round($hasil_forecast_mentah1);
            $hasil_forecast2 = round($hasil_forecast_mentah2);
            $hasil_forecast3 = round($hasil_forecast_mentah3);


            /*hitung forecast tiap minggu*/

            /*Bulan 1*/
              $for_minggu1_bln1x = ($hasil_forecast1 * $p1_bln1) / 100;
              $for_minggu2_bln1x = ($hasil_forecast1 * $p2_bln1) / 100;
              $for_minggu3_bln1x = ($hasil_forecast1 * $p3_bln1) / 100;
              $for_minggu4_bln1x = ($hasil_forecast1 * $p4_bln1) / 100;
              $for_minggu5_bln1x = ($hasil_forecast1 * $p5_bln1) / 100;

               $for_minggu1_bln1 = round($for_minggu1_bln1x);
               $for_minggu2_bln1 = round($for_minggu2_bln1x);
               $for_minggu3_bln1 = round($for_minggu3_bln1x);
               $for_minggu4_bln1 = round($for_minggu4_bln1x);
               $for_minggu5_bln1 = round($for_minggu5_bln1x);

            /*Bulan 2*/
            $for_minggu1_bln2x = ($hasil_forecast2 * $p1_bln2) / 100;
            $for_minggu2_bln2x = ($hasil_forecast2 * $p2_bln2) / 100;
            $for_minggu3_bln2x = ($hasil_forecast2 * $p3_bln2) / 100;
            $for_minggu4_bln2x = ($hasil_forecast2 * $p4_bln2) / 100;
            $for_minggu5_bln2x = ($hasil_forecast2 * $p5_bln2) / 100;

               $for_minggu1_bln2 = round($for_minggu1_bln2x);
               $for_minggu2_bln2 = round($for_minggu2_bln2x);
               $for_minggu3_bln2 = round($for_minggu3_bln2x);
               $for_minggu4_bln2 = round($for_minggu4_bln2x);
               $for_minggu5_bln2 = round($for_minggu5_bln2x);

            /*Bulan 3*/

            $for_minggu1_bln3x = ($hasil_forecast3 * $p1_bln3) / 100;
            $for_minggu2_bln3x = ($hasil_forecast3 * $p2_bln3) / 100;
            $for_minggu3_bln3x = ($hasil_forecast3 * $p3_bln3) / 100;
            $for_minggu4_bln3x = ($hasil_forecast3 * $p4_bln3) / 100;
            $for_minggu5_bln3x = ($hasil_forecast3 * $p5_bln3) / 100;

               $for_minggu1_bln3 = round($for_minggu1_bln3x);
               $for_minggu2_bln3 = round($for_minggu2_bln3x);
               $for_minggu3_bln3 = round($for_minggu3_bln3x);
               $for_minggu4_bln3 = round($for_minggu4_bln3x);
               $for_minggu5_bln3 = round($for_minggu5_bln3x);



            $update_kj = "UPDATE kj SET TRI_BLN1 = '$hasil_forecast1',
                                        TRI_BLN2 = '$hasil_forecast2',
                                        TRI_BLN3 = '$hasil_forecast3',
                                        P1_BLN1  = '$for_minggu1_bln1',
                                        P2_BLN1  = '$for_minggu2_bln1',
                                        P3_BLN1  = '$for_minggu3_bln1',
                                        P4_BLN1  = '$for_minggu4_bln1',
                                        P5_BLN1  = '$for_minggu5_bln1',
                                        P1_BLN2  = '$for_minggu1_bln2',
                                        P2_BLN2  = '$for_minggu2_bln2',
                                        P3_BLN2  = '$for_minggu3_bln2',
                                        P4_BLN2  = '$for_minggu4_bln2',
                                        P5_BLN2  = '$for_minggu5_bln2',
                                        P1_BLN3  = '$for_minggu1_bln3',
                                        P2_BLN3  = '$for_minggu2_bln3',
                                        P3_BLN3  = '$for_minggu3_bln3',
                                        P4_BLN3  = '$for_minggu4_bln3',
                                        P5_BLN3  = '$for_minggu5_bln3'
                                        WHERE NAMA_PRODUK = '$nama_produk'";

            $hasil_update_kj = mysqli_query($mysqli, $update_kj);



        }//end while






        if($hasil_update_kj){

            echo "<script>alert('Berhasil');window.location=dist.php;</script>";
        }
        else{

            echo "<script>alert('Berhasil');window.location=dist.php;</script>";
        }





    }//end isset


    //echo $_SESSION[TRIWULAN];
    $triwulan = $_GET[TRI];

    echo "<h2 style='text-align: center'>Forecast Bulan : " . $triwulan . "</h2>";

    $pecah = explode("-", $triwulan);

    echo $pecah[0] . "" . $pecah[1] . "" . $pecah[2];

    ?>
    <div data-role="page" class="type-interior" data-theme="f">
        <div data-role="header">
            <h1>Forcast FORM </h1>

            <h2>Kokola Distributor 1.0</h2>
        </div>
        <!--end header-->

        <div data-role="content">


            <form method="post" action="dist_forcest_next.php" data-ajax="false">


                <table border="1" cellpadding="1" cellspacing="0" align="center">
                    <tr>
                        <td colspan="3" align="center">
                            <h4>Input Prosentase</h4>

                            <h2><?php echo $triwulan; ?></h2>
                            <input type="hidden" value="<?php echo $triwulan; ?>" name="TRI">

                        </td>

                    </tr>
                    <tr>
                        <th>Triwulan 2016 / <?php echo $pecah[0]; ?><br><input type="text" name="PERSEN_1"
                                                                               placeholder="...%"></th>
                        <th>Triwulan 2016 / <?php echo $pecah[1]; ?><br><input type="text" name="PERSEN_2"
                                                                               placeholder="...%"></th>
                        <th>Triwulan 2016 / <?php echo $pecah[2]; ?><br><input type="text" name="PERSEN_3"
                                                                               placeholder="...%" s></th>

                    </tr>
                    <tr>
                        <th><?php echo $pecah[0]; ?> 2016<br>
                            <input type="text" name="P1_BLN1" placeholder="P1">
                            <input type="text" name="P2_BLN1" placeholder="P2">
                            <input type="text" name="P3_BLN1" placeholder="P3">
                            <input type="text" name="P4_BLN1" placeholder="P4">
                            <input type="text" name="P5_BLN1" placeholder="P5">

                        </th>
                        <th><?php echo $pecah[1]; ?> 2016<br>
                            <input type="text" name="P1_BLN2" placeholder="P1">
                            <input type="text" name="P2_BLN2" placeholder="P2">
                            <input type="text" name="P3_BLN2" placeholder="P3">
                            <input type="text" name="P4_BLN2" placeholder="P4">
                            <input type="text" name="P5_BLN2" placeholder="P5">

                        </th>
                        <th><?php echo $pecah[2]; ?> 2016<br>
                            <input type="text" name="P1_BLN3" placeholder="P1">
                            <input type="text" name="P2_BLN3" placeholder="P2">
                            <input type="text" name="P3_BLN3" placeholder="P3">
                            <input type="text" name="P4_BLN3" placeholder="P4">
                            <input type="text" name="P5_BLN3" placeholder="P5">

                        </th>
                    </tr>
                    <tr>
                        <td align="center" colspan="3"><input type="submit" value="SUBMIT" name="SUBMIT"></td>
                    </tr>
                </table>

                <br><br>


            </form>
            <a href="dist.php" data-ajax="false" data-role="button">Back</a>
        </div>
        <!--end content-->
        <br><br>


        <div data-role="footer">
            <h2>Kokola Web Developer Department, 2016</h2>
        </div>
        <!--end of content-->

        <script>
            /*$(".FORECAST").on("keyup", function() {
             var hasil = $(this).val() * $(this).find('.HARGA').val();
             $(this).find('.TOTAL_VALUE').val(hasil);
             });*/

            /*$(".B").on("keyup", function() {
             var hasil = $(this).val() * $(this).siblings('.A').val();
             $(this).siblings('.C').val(hasil);
             });*/
            /*ini untuko menhitungn Total value*/
            $("tr td .FORECAST").on("keyup", function () {
                var hasil = Number($(this).val()) * Number($(this).parents('tr').find('.HARGA').html());
                $(this).parents('tr').find('.TOTAL_VALUE').val(hasil);
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

 echo "Anda tidak berhak";
}

?>