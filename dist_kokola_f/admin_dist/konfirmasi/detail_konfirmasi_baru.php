<?php
session_start();
//ini_set('display_errors', 1);
include "../../koneksi.php";

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
.new {
	color: #069;
	text-align:center;
}
</style>
<script>
Number.prototype.padLeft = function(base,chr){
   var  len = (String(base || 10).length - String(this).length)+1;
   return len > 0? new Array(len).join(chr || '0')+this : this;
}
var xTable = "";
$(document).ready(function () {	
	var xTable = $('#example').DataTable({
		"scrollY": 300,
		"scrollX": true,
		/*fixedColumns:   {
		 leftColumns: 1
		 },*/
		"scrollCollapse": true,
		"ordering": false,
		"paging": false
	});
	
	var oTable = $("#tb_produk").dataTable({
		"language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Data yang dicari tidak ada, maaf bro",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
			"emptyTable": "Belum ada data KJ bro",
			"sLoadingRecords": "Please wait - loading...",
        },
		//"fixedColumns": true,
		"bSort" : false,
		"bPaginate": false,
		"scrollX": true,
		//"scrollY": "100vh",
		"scrollY": 300,
		"scrollCollapse": true,
		"bJQueryUI": true,
		"bInfo": false,
		"bFilter": false,		
		"dom": '<"top"i>rt<"bottom"flp><"clear">',
	});
	
	// menambahkan item produk baru
	$("#btn_simpan").click(function() {
		var d = new Date,
        dformat = [ d.getFullYear().padLeft(),
										(d.getMonth()+1).padLeft(),
                    d.getDate().padLeft()
                    ].join('-')+
                    ' ' +
                  [ d.getHours().padLeft(),
                    d.getMinutes().padLeft(),
                    d.getSeconds().padLeft()].join(':');
		$("#tb_produk tbody").find(".QTY").each(function(index, element) {
            if ($(element).val() != "") {
				// menambah kedalam tabel
				xTable.row.add([
					dformat,
					$(element).parents("tr").find(".PRODUK").text(),
					'<div class="HARGA">' + format_digit($(element).parents("tr").find(".HARGA").text()) + "</div>",
					'<input type="text" value="' + $(element).val() + '" class="QTY_CONFIRM" name="QTY[]"  />',
					'<div class="KUBIKASI_CONFIRM">' + $(element).parents("tr").find(".KUBIKASI").text() + "</div>" +
					'<input type="hidden" name="KUBIKASI[]" class="nilai_kubik" value="0.243" />',
					'<div class="SUBTOTAL">' + format_digit($(element).parents("tr").find(".TOTAL").text()) + "</div>"
				]).draw(false).nodes()
				.to$()
				.addClass( 'new' );
				$(element).parents("tr").remove();
			}
        });
		
		$("#myPopup").popup( "close" );
		$("#page1").trigger("create");
		//$('.ui-page').trigger('create');
		var total_qty = 0;
		var total_kubik = 0;
		var total_nilai = 0;
		$("#example tbody tr").each(function(index, element) {
            total_qty = Number(total_qty) + Number($("td:eq(3)",element).find(".QTY_CONFIRM").val());
			total_kubik = Number(total_kubik) + Number($("td:eq(4)",element).text());
			total_nilai = Number(total_nilai) + Number($("td:eq(5)",element).text().replace(",","").replace(",",""));
			//alert($("td:eq(5)",element).text().replace(".","").replace(".",""));
        });
		$("#jml_qty").text(total_qty);
		$("#jml_kubik").text(total_kubik.toFixed(3));
		$("#jml_harga").text(format_digit(total_nilai));
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
</script>

</head>

<body onResize="resize()">
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
	
	$qty          = $_POST['QTY'];//jml_order
	$account_idne = $_POST['ACC'];
	$userid       = $_POST['USERID'];
	$item_code    = $_POST['ITEM_CODE'];
	
	$jumlah_qty   = count($item_code);
	//echo "<h1>".$jumlah_qty."</h1>";
	
	$kubikasi = $_POST['KUBIKASI_OLAHAN'];
	$kubikasi_asli = $_POST['KUBIKASI_OLAHAN_ASLI'];
	$id_order = $_POST['ID_ORDER'];
	$tgl_order = $_POST['TGL_ORDER'];
	$id_produk = $_POST['ID_PRODUK'];

	/*foreach ($qty as $bacadata2){	
	}*/
	
	$n=0;
   	while($n < $jumlah_qty ){
		if($qty[$n] != "") {
			if($kubikasi[$n] == ""){
				$kubikasi_fix =  $kubikasi_asli;
			}
			else {
				$kubikasi_fix =  $kubikasi;
			}
			$insert_confirm = "INSERT INTO order_confirm SET ID_ORDER = '$id_order[$n]',
				TGL_ORDER = '$tgl_order[$n]',
				ACCOUNT_ID = '$account_idne',
				ID_PRODUK = '$id_produk[$n]',
				ITEM_CODE = '$item_code[$n]',
				JML_ORDER = '$qty[$n]',
				KUBIKASI = '$kubikasi_fix[$n]',
				TGL_CONFIRM = '$today_database $time'";
			echo $insert_confirm;
			
			$hasil_confirm = mysqli_query($mysqli, $insert_confirm);
		}
		$n++;
   }//end while

   /*ubah order distributor*/
   $sql_ubah_distributor = "UPDATE order_distributor SET  FLAG = '3' WHERE ID_ORDER = '$id_order[0]'";
   echo $sql_ubah_distributor;
   $hasil_ubah = mysqli_query($mysqli, $sql_ubah_distributor);
   if($sql_ubah_distributor){
	   echo "<script>alert('Confirm berhasil..!, Mohon segera kirimkan barang');
	   	window.location='konfirmasi_order.php';
		</script>";
   }
   else{
	   echo "<script>alert('Confirm Gagal..!,');</script>";
   }
}//end isset'
?>
<div data-role="page" id="page1" class="type-interior" data-theme="f">
    <div data-role="header">
        <h1>Forcast FORM </h1>    
        <h2>Kokola Admin 2.5</h2>
    </div>
    
    <div data-role="content" id="top">
		<h2 align="center">KONFIRMASI ORDER DETAIL<br><!--?php echo "<i>".$_SESSION[USER]."</i>";?--></h2>        
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

		/*echo "<a href='tambah_order.php?ID=$account_id&NAMA=$nama&KOTA=$kota&USERID=$user_id'
			data-role='button' data-ajax='false' target='_parent' class='ui-btn ui-btn-inline'
			data-theme='f'>TAMBAH ORDER</a>";*/
		?>
          
		<button id="tambah" data-role='button' class='ui-btn ui-btn-inline' data-theme='f'>Tambah Order</button>
        <!--<a id="tambahx" href="#myPopup" data-transition="flip" class="ui-btn ui-btn-icon-left ui-icon-plus ui-btn-inline" data-rel="popup">Tambah</a>-->
        <button id="tambahx" data-role='button' class='ui-btn ui-btn-inline ui-btn-icon-left' data-icon="plus">
        	Tambah Order
        </button>
        
        <div data-role="popup" id="myPopup" class="ui-content">
        	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
        	<table id="tb_produk" class="display cell-border compact" cellspacing="0" width="100%">
            	<thead>
                	<tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Jml Kubikasi</th>
                        <th>Jml Nilai</th>
                    </tr>
                </thead>
                
                <tbody>
                	<?php
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
								FROM USER,order_distributor,order_detail,m_produk,kubikasi
								WHERE order_distributor.ACCOUNT_ID = user.ACCOUNT_ID
								AND order_distributor.TGL LIKE '%$today_database%'
								AND order_distributor.ID_ORDER = order_detail.ID_ORDER
								AND m_produk.ITEM_CODE = order_detail.ITEM_CODE
								AND order_distributor.ACCOUNT_ID = '$account_id'
								AND kubikasi.ITEM_CODE = order_detail.ITEM_CODE
								GROUP BY m_produk.NAMA_PRODUK);";
    
                        $hasil_produk = mysqli_query($mysqli, $sql_produk);
    
                        while ($data_produk = mysqli_fetch_assoc($hasil_produk)) {
							$jml_kubik = $data_produk['KUBIK'];
                        ?>
                        	<tr>
                            	<td class="PRODUK"><?php echo $data_produk['NAMA_PRODUK'];?></td>
                                <td class="HARGA"><?php echo $data_produk['HARGA'];?></td>
                                <td>
                                <input type='text' class='QTY' data-corners="false" data-mini="true" />
                                <input type='hidden' class='kubik_produk' value='<?php echo $jml_kubik;?>'>
                                </td>
                                <td class="KUBIKASI" align="center">&nbsp;</td>
                                <td class="TOTAL" align="center">&nbsp;</td>
                            </tr>
                        <?php
                        }
                        ?>
                </tbody>
                <tfoot>
                	<tr>
                        <th colspan="2">Total</th>
                        <th><span class="foot_qty">&nbsp;</span></th>
                        <th><span class="foot_kubik">&nbsp;</span></th>
                        <th><span class="foot_nilai">&nbsp;</span></th>
                    </tr>
                </tfoot>
            </table>
            <div style="margin:auto;text-align:center;"> 
                <input type="hidden" name="ACC" value="<?php echo $account_id;?>">
                <input type="hidden" name="USERID" value="<?php echo $user_id;?>">	
                <input type="hidden" name="DISTRIBUTOR" value="<?php echo $nama;?>">
                <input type="hidden" name="KOTA_DISTRIBUTOR" value="<?php echo $kota;?>">				
                <button id="btn_simpan" type="button" data-role='button' data-inline="true" data-corners="false" data-icon="check" data-iconpos="left">
                    Simpan
                </button>
                <button id="btn_tutup" type="button" data-role='button' data-inline="true" data-corners="false" data-icon="back" data-iconpos="left">
                    Batal
                </button>
            </div>
        </div>
        <form method="POST" action="detail_konfirmasi.php" data-ajax="false">
			<table id="example" class="stripe row-border order-column" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    	<td align="center" colspan="6"><b><?php echo $nama.", ".strtoupper($kota);?></b></td>
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
                        FROM USER,order_distributor,order_detail,m_produk,kubikasi
                        WHERE order_distributor.ACCOUNT_ID = user.ACCOUNT_ID
                        AND order_distributor.TGL LIKE '%$today_database%'
                        AND order_distributor.ID_ORDER = order_detail.ID_ORDER
                        AND m_produk.ITEM_CODE = order_detail.ITEM_CODE
                        AND order_distributor.ACCOUNT_ID = '$account_id'
                        AND kubikasi.ITEM_CODE = order_detail.ITEM_CODE
                        GROUP BY m_produk.NAMA_PRODUK";
						
                    $hasil = mysqli_query($mysqli, $sql);
                    $jumlah_qty = 0;
                    $jumlah_total = 0;
                    $jumlah_kubikasi_total = 0;
                    $jumlah_qty2 = 0;
                    while($data = mysqli_fetch_assoc($hasil)){
						$jml_kubik = $data['KUBIK'];
                        $subtotal = $data['HARGA'] * $data['qty'];
                        $kubikasi_total = $data['qty'] * $data['KUBIK'];
                        $kubikasi_total2 = number_format($kubikasi_total,3);
        
                        $harga2 = number_format($data['HARGA']);
                        $qty2   = number_format($data['qty']);
                        $subtotal2   = number_format($subtotal);
                        echo "<tr>";
                        echo "<td align='center'>$data[TGL_ORDER]
                                 <input type='hidden' value='$data[ID_PRODUK]' id='ID_PRODUK' name='ID_PRODUK[]'>
                                 <input type='hidden' value='$data[ITEM_CODE]' id='ITEM_CODE' name='ITEM_CODE[]'>
                                 <input type='hidden' value='$data[ID_ORDER]' id='ID_ORDER' name='ID_ORDER[]'>
                                 <input type='hidden' value='$data[TGL_ORDER]' id='TGL_ORDER' name='TGL_ORDER[]'>
                                 </td>";
        
                        echo "<td align='center'>$data[NAMA_PRODUK]</td>";
                        echo "<td align='center'><div class='HARGA'>$harga2</div>
                            <input type='hidden' value='$data[HARGA]' id='HARGA' name='HARGA[]'>
                            </td>";
							
                        echo "<td align='center'><input type='text' value='$data[qty]' class='QTY_CONFIRM' name='QTY[]' /></td>";
						
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
                <input type="hidden" name="ACC" value="<?php echo $account_id;?>" />
                <input type="submit" name="CONFIRM" value="CONFIRM" />
                </form>
		<br><br>

        <a href="konfirmasi_order.php" data-role="button" data-ajax="false">Back</a>        
	</div><!--end of data role page-->
	<!--emnd role-content-->
	<div data-role="footer">
		<h2>Kokola Web Developer Department, 2016</h2>
	</div>


</div>
<!--end role page-->

<script>
/*$("#example tbody tr td .QTY_CONFIRM").keyup(function(e) {
	var harga     = Number($(this).parents('tr').find('.HARGA').html().replace(",","").replace(",",""));
	var kubikasi  = Number($(this).parents('tr').find('.nilai_kubik').val());
	var qty       = Number($(this).val());
	var subtotal =  Math.round(Number((harga * qty)));
	var sub_kubikasi = Number((kubikasi * qty));
    $(this).parents("tr").find(".SUBTOTAL").html(format_digit(subtotal));
	$(this).parents("tr").find(".KUBIKASI_CONFIRM").html(sub_kubikasi.toFixed(3));
	
	hitung_baru();
});*/
$(document).on("keyup", ".QTY_CONFIRM", function() {
	var harga     = Number($(this).parents('tr').find('.HARGA').html().replace(",","").replace(",",""));
	var kubikasi  = Number($(this).parents('tr').find('.nilai_kubik').val());
	var qty       = Number($(this).val());
	var subtotal =  Math.round(Number((harga * qty)));
	var sub_kubikasi = Number((kubikasi * qty));
    $(this).parents("tr").find(".SUBTOTAL").html(format_digit(subtotal));
	$(this).parents("tr").find(".KUBIKASI_CONFIRM").html(sub_kubikasi.toFixed(3));
	
	hitung_baru();
});

function format_digit( toFormat ) {
	return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
	$("#jml_kubik").html(jml_kubik.toFixed(3));
	
	var jml_harga = 0;
	$(".SUBTOTAL").each(function(index, element) {
		jml_harga = Number(jml_harga) + Number($(element).text().toString().replace(",","").replace(",",""));
	});
	$("#jml_harga").html(format_digit(jml_harga));
}

$("#tambahx").click(function(e) {	
	$('#myPopup').popup({
		positionTo: 'window',
		transition: "slideup",
		overlayTheme: "d"
	});
	$('#myPopup').popup("open");
});

$("#btn_tutup").click(function(e) {
    $( "#myPopup" ).popup( "close" );
});

$(".QTY").keyup(function(e) {
    var harga = $(this).parents("tr").find(".HARGA").text();
	var kubik = $(this).parents("tr").find(".kubik_produk").val();
	$(this).parents("tr").find(".KUBIKASI").text((Number(kubik) * Number($(this).val())).toFixed(3));
	$(this).parents("tr").find(".TOTAL").text(Number(harga) * Number($(this).val()));
	total_baru();
});

function total_baru() {
	var total_qty = 0;
	var total_kubikasi = 0;
	var total_nilai = 0;
	$(".QTY").each(function(index, element) {
        total_qty = Number(total_qty) + Number($(element).val());
    });
	$(".KUBIKASI").each(function(index, element) {
        total_kubikasi = Number(total_kubikasi) + Number($(element).text());
    });
	$(".TOTAL").each(function(index, element) {
        total_nilai = Number(total_nilai) + Number($(element).text());
    });
	$(".foot_qty").html(total_qty);
	$(".foot_kubik").html(total_kubikasi.toFixed(3));
	$(".foot_nilai").html(total_nilai);
}

function resize() {	
	var lebar = $(window).width();
	$("#myPopup").width(lebar-150);
}

resize();
</script>

</body>
</html>
