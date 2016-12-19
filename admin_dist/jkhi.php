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
     <td><?php echo "<a href='../logout.php' data-role='button' data-ajax='false' target='_parent'>Log Out</a>";?></td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td><a href='kirim_now.php'   data-ajax='false'
 data-role='button' >TOTAL PO HARI INI</a></td>
 <td>&nbsp;&nbsp;&nbsp;</td>
 <td><?php //echo "<a href='#POKU' 
 //data-position-to='window' data-rel='popup'  data-transition='flow'
 //data-role='button' >TOTAL PO HARI INI</a>";
 ?></td>
      </tr>
    
      
      <!-- ganti popoup  -->
      
    
    					
					<div class='header' data-role='header' style="background-color:#090B7B">
                    <h3>JADWAL KIRIM HARI INI <?php echo '&nbsp;'.$tgl_tampil?> &nbsp;&nbsp;&nbsp;<a href="kirim_now.php" class="ui-btn ui-btn-inline ui-icon-back ui-btn-icon-notext ui-corner-all">No text</a></div></h3>
                    </div>                  



				
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