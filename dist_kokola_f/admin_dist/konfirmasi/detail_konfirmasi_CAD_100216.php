<?php
session_start();
error_reporting (0);
//ini_set('display_errors', 1);
include "../../koneksi.php";
//include "koneksi.php";
if($_SESSION['HAK'] != "ADMIN") {
    echo "Anda tidak berhak..!";
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<script src="../../jqm2/jquery-2.1.4.min.js"></script>
<script src="../../jqm2/jquery.mobile-1.4.5.min.js"></script>
<script src="../../jqtable/jquery.dataTables.min.js"></script>
<script src="../../jqtable/dataTables.fixedColumns.min.js"></script>
<script src="../../jqtable/dataTables.jqueryui.min.js"></script>
<script src="../../jqtable/dataTables.buttons.min.js"></script>
<script src="../../jqtable/dataTables.select.min.js"></script>
<script src="../../jqtable/dataTables.editor.min.js"></script>
<!--script src="jquery.jeditable.js" type="text/javascript" charset="utf-8"></script-->

<script src="../../validation/jquery.validate.js"></script>
<link rel="stylesheet" href="../../themes/9septi_season.min.css" />
<link rel="stylesheet" href="../../themes/jquery.mobile.icons.min.css" />
<!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
<link rel="stylesheet" href="../../jqm2/jqmobile.structure-1.4.5.min.css"/>
<link rel="stylesheet" href="../../jqtable/jquery.dataTables.min.css">
<link rel="stylesheet" href="../../jqtable/fixedColumns.dataTables.min.css">

<link rel="stylesheet" href="../../jqtable/buttons.dataTables.min.css">
<link rel="stylesheet" href="../../jqtable/select.dataTables.min.css">
<link rel="stylesheet" href="../../jqtable/editor.dataTables.min.css">
<link rel="stylesheet" href="../../jqtable/themes/smoothness/jquery-ui.css">
<script>
$(document).ready(function () {

	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});




	$('#example').DataTable({
		"scrollY": 300,
		"scrollX": true,
		/*fixedColumns:   {
		 leftColumns: 1
		 },*/
		"scrollCollapse": true,
		"ordering": false,
		"paging": false
	});
});

$(document).ready(function () {
	$('#example2').DataTable({
		"scrollY": 300,
		"scrollX": true,
		/*fixedColumns:   {
		 leftColumns: 1
		 },*/

		"scrollCollapse": true,
		"ordering": false,
		"paging": false
	});
});

//tambah order
$(document).ready(function () {
	$('#example3').DataTable({
		"dom": '<"toolbar">frtip',
		"scrollY": 400,
		"scrollX": true,
		/*fixedColumns:   {
		 leftColumns: 1
		 },*/

		"scrollCollapse": true,
		"ordering": false,
		"paging": false,
		"filter":false,
	});

	$("div.toolbar").html('<b><input type="text" id="cari" placeholder="Cari"></b>');
	$("#cari").keyup(function(e) {
		cari_table();
	});
});//end ready function

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

//$(document).ready(function(){

    $("#FORM_CONFIRM").on('keyup keypress',function(e){
	var keyCode = e.keyCode || e.which;
	if(keyCode === 13){
	  e.preventDefault();
	  returnfalse;
	}
	
	});
//});
  

</script>

<style>
/*th, td { white-space: nowrap; }
div.dataTables_wrapper {
	width: 800px;
	margin: 0 auto;
}*/


.ui-dialog-contain {
	width: 100%;
	max-width: 1000px;
	margin: 10% auto 15px auto;
	padding: 0;
	position: relative;
	top: -90px;
}
.NITAS{
  color: black;
  font-size: 55px;
}
.NITIS{
  font-size: 24px;
 font-weight: bold;
}
</style>

</head>

<body>
<script>
$(document).ready(function (){
	$("#tbl").hide();    
    $("#tambah").click(function (){
        $('html, body').animate({
            scrollTop: $("#div1").offset().top
        }, 700);
        $("#tbl").show();
    });
    $("#cancel").click(function (){
        $('html, body').animate({
            scrollTop: 0
        }, 700);
        
        $("#tbl").hide();
    });
	
	hitung_baru();
});

</script>


<?php
if(isset($_POST['CONFIRM'])){	
	date_default_timezone_set("Asia/Jakarta");
	$today          = date('d')."-".date('m')."-".date('Y');
	$today_database = date('Y')."-".date('m')."-".date('d');
	$time = date('H:i:s');
	
	
	//print_r($_POST);
	
	
	$jos = $_POST['JOS']; 
	
	//echo "<h1>".$jos."</h1>";
	$qty          = $_POST['QTY'];//jml_order
	$account_idne = $_POST['ACC'];
	$userid       = $_POST['USERID'];
	$item_code    = $_POST['ITEM_CODE'];
	
	$jumlah_qty   = count($item_code);
	//echo "<h1>".$jumlah_qty."</h1>";
	
	$kubikasi      = $_POST['KUBIKASI_OLAHAN'];
	$kubikasi_asli = $_POST['KUBIKASI_OLAHAN_ASLI'];
	$id_order      = $_POST['ID_ORDER'];
	$tgl_order     = $_POST['TGL_ORDER'];
	$id_produk     = $_POST['ID_PRODUK'];
        

	/*foreach ($qty as $bacadata2){	
	}*/
	
	if($jos == "1"){
	   $n=0;
   	while($n < $jumlah_qty ){
		if($qty[$n] != "") {
			if($kubikasi[$n] == ""){
				$kubikasi_fix =  $kubikasi_asli;
			}
			else {
				$kubikasi_fix =  $kubikasi;
			}

			$insert_confirm = "INSERT INTO order_confirm SET ID_ORDER = '$id_order',
				TGL_ORDER = '$tgl_order[$n]',
				ACCOUNT_ID = '$account_idne',
				ID_PRODUK = '$id_produk[$n]',
				ITEM_CODE = '$item_code[$n]',
				JML_ORDER = '$qty[$n]',
				KUBIKASI = '$kubikasi_fix[$n]',
				TGL_CONFIRM = '$today_database $time',
				FLAG2 = '3'";
				
			//echo $insert_confirm;
			
			$hasil_confirm = mysqli_query($mysqli, $insert_confirm);


			/*Update flag order_kirim_wd flag yang sudah diorderkan*/

			$update_kirim_wd = "UPDATE order_kirim_wd SET flag = '3' WHERE item_code = '$item_code[$n]' AND qty = '$qty[$n]'";

			$hasil_update_wd = mysqli_query($mysqli, $update_kirim_wd);
			
	/*ambil lagi sisanya*/
			$cari_sisa_kj = "SELECT qty,item_code
                            FROM order_kirim_wd
                            WHERE flag = '1'
                             AND ACCOUNT_ID= '$account_idne'
                            AND periode2 <= '$today_database'";
							
							
							   
            $hasil_sisa_kj = mysqli_query($mysqli, $cari_sisa_kj);	
              $data_sisa = mysqli_fetch_assoc($hasil_sisa_kj);
			  
			  $qty_sisa = $data_sisa[qty];
              $item_sisa = $data_sisa[item_code];
			  
			//  echo $cari_sisa_kj;
			  
			  

 	/*Update status jadi sisa order_kirim_wd*/		  
	
	 $update_flag_sisa = "UPDATE order_kirim_wd SET flag = '6' WHERE item_code = '$item_sisa'
	                       AND qty = '$qty_sisa'";
						   
		$hasil_update_sisa  = mysqli_query($mysqli, $update_flag_sisa);
		
		//echo $update_flag_sisa;
		
		//exit;
      	


		}
		$n++;
   }

   
   	
			  

   
   
   $sql_ubah_distributor = "UPDATE order_distributor SET  FLAG = '3' WHERE ID_ORDER = '$id_order'";

   $hasil_ubah = mysqli_query($mysqli, $sql_ubah_distributor);





   
	}
	
	if($jos == "2"){
	    $n=0;
   	while($n < $jumlah_qty ){
		if($qty[$n] != "") {
			if($kubikasi[$n] == ""){
				$kubikasi_fix =  $kubikasi_asli;
			}
			else {
				$kubikasi_fix =  $kubikasi;
			}
			$insert_confirm = "INSERT INTO order_confirm SET ID_ORDER = 'no ID Order/Bypass',
				TGL_ORDER = '$today_database $time',
				ACCOUNT_ID = '$account_idne',
				ID_PRODUK = '$id_produk[$n]',
				ITEM_CODE = '$item_code[$n]',
				JML_ORDER = '$qty[$n]',
				KUBIKASI = '$kubikasi_fix[$n]',
				TGL_CONFIRM = '$today_database $time',
				FLAG2 = '4'";
				
			//echo $insert_confirm;
			
			$hasil_confirm = mysqli_query($mysqli, $insert_confirm);


			/*Update flag order_kirim_wd*/

			//$update_kirim_wd = "UPDATE order_kirim_wd SET flag = '5' WHERE item_code = '$item_code[$n]'";
			$update_kirim_wd = "UPDATE order_kirim_wd SET flag = '4' WHERE item_code = '$item_code[$n]'";

			$hasil_update_wd = mysqli_query($mysqli, $update_kirim_wd);

			/*Update flag order_distributor*/

			/*$update_order_detail = "UPDATE order_detail SET FLAG = '5' WHERE item_code = '$item_code[$n]'";

			$hasil_order_detail = mysqli_query($mysqli, $update_order_detail);*/




		}
		$n++;
   }

   /*ubah order order_kirim_wd*/
   $sql_ubah_kirim_wd = "UPDATE order_kirim_wd SET  FLAG = '4' WHERE ACCOUNT_ID = '$account_idne' AND periode2 = '$today_database'";
   //echo $sql_ubah_kirim_wd;
   $hasil_ubah = mysqli_query($mysqli, $sql_ubah_kirim_wd);



		$sql_ubah_distributor = "UPDATE order_distributor SET  FLAG = '3' WHERE ID_ORDER = '$id_order'";

		$hasil_ubah = mysqli_query($mysqli, $sql_ubah_distributor);
   
  }
  if($jos == "3"){
	    $n=0;
   	while($n < $jumlah_qty ){
		if($qty[$n] != "") {
			if($kubikasi[$n] == ""){
				$kubikasi_fix =  $kubikasi_asli;
			}
			else {
				$kubikasi_fix =  $kubikasi;
			}
			$insert_confirm = "INSERT INTO order_confirm SET ID_ORDER = 'no ID Order/Bypass',
				TGL_ORDER = '$today_database $time',
				ACCOUNT_ID = '$account_idne',
				ID_PRODUK = '$id_produk[$n]',
				ITEM_CODE = '$item_code[$n]',
				JML_ORDER = '$qty[$n]',
				KUBIKASI = '$kubikasi_fix[$n]',
				TGL_CONFIRM = '$today_database $time',
				FLAG2 = '5'";
				
			//echo $insert_confirm;
			
			$hasil_confirm = mysqli_query($mysqli, $insert_confirm);


			/*Update flag order_kirim_wd*/

			$update_kirim_wd = "UPDATE order_kirim_wd SET flag = '5' WHERE item_code = '$item_code[$n]'";
		
			$hasil_update_wd = mysqli_query($mysqli, $update_kirim_wd);

			/*Update flag order_distributor*/

			/*$update_order_detail = "UPDATE order_detail SET FLAG = '5' WHERE item_code = '$item_code[$n]'";

			$hasil_order_detail = mysqli_query($mysqli, $update_order_detail);*/




		}
		$n++;
   }

   /*ubah order order_kirim_wd*/
   $sql_ubah_kirim_wd = "UPDATE order_kirim_wd SET  FLAG = '4' WHERE ACCOUNT_ID = '$account_idne' AND periode2 = '$today_database'";
   //echo $sql_ubah_kirim_wd;
   $hasil_ubah = mysqli_query($mysqli, $sql_ubah_kirim_wd);


	  $sql_ubah_distributor = "UPDATE order_distributor SET  FLAG = '3' WHERE ID_ORDER = '$id_order'";

	  $hasil_ubah = mysqli_query($mysqli, $sql_ubah_distributor);
   
  } 
	
	
	
	
   
   if($hasil_ubah){
	   echo "<script>alert('Confirm berhasil..!, Mohon segera kirimkan barang');
	   	window.location='konfirmasi_order.php';
		</script>";
   }
   else{
	   echo "<script>alert('Confirm Gagal..!,');</script>";
   }
}//end isset'
?>
<div data-role="page"  id="page1" class="type-interior" data-theme="f">
    <div data-role="header">
        <h1>Forcast FORM </h1>    
        <h2>Kokola Admin 2.5</h2>
    </div>
    <?php
		$jos = $_GET['JOS'];
	?>
    <div data-role="content" id="top">
		<div align="center" class='NITIS'>KONFIRMASI ORDER DETAIL<?php //if($jos == 1){echo "<div style='color:yellow'>CODE 1</div>";}else{echo "<div style='color:red'>CODE 2</div>";}?></div>
        
		<?php
		// error_reporting(0);
		date_default_timezone_set("Asia/Jakarta");
		$today = date('d') . "-" . date('m') . "-" . date('Y');
		$today_database = date('Y') . "-" . date('m') . "-" . date('d');
		$time = date('H:i:s');
		$month = date('M');

		$_SESSION['BULAN_NOW'] = $month;
		$account_id = $_GET['ID'];
		$nama = $_GET['NAMA'];
		$kota = $_GET['KOTA'];
		$user_id = $_GET['USERID'];
		$id_order = $_GET['IDORDER'];

//echo $id_order;
	
		
		//echo $jos;

		/*echo "<a href='tambah_order.php?ID=$account_id&NAMA=$nama&KOTA=$kota&USERID=$user_id'
			data-role='button' data-ajax='false' target='_parent' class='ui-btn ui-btn-inline'
			data-theme='f'>TAMBAH ORDER</a>";*/
		?>
        
		<!--<button id="tambah" data-role='button' class='ui-btn ui-btn-inline' data-theme='f'>Tambah Order</button>-->
	
     <!--   <fieldset class="ui-grid-a">
    <div class="ui-block-a">
            <button id="tambah" data-role='button' class='ui-btn ui-btn-inline' data-theme='f'>Tambah Order</button>
    </div>
    <div class="ui-block-b" align="right">
          <SOS align="right" id="MKJ" class='NITAS' >rhyreyh</SOS>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<SOS align="right" id="MKI" class='NITAS' >rhyreyh</SOS>
    </div>
    
</fieldset>-->
        <table border="0" width="100%">
        <tr>
        <td class='NITIS'><?php if($jos == 1) {
			echo "<div style='color:yellow'>CODE 1</div>";}
			if($jos == 2){echo "<div style='color:red'>CODE 2</div>";}
			if($jos == 3){echo "<div style='color:red'>CODE 3</div>";}
			?></td>         
        <td align="right"><SOS  id="MKJ" class='NITAS' >rhyreyh</SOS></td>
        </tr>
        <tr>
        <td><button id="tambah" data-role='button' class='ui-btn ui-btn-inline' data-theme='f'>Tambah Order</button></td>
        <td align="right"><SOS  id="MKI" class='NITAS' >rhyreyh</SOS></td>
        </tr>
        </table>
        <form method="POST" action="detail_konfirmasi.php" data-ajax="false" id="FORM_CONFIRM">
			<table id="example" class="stripe row-border order-column" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    	<td align="center" colspan="6"><h2><?php echo $nama." ".$kota;?></h2></td>
                    </tr>
                    <tr>
                        <th align="center">DATE TIME</th>
                        <th align="center">ITEM</th>
                        <th align="center">HARGA</th>
                        <th align="center">QTY</th>
                        <th align="center">KUBIKASI TOTAL</th>
                        <th align="center">SUBTOTAL</th>
                        <!--th align="center">EDIT ORDER</th-->
                    </tr>
                </thead>
                
				<tbody>
					<?php	

					if($jos == 1) {           
						$sql = "SELECT distinct order_distributor.TGL AS TGL_ORDER,
							order_distributor.ID_ORDER,
							`order_distributor`.`ACCOUNT_ID`,
							`order_detail`.`ID_PRODUK`,
							`order_detail`.`ITEM_CODE`,
							order_distributor.USERID,
							user.KOTA,
							order_detail.JML_ORDER AS qty,
							m_produk.NAMA_PRODUK,
							m_produk.HARGA,
							kubikasi.KUBIK
							FROM user,order_distributor,order_detail,m_produk,kubikasi
							WHERE order_distributor.ACCOUNT_ID = user.ACCOUNT_ID
							AND DATE(order_distributor.TGL) <= '$today_database'
							AND order_distributor.ID_ORDER = order_detail.ID_ORDER
							AND m_produk.ITEM_CODE = order_detail.ITEM_CODE
							AND order_distributor.ACCOUNT_ID = '$account_id'
							AND kubikasi.ITEM_CODE = order_detail.ITEM_CODE
                            AND order_distributor.ID_ORDER = '$id_order'
							GROUP BY m_produk.NAMA_PRODUK";
					}
					if($jos == 2) {
                    
					$sql = "SELECT user.NAMA,
							user.KOTA,
							user.ACCOUNT_ID,
							order_kirim_wd.ACCOUNT_ID,
							order_kirim_wd.periode2,
							SUM(order_kirim_wd.qty) AS qty,
							order_kirim_wd.ITEM_CODE,
							m_produk.NAMA_PRODUK,
							m_produk.HARGA,
							kubikasi.KUBIK,
							m_produk.ID as ID_PRODUK
							
							FROM user,order_kirim_wd,m_produk,kubikasi
							WHERE user.ACCOUNT_ID = order_kirim_wd.ACCOUNT_ID
							AND order_kirim_wd.periode2 <= '$today_database'
							AND order_kirim_wd.ACCOUNT_ID = '$account_id'
							AND m_produk.ITEM_CODE = order_kirim_wd.ITEM_CODE
							AND m_produk.ITEM_CODE = kubikasi.ITEM_CODE
							AND order_kirim_wd.flag = '1'
							GROUP BY m_produk.NAMA_PRODUK";	   
						}   
						if($jos == 3) {
							
							$sql = "SELECT user.NAMA,
							user.KOTA,
							user.ACCOUNT_ID,
							order_kirim_wd.ACCOUNT_ID,
							order_kirim_wd.periode2,
							SUM(order_kirim_wd.qty) AS qty,
							order_kirim_wd.ITEM_CODE,
							m_produk.NAMA_PRODUK,
							m_produk.HARGA,
							kubikasi.KUBIK,
							m_produk.ID as ID_PRODUK
							
							FROM user,order_kirim_wd,m_produk,kubikasi
							WHERE user.ACCOUNT_ID = order_kirim_wd.ACCOUNT_ID
							AND order_kirim_wd.periode2 <= '$today_database'
							AND order_kirim_wd.ACCOUNT_ID = '$account_id'
							AND m_produk.ITEM_CODE = order_kirim_wd.ITEM_CODE
							AND m_produk.ITEM_CODE = kubikasi.ITEM_CODE
							AND order_kirim_wd.flag = '6'
							GROUP BY m_produk.NAMA_PRODUK";
						
							
							
						}
						
						
						
						
						
						//echo $sql;
                    
                        /*$sql = "SELECT user.NAMA,
                        user.`KOTA`,
                        user.`ACCOUNT_ID`,
                        `m_produk`.`NAMA_PRODUK`,
                        `m_produk`.`ITEM_CODE`,
                        `m_produk`.`HARGA`,
                        `kubikasi`.`KUBIK`,
                        SUM(order_kirim_wd.`qty`) AS qty
                        FROM USER,`order_kirim_wd`,`m_produk`,`kubikasi`
                        WHERE `order_kirim_wd`.`periode2` = '$today_database'
                        AND `order_kirim_wd`.`ACCOUNT_ID` = user.`ACCOUNT_ID`
                        AND order_kirim_wd.`item_code` = `m_produk`.`ITEM_CODE`
                        AND `order_kirim_wd`.`ACCOUNT_ID` = '$account_id'
                        AND `kubikasi`.`ITEM_CODE` = `m_produk`.`ITEM_CODE`
                        GROUP BY `m_produk`.`NAMA_PRODUK`";*/
						
                    $hasil = mysqli_query($mysqli, $sql);
                    $jumlah_qty = 0;
                    $jumlah_total = 0;
                    $jumlah_kubikasi_total = 0;
                    $jumlah_qty2 = 0;
                    while($data = mysqli_fetch_assoc($hasil)){

                          //echo $data[ID_ORDER];
						$jml_kubik = $data['KUBIK'];
                        $subtotal = $data['HARGA'] * $data['qty'];
                        $kubikasi_total = $data['qty'] * $data['KUBIK'];
                        $kubikasi_total2 = number_format($kubikasi_total);
        
                        $harga2 = number_format($data['HARGA']);
                        $qty2   = number_format($data['qty']);
                        $subtotal2   = number_format($subtotal);
                        echo "<tr>";						
						if($data['TGL_ORDER'] =="") {						
						echo "<td align='center'>---
                                 <input type='hidden' value='$data[ID_PRODUK]' id='ID_PRODUK' name='ID_PRODUK[]'>
                                 <input type='hidden' value='$data[ITEM_CODE]' id='ITEM_CODE' name='ITEM_CODE[]'>
                                 <input type='hidden' value='$data[ID_ORDER]' id='ID_ORDER' name='ID_ORDER[]'>
                                 <input type='hidden' value='$data[TGL_ORDER]' id='TGL_ORDER' name='TGL_ORDER[]'>
                                 </td>";
        
						
						
						}
						else{
						
						  echo "<td align='center'>$data[TGL_ORDER]
                                 <input type='hidden' value='$data[ID_PRODUK]' id='ID_PRODUK' name='ID_PRODUK[]'>
                                 <input type='hidden' value='$data[ITEM_CODE]' id='ITEM_CODE' name='ITEM_CODE[]'>
                                 <input type='hidden' value='$data[ID_ORDER]' id='ID_ORDER' name='ID_ORDER[]'>
                                 <input type='hidden' value='$data[TGL_ORDER]' id='TGL_ORDER' name='TGL_ORDER[]'>
                                 </td>";
        
						
						}
						
                        
                        echo "<td align='center'>$data[NAMA_PRODUK]</td>";
                        echo "<td align='center'><div class='HARGA'>$harga2</div>
                            <input type='hidden' value='$data[HARGA]' id='HARGA' name='HARGA[]'>
                            </td>";
							
                        echo "<td align='center'><input type='text' value='$data[qty]' class='QTY_CONFIRM' name='QTY[]'> </td>";
						
                        echo "<td align='center'><div class='KUBIKASI_CONFIRM'>$kubikasi_total2</div>
							<input type='hidden' name='KUBIKASI[]' class='nilai_kubik' value='$jml_kubik'>
                            <input type='hidden' name='KUBIKASI[]' id='KUBIKASI' value='$kubikasi_total2'>
                            <input type='hidden' name='KUBIKASI_OLAHAN[]' id='KUBIKASI_OLAHAN'>
                            <input type='hidden' name='KUBIKASI_OLAHAN_ASLI[]' value='$kubikasi_total2' id='KUBIKASI_OLAHAN'>
                            </td>";
							
                        echo "<td align='center'><div class='SUBTOTAL'>$subtotal2</div>
                            <input type='hidden' name='SUBTOTAL[]' id='SUBTOTAL'>
                            </td>";
                        echo "</tr>";
    
                        //echo $qty2;
                        $jumlah_qty = $jumlah_qty + $data['qty'];
                        $jumlah_total =  $jumlah_total + $subtotal;
                        $jumlah_kubikasi_total = $jumlah_kubikasi_total + $kubikasi_total2;
                        
                        $jumlah_qty2 = number_format($jumlah_qty);
                        $jumlah_total2 = number_format($jumlah_total);
                        $jumlah_kubikasi_total2 = number_format($jumlah_kubikasi_total);
                    }
                    ?>
                    </tbody>
                    <!--<form method="POST" action='edit_qty.php'>	
                    <div id="popupLogin" data-role="popup" data-theme="a" class="ui-corner-all">            
                        <div style="padding:10px 20px;">
                            <h3>Please sign in</h3>
                            <label for="un" class="ui-hidden-accessible">Username:</label>
                            <input name="user" id="un" value="" placeholder="username" data-theme="a" type="text">
                           
                            <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">
                                Sign in</button>
                        </div>            
                    </div>
                    </form>-->
					<tfoot>
                    <tr>
                        <!--th align="center" colspan="3"></th>
                        <th align="center"><?php echo $jumlah_qty2;?></th>
                        <th-- align="center"><?php echo $jumlah_total2;?></th-->        
                        <th align="center" colspan="3"></th>
                        <th align="center"><!--<?php echo $jumlah_qty2;?>-->
                        	<div id="jml_qty" class='jumlah_total_qty'></div></th>
                        <th align="center"><!--<?php echo $jumlah_kubikasi_total2;?>-->
                        	<div id="jml_kubik" class='KUBIKASI_PUT'></div></th>
                        <th align="center"><!--<?php echo $jumlah_total2;?>-->
                        	<div id="jml_harga" class='SUBTOTAL_PUT'></div></th>       
                    </tr>
                    </tfoot>
                </table>
				<input type="hidden"   name="JOS" value="<?php echo $jos;?>">
                <input type="hidden" name="ACC" value="<?php echo $account_id;?>" />
 <input name="ID_ORDER" id="un" value="<?php echo $id_order;?>"  data-theme="a" type="hidden">
                <input type="submit" name="CONFIRM" value="CONFIRM" />
                </form>
		<br><br>

        <a href="konfirmasi_order.php" data-role="button" data-ajax="false">Back</a>
        <!-- tambaahan -->
        <div id="div1">
		<div id="tbl" >
			<form id="formx" method="post" action="detail_konfirmasi.php" data-ajax="false">
				<table>
					<tr>
						<td align="center" colspan="9">
							<h4 align="center">Distributor  : <?php echo $nama; ?></h4>
							<input type="hidden" value="<?php echo $_SESSION['TRIWULAN']; ?>" name="TRIWULAN">
						</td>
					</tr>
                    <!--tr>
                    	<th colspan="9" align="center">Nama Distributor : <?php #echo $_SESSION['USER']; ?></th>
                    </tr-->
				</table>

				<!--table border="1" cellpadding="1" cellspacing="0" align="center"-->
				<table id="example3"  class="order-column display stripe" cellspacing="0" width="100%">
					<thead>
					<tr bgcolor="#7fffd4">
						<th width="100">Nama Produk</th>
						<th width="30">Harga</th>
						<th width="50">Qty</th>
						<th width="50">Total Kubikasi</th>
						<th width="100" class="TOTAL_VALUE">Total Value</th>
					</tr>
					</thead>

					<tbody>
					<?php
					//$sql_produk = "SELECT * FROM m_produk WHERE HARGA <> 0  ORDER BY NAMA_PRODUK ASC";

					/*$sql_produk = "SELECT m_produk.`NAMA_PRODUK`,
											m_produk.`HARGA`,
											m_produk.`ITEM_CODE`,
										   `kubikasi`.`KUBIK`
											FROM `m_produk`,`kubikasi`
											  WHERE m_produk.`ITEM_CODE` = `kubikasi`.`ITEM_CODE`
											  AND   m_produk.`HARGA` <> 0
										   ORDER BY `m_produk`.`NAMA_PRODUK` ASC";*/
										   
					$sql_produk = "select * from
						(SELECT m_produk.`NAMA_PRODUK`,	m_produk.`HARGA`,
						m_produk.`ITEM_CODE`,
						`kubikasi`.`KUBIK`
						FROM `m_produk`,`kubikasi`
						WHERE m_produk.`ITEM_CODE` = `kubikasi`.`ITEM_CODE`
						AND   m_produk.`HARGA` <> 0
						ORDER BY `m_produk`.`NAMA_PRODUK` ASC) XXX
											WHERE XXX.ITEM_CODE NOT IN
												(SELECT m_produk.ITEM_CODE
												FROM user,order_distributor,order_detail,m_produk,kubikasi
												WHERE order_distributor.ACCOUNT_ID = user.ACCOUNT_ID
												AND order_distributor.TGL LIKE '%$today_database%'
												AND order_distributor.ID_ORDER = order_detail.ID_ORDER
												AND m_produk.ITEM_CODE = order_detail.ITEM_CODE
												AND order_distributor.ACCOUNT_ID = '$account_id'
												AND kubikasi.ITEM_CODE = order_detail.ITEM_CODE
												GROUP BY m_produk.NAMA_PRODUK);";

					$hasil_produk = mysqli_query($mysqli, $sql_produk);

					while ($data_produk = mysqli_fetch_assoc($hasil_produk)) {
						echo "<tr>";
						echo "<td align='left'>$data_produk[NAMA_PRODUK]
							<input type='hidden' value='$data_produk[ITEM_CODE]' name='ITEM_CODE[]'>
							</td>";
						echo "<td><div class='HARGA' align='center'>$data_produk[HARGA]</div>
							<input type='hidden' value='$data_produk[HARGA]' name='HARGA[]'></td>";
						echo "<td align='left'><input type='text' name='QTY[]' id='QTY' class='QTY' placeholder='...' ></td>";
						echo "<td align='center'><div class='KUBIKASI'></div>
							<input type='hidden' name='KUBIKASI[]' value='$data_produk[KUBIK]' id='KUBIKASI' readonly>
							<input type='hidden' name='KUBIKASI2[]' id='KUBIKASI2' readonly>
							</td>";
						echo "<td align='center'><div class='TOTAL'></div>
							<input type='hidden' name='TOTAL[]' id='TOTAL' readonly></td>";
						echo "</tr>";
					}
					?>
					</tbody>
					<tfoot>
					<tr bgcolor="#7fffd4">
						<th width="100">Nama Produk</th>
						<th width="30">Harga</th>
						<th width="50"><div id="jumlah_total_qty">0</div></th>
						<th width="50"><div id="kubikasi_total"></div></th>
						<th width="100"><div id="total_total_value"></div> </th>
					</tr>
					</tfoot>
				</table>

				<table align="center" width="300">
					<tr>
						<td colspan="5" align="center">		
                        	<input type="hidden" name="ACC" value="<?php echo $account_id;?>">
							<input type="hidden" name="USERID" value="<?php echo $user_id;?>">	
                            <input type="hidden" name="DISTRIBUTOR" value="<?php echo $nama;?>">
							<input type="hidden" name="KOTA_DISTRIBUTOR" value="<?php echo $kota;?>">
							<input type="submit" value="SAVE" name="SAVE" id="SAVE"><br>
							<button id="cancel" type="button" data-role='button' data-theme='f'>cancel</button>
							<!--a-- href="syarat.php" class="ui-shadow ui-btn ui-corner-all ui-btn-inline" data-transition="pop" id="SYARAT">SYARAT</a-->
							<!--a-- href="dist.php" data-ajax="false" data-role="button">Back</a-->
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<!-- end tambahana -->
	</div><!--end of data role page-->
	<!--emnd role-content-->
	<div data-role="footer">
		<h2>Kokola Web Developer Department, 2016</h2>
	</div>


</div>
<!--end role page-->

<script>
$("tr td .QTY_CONFIRM").keyup(function(e) {
	var harga     = Number($(this).parents('tr').find('.HARGA').html().replace(",","").replace(",",""));
	var kubikasi  = Number($(this).parents('tr').find('.nilai_kubik').val());
	var qty       = Number($(this).val());
	var subtotal =  Math.round(Number((harga * qty)));
	var sub_kubikasi = Math.round(Number((kubikasi * qty)));
    $(this).parents("tr").find(".SUBTOTAL").html(subtotal);
	$(this).parents("tr").find(".KUBIKASI_CONFIRM").html(sub_kubikasi);
	
	hitung_baru();
});

$("tr td .QTY").on("change", function(){
	var harga     = Number($(this).parents('tr').find('.HARGA').html());
	var kubikasi  = Number($(this).parents('tr').find('#KUBIKASI').val());
	var qty       = Number($(this).val());

	var total_value =  Math.round(Number((harga * qty)));
	var total_kubikasi = Math.round(Number((kubikasi * qty)));

   // var kolom_lain =  Math.round(Number((forcast - bulan1) ));
	/*alert(harga);
	alert(kubikasi);
	alert(qty);*/

	$(this).parents('tr').find('#TOTAL').val(total_value);
	$(this).parents('tr').find('.TOTAL').html(total_value);


	$(this).parents('tr').find('#KUBIKASI2').val(total_kubikasi);
	$(this).parents('tr').find('.KUBIKASI').html(total_kubikasi);

	//$(this).parents('tr').find('.BULAN3').val(kolom_lain);
	hitung_total();
});

function hitung_total() {
	var qty_total = 0;
	var kubikasi = 0;
	var jumlah_total_value = 0;


	$(".QTY").each(function(index, element) {
		qty_total = (Number($(element).val()) + qty_total);

	});

	$(".KUBIKASI").each(function(index, element) {
		kubikasi = (Number($(element).html()) + kubikasi);
	});

	$(".TOTAL").each(function(index, element) {
		jumlah_total_value = (Number($(element).html()) + jumlah_total_value);
	});

	$("#jumlah_total_qty").html(format_digit(qty_total));
	$("#kubikasi_total").html(format_digit(kubikasi));
	$("#total_total_value").html(format_digit(jumlah_total_value));
}

function format_digit( toFormat ) {
	return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};

	

$(document).on("collapsibleexpand", "[data-role=collapsible]", function () {
	var position = $(this).offset().top;
	$.mobile.silentScroll(position);	
});	

function hitung_baru() {
	var jml_qty = 0;
	$(".QTY_CONFIRM").each(function(index, element) {
		jml_qty = Number(jml_qty) + Number($(element).val());
	});
	$("#jml_qty").html(jml_qty);
	
	var jml_kubik = 0;
	$(".KUBIKASI_CONFIRM").each(function(index, element) {
		jml_kubik = Number(jml_kubik) + Number($(element).text());
	});
	$("#jml_kubik").html(format_digit(jml_kubik));
	$("#MKJ").html("KUBIKASI : "+format_digit(jml_kubik));
	
	var jml_harga = 0;
	$(".SUBTOTAL").each(function(index, element) {
		jml_harga = Number(jml_harga) + Number($(element).text().toString().replace(",","").replace(",",""));
	});
	$("#jml_harga").html(format_digit(jml_harga));
	$("#MKI").html("SUBTOTAL : "+format_digit(jml_harga));
}
</script>

</body>
</html>
<?php

?>


<?php
if(isset($_POST['SAVE'])) {
	date_default_timezone_set("Asia/Jakarta");	
	$today          = date('d')."-".date('m')."-".date('Y');
	//$today_database = date('Y')."-".date('m')."-".date('d');
	$today_database = date('Y-m-d H:i:s');
	$time = date('H:i:s');
	
	$qty          = $_POST['QTY'];
	$jumlah_qty   = count($qty);
	$account_idne = $_POST['ACC'];
	$userid       = $_POST['USERID'];
	$item_code    = $_POST['ITEM_CODE'];
	$kubikasi     = $_POST['KUBIKASI2'];
	$accoun		=	$_POST['ACCOUNT'];
	$namaa		=	$_REQUEST['DISTRIBUTOR'];
	$kota		=	$_REQUEST['KOTA_DISTRIBUTOR'];
	$userid		=	$_POST['USERID'];
	
	//$sqlID = "select ID_ORDER, (substr(ID_ORDER,-3)+1) as NOMOR from order_distributor order by ID_ORDER desc";
	$sqlID = "select ID_ORDER, (substr(ID_ORDER,-3)+1) as NOMOR, substr(ID_ORDER, 1, 8)
		from order_distributor
		where substr(ID_ORDER, 1, 8) = date_format(curdate(),'%Y%m%d') order by ID_ORDER desc;";
	
	$myID = mysqli_query($mysqli, $sqlID);
	if ($dataID = mysqli_fetch_assoc($myID)) {
		$id_order = $dataID['NOMOR'];
		if ($id_order < 10) {
			$id_order = date('Ymd').'00'.$id_order;
		}
		elseif ($id_order < 100) {
			$id_order = date('Ymd').'0'.$id_order;
		}
		else {
			$id_order = date('Ymd').$id_order;
		}
	}
	else {
		$id_order = date('Ymd').'001';
	}
	
	/*ini input ke tabel order_distributor*/	
	$sql_order = "INSERT INTO order_distributor SET  ID_ORDER = '$id_order',
				 TGL = '$today_database',
				 USERID = '$userid',
				 ACCOUNT_ID = '$account_idne',
				 FLAG = '2'";
	
	$hasil_order = mysqli_query($mysqli, $sql_order);	
	/*ini input ke tabel order_detail*/	
	$n = 0;
	while ($n < $jumlah_qty) {	
		/*Cari produk_id*/	
		$sql_cari_produk_id = "SELECT ID FROM m_produk WHERE ITEM_CODE = '$item_code[$n]' ";
		$hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
		$data_id = mysqli_fetch_assoc($hasil_cari_produk_id);
		$id_produk = $data_id['ID'];
	
	
		if($qty[$n] != "") {	
			 $sql_order_detail = "INSERT INTO order_detail SET  ID_ORDER = '$id_order',
								ID_PRODUK = '$id_produk',
								JML_ORDER = '$qty[$n]',
								ITEM_CODE = '$item_code[$n]',
								KUBIKASI  = '$kubikasi[$n]',
								FLAG = '2'";	
			$hasil_order_detail = mysqli_query($mysqli, $sql_order_detail);	
			
			
			
			
			
			
			
			
			
			
			
			
		}
		$n++;
	}	
	if($hasil_order_detail){
		echo $accoun."<br />";
		echo $namaa."<br />";
		echo $userid."<br />";
		echo "<script>alert('TambahTambah Order Berhasil..!');
					  //window.location='detail_konfirmasi.php?ID=$account_idne&NAMA=$namaa&KOTA=$kota&USERID=$userid';
					  window.location='konfirmasi_order.php?ID=$account_idne&NAMA=$namaa&KOTA=$kota&USERID=$userid';
					  </script>";	
	}
	else{
		
		echo "<script>alert('Tambah Order Gagal..!');
		  //window.location='detail_konfirmasi.php?ID=$account_idne&NAMA=$namaa&KOTA=$kota&USERID=$userid';
		  window.location='konfirmasi_order.php?ID=$account_idne&NAMA=$namaa&KOTA=$kota&USERID=$userid';
		  </script>";	
	}	
}//end isset

?>
