<?php
session_start();
error_reporting(0);
include "../koneksi.php";
if(($_SESSION[USER])&& ($_SESSION[HAK] == "ADMIN")) {
//date_default_timezone_set("Asia/Jakarta");
	   		    $tgl = date('Y')."-".date('m')."-".date('d');
				 $tgl_tampil = date('d')."-".date('M')."-".date('Y');
				///////hari
		$tgl2 = date('Y-m-d', strtotime('-1 days', strtotime( $tgl ))); 
		
		$kemarin = date('D', strtotime('-1 days', strtotime( $tgl ))); 
		$tanggal = '$tgl';
		$tgl_kemarin = '$kemarin';
		
		$hai = date('D');
		
	$day_k = date('D', strtotime($tgl_kemarin));	
    $day = date('D', strtotime($tanggal));
    $dayList = array(
    	'Sun' => 'Minggu',
    	'Mon' => 'Senin',
    	'Tue' => 'Selasa',
    	'Wed' => 'Rabu',
    	'Thu' => 'Kamis',
    	'Fri' => 'Jumat',
    	'Sat' => 'Sabtu'
    );
	$dayList2 = array(
    	'Sun' => 'MINGGU',
    	'Mon' => 'SENIN',
    	'Tue' => 'SELASA',
    	'Wed' => 'RABU',
    	'Thu' => 'KAMIS',
    	'Fri' => 'JUMAT',
    	'Sat' => 'SABTU'
    );
    //echo "Tanggal {$tanggal} adalah hari : " . $dayList[$day]; 
			$tgl_kes = $dayList[$hai]." Tgl ".date('d')." ".date('M')." ".date('Y');
			$tgl_var = $dayList2[$kemarin];
				
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
	$("#example tbody tr").each(function(index, element) {
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

<div align="center"><strong>Jadwal Kirim Hari Ini <?php echo '&nbsp;'.$tgl_tampil?></strong>&nbsp;&nbsp;&nbsp;<a href="home_admin.php" class="ui-btn ui-btn-inline ui-icon-back ui-btn-icon-notext ui-corner-all">No text</a></div>


<form action="" method="post">

   <table  border="0" cellpadding="1" cellspacing="0" align="left">
      <tr>
     <td><?php echo "<a href='../logout.php' data-role='button' data-ajax='false' target='_parent'>Log Out</a>";?></td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td><?php echo "<a href='#JKKU' 
 data-position-to='window' data-rel='popup'  data-transition='flow'
 data-role='button' >JADWAL KIRIM HARI INI</a>";?></td>
 <td>&nbsp;&nbsp;&nbsp;</td>
 <td><?php echo "<a href='#POKU' 
 data-position-to='window' data-rel='popup'  data-transition='flow'
 data-role='button' >TOTAL PO HARI INI</a>";?></td>
      </tr>
      <div data-role='popup' id='JKKU' class='ui-content' data-theme='a'>
     <a href='#' data-rel='back' class='ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right'>Close</a>					
					<div class='header' data-role='header' style="padding:6">
                    Jadwal Kesepakatan <?php echo $tgl_kes;?>
                    </div>
                    
                    <div class='rTableRow'>
                    <div class='rTableHead'><strong>No</strong></div>
		          <div class='rTableHead'><strong>Representative</strong></div>
				  <div class='rTableHead'><strong>Nama</strong></div>
				 <div class='rTableHead'><strong>Kota</strong></div>
				 <div class='rTableHead'><span style='font-weight: bold;'>Qty</span></div>
				
                 </div> 
                    <?php
					$sql_kirim = "select AA.* from(select a.Id as IDNE, a.ID_ORDER, DATE(a.TGL_ORDER) as TGLKU, b.id, b.ACCOUNT_ID
,b.item_code, sum(b.qty) as QTY, b.periode1, b.periode2, b.tgl_upload, b.REPRESENTATIVE, b.NAMA, b.KOTA from order_confirm a
 right join 
 (select xx.*, zz.REPRESENTATIVE, zz.NAMA,zz.KOTA 
 from order_kirim_wd xx, user zz where xx.ACCOUNT_ID = zz.ACCOUNT_ID and xx.periode2 = '$tgl') b 
on a.ACCOUNT_ID = b.ACCOUNT_ID  and a.ITEM_CODE = b.item_code 
and DATE(a.TGL_ORDER) = b.periode2 group by b.ACCOUNT_ID)as AA
 where AA.periode2 = '$tgl'"; 
 $ji = 1;
					$hasil_kirim = mysqli_query($mysqli, $sql_kirim);
                    while ($data_kirim = mysqli_fetch_array($hasil_kirim)) {
					$rep = $data_kirim['REPRESENTATIVE'];
					$namaz = $data_kirim['NAMA'];
					$kotaz = $data_kirim['KOTA'];	
					$qtyz = $data_kirim['QTY'];			
					//$jumtotal = number_format($sisa_target);
					echo "
				
				 <div class='rTableRow'>
				 <div class='rTableCell'>$ji</div>
				  <div class='rTableCell'>$rep</div>
				  <div class='rTableCell'>$namaz</div>
				 <div class='rTableCell'>$kotaz</div>
				 <div class='rTableCell' align='right'>$qtyz</div>
				 
				 </div>";
					
					
					
					$ji++;
					
					}
					
					$sql_kirim2 = "select sum(qty) as MES from order_kirim_wd where periode2 = '$tgl'"; 
					$hasil_kirim2 = mysqli_query($mysqli, $sql_kirim2);
                    $data_kirim2 = mysqli_fetch_array($hasil_kirim2);
					$total99 = $data_kirim2['MES'];
					
					$sql_kirim21 = "select IFNULL(SUM(AA.JML_ORDER),0), IFNULL(SUM(AA.QTY),0), IFNULL(SUM(AA.JML_ORDER),0) - IFNULL(SUM(AA.QTY),0) as HASILE from(select a.Id as IDNE, a.ID_ORDER, DATE(a.TGL_ORDER) as TGLKU,a.JML_ORDER, b.id, b.ACCOUNT_ID
,b.item_code, sum(b.qty) as QTY, b.periode1, b.periode2, b.tgl_upload, b.REPRESENTATIVE, b.NAMA, b.KOTA from order_confirm a
 right join 
 (select xx.*, zz.REPRESENTATIVE, zz.NAMA,zz.KOTA 
 from order_kirim_wd xx, user zz where xx.ACCOUNT_ID = zz.ACCOUNT_ID and xx.periode2 = '$tgl2') b 
on a.ACCOUNT_ID = b.ACCOUNT_ID  and a.ITEM_CODE = b.item_code 
and DATE(a.TGL_ORDER) = b.periode2 group by b.ACCOUNT_ID)as AA
 where AA.periode2 = '$tgl2'"; 
					$hasil_kirim21 = mysqli_query($mysqli, $sql_kirim21);
                    $data_kirim21 = mysqli_fetch_array($hasil_kirim21);
					$total992 = $data_kirim21['HASILE'];
					if ($total992 < 0){
						$akurat = abs($total992); 
						}
						else { $akurat = 0;}
						
						$jotayu = $akurat + $total99 ;
				echo "
				      <div>TOTAL         : $total99</div>
				      <div>TOTAL GAGAL $tgl_var : $akurat</div>
					  <div>GRAND TOTAL   : $jotayu</div>";	
					?> 
      
      
      </div>
      
      
      
     <div data-role='popup' id='POKU' class='ui-content' data-theme='a'>
     <a href='#' data-rel='back' class='ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right'>Close</a>					
					<div class='header' data-role='header'>
                    <h1>TOTAL PO HARI INI</h1>
                    </div>                  
            <?php 
 $sql_kj2ta = "select GG.account_id, GG.NAMA_PRODUK, SUM(GG.qty) as hasil, GG.KATEGORI, GG.TARGET,  GG.TARGET - SUM(GG.qty) as SH, GG.REGIONAL, GG.KOTA from
(select * from 
(select KK.ACCOUNT_ID as account_id, KK.ITEM_CODE as item_code , KK.JML_ORDER as qty, DATE(KK.TGL_CONFIRM) as periode2,
 LL.REGIONAL, LL.KOTA from order_confirm KK, user LL
 where KK.ACCOUNT_ID = LL.ACCOUNT_ID ) as CC 
left join (select MP.ITEM_CODE as ii, MP.NAMA_PRODUK, MP.KATEGORI, MP.GRAMATUR, KPF.KATEGORI as MN, KPF.TARGET
 from m_produk MP, kategori_produk_fix KPF
where MP.KATEGORI = KPF.KATEGORI) as XX
 on XX.ii = CC.item_code) as GG where GG.periode2 = '$tgl' group by GG.REGIONAL;";

       // echo $sql_kj2ta;
				 $no = 1;
 $hasil_kj2ta = mysqli_query($mysqli, $sql_kj2ta);
                    while ($data_kj2ta = mysqli_fetch_array($hasil_kj2ta)) {
					$regional = $data_kj2ta['REGIONAL'];
					$forkx = $data_kj2ta['KATEGORI'];
				
					$sisa_target = $data_kj2ta['hasil'];
					$jumtotal = number_format($sisa_target);
					///menampilkan dialog	
//echo "<div>$fork || $qty45</div>";
echo "	                
				 <div>$regional &nbsp;&nbsp;  $jumtotal  &nbsp;&nbsp; terdiri &nbsp;";  
				 //////////////////batas kota

				 $sql_kj2tax = "select GG.account_id, GG.NAMA_PRODUK, SUM(GG.qty) as hasil, GG.KATEGORI, GG.TARGET,  GG.TARGET - SUM(GG.qty) as SH, GG.REGIONAL, GG.KOTA from
(select * from 
(select KK.ACCOUNT_ID as account_id, KK.ITEM_CODE as item_code , KK.JML_ORDER as qty, DATE(KK.TGL_CONFIRM) as periode2,
 LL.REGIONAL, LL.KOTA from order_confirm KK, user LL
 where KK.ACCOUNT_ID = LL.ACCOUNT_ID ) as CC 
left join (select MP.ITEM_CODE as ii, MP.NAMA_PRODUK, MP.KATEGORI, MP.GRAMATUR, KPF.KATEGORI as MN, KPF.TARGET
 from m_produk MP, kategori_produk_fix KPF
where MP.KATEGORI = KPF.KATEGORI) as XX
 on XX.ii = CC.item_code) as GG where GG.periode2 = '$tgl' AND GG.REGIONAL ='$regional' group by GG.REGIONAL, GG.KOTA;";

          
				 
 $hasil_kj2tax = mysqli_query($mysqli, $sql_kj2tax);
                    while ($data_kj2tax = mysqli_fetch_array($hasil_kj2tax)) {
					$kota = $data_kj2tax['KOTA'];
					
					
				echo "$kota,";	
					
					}
				echo "</div>	" ; /////batas div record
				$no++;
}
			
							  
							  
 $sql_totalku = "select GG.account_id, GG.qty, GG.NAMA_PRODUK, SUM(GG.qty) as hasil, GG.KATEGORI, GG.TARGET,  GG.TARGET - SUM(GG.qty) as SH, GG.REGIONAL, GG.KOTA from
(select * from 
(select KK.ACCOUNT_ID as account_id, KK.ITEM_CODE as item_code , KK.JML_ORDER as qty, DATE(KK.TGL_CONFIRM) as periode2,
 LL.REGIONAL, LL.KOTA from order_confirm KK, user LL
 where KK.ACCOUNT_ID = LL.ACCOUNT_ID ) as CC 
left join (select MP.ITEM_CODE as ii, MP.NAMA_PRODUK, MP.KATEGORI, MP.GRAMATUR, KPF.KATEGORI as MN, KPF.TARGET
 from m_produk MP, kategori_produk_fix KPF
where MP.KATEGORI = KPF.KATEGORI) as XX
 on XX.ii = CC.item_code) as GG where GG.periode2 = '$tgl' ;";

          
			
 $hasil_totalku = mysqli_query($mysqli, $sql_totalku);
                    $data_totalku = mysqli_fetch_array($hasil_totalku);
					$totalkui = $data_totalku['hasil'];
				 echo "<div><span style='font-weight: bold;'>JADI TOTAL PO HARI INI = $totalkui</span></div>";
				 
				 ////////////////batas total
			
			/////////////////////batas report produk
			/* $sql_kj2t = "select GG.account_id, GG.NAMA_PRODUK, SUM(GG.qty) as hasil, GG.KATEGORI, GG.TARGET,  GG.TARGET - SUM(GG.qty) as SH from
(select * from 
(select KK.ACCOUNT_ID as account_id, KK.ITEM_CODE as item_code , KK.JML_ORDER as qty, DATE(KK.TGL_CONFIRM) as periode2,
 LL.REGIONAL from order_confirm KK, user LL
 where KK.ACCOUNT_ID = LL.ACCOUNT_ID ) as CC 
left join (select MP.ITEM_CODE as ii, MP.NAMA_PRODUK, MP.KATEGORI, MP.GRAMATUR, KPF.KATEGORI as MN, KPF.TARGET
 from m_produk MP, kategori_produk_fix KPF
where MP.KATEGORI = KPF.KATEGORI) as XX
 on XX.ii = CC.item_code) as GG where GG.periode2 = '$tgl' group by GG.KATEGORI;";*/
 
  $sql_kj2t = "select *, TARGET - hasil as SH from(
 select GG.account_id, GG.NAMA_PRODUK, SUM(GG.qty) as hasil, GG.item_code,
        GG.KATEGORI 
        from
      (select * from 
          (select KK.ACCOUNT_ID as account_id, KK.ITEM_CODE as item_code , KK.JML_ORDER as qty, DATE(KK.TGL_CONFIRM) as periode2,
            LL.REGIONAL
             from order_confirm KK, user LL
              where KK.ACCOUNT_ID = LL.ACCOUNT_ID ) as CC 
left join 
(select PT.item_code as ii, PT.item_name as NAMA_PRODUK, MP.KATEGORI, MP.GRAMATUR
 from push_item PT
 left join m_produk MP on PT.item_code = MP.ITEM_CODE) as XX
 on XX.ii = CC.item_code) as GG where GG.periode2 = '$tgl' group by GG.KATEGORI) as PERTAMA
 left join kategori_produk_fix KEDUA on PERTAMA.KATEGORI = KEDUA.KATEGORI ;";

          echo " <div class='rTableRow'>
		          <div class='rTableHead'><strong>No</strong></div>
				  <div class='rTableHead'><strong>Nama Produk</strong></div>
				 <div class='rTableHead'><strong>Kategori</strong></div>
				 <div class='rTableHead'><span style='font-weight: bold;'>Qty</span></div>
				 <div class='rTableHead'><span style='font-weight: bold;'>Target</span></div>
				 <div class='rTableHead'><span style='font-weight: bold;'>Sisa</span></div>
                 </div>";
				 $no = 1;
 $hasil_kj2t = mysqli_query($mysqli, $sql_kj2t);
                    while ($data_kj2t = mysqli_fetch_array($hasil_kj2t)) {
					$fork = $data_kj2t['NAMA_PRODUK'];
					$forkx = $data_kj2t['KATEGORI'];
					$qty45 = $data_kj2t['hasil'];
					$target = $data_kj2t['TARGET'];
					
					$sisa_target = $data_kj2t['SH'];
					
					$mui = number_format($qty45);
					///menampilkan dialog	
//echo "<div>$fork || $qty45</div>";
echo "	
                
				 <div class='rTableRow'>
				  <div class='rTableCell'>$no</div>
				  <div class='rTableCell'>$fork</div>
				 <div class='rTableCell'>$forkx</div>
				 <div class='rTableCell' align='right'>$mui</div>
				 <div class='rTableCell' align='right'>$target</div>";
				 if ($sisa_target != NULL)
				 {
				echo " <div class='rTableCell' align='right'>-$sisa_target</div>";
				 } 
				
				 else 
				 { echo " <div class='rTableCell' align='right'></div>";}
		echo "</div>";
				$no++;
} ?>
                    
                    </div>
   
   
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
                          <th width="100" class="header-bulan3"><a href=""><div align="left" id="total3"> </div></a></th>
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
								$sql_kj = "SELECT 
										
										a.ACCOUNT_ID, 
										SUM(a.JML_ORDER) AS TOTAL_ORDER,
										c.NAMA, c.KOTA
										
										FROM
										order_confirm a,
										user c
										
										WHERE
										a.TGL_CONFIRM LIKE '$tgl%' AND
										
										a.ACCOUNT_ID = c.ACCOUNT_ID 
										
								
										GROUP BY  a.ACCOUNT_ID";
							
                  
				
                    $hasil_kj = mysqli_query($mysqli, $sql_kj);
                 $no = 1;
                    while ($data_kj = mysqli_fetch_array($hasil_kj)) {
						$nama = $data_kj['NAMA'];
						$kota = $data_kj['KOTA'];
						$total = $data_kj['TOTAL_ORDER'];
						
						$sis = $data_kj['sisa'];
						$sisa = number_format($sis);
						$idac = $data_kj['ACCOUNT_ID'];
						$ttt = $data_kj['periode2'];
				//+ Sisa kirim : $sisa
						
				    echo "<tr><td align='center'>$no</td>
					<td>$nama</td><td>$kota</td><td class ='SMK'> $total</td>
					<td align='center'><a href='#popupBasic$idac'data-mini='true' data-position-to='window' data-rel='popup'  data-transition='flow'>Lihat </a></td></tr>";
					
							
				
					
					echo "<div data-role='popup' id='popupBasic$idac' class='ui-content' data-theme='a'>
					<a href='#' data-rel='back' class='ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right'>Close</a>
					
					<div class='header' data-role='header'>
                <h1>$nama</h1>
            </div>
					
					
					<div class='rTable' >
					<div class='rTableRow'>
				 <div class='rTableHead'><strong>Produk</strong></div>
				 <div class='rTableHead'><span style='font-weight: bold;'>Qty</span></div>
				
                 </div>";
					
//query detail kirim
/*$sql_kj2 = "select * from(select * from (select account_id, item_code , qty, periode2 from order_kirim_wd) as CC left join (select ITEM_CODE as ii, NAMA_PRODUK from m_produk) as KK
 on KK.ii = CC.item_code) as GG where GG.account_id = '$idac'  and GG.periode2 = '$tgl' ";*/
 /*$sql_kj2 = "select GG.account_id, GG.NAMA_PRODUK,   GG.qty, GG.KATEGORI, GG.TARGET from
(select * from
 (select KK.ACCOUNT_ID as account_id, KK.ITEM_CODE as item_code , KK.JML_ORDER as qty, DATE(KK.TGL_CONFIRM) as periode2,
 LL.REGIONAL from order_confirm KK, user LL
 where KK.ACCOUNT_ID = LL.ACCOUNT_ID ) as CC 
left join (select MP.ITEM_CODE as ii, MP.NAMA_PRODUK, MP.KATEGORI, MP.GRAMATUR, KPF.KATEGORI as MN, KPF.TARGET
 from m_produk MP, kategori_produk_fix KPF
where MP.KATEGORI = KPF.KATEGORI) as XX
 on XX.ii = CC.item_code) as GG where GG.account_id = '$idac'  and GG.periode2 = '$tgl' ";
*/
$sql_kj2 = "SELECT 
									GG.account_id, 
									GG.NAMA_PRODUK,GG.qty AS qty, 
									GG.KATEGORI
									FROM
									(
									SELECT * FROM
										(SELECT 
											KK.ACCOUNT_ID AS account_id, 
											KK.ITEM_CODE AS item_code , 
											KK.JML_ORDER AS qty, DATE(KK.TGL_CONFIRM) AS periode2,
											LL.REGIONAL 
										FROM 
											order_confirm KK, user LL
										WHERE 
											KK.ACCOUNT_ID = LL.ACCOUNT_ID 
										) AS CC 
										LEFT JOIN 
										(
											SELECT 
												pt.item_code AS ii, 
												pt.item_name AS NAMA_PRODUK, 
												MP.KATEGORI
											
											FROM 
											push_item pt 
											LEFT JOIN m_produk MP ON pt.item_code = MP.ITEM_CODE
										) AS XX
									ON XX.ii = CC.item_code
									) AS GG 
									WHERE GG.account_id = '$idac'  AND GG.periode2 LIKE '$tgl%';";
 $hasil_kj2 = mysqli_query($mysqli, $sql_kj2);
$no = 1;
                    while ($data_kj2 = mysqli_fetch_array($hasil_kj2)) {
					$fork = $data_kj2['NAMA_PRODUK'];
					$forkx = $data_kj2['KATEGORI'];
					$qty45 = $data_kj2['qty'];
					$target = $data_kj2['TARGET'];
					$sisa_target = $data_kj2['SH'];
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
			$sql_kj21 =" SELECT 
										
										a.ACCOUNT_ID, 
										SUM(a.JML_ORDER) AS TOTAL_ORDER,
										c.NAMA, c.KOTA
										
										FROM
										order_confirm a,
										user c
										
										WHERE
										a.TGL_CONFIRM LIKE '$tgl%' AND
										
										a.ACCOUNT_ID = c.ACCOUNT_ID 
										and  a.ACCOUNT_ID = '$idac'
								
										GROUP BY  a.ACCOUNT_ID ";
					$hasil_kj21 = mysqli_query($mysqli, $sql_kj21);
                $data_kj21 = mysqli_fetch_array($hasil_kj21);
					$totalku = $data_kj21['TOTAL_ORDER'];
					$toool =  number_format($totalku);
					//$mnk = $data_kj21['account_id'];
echo "
<div class='rTableRow'>
				 <div class='rTableCell' align='right'><strong>Total</strong></div>
				 <div class='rTableCell' align='right'><strong>$toool</strong></div>				 
				 
				 </div>";//////////////////akhir table div
				 
///////////////////////////query sisa kirim				
/*$sql_kj2s = "select * from(SELECT
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
echo "<div>Sisa total : $sisa</div>";		*/ 

					
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