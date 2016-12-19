<?php
session_start();
include "koneksi.php";

if($_SESSION[USER]) {
    ?>

    <html>


    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <!--script src="jqm2/jquery-2.1.4.min.js"></script>
        <script-- src="jqm2/jquery.mobile-1.4.5.min.js"></script-->



        <!--script src="validation/jquery.validate.js"></script>
        <link rel="stylesheet" href="themes/9septi_season.min.css"/>
        <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css"/-->
        <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
        <!--link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/-->

<style>

    @header_background_color: #333;
    @header_text_color: #FDFDFD;
    @alternate_row_background_color: #DDD;

    @table_width: 1500px;
    @table_body_height: 300px;
    @column_one_width: 100px;
    @column_two_width: 100px;
    @column_three_width: 100px;

    .fixed_headers {
        width: @table_width;
        table-layout: fixed;
        border-collapse: collapse;

    th { text-decoration: underline; }
    th, td {
        padding: 5px;
        text-align: left;
    }

    td:nth-child(1), th:nth-child(1) { min-width: @column_one_width; }
    td:nth-child(2), th:nth-child(2) { min-width: @column_two_width; }
    td:nth-child(3), th:nth-child(3) { width: @column_three_width; }

    thead {
        background-color: @header_background_color;
        color: @header_text_color;
    tr {
        display: block;
        position: relative;
    }
    }
    tbody {
        display: block;
        overflow: auto;
        width: 100%;
        height: @table_body_height;
    tr:nth-child(even) {
        background-color: @alternate_row_background_color;
    }
    }
    }

    .old_ie_wrapper {
        height: @table_body_height;
        width: @table_width;
        overflow-x: hidden;
        overflow-y: auto;
    tbody { height: auto; }
    }
</style>



    </head>
    <body>


    <?php
    include "koneksi.php";

    if (isset($_POST[SAVE])) {


//$produk = $_POST[PRODUK];
        $produk = $_POST[PRODUK];
        $harga = $_POST[HARGA];
        $bulan_akhir = $_POST[bln_akhir];
        $forecast = $_POST[FORECAST];
        $total_value = $_POST[TOTAL_VALUE];
        $jumlah_forcast = count($forecast);


//echo $jumlah_forcast;


        $n = 0;
        while ($n <= $jumlah_forcast) {

            if ($forecast[$n] != "") {


                $sql_kj = "INSERT INTO kj SET TRIWULAN = '$_SESSION[TRIWULAN]',
                                            NAMA_DIST = '$_SESSION[USER]',
                                       NAMA_PRODUK = '$produk[$n]',
                                        HARGA = '$harga[$n]',
                                        BLN_AKHIR = '$bulan_akhir[$n]',
                                        FORECAST = '$forecast[$n]',
                                        TOTAL_VALUE = '$total_value[$n]'";

                //  echo $sql."<br>";

                $hasil_input_kj = mysqli_query($mysqli, $sql_kj);

            }
            $n++;
        }

        if ($hasil_input_kj) {

            //echo "input Barhasil";
            /*echo "<script>alert('Input Barhasil, silahkan input Forecast');
                          window.location='dist_forcest_next.php?TRI + +';</script>";*/

            header("Location: dist_forcest_next.php?TRI=$_SESSION[TRIWULAN]");


        } else {
            echo "input gagal";
            //echo "<script>alert('Input Gagal, Harap Coba lagi..!');window.location='dist_forcast.php';</script>";

        }


    }

    $bulan = $_GET[BULAN];

    echo $bulan;

    switch ($bulan) {
        case "JFM":
            $bulan = "Jan, Feb, Mar";
            break;
        case "AMJ":
            $bulan = "Apr, Mei, Jun";
            break;
        case "JAS":
            $bulan = "Jul, Agu, Sep";
            break;
        case "OND":
            $bulan = "Okt, Nov, Des";
            break;

    }
    $pecah = explode(", ", $bulan);

    echo $pecah[0] . "" . $pecah[1] . "" . $pecah[2];

    $_SESSION[TRIWULAN] = $pecah[0] . "-" . $pecah[1] . "-" . $pecah[2];

    echo "<h2 style='text-align: center'>Forecast Bulan : " . $bulan . "</h2>";


    /* ini untuk mencari apakah triwulan ini sudah ada di database, jika sudah maka dilarang masuk */
    $sql_block = "SELECT TRIWULAN FROM kj WHERE TRIWULAN = '$_SESSION[TRIWULAN]'";
    $hasil_block = mysqli_query($mysqli, $sql_block);
    $data_block = mysqli_fetch_assoc($hasil_block);

    if($data_block[TRIWULAN] == ""){

        echo "<script>
                    alert('Anda BELUM membuat Forecast bulan tersebut.!, Silahkan Add New Forcast terlebih dahulu');
                    window.location='dist.php';
              </script>";

    }


    ?>
    <div data-role="page" class="type-interior" data-theme="f">
        <!--div-- data-role="header">
            <h1>Forcast FORM </h1>

            <h2>Kokola Distributor 1.0</h2>
        </div-->
        <!--end header-->

        <div data-role="content">


            <form method="post" action="dist_forcast.php" data-ajax="false">


                <table border="1" cellpadding="1" cellspacing="0" align="center" id="bigtable" class="fixed_headers">
                   <thead>
                    <tr>
                        <td colspan="24">
                            <h3 align="center">EDIT FORECAST</h3>
                        </td>

                    </tr>
                    <tr>
                        <td align="center" colspan="24">
                            <h1>Forecast : <?php echo $_SESSION[TRIWULAN]; ?></h1>
                            <input type="hidden" value="<?php echo $_SESSION[TRIWULAN]; ?>" name="TRIWULAN">
                        </td>

                    </tr>
                    <tr>
                        <th colspan="24" align="center">Nama Distributor : <?php echo $_SESSION[USER]; ?></th>
                    </tr>

                    <tr>
                        <th rowspan="4">Nama Produk</th>
                        <th rowspan="4">Satuan</th>
                        <th rowspan="4">Harga</th>
                        <th rowspan="4">Sales 3 Bulan Terakhir</th>
                        <th rowspan="4">Forecast 3 Bulan KeDepan</th>
                        <th rowspan="4">Total Value</th>
                        <th colspan="3">Triwulan</th>
                        <th colspan="5"><?php echo $pecah[0];?> 2016</th>
                        <th colspan="5"><?php echo $pecah[1];?> 2016</th>
                        <th colspan="5"><?php echo $pecah[2];?> 2016</th>
                    </tr>
                    <tr>
                        <td align="center"><?php echo $pecah[0];?></td>
                        <td align="center"><?php echo $pecah[1];?></td>
                        <td align="center"><?php echo $pecah[2];?></td>
                        <td align="center">P1</td>
                        <td align="center">P2</td>
                        <td align="center">P3</td>
                        <td align="center">P4</td>
                        <td align="center">P5</td>
                        <td align="center">P1</td>
                        <td align="center">P2</td>
                        <td align="center">P3</td>
                        <td align="center">P4</td>
                        <td align="center">P5</td>
                        <td align="center">P1</td>
                        <td align="center">P2</td>
                        <td align="center">P3</td>
                        <td align="center">P4</td>
                        <td align="center">P5</td>
                    <tr>
                    <tr>
                        <td><input type="text" name="TRI_BLN1"></td>
                        <td><input type="text" name="TRI_BLN2"></td>
                        <td><input type="text" name="TRI_BLN2"></td>

                        <td><input type="text" name="P1_BLN1"></td>
                        <td><input type="text" name="P2_BLN1"></td>
                        <td><input type="text" name="P3_BLN1"></td>
                        <td><input type="text" name="P4_BLN1"></td>
                        <td><input type="text" name="P5_BLN1"></td>

                        <td><input type="text" name="P1_BLN2"></td>
                        <td><input type="text" name="P2_BLN2"></td>
                        <td><input type="text" name="P3_BLN2"></td>
                        <td><input type="text" name="P4_BLN2"></td>
                        <td><input type="text" name="P5_BLN2"></td>

                        <td><input type="text" name="P1_BLN3"></td>
                        <td><input type="text" name="P2_BLN3"></td>
                        <td><input type="text" name="P3_BLN3"></td>
                        <td><input type="text" name="P4_BLN3"></td>
                        <td><input type="text" name="P5_BLN3"></td>
                    <tr>
                   </thead>
                   <tbody>
                    <?php

                    //$sql_produk = "SELECT * FROM m_produk join dengan kj";

                    $sql_join = "SELECT m_produk.`NAMA_PRODUK`, m_produk.SATUAN, m_produk.HARGA,
                                 kj.`BLN_AKHIR`,
                                 kj.`FORECAST`,
                                 kj.`TOTAL_VALUE`,
                                 kj.`TRI_BLN1`,
                                 kj.`TRI_BLN2`,
                                 kj.`TRI_BLN3`,
                                 kj.`P1_BLN1`,
                                 kj.`P2_BLN1`,
                                 kj.`P3_BLN1`,
                                 kj.`P4_BLN1`,
                                 kj.`P5_BLN1`,
                                 kj.`P1_BLN2`,
                                 kj.`P2_BLN2`,
                                 kj.`P3_BLN2`,
                                 kj.`P4_BLN2`,
                                 kj.`P5_BLN2`,
                                 kj.`P1_BLN3`,
                                 kj.`P2_BLN3`,
                                 kj.`P3_BLN3`,
                                 kj.`P4_BLN3`,
                                 kj.`P5_BLN3`
                                 FROM m_produk
                                 LEFT JOIN kj
                                 ON m_produk.`NAMA_PRODUK` = kj.`NAMA_PRODUK` AND kj.TRIWULAN = 'Apr-Mei-Jun' AND kj.NAMA_DIST = 'user1'";

                    $hasil_join = mysqli_query($mysqli, $sql_join);

                    while ($data_join = mysqli_fetch_assoc($hasil_join)) {

                        echo "<tr>";
                        echo "<th align='left'>$data_join[NAMA_PRODUK]<input type='hidden' value='$data_join[NAMA_PRODUK]' name='PRODUK[]'> </th>";
                        echo "<th align='left'>$data_join[SATUAN]</th>";
                        echo "<td><div class='HARGA'>$data_join[HARGA]</div><input type='hidden' value='$data_join[HARGA]' name='HARGA[]'></td>";
                        echo "<td align='center'><input type='text' name='bln_akhir[]' id='bln_akhir' class='3bln_akhir' value='$data_join[BLN_AKHIR]'></td>";
                        echo "<td align='center'><input type='text' name='FORECAST[]' id='FORECAST' class='FORECAST' value='$data_join[FORECAST]'></td>";
                        echo "<td align='center'><input type='text' name='TOTAL_VALUE[]' id='TOTAL_VALUE' readonly class='TOTAL_VALUE' value='$data_join[TOTAL_VALUE]'></td>";
                        echo "<td align='center'><input type='text' name='TRI_BLN1[]' id='TRI_BLN1' readonly class='TRI_BLN1' value='$data_join[TRI_BLN1]'></td>";
                        echo "<td align='center'><input type='text' name='TRI_BLN2[]' id='TRI_BLN2' readonly class='TRI_BLN2' value='$data_join[TRI_BLN2]'></td>";
                        echo "<td align='center'><input type='text' name='TRI_BLN3[]' id='TRI_BLN3' readonly class='TRI_BLN3' value='$data_join[TRI_BLN3]'></td>";

                        echo "<td align='center'><input type='text' name='P1_BLN1[]' id='P1_BLN1' readonly class='P1_BLN1' value='$data_join[P1_BLN1]'></td>";
                        echo "<td align='center'><input type='text' name='P2_BLN1[]' id='P2_BLN1' readonly class='P2_BLN1' value='$data_join[P2_BLN1]'></td>";
                        echo "<td align='center'><input type='text' name='P3_BLN1[]' id='P3_BLN1' readonly class='P3_BLN1' value='$data_join[P3_BLN1]'></td>";
                        echo "<td align='center'><input type='text' name='P4_BLN1[]' id='P4_BLN1' readonly class='P4_BLN1' value='$data_join[P4_BLN1]'></td>";
                        echo "<td align='center'><input type='text' name='P5_BLN1[]' id='P5_BLN1' readonly class='P5_BLN1' value='$data_join[P5_BLN1]'></td>";

                        echo "<td align='center'><input type='text' name='P1_BLN2[]' id='P1_BLN2' readonly class='P1_BLN2' value='$data_join[P1_BLN2]'></td>";
                        echo "<td align='center'><input type='text' name='P2_BLN2[]' id='P2_BLN2' readonly class='P2_BLN2' value='$data_join[P2_BLN2]'></td>";
                        echo "<td align='center'><input type='text' name='P3_BLN2[]' id='P3_BLN2' readonly class='P3_BLN2' value='$data_join[P3_BLN2]'></td>";
                        echo "<td align='center'><input type='text' name='P4_BLN2[]' id='P4_BLN2' readonly class='P4_BLN2' value='$data_join[P4_BLN2]'></td>";
                        echo "<td align='center'><input type='text' name='P5_BLN2[]' id='P5_BLN2' readonly class='P5_BLN2' value='$data_join[P5_BLN2]'></td>";

                        echo "<td align='center'><input type='text' name='P1_BLN3[]' id='P1_BLN3' readonly class='P1_BLN3' value='$data_join[P1_BLN3]'></td>";
                        echo "<td align='center'><input type='text' name='P2_BLN3[]' id='P2_BLN3' readonly class='P2_BLN3' value='$data_join[P2_BLN3]'></td>";
                        echo "<td align='center'><input type='text' name='P3_BLN3[]' id='P3_BLN3' readonly class='P3_BLN3' value='$data_join[P3_BLN3]'></td>";
                        echo "<td align='center'><input type='text' name='P4_BLN3[]' id='P4_BLN3' readonly class='P4_BLN3' value='$data_join[P4_BLN3]'></td>";
                        echo "<td align='center'><input type='text' name='P5_BLN3[]' id='P5_BLN3' readonly class='P5_BLN3' value='$data_join[P5_BLN3]'></td>";


                        //echo "<td align='center'><input type='text' name='GROWTH[]' id='GROWTH' class='GROWTH' readonly></td>";
                        echo "</tr>";

                    }

                    ?>
                   </tbody>
                    <tr>
                        <td colspan="5" align="center">
                            <input type="submit" value="SAVE" name="SAVE">
                            <a href="dist_forcest_next.php" data-ajax="false" data-role="button">Next</a>
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

    echo "Anda tidak Berhak";
}


?>