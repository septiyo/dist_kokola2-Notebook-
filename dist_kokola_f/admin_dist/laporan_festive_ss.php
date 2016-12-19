<?php
error_reporting(0);
session_start();

if($_SESSION['USER']) {
	include "../koneksi.php";
$accid = $_SESSION['ACCOUNT_ID'];	
//date_default_timezone_set("Asia/Jakarta");
	   		    $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				$bulanku = date('m');
				$wkt = date('H:i:s'); 
				$thn_dpn= date('Y', strtotime('+1 years', strtotime( $tgl ))); 
				
$jumHari = cal_days_in_month(CAL_GREGORIAN, $bulanku, 2016);

    ?>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="themeku/themes/themeku.css" />
	<link rel="stylesheet" href="themeku/themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="themeku/jquery.mobile.structure-1.4.5.css" />
    <link rel="stylesheet" href="themeku/jquery.dataTables.css" />
     <link rel="stylesheet" href="themeku/fixedColumns.dataTables.min.css" />
  <link rel="stylesheet" href="jqtable/themes/smoothness/jquery-ui.css">
     <link rel="stylesheet" href="jqtable/dataTables.jqueryui.min.css">

       
	    <script src="themeku/jquery.js"></script>
	    <script src="themeku/jquery.mobile-1.4.5.js"></script>
        <script src="themeku/jquery.dataTables.js"></script>
        <script src="jqtable/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="themeku/jquery-ui.js"></script> 
        <script src="jqtable/dataTables.jqueryui.min.js"></script>
         <script type="text/javascript"  src="themeku/jquery-ui.multidatespicker.js"></script>     
         <script src="themeku/dataTables.fixedColumns.min.js"></script>
         <script src="validation/jquery.validate.js"></script>
    
       
        <style>
		
		.toolbar{
			margin:8;
		}
		div.toolbar {
   width: 50%;
   float: right;
   text-align: right;
}
u {
    text-decoration: underline;
} 
#merah {
     background-color: #72F0E2;
} 
kl {
     text-color:#ED0E11;
}
       
	  
		.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
	background: #A6A5F3 url('images/ui-bg_fine-grain_10_f8f7f6_60x60.png') 50% 50% repeat;
}

/* begin: jQuery UI Datepicker moving pixels fix */
table.ui-datepicker-calendar {border-collapse: separate;}
.ui-datepicker-calendar td {border: 1px solid transparent;}
/* end: jQuery UI Datepicker moving pixels fix */

/* begin: jQuery UI Datepicker emphasis on selected dates */
.ui-datepicker .ui-datepicker-calendar .ui-state-highlight a {
	background: #743620 none;
	color: white;
}


.ui-page .ui-content .ui-btn.my-btn .ui-btn-inner {
    color      : green;
    background : red;
}



th {
    background-color: #4CAF50;
    color: white;
}
th, td {
    border: 1px solid #ddd;
}
tr:nth-child(even) {background-color: #D5F6F8}

tr{background-color:#FCF9F9}
tr:hover {background-color: 	}
  </style>
<script>		  
$(document).ready(function () {
   $("td .std").click(function() {
	//alert ('dfdg');
	var PO_KU = $(this).attr('POKU')
	var DIST = $(this).attr('man')
            window.open ( "detail_lap.php?INK="+DIST+"&POKU="+PO_KU, "MyWindow", 'width=1100, height=500, top=80, left=40')	
	
        });	
    
 });
</script>
    </head>

    <body>
    <?php  


$sqlshow9 = "select * from push_distributor where ACCOUNT_ID = '$AAA';";
		$queryshow9=mysqli_query($mysqli, $sqlshow9);
$datashow9=mysqli_fetch_array($queryshow9);
        $namaae = $datashow9 ['ACCOUNT_NAME'];

?>
    <div data-role="page" id="page1" data-theme="a">
        <div data-role="header">
            <h1>LAPORAN FESTIVE</h1>
            <h2></h2>
           <a href="home_admin.php" target="_parent" class="ui-btn ui-btn-inline ui-icon-back ui-btn-icon-notext ui-corner-all">No text</a>
        </div>
<!-- dialog so-->
<div id="data-popup" data-role="popup" data-theme="a" > </div>
<div id="popup-tgl" data-role="popup" data-theme="a" ></div>

        <div data-role="content">
         <br>
        <!--<button class="ui-btn ui-btn-inline" style="background:#F5BD8D;" id="tmb">Tambah Data</button>-->
        
      
      <!-- <b><font color="#BC0CBB">Note : Jika total kirim berwarna merah berarti jadwal kirim kurang dari KJ , Jadwal kirim harus ditambah!</font></b>--> 
<form id="formx" method="post" action="save_pengiriman.php" data-ajax="false">

<!--<div style="overflow-y:10px;">-->
       <table  width="100%" cellspacing="0" cellpadding="6">
  		<thead>
        <tr>
        <th >TAHUN</th>
        <th >ACCOUNT ID</th>
    		<th >NAMA</th>
            <th >KJ</th>
             <th  >REAL</th>
               <th  >DETAIL</th>
            
               
            
    		 
  		<!--style='min-width:150px'-->
        </tr>
        </thead>
        <tbody>
        <?php $sqlshow = "select *, YEAR(TGLD) as TANGGAL from
(select * from 
(select TGL as TGLD, BULAN_INPUT, NAMA_PRODUK, ITEM_CODE as ICX,
         ACCOUNT_ID as ACIDX, SUM(TARGET) as KJ from kj_f 
         group by ACCOUNT_ID, YEAR(TGL)) as SATU     
 left join      
 (select *, SUM(qty) as REALX from        
 (select * from order_kirim as AA, 
        (select  max(id) as max from order_kirim group by ACCOUNT_ID, YEAR(periode2), MONTH(periode2), item_code ) as BB 
         where  BB.max = AA.id) as NN
         group by YEAR(NN.periode2), NN.ACCOUNT_ID ) as DUA
         on SATU.ACIDX = DUA.ACCOUNT_ID
         
         and YEAR(SATU.TGLD) = YEAR(DUA.periode2)) as YY         
left join
(select * from push_distributor) as ZZ
on YY.ACIDX = ZZ.ACCOUNT_ID";
   
 
   
		$queryshow=mysqli_query($mysqli, $sqlshow);
while  	($datashow=mysqli_fetch_array($queryshow)){
	    $thns = $datashow ['TANGGAL']; 
        $acid = $datashow ['ACCOUNT_ID']; 
		 $name = $datashow ['ACCOUNT_NAME']; 
		 $target = $datashow ['KJ']; 
		 $qty = $datashow ['REALX'];
	
		 
		 		 
		echo "<tr>
		<td>$thns</td>
		<td>$acid</td>
		<td>$name</td>
		<td align='right'>$target</td>
		
		<td align='right'>$qty</td>
		<td><a href='#'  class='std' man='$acid' poku='$thns' >View</a></td>
		</tr>";
		
      }
		?>
			
        </tbody>
       
        </table>
       <!-- </div>-->
<!--<input type="submit" value="SAVE" name="SAVE" id="SAVE">          onClick= 'myPopup()'-->

</form>

        </div>
        <!--emnd role-content-->
        

        <div data-role="footer">
          
            <h2>Kokola Web Developer Department, 2016 </h2>
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