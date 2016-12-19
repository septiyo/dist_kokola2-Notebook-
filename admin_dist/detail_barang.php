<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <script src="../jqm2/jquery-2.1.4.min.js"></script>

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
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

$(document).ready(function(){

    $('#myTable').DataTable();

   //alert('jos');
});

   /*$(document).ready(function () {
                    $('#kunam').DataTable({
                        "scrollY": 450,
                        "scrollX": false,

                         "scrollCollapse": true,
                        "ordering": false,
                        "paging": false,
						"bFilter": false
                    });*/



</script>

</head>




<body>
<div data-role="page" class="type-interior" data-theme="f">
    <div data-role="header">
        <h1>Forecast FORM </h1>

        <h2>Kokola Admin 4.0</h2>
    </div>

    <div data-role="content">



        <table id='myTable' class="display" cellspacing="0" width="100%">
            <thead>
            <th>TRIWULAN</th>
            <th>KATEGORI</th>
            <th>Nama Produk</th>
            <th>Bulan 1</th>
            <th>Bulan 2</th>
            <th>Bulan 3</th>

            </thead>



<!--            <tfoot>-->
<!--            <th >&nbsp;</th>-->
<!--            <th >&nbsp;</th>-->
<!--            <th >&nbsp;</th>-->
<!--            <th><div class='bulan1'></div></th>-->
<!--            <th><div class='bulan2'></div></th>-->
<!--            <th><div class='bulan3'></div></th>-->
<!---->
<!--            </tfoot>-->


<?php
include "../koneksi.php";


$kategori = $_GET['KATE'];
$tri    = $_GET['TRI'];



//echo $kategori;
//echo $tri;



            $sql = "SELECT m_produk.NAMA_PRODUK,
                   m_produk.ITEM_CODE,
                   m_produk.KATEGORI,
                  forecast.BULAN1 AS BULAN1,
                  forecast.BULAN2 AS BULAN2,
                  forecast.BULAN3 AS BULAN3,
                   forecast.BULAN_INPUT,
                   forecast.TRIWULAN,
                   forecast.publish

                   FROM forecast
                   LEFT JOIN m_produk
                   ON m_produk.ITEM_CODE=forecast.ITEM_CODE

                   WHERE TRIWULAN = '$tri'
            AND forecast.`publish` = '1'
            AND m_produk.KATEGORI = '$kategori'
                   ORDER BY m_produk.NAMA_PRODUK ASC;";

     $hasil = mysqli_query($mysqli, $sql);

    echo "<tbody>";

    while($data=mysqli_fetch_assoc($hasil)){

      echo "<tr>";
      echo "<td>$data[TRIWULAN]</td>";
      echo "<td>$data[KATEGORI]</td>";
      echo "<td>$data[NAMA_PRODUK]</td>";
      echo "<td>$data[BULAN1]</td>";
      echo "<td>$data[BULAN2]</td>";
      echo "<td>$data[BULAN3]</td>";
      echo "</tr>";




    }//end while

    echo "<tbody>";


?>
        </table>
    </div><!--end conternt-->




    <a href="list_total_kj.php" data-role="button" data-ajax="false" target="_parent">Back</a>
    <!--emnd role-content-->
    <!-- div footer -->
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
</body>



</html>