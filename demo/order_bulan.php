<?php
session_start();
include "koneksi.php";
if($_SESSION['USER']) {
$jumHari = cal_days_in_month(CAL_GREGORIAN, 1, 2016);
    ?>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <script src="jqm2/jquery-2.1.4.min.js"></script>
        <script src="jqm2/jquery.mobile-1.4.5.min.js"></script>
        <script src="jqtable/jquery.dataTables.min.js"></script>
        <script src="jqtable/dataTables.jqueryui.min.js"></script>
         <script src="jqm2/dataTables.fixedColumns.min.js"></script>


        <script src="validation/jquery.validate.js"></script>
        <link rel="stylesheet" href="themes/9septi_season.min.css"/>
        <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css"/>
        <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
        <link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>
        <!--<link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">-->
        <link rel="stylesheet" href="jqtable/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="jqtable/dataTables.jqueryui.min.css">
        <style>.toolbar{
			margin:8;
		}
        </style>
        <script>
            $(document).ready(function () {
                $('#example').DataTable({
					 "dom": '<"toolbar">frtip',
					 fixedColumns:   {
            leftColumns: 2,
            //rightColumns: 1
        },
                    "scrollY": 300,
                    "scrollX": true,
                    /*"scrollY":        "400px",
                     "scrollCollapse": true,*/
                    "ordering": false,
                    "paging": false,
					"filter": false
                });
                
                
				$("div.toolbar").html('<b><input type="text" id="cari"></b>');
				$("#cari").keyup(function(e) {
                    cari_table();
                });
            });

function cari_table() {
	var value = $("#cari").val();	
	$("table tbody tr").each(function(index, element) {
		if (index >= 0) {	
			$row = $(this);	
			var id = $row.find("td:eq(1)").text().toLowerCase();
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
    </head>

    <body>

    <div data-role="page" class="type-interior" data-theme="f">
        <div data-role="header">
            <h1>ORDER KIRIM</h1>

            <h2>Kokola Distributor 2.5</h2>
        </div>

        <div data-role="content">

       <table id="example"  class="display"  cellspacing="0" width="100%">
  		<thead>
        <tr>
    		<th width="3%" align="center">No</th>
    		<th style='min-width:250px'>Nama Produk</th>
            
	        <?php
			
			for($i=0; $i<$jumHari; $i++){
				$k = $i+1 ;
				echo "<th style='min-width:50px' >$k</th>";
				}
				?>
  		</tr>
        </thead>
        <tbody>
        <?php
		$no = 1;
		$sql_cari_produk_id = "SELECT * FROM m_produk ";
                $hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
                while ($data_id = mysqli_fetch_array($hasil_cari_produk_id)){
					$nmprod = $data_id['NAMA_PRODUK'];
					
			echo "<tr><td width='3%' align='center'>$no</td>
    		<td width='17%'>$nmprod</td>";
			for($i=0; $i<$jumHari; $i++){
				$k = $i+1 ;
				echo "<td><input type='text' name='$k' data-mini='true'></td>";
				}
		    echo "</tr>";
			$no++;
				}
				
				?>
                </tbody>
        </table>


        </div>
        <!--emnd role-content-->

        <div data-role="footer">
            <table align="center">
                <tr>
                    <td align="center">
                        <a href="logout.php" style="text-align: center" data-role="button" data-icon="power"
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
}
?>