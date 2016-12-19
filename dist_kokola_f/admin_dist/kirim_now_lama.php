<?php
session_start();
error_reporting(0);
include "../koneksi.php";
if(($_SESSION[USER])&& ($_SESSION[HAK] == "ADMIN")) {
date_default_timezone_set("Asia/Jakarta");
	   		    $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				$bulanku = date('m');
				$wkt = date('H:i:s'); 

    ?>
<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
      <script src="../jqm2/jquery-2.1.4.min.js"></script>
      <script src="../jqm2/jquery.mobile-1.4.5.min.js"></script>
      <script src="../jqtable/jquery.dataTables.min.js"></script>
      <script src="../jqtable/dataTables.jqueryui.min.js"></script>


      <script src="validation/jquery.validate.js"></script>
      <link rel="stylesheet" href="../themes/9septi_season.min.css" />
      <link rel="stylesheet" href="../themes/jquery.mobile.icons.min.css" />
      <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
      <link rel="stylesheet" href="../jqm2/jqmobile.structure-1.4.5.min.css"/>
      <!--<link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">-->
      <link rel="stylesheet" href="../jqtable/themes/smoothness/jquery-ui.css">
      <link rel="stylesheet" href="../jqtable/dataTables.jqueryui.min.css">
      <style>
.okl {
  font: bold 15px Arial;
  text-decoration: none;
  background-color: #EEEEEE;
  color: #333333;
  padding: 2px 6px 2px 6px;
  border-top: 1px solid #CCCCCC;
  border-right: 1px solid #333333;
  border-bottom: 1px solid #333333;
  border-left: 1px solid #CCCCCC;
}
.toolbar{
			margin:8;
		}
		div.toolbar {
   width: 50%;
   float: right;
   text-align: right;
}
 
 .rTable {
		    	display: table;
		    	width: 100%;
		}
		.rTableRow {
		    	display: table-row;
		}
		.rTableHeading {
		    	display: table-header-group;
		    	background-color: #ddd;
		}
		.rTableCell, .rTableHead {
		    	display: table-cell;
		    	padding: 3px 10px;
		    	border: 1px solid #999999;
		}
		/*.rTableHeading {
		    	display: table-header-group;
		    	background-color: #ddd;
		    	font-weight: bold;
		}*/
		.rTableFoot {
		    	display: table-footer-group;
		    	font-weight: bold;
		    	background-color: #ddd;
		}
		.rTableBody {
		    	display: table-row-group;
		} 
		
	


</style>
      <script>
	  
          $(document).ready(function() {
			  
               $('#example').DataTable( {
				    "dom": '<"toolbar">frtip',
                    "scrollY": 300,
                    "scrollX": true,
					"paging": false,
					"filter": false,
					"scrollCollapse": true,
					 aoColumnDefs: [
                                 {
                                   bSortable: false,
                                    aTargets: [ 0 ]
                                     }
                                 ],
			
                    /*"scrollY":        "400px",
                    "scrollCollapse": true,*/
					//"ordering": false,
                   // "paging":         false
                } );
				$("div.toolbar").html('<b><input type="text" id="cari"></b>');
				$("#cari").keyup(function(e) {
                    cari_table();
                });
          } );



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
        

        <h2>Kokola Distributor</h2>
    </div>

    <div data-role="content">

<div align="center"><strong>Jadwal Kirim Hari Ini</strong>&nbsp;&nbsp;&nbsp;<a href="home_admin.php" class="ui-btn ui-btn-inline ui-icon-back ui-btn-icon-notext ui-corner-all">No text</a></div>

<form action="" method="post">
   <table  border="0" cellpadding="1" cellspacing="0" align="left">
      <tr>
        <td><?php echo "<a href='../logout.php' data-role='button' data-ajax='false' target='_parent'>Log Out</a>";?></td>
      </tr>
   
   </table>
   <table id="example" class="display" cellspacing="0" width="100%">
   <thead>
   <tr><th >No</th><th style='min-width:250px'>Nama</th><th>Kota</th><th>Total</th><th>Detail</th></tr>
   </thead>
   <tfoot>
                        <tr bgcolor="#7fffd4">
                            <th width="50">&nbsp;</th>
                            <th width="50">&nbsp;</th>
                            <th width="100" class="header-bulan2"><div align="right" id="total2">Jumlah Total :</div></th>
                            <th width="100" class="header-bulan3"><div align="left" id="total3"> </div></th>
                            <th width="100"><div id="total"></div></th>
                            
                        </tr>
     </tfoot>
    <?php
                    /*   $sql_param =  "SELECT
										b.NAMA,
										b.KOTA, 
										a.account_id, 
										a.periode2,
										SUM(a.qty)AS total

									FROM
										order_kirim_wd a,
										user b

									WHERE
										a.periode2 BETWEEN '$yearku-$bulanku-01' AND '$tgl' AND
                                   a.flag = '6'                                                
									 AND
										a.ACCOUNT_ID = b.ACCOUNT_ID

									GROUP BY account_id
									ORDER BY account_id";
						$hasil_param = mysqli_query($mysqli, $sql_param);
                       $data_param = mysqli_fetch_array($hasil_param);
						$parame = $data_param['NAMA'];
						
						if ($parame == '') 
						{
							*/
								$sql_kj = "select KIRIM.NAMA, KIRIM.KOTA, KIRIM.account_id, KIRIM.periode2, COALESCE(SISA.total,0) as sisa, COALESCE(KIRIM.total,0) as kirim from ( SELECT
										b.NAMA,
										b.KOTA, 
										a.account_id, 
										a.periode2,
										SUM(a.qty)AS total

									FROM
										order_kirim_wd a,
										user b

									WHERE
										a.periode2 BETWEEN '$yearku-$bulanku-01' AND '$tgl' AND
                     a.flag = '6'                                                
									 AND
										a.ACCOUNT_ID = b.ACCOUNT_ID

									GROUP BY account_id
									ORDER BY account_id ) as SISA
            right join 
            (  SELECT
										b.NAMA,
										b.KOTA, 
										a.account_id, 
										a.periode2,
										SUM(a.qty)AS total

									FROM
										order_kirim_wd a,
										user b

									WHERE
										a.periode2 = '$tgl' AND
                     a.flag = '1'                                                
									 AND
										a.ACCOUNT_ID = b.ACCOUNT_ID

									GROUP BY account_id
									ORDER BY account_id ) as KIRIM on SISA.account_id = KIRIM.account_id
									
									UNION
									
									
									select SISA.NAMA, SISA.KOTA, SISA.account_id, SISA.periode2, COALESCE(SISA.total,0) as sisa, COALESCE(KIRIM.total,0) as kirim from ( SELECT
										b.NAMA,
										b.KOTA, 
										a.account_id, 
										a.periode2,
										SUM(a.qty)AS total

									FROM
										order_kirim_wd a,
										user b

									WHERE
										a.periode2 BETWEEN '$yearku-$bulanku-01' AND '$tgl' AND
                     a.flag = '6'                                                
									 AND
										a.ACCOUNT_ID = b.ACCOUNT_ID

									GROUP BY account_id
									ORDER BY account_id ) as SISA
            left join 
            (  SELECT
										b.NAMA,
										b.KOTA, 
										a.account_id, 
										a.periode2,
										SUM(a.qty)AS total

									FROM
										order_kirim_wd a,
										user b

									WHERE
										a.periode2 = '$tgl' AND
                     a.flag = '1'                                                
									 AND
										a.ACCOUNT_ID = b.ACCOUNT_ID

									GROUP BY account_id
									ORDER BY account_id ) as KIRIM on SISA.account_id = KIRIM.account_id";
							
                  
				
                    $hasil_kj = mysqli_query($mysqli, $sql_kj);
                 $no = 1;
                    while ($data_kj = mysqli_fetch_array($hasil_kj)) {
						$nama = $data_kj['NAMA'];
						$kota = $data_kj['KOTA'];
						$total = $data_kj['kirim'];
						
						$sis = $data_kj['sisa'];
						$sisa = number_format($sis);
						$idac = $data_kj['account_id'];
						$ttt = $data_kj['periode2'];
				
						
				    echo "<tr><td align='center'>$no</td>
					<td>$nama</td><td>$kota</td><td class ='SMK'> $total</td>
					<td align='center'><a href='#popupBasic$idac'data-mini='true' data-position-to='window' data-rel='popup'  data-transition='flow'>Lihat + Sisa kirim : $sisa</a></td></tr>";
					
							
				
					
					echo "<div data-role='popup' id='popupBasic$idac' class='ui-content' data-theme='a'>
					<a href='#' data-rel='back' class='ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right'>Close</a>
					
					<div class='header' data-role='header'>
                <h1>$nama</h1>
            </div>
					
					<div>Jadwal kirim hari ini :</div>
					<div class='rTable' >
					<div class='rTableRow'>
				 <div class='rTableHead'><strong>Produk</strong></div>
				 <div class='rTableHead'><span style='font-weight: bold;'>Qty</span>
                 </div></div>";
						//$sql_kj2 ="select KK.NAMA_PRODUK, KK.ii as PROD,account_id, item_code , qty, periode2 from order_kirim_wd as CC 
 //left join (select ITEM_CODE as ii, NAMA_PRODUK from m_produk) as KK
// on KK.ii = CC.item_code where account_id = '$idac'  and periode2 = '$ttt'";
$sql_kj2 = "select * from(select * from (select account_id, item_code , qty, periode2 from order_kirim_wd) as CC left join (select ITEM_CODE as ii, NAMA_PRODUK from m_produk) as KK
 on KK.ii = CC.item_code) as GG where GG.account_id = '$idac'  and GG.periode2 = '$tgl' ";

 $hasil_kj2 = mysqli_query($mysqli, $sql_kj2);
$no = 1;
                    while ($data_kj2 = mysqli_fetch_array($hasil_kj2)) {
					$fork = $data_kj2['NAMA_PRODUK'];
					$qty45 = $data_kj2['qty'];
					$mui = number_format($qty45);
					///menampilkan dialog	
//echo "<div>$fork || $qty45</div>";
echo "	
				 <div class='rTableRow'>
				 <div class='rTableCell'>$fork</div>
				 <div class='rTableCell' align='right'>$mui</div>
				 
				 </div>
				 
				
				";
}
                  ////footer div
			$sql_kj21 ="SELECT
										b.NAMA,
										b.KOTA, 
										a.account_id, 
										SUM(a.qty)AS total

									FROM
										order_kirim_wd a,
										user b

									WHERE
										
										a.periode2 = '$tgl' AND
										a.ACCOUNT_ID = b.ACCOUNT_ID
                    and a.ACCOUNT_ID = '$idac'

									GROUP BY account_id
									ORDER BY account_id ";
					$hasil_kj21 = mysqli_query($mysqli, $sql_kj21);
                $data_kj21 = mysqli_fetch_array($hasil_kj21);
					$totalku = $data_kj21['total'];
					$toool =  number_format($totalku);
					//$mnk = $data_kj21['account_id'];
echo " <div class='rTable' >
<div class='rTableRow'>
				 <div class='rTableCell' align='right'><strong>Total</strong></div>
				 <div class='rTableCell' align='right'><strong>$toool</strong></div>				 
				 </div>
				 </div>";//////////////////akhir table div
				 
///////////////////////////query sisa kirim				
$sql_kj2s = "select * from(SELECT
										b.NAMA,
										b.KOTA, 
										a.account_id, 
										a.periode2,
                    a.qty,
                    a.item_code,
                    c.NAMA_PRODUK                             
									FROM
										order_kirim_wd a,
										user b, m_produk c
									WHERE
										a.periode2 BETWEEN '$yearku-$bulanku-01' AND '$tgl' AND
                     a.flag = '6'                                                
									 AND
										a.ACCOUNT_ID = b.ACCOUNT_ID AND a.item_code = c.ITEM_CODE) as CV
										where CV.account_id = '$idac'";
										

									
echo "<div><strong>Sisa Kirim</strong></div>";
echo "<div class='rTableRow'>
<div class='rTableCell'>Nama </div><div class='rTableCell'>Tgl </div><div class='rTableCell'>Qty </div></div>";	
 $hasil_kj2s = mysqli_query($mysqli, $sql_kj2s);

                    while ($data_kj2s = mysqli_fetch_array($hasil_kj2s)) {
					$forks = $data_kj2s['NAMA_PRODUK'];
					$qty45s = $data_kj2s['qty'];
					$perkus = $data_kj2s['periode2'];
					$muis = number_format($qty45s);				 
echo "<div class='rTableRow'>
<div class='rTableCell'>$forks </div><div class='rTableCell'> $perkus</div> <div class='rTableCell'> $muis</div>
</div> ";	
					}
echo "<div>Sisa total : $sisa</div>";		 

					
					$no++;
					}
					echo "</div>";	
					?>
   
    
   </table>
   </form>
    </div><!--emnd role-content-->

    <div data-role="footer">
        <h2>Kokola Web Developer Department, 2016</h2>
    </div>


</div><!--end role page-->
<script>
 $(document).ready(function () {
	hitung_total(); 
	
	
 });
function hitung_total() {
			
    var sum=0;
    
    $('.SMK').each(function() {     
            sum += parseInt($(this).text());                     
    });
	//alert (sum); 
   
    $('#total3').html(sum);
			}
	</script>		
</body>
</html>
 <?php
}
else{

    echo "Anda tidak Berhak";
}


?>