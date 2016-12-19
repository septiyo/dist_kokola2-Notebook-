<?php
session_start();
error_reporting(0);
/*include "../koneksi.php";*/
$mysqli = mysqli_connect("10.1.13.54","rambo","rogerthat","distributor_kokola", 2272) or die('gagalx');


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
      
      <link rel="stylesheet" href="../jqm2/jqmobile.structure-1.4.5.min.css"/>
    
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
     
  </head>

<body>

<div data-role="page" class="type-interior" data-theme="f">
    <div data-role="header">
        

        <h2>Kokola Distributor</h2>
    </div>

    <div data-role="content">

<!--<div align="center"><strong>Jadwal Kirim Hari Ini <?php //echo '&nbsp;'.$tgl_tampil?></strong>&nbsp;&nbsp;&nbsp;
<a href="home_admin.php" class="ui-btn ui-btn-inline ui-icon-back ui-btn-icon-notext ui-corner-all">No text</a></div>-->


<form action="" method="post">

   <table  border="0" cellpadding="1" cellspacing="0" align="left" id='kesatu'>
      <tr>
     <td><a href='../logout.php' data-role='button' data-ajax='false' target='_parent'>Log Out</a></td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td><?php // echo "<a href='jkhi.php' 
 //data-position-to='window' data-rel='popup' data-ajax='false' data-transition='flow'
 //data-role='button' >JADWAL KIRIM HARI INI</a>";
 ?>
<!-- <a href='jkhi.php' data-ajax='false' data-role='button' >JADWAL KIRIM HARI INI</a
 >--></td>
 <td>&nbsp;&nbsp;&nbsp;</td>
 <td><?php //echo "<a href='#POKU' 
 //data-position-to='window' data-rel='popup'  data-transition='flow'
 //data-role='button' >TOTAL PO HARI INI</a>";
 ?></td>
      </tr>
    
      
      <!-- ganti popoup  -->
      
    
    					
					<div class='header' data-role='header' style="background-color:#090B7B">
                    <h3>TOTAL PO HARI INI <?php echo '&nbsp;'.$tgl_tampil?> &nbsp;&nbsp;&nbsp;<a href="home_admin.php" class="ui-btn ui-btn-inline ui-icon-back ui-btn-icon-notext ui-corner-all">No text</a></div></h3>
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
			
							  
							  
 /*$sql_totalku = "select GG.account_id, GG.qty, GG.NAMA_PRODUK, SUM(GG.qty) as hasil, GG.KATEGORI, GG.TARGET,  GG.TARGET - SUM(GG.qty) as SH, GG.REGIONAL, GG.KOTA from
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
				 echo "<div><span style='font-weight: bold;'>JADI TOTAL PO HARI INI = $totalkui</span></div>";*/
				  echo "<div><span id='TTLS' style='font-weight: bold;'></span></div>";
				 
				 

				 
				 
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
					
					/*$mui = number_format($qty45);*/
					$mui = number_format($qty45);
					///menampilkan dialog	
//echo "<div>$fork || $qty45</div>";
echo "	
                
				 <div class='rTableRow'>
				  <div class='rTableCell'>$no</div>
				  <div class='rTableCell'>$fork</div>
				 <div class='rTableCell'>$forkx</div>
				 <div class='rTableCell totalku' align='right'>$qty45</div>
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
	
	
	
var sum = 0;
$('.totalku').each(function(){
    sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
});
	
//alert(sum);	
$('#TTLS').html('JADI TOTAL PO HARI INI = '+sum);
	
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