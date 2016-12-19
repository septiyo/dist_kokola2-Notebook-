<?php
//error_reporting(0);
session_start();

if($_SESSION['USER']) {
	include "koneksi.php";
$accid = $_SESSION['ACCOUNT_ID'];	
date_default_timezone_set("Asia/Jakarta");
	   		    $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				$lanku = date('m');
				$wkt = date('H:i:s'); 
//$jumHari = cal_days_in_month(CAL_GREGORIAN, $bulankus, 2016);
    ?>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="themeku/themes/themeku.css" />
	<link rel="stylesheet" href="themeku/themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="themeku/jquery.mobile.structure-1.4.5.css" />
    <link rel="stylesheet" href="themeku/fixedColumns.dataTables.min.css" />
	<script src="themeku/jquery-1.3.2.js"></script>
	<script src="themeku/jquery.mobile-1.4.5.js"></script>
        <script src="jqtable/jquery.dataTables.min.js"></script>
        <script src="jqtable/dataTables.jqueryui.min.js"></script>
         <script src="jqm2/dataTables.fixedColumns.min.js"></script>


        <script src="validation/jquery.validate.js"></script>
       <!-- <link rel="stylesheet" href="themes/9septi_season.min.css"/>
        <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css"/>-->
        <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
       <!-- <link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>-->
        <!--<link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">-->
        <link rel="stylesheet" href="jqtable/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="jqtable/dataTables.jqueryui.min.css">
        <style>.toolbar{
			margin:8;
		}
		div.toolbar {
   width: 50%;
   float: right;
   text-align: right;
}
        </style>
        <script>
		
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});
		
            $(document).ready(function () {
                $('#example').DataTable({
					 "dom": '<"toolbar">frtip',
					 fixedColumns:   {
            leftColumns: 2,
            //rightColumns: 1
        },
                    "scrollY": 300,
                    "scrollX": true,
                    /*"scrollY":        "400px",*/
                     "scrollCollapse": true,
                    "ordering": false,
                    "paging": false,
					"filter": false
                });
				$("div.toolbar").html('<b><input type="text" id="cari"></b>');
				$("#cari").keyup(function(e) {
                    cari_table();
                });
////total kjt
			//$("td .kjt").on("keyup", function(){
	            // var masuk   = $(this).val();
				// var satu   = Number($(this).parents('tr').find('.kjt').val());
				// var total = 0;
                   //  $(satu).each(function (index, element) {
                    //  total = total + parseFloat($(element).val());
                     //   });
						
                   //alert(total);
               // var forcast   = Number($(this).parents('tr').find('.FORECAST').val());
               /// var bulan1    = Number($(this).val());
               // var kolom_lain =  Math.round(Number((forcast - bulan1) ));
                //$(this).parents('tr').find('.BULAN2').val(kolom_lain);
				//hitung_total();
           // });	
				
				
				
				
            }); /////doc ready

function cari_table() {
	var value = $("#cari").val();	
	$("table tbody tr").each(function(index, element) {
		if (index >= 0) {	
			$row = $(this);	
			var id = $row.find("td:eq(0)").text().toLowerCase();
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
<?php 
  if ($lanku == "01")
					{  $tri = 'Jan-Feb-Mar'; }
					elseif ($lanku == "02")
					{  $tri = 'Jan-Feb-Mar'; }
					elseif ($lanku == "03")
					{  $tri = 'Jan-Feb-Mar'; }
					elseif ($lanku == "04")
					{  $tri = 'Apr-May-Jun'; }
					elseif ($lanku == "05")
					{  $tri = 'Apr-May-Jun'; }
					elseif ($lanku == "06")
					{  $tri = 'Apr-May-Jun'; }
					elseif ($lanku == "07")
					{  $tri = 'Jul-Aug-Sep'; }
					elseif ($lanku == "08")
					{  $tri = 'Jul-Aug-Sep'; }
					elseif ($lanku == "09")
					{  $tri = 'Jul-Aug-Sep'; }
					elseif ($lanku == "10")
					{  $tri = 'Oct-Nov-Dec'; }
					elseif ($lanku == "11")
					{  $tri = 'Oct-Nov-Dec'; }
					elseif ($lanku == "12")
					{  $tri = 'Oct-Nov-Dec'; }

?>
    <body>

    <div data-role="page" class="type-interior" data-theme="a">
        <div data-role="header">
            <h1>ORDER KIRIM <?php // echo $jumlah_kun?></h1>

            <h2>Kokola Distributor</h2>&nbsp;&nbsp;&nbsp;<a href="pilih_pengiriman.php" target="_parent" class="ui-btn ui-btn-inline ui-icon-back ui-btn-icon-notext ui-corner-all">No text</a>
        </div>

        <div data-role="content">
<form id="formx" method="post" action="save_pengiriman.php" data-ajax="false">
       <table id="example"  class="display"  cellspacing="0" width="100%">
  		<thead>
        <tr>
    		<th style='min-width:250px' align="center">Nama Produk</th>
    		<th style='min-width:70px'>Jumlah </th>
            
	        <?php
			 $tanggalan   = $_POST['JADWAL'];
             $kun = explode(",",$tanggalan);
             //$jumlah_kun = count($kun)-1;
			 //////tambahan replace
			 $rep = str_replace(',', '', $tanggalan);
			 $lace = str_split($rep,2);
			 $ace = array_unique($lace);
			 
			 $jumlah_kun = count($ace);
			 //////////////akhir replace
			 
			//echo "<th style='min-width:70px'>Nama Produk</th>";
		
			for($i=0; $i<$jumlah_kun; $i++){
				$k = $i+1 ;
				$mol = $kun[$i];
				$siomie = $ace[$i];
				echo "<th style='min-width:50px' >$siomie</th>";
				}
				?>
  		</tr>
        </thead>
        <tbody>
        <?php
		$no = 1;
		//$sql_acc = " SELECT * from user where account_id = '$accid'";
              //  $hasil_cc = mysqli_query($mysqli, $sql_cc);
               // $data_cc = mysqli_fetch_assoc($hasil_cc);
				//$unm = $data_cc['USER'];
				 $sql_kj = "SELECT * from user where account_id = '$accid'";
                $hasil_kj = mysqli_query($mysqli, $sql_kj);

               $data_kj = mysqli_fetch_array($hasil_kj);
				$unm = $data_kj['USER'];	
		//$sql_cari_produk_id = "SELECT KK.KU, KK.ID_PRODUK, KK.BULAN1,  ID, NAMA_PRODUK, ITEM_CODE FROM m_produk as CC 
//right join (select ID as KU, ID_PRODUK, BULAN1  from kj) as KK on CC.ID = KK.KU; ";

//$sql_cari_produk_id = " SELECT KK.KU, KK.ID_PRODUK, KK.BULAN_INPUT as BLI, KK.BULAN1,KK.BULAN2,KK.BULAN3, KK.NAMA_DIST,  //ID, NAMA_PRODUK, ITEM_CODE FROM m_produk as CC inner join (select ID as KU, BULAN_INPUT,ID_PRODUK, BULAN1,BULAN2,BULAN3, //NAMA_DIST  from kj) as KK on CC.ID = KK.KU and KK.NAMA_DIST = '$unm'";
$sql_cari_produk_id = "  Select * from ( select * from (select ITEM_NAME as NP, ITEM_CODE as ICOD from push_item) as KK 
right join (select * from forecast where publish = '1') as forecast on KK.ICOD = forecast.ITEM_CODE ) 
    as MM where MM.ACCOUNT_ID = '$accid' and TRIWULAN = '$tri' and YEAR(TGL) = '$yearku'; ";
                $hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
                while ($data_id = mysqli_fetch_array($hasil_cari_produk_id)){
					$nmprod = $data_id['NP'];
					$bli = $data_id['BULAN_INPUT'];
					//////detect bulan
					if ($lanku == "01")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "02")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "03")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "04")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "05")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "06")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "07")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "08")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "09")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "10")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "11")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "12")
					{  $bulanku = $data_id['BULAN1']; }
					
					//$bulanku = $data_id['BULAN2'];
					$icod = $data_id['ICOD'];
					
			//echo "<input type='hidden' name='ACCID[]' value='$accid'>";		
			echo "<tr><td ><input type='hidden' name='BARANG[]' value=''>$nmprod</td>
			<td class='jml_barang' align='center'>$bulanku</td>";
			for($i=0; $i<$jumlah_kun; $i++){
				$k = $i+1 ;
				$mol = $kun[$i];
			   echo "<td align='center'><input type='hidden' name='ACCID[]' value='$accid'>
				     <input type='hidden' name='KUS[]' value='$icod'>
				     <input type='hidden' name='TANGGAL[]' value='$yearku-$lanku-$mol'>
<input type='text' class='produk' urut='".$i."' name='PRODUK1[]' value='0' style='width:70' data-role='none' ></td>";
				}
		    echo "</tr>";
			$no++;
				}
				
				?>
                </tbody>
        </table>
<input type="submit" value="SAVE" name="SAVE" id="SAVE">

</form>
<?php //foreach($sol as $result) {
                  //  echo $result['type'], '<br>';
                   // }
				   //echo 'dufu'.$unm?>
        </div>
        <!--emnd role-content-->

        <div data-role="footer">
         <!--   <table align="center">
                <tr>
                    <td align="center">
                        <a href="logout.php" style="text-align: center" data-role="button" data-icon="power"
                           target="_parent" data-ajax="false">Sign Out</a>
                    </td>
                </tr>
            </table>-->
            <h2>Kokola Web Developer Department, 2016</h2>
        </div>


    </div>
    <!--end role page-->
    <script>
	
	$(document).ready(function() {
		
	$(".produk").each(function(index, element) {
		//if ($(this).attr("urut") == 0) {
		//	var jml = $(this).parents("tr").find(".jml_barang").text();
		//	$(this).val('');
		//}
		//else {
		//	$(this).val('');
       //}
    });
	////////////tdk dipakai
	
	var lama = "";
	$(".produk").keydown(function() {
		lama = $(this).val();
    });
	
	$(".produk").keyup(function() {
		var omg = 0;
		var $this = $(this);
		var urut = $(this).attr("urut");
		
        for (x=0;x<=urut;x++){
			omg = Number(omg) + Number($this.parents("tr").find($("input[urut="+x+"]")).val());
		}
		
		
		urut = Number(urut)+1;
		var jml = $(this).parents("tr").find(".jml_barang").text();
		//alert(jml - omg);
		if ((jml - omg) >= 0) {
			$(this).parents("tr").find("input[urut="+urut+"]").val(jml - omg);
		}
		/*else {
			alert("Jumlah total tidak boleh kurang dari komitmen jual = "+jml+"");
			$(this).val(lama);
		}*/
		return false;	
    });
});

	</script>
    </body>
    </html>
    <?php
}
else{
}
?>