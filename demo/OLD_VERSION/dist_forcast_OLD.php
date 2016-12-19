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
    $sql_block = "SELECT TRIWULAN FROM kj";
    $hasil_block = mysqli_query($mysqli, $sql_block);
    $data_block = mysqli_fetch_assoc($hasil_block);

    if($data_block[TRIWULAN] == $_SESSION[TRIWULAN]){

        echo "<script>
                    alert('Anda sudah pernah membuat Forecast bulan tersebut.!, anda hannya bisa mengeditnya');
                    window.location='dist.php';
              </script>";

    }





    ?>
    <div data-role="page" class="type-interior" data-theme="f">
        <div data-role="header">
            <h1>Forcast FORM </h1>

            <h2>Kokola Distributor 1.0</h2>
        </div>
        <!--end header-->

        <div data-role="content">


            <form method="post" action="dist_forcast.php" data-ajax="false">


                <table border="1" cellpadding="1" cellspacing="0" align="center">
                    <tr>
                        <td align="center" colspan="6">
                            <h1>Forecast : <?php echo $_SESSION[TRIWULAN]; ?></h1>
                            <input type="hidden" value="<?php echo $_SESSION[TRIWULAN]; ?>" name="TRIWULAN">
                        </td>

                    </tr>
                    <tr>
                        <th colspan="6" align="center">Nama Distributor : <?php echo $_SESSION[USER]; ?></th>
                    </tr>
                    <!--tr>
                        <td colspan="7">Triwulan 2016</td>
                    <tr-->
                    <tr>
                        <th>Nama Produk Sub Group</th>
                        <th>Harga</th>
                        <th>Sales 3 Bulan Terakhir</th>
                        <th>Forecast 3 Bulan KeDepan</th>
                        <th>Total Value</th>
                        <!--th>Growth</th-->
                    </tr>

                    <?php

                    $sql_produk = "SELECT * FROM m_produk";
                    $hasil_produk = mysqli_query($mysqli, $sql_produk);

                    while ($data_produk = mysqli_fetch_assoc($hasil_produk)) {

                        echo "<tr>";
                        echo "<th align='left'>$data_produk[NAMA_PRODUK]<input type='hidden' value='$data_produk[NAMA_PRODUK]' name='PRODUK[]'> </th>";

                        echo "<td><div class='HARGA'>$data_produk[HARGA]</div><input type='hidden' value='$data_produk[HARGA]' name='HARGA[]'></td>";
                        echo "<td align='center'><input type='text' name='bln_akhir[]' id='bln_akhir' class='3bln_akhir' placeholder='...'></td>";
                        echo "<td align='center'><input type='text' name='FORECAST[]' id='FORECAST' class='FORECAST' placeholder='...'></td>";
                        echo "<td align='center'><input type='text' name='TOTAL_VALUE[]' id='TOTAL_VALUE' class='TOTAL_VALUE'></td>";
                        //echo "<td align='center'><input type='text' name='GROWTH[]' id='GROWTH' class='GROWTH' readonly></td>";
                        echo "</tr>";

                    }

                    ?>
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