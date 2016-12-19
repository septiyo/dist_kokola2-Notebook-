<?php
session_start();
/*ini_set('display_errors', 1);*/
/*error_reporting(E_ALL|E_STRICT);*/
include "koneksi.php";
include "bantuan.class.php";

$bantuan = new bantuan();
$tanggal = $bantuan->tgl_indo("datetime");

if(!$_SESSION['USER']) {
    echo "Anda tidak Berhak";
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<script src="jqm2/jquery-2.1.4.min.js"></script>
<script src="jqm2/jquery.mobile-1.4.5.min.js"></script>
<script src="jqtable/jquery.dataTables.min.js"></script>
<script src="jqtable/dataTables.fixedColumns.min.js"></script>
<script src="validation/jquery.validate.js"></script>

<link rel="stylesheet" href="themes/9septi_season.min.css"/>
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css"/>
<link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>

<link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">
<link rel="stylesheet" href="jqtable/fixedColumns.dataTables.min.css">
<style type="text/css">
.ui-corner-all {
	border-radius: 0!important;
}
.input-disabled {
	background-color:#EBEBE4;
	border:1px solid #ABADB3;
	padding:2px 1px;
}
</style>

<script type="text/javascript">
$(document).ready(function() {	

$(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });




	$('#example').DataTable( {
		"dom": '<"toolbar">frtip',
		"scrollY": 300,
		"scrollX": true,
		"paging": false,
		"filter": false,
		"fixedColumns": {
			leftColumns: 2
		},
	});
	
	$("div.toolbar").html('<b><input type="text" id="cari" style="margin:10px 0;padding:4px;"></b>');
	$("#cari").keyup(function(e) {
		cari_table();
	});
});
            
function cari_table() {
	var value = $("#cari").val();	
	//alert(value);
	$("table tbody tr").each(function(index, element) {
		if (index >= 0) {	
			$row = $(this);	
			var id = $row.find("th:eq(0)").text().toLowerCase();
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
<?php
if(isset($_POST['EDIT'])) {

	$produk      = $_POST['PRODUK'];
	$harga       = $_POST['HARGA'];
	$bulan_akhir = $_POST['bln_akhir'];
	$forecast    = $_POST['FORECAST'];
	$persen      = $_POST['PERSEN'];
	$bulan1      = $_POST['BULAN1'];
	$bulan2      = $_POST['BULAN2'];
	$bulan3      = $_POST['BULAN3'];
	
	
	//$total_value = $_POST['TOTAL_VALUE'];
	/*$set_bln1 = $_POST[SET_BLN1];
	 $set_bln2 = $_POST[SET_BLN2];
	$set_bln3 = $_POST[SET_BLN3];*/
	//print_r($_POST);
	//$jumlah_forcast = count($forecast);
	//$jumlah_total_value = count($total_value);

	//echo $jumlah_forcast;
	
	foreach($forecast as $item=>$isi){
		
		if($isi != ""){
			
			/*$sql_kj = "UPDATE  kj SET   TGL = '$tanggal',
				BULAN_INPUT = '$_SESSION[BULAN_NOW]',				
				BULAN1   = '".$item['BULAN1']."',
				BULAN2   = '".$item['BULAN2']."',
				BULAN3   = '".$item['BULAN3']."'				
				WHERE TRIWULAN = '$_SESSION[TRIWULAN]'
				AND ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'
				AND NAMA_PRODUK = '".$item['PRODUK']."'";*/
				
				$sql_kj = "UPDATE  kj SET   TGL = '$tanggal',
				BULAN_INPUT = '$_SESSION[BULAN_NOW]',				
				BULAN1   = '".$bulan1[$item]."',
				BULAN2   = '".$bulan2[$item]."',
				BULAN3   = '".$bulan3[$item]."'				
				WHERE TRIWULAN = '$_SESSION[TRIWULAN]'
				AND ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'
				AND ITEM_CODE = '".$produk[$item]."'";
					
			$hasil_input_kj = mysqli_query($mysqli, $sql_kj);
			//echo $sql_kj;		
             //exit;	
			
		}
		
		
	}
	
	
	/*$n = 0;
	while ($n <= $jumlah_forcast) {
		if ($total_value[$n] != "") {
			
			$sql_kj = "UPDATE  kj SET   TGL = '$tanggal',
				BULAN_INPUT = '$_SESSION[BULAN_NOW]',				
				BULAN1   = '$bulan1[$n]',
				BULAN2   = '$bulan2[$n]',
				BULAN3   = '$bulan3[$n]'				
				WHERE TRIWULAN = '$_SESSION[TRIWULAN]'
				AND NAMA_DIST = '$_SESSION[USER]'
				AND NAMA_PRODUK = '$produk[$n]'";
			echo $sql_kj;		
    
			$hasil_input_kj = mysqli_query($mysqli, $sql_kj);
		}
		$n++;
	} */
	
	if ($hasil_input_kj) {
		//echo "input Barhasil";
		echo "<script>alert('Edit Barhasil');
						window.location='dist.php';
			  </script>";
		// header("Location: dist_forcest_next.php?TRI=$_SESSION[TRIWULAN]");
	} else {
		//echo "input gagal";
		echo "<script>alert('Edit Gagal, Harap Coba lagi..!');window.location='dist_forcast.php';</script>";
	}
}//end isset edit	
	/*Cek untuk blocking access*/
date_default_timezone_set("Asia/Jakarta");
$today = date('d') . "-" . date('m') . "-" . date('Y');
$today_database = date('Y') . "-" . date('m') . "-" . date('d');
$time = date('H:i:s');

$month = date('M');

$_SESSION['BULAN_NOW'] = $month;

$tri = $_GET['TRI'];
$locked = $_GET['LOCKED'];
$pecah = explode("-", $tri);
//echo $pecah[0] . "<br>" . $pecah[1] . "<br>" . $pecah[2];
date_default_timezone_set("Asia/Jakarta");

//$sql_cari_isi = "SELECT SET_BLN1, SET_BLN2, SET_BLN2 FROM kj WHERE TRIWULAN = '$tri' AND NAMA_DIST= '$_SESSION[USER]' ";
/* $sql_cari_isi = "SELECT BULAN_INPUT, NAMA_DIST FROM kj WHERE TRIWULAN = '$tri' AND NAMA_DIST= '$_SESSION[USER]' GROUP BY BULAN_INPUT "; */


/* $sql_cari_isi = "SELECT *, m_produk.`NAMA_PRODUK` AS REV_NAMA_PRODUK FROM kj 
										INNER JOIN `m_produk` ON kj.`ITEM_CODE` = `m_produk`.`ITEM_CODE`
										WHERE kj.ACCOUNT_ID = '$_SESSION[USER]' AND kj.TRIWULAN = '$tri' AND kj.publish = '1' ORDER BY kj.NAMA_PRODUK ASC;";
	
	 */
$hasil_isi = mysqli_query($mysqli, $sql_cari_isi);
$data_isi = mysqli_fetch_assoc($hasil_isi);
$bulan_input = $data_isi['BULAN_INPUT'];
	
//echo $bulan_input;
if(date('d') >= 25) {
	echo "<script>alert('Anda sudah melewati tanggal 25, Revisi hanya bisa dilakukan  bulan depan.');
			   window.location='dist.php';
	  </script>";
}

$cek_bulan1 = (($_SESSION['BULAN_NOW'] == "Jan") || ($_SESSION['BULAN_NOW'] == "Apr") ||
	($_SESSION['BULAN_NOW'] == "Jul") || ($_SESSION['BULAN_NOW'] == "Oct"));
if(($cek_bulan1 == true) && (date('d') < 25)){	
	$kunci = 'KUNCI_1';
}

$cek_bulan2 = (($_SESSION['BULAN_NOW'] == "Feb") || ($_SESSION['BULAN_NOW'] == "May") ||
	($_SESSION['BULAN_NOW'] == "Aug") || ($_SESSION['BULAN_NOW'] == "Nov"));
if(($cek_bulan2 == true) && (date('d') < 25)) {
	$kunci = 'KUNCI_2';
}

$cek_bulan3 = (($_SESSION['BULAN_NOW'] == "Mar") || ($_SESSION['BULAN_NOW'] == "Jun") ||
	($_SESSION['BULAN_NOW'] == "Sep") || ($_SESSION['BULAN_NOW'] == "Dec"));
if(($cek_bulan3 == true) && (date('d') < 25)){
	$kunci = 'KUNCI_3';
}
?>
<div data-role="page" class="type-interior" data-theme="a">
    <div data-role="header">
        <h1>Edit Forcast FORM </h1>    
        <h2>Kokola Distributor 2.5</h2>
    </div>
    <!--end header-->    
    <div data-role="content">
		<form method="post" action="edit_forcast.php" data-ajax="false">
        <table>
            <tr>
                <td align="center" colspan="9">
                    <h3>Forecast : <?php echo $tri; ?></h3>
                    <input type="hidden" value="<?php echo $tri; ?>" name="TRIWULAN">
                </td>
        
            </tr>
            <tr>
                <th colspan="9" align="center">Nama Distributor : <?php echo $_SESSION['NAMA']; ?></th>
            </tr>
        </table>

        <!--table border="1" cellpadding="1" cellspacing="0" align="center"-->
        <table id="example" class="display order-column" cellspacing="0" width="100%">
            <thead>
                <tr bgcolor="#7fffd4">
                    <th width="350">Nama Produk</th>
                    <!--th width="30">Harga</th-->
                    <th width="100" class="header-lastmonth">Last 3 Month</th>
                    <th width="100" class="header-forecast">Forecast 3 Month</th>
                    <th width="100" class="header-persen"> % </th>
                    <th width="100" class="header-bulan1"><?php echo $pecah[0];?></th>
                    <th width="100" class="header-bulan2"><?php echo $pecah[1];?></th>
                    <th width="100" class="header-bulan3"><?php echo $pecah[2];?></th>
                    <!--th width="100" class="header-totalvalue">Total Value</th-->
                    <!--th>Growth</th-->
                </tr>
            </thead>
			<tbody>
			<?php
		   /* $sql_produk = "SELECT m_produk.`NAMA_PRODUK`,
				m_produk.SATUAN,
				m_produk.HARGA,
				kj.`BLN_AKHIR`,
				kj.`FORECAST`,
				kj.`PERSEN`,
				kj.`BULAN1`,
				kj.`BULAN2`,
				kj.`BULAN3`,
				kj.`TOTAL_VALUE`,
				kj.SET_BLN1,
				kj.SET_BLN2,
				kj.SET_BLN3
				FROM m_produk
				LEFT JOIN kj
				ON m_produk.`NAMA_PRODUK` = kj.`NAMA_PRODUK`
				AND kj.TRIWULAN = '$tri' AND kj.NAMA_DIST = '$_SESSION[USER]' ORDER BY NAMA_PRODUK ASC";*/

			/* $sql_produk = "SELECT * FROM kj WHERE TRIWULAN = '$tri' AND NAMA_DIST = '$_SESSION[USER]' ORDER BY NAMA_PRODUK ASC"; */
			$sql_produk = "SELECT *, m_produk.`NAMA_PRODUK` AS REV_NAMA_PRODUK FROM kj 
										INNER JOIN `m_produk` ON kj.`ITEM_CODE` = `m_produk`.`ITEM_CODE`
										WHERE kj.ACCOUNT_ID = '$_SESSION[USER]' AND kj.TRIWULAN = '$tri' AND kj.publish = '1' ORDER BY kj.NAMA_PRODUK ASC;";

			$hasil_produk = mysqli_query($mysqli, $sql_produk);
			while ($data_produk = mysqli_fetch_assoc($hasil_produk)) {
                            echo "<tr>";
                            echo "<th align='left'>$data_produk[REV_NAMA_PRODUK]
								<input type='hidden' value='$data_produk[ITEM_CODE]' name='PRODUK[]'> </th>";
                            /*echo "<td><div class='HARGA'>$data_produk[HARGA]</div>
								<input type='hidden' value='$data_produk[HARGA]' name='HARGA[]'></td>";*/
                            echo "<td align='center'>
								<input type='text' name='bln_akhir[]' id='bln_akhir' class='bln_akhir' 
								value='$data_produk[BLN_AKHIR]' ></td>";
                            echo "<td align='center'>
								<input type='text' name='FORECAST[]' id='FORECAST' class='FORECAST'
								value='$data_produk[FORECAST]'></td>";
                            echo "<td align='center'>
								<input type='text' name='PERSEN[]' style='min-width: 30px' id='PERSEN' class='PERSEN'
								value='$data_produk[PERSEN]' readonly placeholder='...' ></td>";
                            echo "<td align='center'>
								<input type='text' name='BULAN1[]' style='min-width: 100px' id='BULAN1' class='BULAN1'
								value='$data_produk[BULAN1]'   ></td>";
                            echo "<td align='center'>
								<input type='text' name='BULAN2[]' style='min-width: 100px' id='BULAN2' class='BULAN2' 
								value='$data_produk[BULAN2]'   ></td>";
                            echo "<td align='center'>
								<input type='text' name='BULAN3[]' style='min-width: 100px' id='BULAN3' 
								class='BULAN3' value='$data_produk[BULAN3]'   ></td>";
                          /* echo "<td align='center'>
								<input type='text' name='TOTAL_VALUE[]' style='min-width: 100px' 
								id='TOTAL_VALUE' class='TOTAL_VALUE'
								value='".number_format($data_produk['TOTAL_VALUE'])."' placeholder='...' ></td>";*/
                            //echo "<td align='center'><input type='text' name='GROWTH[]' id='GROWTH'
								//class='GROWTH' readonly></td>";
                            echo "</tr>";
                    }//end while

                    ?>
                    </tbody>
					<tfoot>
                        <tr bgcolor="#7fffd4">
                            <th width="350">&nbsp;</th>
                            <!--th width="100">&nbsp;</th-->
                            <th width="100">&nbsp;</th>
                            <th width="100">&nbsp;</th>
                            <th width="100">&nbsp;</th>
                            <th width="100" class="header-bulan1"><div id="total1"></div></th>
                            <th width="100" class="header-bulan2"><div id="total2"></div></th>
                            <th width="100" class="header-bulan3"><div id="total3"></div></th>
                            <!--th width="100"><div id="total"></div></th-->
                            <!--th-- width="100">ID PRODUK</th-->
                            <!--th>Growth</th-->
                        </tr>
                    </tfoot>

                </table>
        <table align="center" width="300">
            <tr>
                <td colspan="5" align="center">
                    <input type="submit" value="EDIT" name="EDIT">
                    <!--a-- href="dist_forcest_next.php" data-ajax="false" data-role="button">Next</a-->
                    <a href="dist.php" data-ajax="false" data-role="button">Back</a>
                </td>

            </tr>
        </table>
	</form>
	</div>
	<!--end content-->
    <div data-role="footer">
        <h2>Kokola Web Developer Department, 2016</h2>
    </div>
    <!--end of content-->
    <script>
    /* (function($){
            // "1234567".commafy() returns "1,234,567"
            String.prototype.commafy = function() {
                return this.replace(/(.)(?=(.{3})+$)/g,"$1,")
            }
            $.fn.digits = function () {
                return this.each(function () {
                    $(this).val($(this).val().commafy());
                })
            }
        })(jQuery)

        jQuery(function(){
            $('input[type=text]').digits();
        });*/

        /*untuk disable inputan saat tidak boleh edit*/

    $( document ).ready(function(e) {
        var kunci = '<?php echo $kunci;?>';
        //alert(kunci);
        if(kunci == 'KUNCI_0'){
            $(".header-forecast").addClass('input-disabled');
            $(".header-lastmonth").addClass('input-disabled');
            $("tr td .FORECAST").prop('readOnly', true);
            $("tr td .bln_akhir").prop('readOnly', true);
        }
        if(kunci == 'KUNCI_1'){
           //$("input").prop('disabled', true);
            //$("tr td .BULAN1").prop('readOnly', true);
            $("tr td .FORECAST").prop('readOnly', true);
            $("tr td .bln_akhir").prop('readOnly', true);
            $("tr td .TOTAL_VALUE").prop('readOnly', true);
            //$(".header-bulan1").addClass('input-disabled');
            $(".header-forecast").addClass('input-disabled');
            $(".header-lastmonth").addClass('input-disabled');
            $(".header-persen").addClass('input-disabled');
        }
        else if(kunci == 'KUNCI_2') {
            $("tr td .BULAN1").prop('readOnly', true);
            //$("tr td .BULAN2").prop('readOnly', true);
            $("tr td .FORECAST").prop('readOnly', true);
            $("tr td .bln_akhir").prop('readOnly', true);
            $("tr td .TOTAL_VALUE").prop('readOnly', true);
            $(".header-bulan1").addClass('input-disabled');
           // $(".header-bulan2").addClass('input-disabled');
            $(".header-forecast").addClass('input-disabled');
            $(".header-lastmonth").addClass('input-disabled');
            $(".header-persen").addClass('input-disabled');

            //alert(kunci);
            //$("input").prop('disabled', false);
        }
        else if(kunci == 'KUNCI_3') {
            $("tr td .BULAN1").prop('readOnly', true);
            $("tr td .BULAN2").prop('readOnly', true);
            $("tr td .BULAN3").prop('readOnly', true);
            $("tr td .FORECAST").prop('readOnly', true);
            $("tr td .bln_akhir").prop('readOnly', true);
            $("tr td .TOTAL_VALUE").prop('readOnly', true);
            $(".header-bulan1").addClass('input-disabled');
            $(".header-bulan2").addClass('input-disabled');
            $(".header-bulan3").addClass('input-disabled');
            $(".header-forecast").addClass('input-disabled');
            $(".header-lastmonth").addClass('input-disabled');
            $(".header-persen").addClass('input-disabled');
            $(".header-totalvalue").addClass('input-disabled');

          /*  $("tr td .BULAN1").prop('readOnly', true);
            $("tr td .BULAN2").prop('readOnly', true);
            $("tr td .BULAN3").prop('readOnly', true);
            $("tr td .FORECAST").prop('readOnly', true);
            $("tr td .bln_akhir").prop('readOnly', true);
            $("tr td .TOTAL_VALUE").prop('readOnly', true);
            $(".header-bulan1").addClass('input-disabled');
            $(".header-bulan2").addClass('input-disabled');
            $(".header-bulan3").addClass('input-disabled');
            $(".header-forecast").addClass('input-disabled');
            $(".header-lastmonth").addClass('input-disabled');
            $(".header-persen").addClass('input-disabled');*/

            //alert(kunci);
            //$("input").prop('disabled', false);
        }
        else if(kunci == 'LOCKED'){
            $("tr td .BULAN1").prop('readOnly', true);
            $("tr td .BULAN2").prop('readOnly', true);
            $("tr td .BULAN3").prop('readOnly', true);
            $("tr td .FORECAST").prop('readOnly', true);
            $("tr td .bln_akhir").prop('readOnly', true);
            $("tr td .TOTAL_VALUE").prop('readOnly', true);
            $(".header-bulan1").addClass('input-disabled');
            $(".header-bulan2").addClass('input-disabled');
            $(".header-bulan3").addClass('input-disabled');
            $(".header-forecast").addClass('input-disabled');
            $(".header-lastmonth").addClass('input-disabled');
            $(".header-persen").addClass('input-disabled');
            $(".header-totalvalue").addClass('input-disabled');
        }
		hitung_total();
    });
	
	/*ini untuko menhitungn Total value*/
	$("#example tr td .FORECAST").on("keyup", function () {
		var hasil = Number($(this).val()) * Number($(this).parents('tr').find('.HARGA').html());
		$(this).parents('tr').find('.TOTAL_VALUE').val(hasil);
	});
	
	/*untuk hitung persen*/
	$("tr td .FORECAST").on("change", function () {

		var forcast   = Number($(this).val());
		var bln_akhir = Number($(this).parents('tr').find('.bln_akhir').val());
		//var bulan1    = Number($(this).parents('tr').find('.BULAN1').val());
		//var bulan1    = 0;
		var bulan2    = 0;
		var bulan3    = 0;

		var persen = Math.round((forcast - bln_akhir) / bln_akhir * 100);
		$(this).parents('tr').find('.PERSEN').val(persen);

		if(persen < 20){
			alert('Prosentase tidak boleh kurang dari 20%');
			$(this).parents('tr').find('.FORECAST').focus();

		}

		/*if((bulan1 == "0") && (bulan2 == "0") && (bulan3 == "0")){

		 var bagi_3 = Math.round(Number(forcast / 3));
		 }*/

		$(this).parents('tr').find('.BULAN1').val(forcast);
		$(this).parents('tr').find('.BULAN2').val(bulan2);
		$(this).parents('tr').find('.BULAN3').val(bulan3);

		/*alert(bulan1);
		 alert(bulan2);
		 alert(bulan3);*/
	});

	$("tr td .BULAN1").on("keyup", function() {
		var forcast   = Number($(this).parents('tr').find('.FORECAST').val());
		var bulan1    = Number($(this).val());

		//var kolom_lain =  Math.round(Number((forcast - bulan1) / 2));
		var kolom_lain =  Math.round(Number((forcast - bulan1) ));
		//alert(kolom_lain);

		$(this).parents('tr').find('.BULAN2').val(kolom_lain);
		//$(this).parents('tr').find('.BULAN3').val(kolom_lain);
	});
	
	var nilai_lama2 = 0;
	$("tr td .BULAN2").on("keyup", function(ev){		
		var forcast   = Number($(this).parents('tr').find('.FORECAST').val());
		var bulan1    = Number($(this).parents('tr').find('.BULAN1').val());
		var bulan2    = Number($(this).val());
		var kolom_lain =  Math.round(Number((forcast - bulan1) - bulan2));
		//alert(kolom_lain);
		if (kolom_lain > 0) {
			$(this).parents('tr').find('.BULAN3').val(kolom_lain);
		}
		else {
			$(this).val(nilai_lama2);
			return false;
		}
		nilai_lama2 = $(this).val();
		hitung_total();
	}).on("keydown", function() {
		nilai_lama2 = $(this).val();
	});
	
	var nilai_lama3 = 0;
	$("tr td .BULAN3").on("keyup", function(ev){
		var forcast   = Number($(this).parents('tr').find('.FORECAST').val());
		var bulan1    = Number($(this).parents('tr').find('.BULAN1').val());
		var bulan2    = Number($(this).parents('tr').find('.BULAN1').val());
		var bulan3    = Number($(this).val());
		
		//var kolom_lain =  Math.round(Number((bulan2 - bulan3)));
		//var kolom_lain =  Math.round(Number((forcast - bulan3)/ 2));
		var kolom_lain =  Math.round(Number(forcast-(bulan1 + bulan3)));		
		if (kolom_lain > 0) {
			$(this).parents('tr').find('.BULAN2').val(kolom_lain);
		}
		else {
			$(this).val(nilai_lama3);
			return false;
		}
		
		nilai_lama3 = $(this).val();
		hitung_total();
	}).on("keydown", function() {
		nilai_lama3 = $(this).val();
	});
	
	function hitung_total() {
		var total = 0;
		var total_1 = 0;
		var total_2 = 0;
		var total_3 = 0;
		$(".TOTAL_VALUE").each(function(index, element) {
			total = (Number($(element).val().replace(",","").replace(",","")) + total);
		});
		
		$(".BULAN1").each(function(index, element) {
			total_1 = (Number($(element).val()) + total_1);
		});
		$(".BULAN2").each(function(index, element) {
			total_2 = (Number($(element).val()) + total_2);
		});
		$(".BULAN3").each(function(index, element) {
			total_3 = (Number($(element).val()) + total_3);
		});
		
		$("#total").html(format_digit(total));
		$("#total1").html(format_digit(total_1));
		$("#total2").html(format_digit(total_2));
		$("#total3").html(format_digit(total_3));
	}
	
	function format_digit( toFormat ) {
		return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	};
	/*ini untuk menghitung growth*/
	/*$("tr td .3bln_akhir").on("keyup",function() {
	var hasil = (Number($(this).parents('tr').find('.FORECAST').val()) - Number($(this).val())) / Number($(this).val());
	$(this).parents('tr').find('.GROWTH').val(hasil);
	});*/

    </script>
	</div>
</body>
</html>