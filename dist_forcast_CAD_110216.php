<?php
//session_start();
/*if (session_status() == PHP_SESSION_NONE) { //PHP >= 5.4.0
    session_start();
}*/
error_reporting(0);
if(session_id() == '') { //PHP < 5.4.0
    session_start();
}
/*ini_set('display_errors', 1);*/
/*error_reporting(E_ALL|E_STRICT);*/
ini_set('max_execution_time', 1000);
include "koneksi.php";
include "bantuan.class.php";

$bantuan = new bantuan();
$tanggal = $bantuan->tgl_indo("datetime");

echo "Bulan ".$_SESSION['BULAN_NOW'];
//$bantuan = new bantuan();
//  $tanggal = $bantuan->tgl_indo("datetime");
if($_SESSION['USER']) {
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<script src="jqm2/jquery-2.1.4.min.js"></script>
<script src="jqm2/jquery.mobile-1.4.5.min.js"></script>
<!--script-- src="jqtable/jquery.dataTables.min.js"></script-->
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="jqtable/dataTables.fixedColumns.min.js"></script>
<script src="validation/jquery.validate.js"></script>
<link rel="stylesheet" href="themes/9septi_season.min.css"/>
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css"/>
<!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
<link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>
<link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">
<link rel="stylesheet" href="jqtable/fixedColumns.dataTables.min.css">
	
	
<style type="text/css">
	p.speech
	{
	position: relative;
	width: 50;
	height: 40;
	text-align: center;
	line-height: 100px;
	background-color: #fff;
	border: 8px solid #666;
	-webkit-border-radius: 30px;
	-moz-border-radius: 30px;
	border-radius: 30px;
	-webkit-box-shadow: 2px 2px 4px #888;
	-moz-box-shadow: 2px 2px 4px #888;
	box-shadow: 2px 2px 4px #888;
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
	   "fixedColumns": true
		});
		
			$("div.toolbar").html('<b><input type="text" id="cari"></b>');
				$("#cari").keyup(function(e) {
                    cari_table();
            });
		
		
		/*$(".BULAN1").attr("readonly","readonly");
		$(".BULAN2").attr("readonly","readonly");
		$(".BULAN3").attr("readonly","readonly");*/
		
		
	});
	
	
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
<style>
.ui-corner-all{
	border-radius: 0!important;
}

.input-disabled{
			 background-color:#EBEBE4;
			 border:1px solid #ABADB3;
			 padding:2px 1px;
}    
</style>
</head>    
    
    <body>
    <?php
	if (isset($_POST['SAVE'])) {
		//$produk = $_POST[PRODUK];
       // $id_jos      = $_POST[ID_JOS];
        $produk      = $_POST['PRODUK'];
        $harga       = $_POST['HARGA'];
        $bulan_akhir = $_POST['bln_akhir'];
        $forecast    = $_POST['FORECAST'];
        $persen      = $_POST['PERSEN'];
        $bulan1      = $_POST['BULAN1'];
        $bulan2      = $_POST['BULAN2'];
        $bulan3      = $_POST['BULAN3'];
        $total_value = $_POST['TOTAL_VALUE'];
		
		$id = $_POST['ID'];
		$item_code = $_POST['ITEM_CODE'];
		
        $jumlah_forcast = count($forecast);
		//echo $jumlah_forcast;
        $n = 0;
        while ($n < $jumlah_forcast) {
            if($forecast[$n] != "") {
                date_default_timezone_set("Asia/Jakarta");
                $month = date('M');
              	/*cari produk*/
                /*$sql_cari_produk_id = "SELECT ID,ITEM_CODE FROM m_produk WHERE NAMA_PRODUK LIKE '%$produk[$n]%'";
                $hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
                $data_id = mysqli_fetch_assoc($hasil_cari_produk_id);
                $id = $data_id['ID'];
				$item_code = $data_id['ITEM_CODE'];*/
				
                $sql_kj = "INSERT INTO kj SET  TGL = '$tanggal',
					TRIWULAN = '$_SESSION[TRIWULAN]',
					BULAN_INPUT = '$month',
					NAMA_DIST = '$_SESSION[USER]',
					ID_PRODUK = '$id[$n]',
					NAMA_PRODUK = '$produk[$n]',
					ITEM_CODE = '$item_code[$n]',
					DAERAH     = '$_SESSION[KOTA]',
					HARGA = '$harga[$n]',
					BLN_AKHIR = '$bulan_akhir[$n]',
					FORECAST = '$forecast[$n]',
					PERSEN   = '$persen[$n]',
					BULAN1   = '$bulan1[$n]',
					BULAN2   = '$bulan2[$n]',
					BULAN3   = '$bulan3[$n]',
					TOTAL_VALUE    = '$total_value[$n]',
					SET_BLN1 = 'ISI',
					ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
                
				//echo $sql_kj;

                $hasil_input_kj = mysqli_query($mysqli, $sql_kj);
            }
            $n++;
        }
		
        if ($hasil_input_kj) {
            //echo "input Barhasil";
            echo "<script>alert('Input Barhasil');
                          window.location='dist.php';
                  </script>";
           // header("Location: dist_forcest_next.php?TRI=$_SESSION[TRIWULAN]");
        } else {
            //echo "input gagal";
            echo "<script>alert('Input Gagal, Harap Coba lagi..!');window.location='dist_forcast.php';</script>";
        }
    }
    $bulan = $_GET['BULAN'];
    $pecah = explode("-", $bulan);
    echo $pecah[0] . "" . $pecah[1] . "" . $pecah[2];
    echo $_SESSION['TRIWULAN'];
	
	
	date_default_timezone_set("Asia/Jakarta");

        //$today          = date('d')."-".date('m')."-".date('Y');
        $today_database = date('Y')."-".date('m')."-1";
        //$time = date('H:i:s');

        /** cari 3 bulan yang lalu setelah hari ini **/
               
        $bulan_lalu  = date( 'Y-m-d', strtotime( $today_database . ' -1 month'));
		$bulan_lalu2 = date( 'Y-m-d', strtotime( $today_database . ' -2 month'));
		$bulan_lalu3 = date( 'Y-m-d', strtotime( $today_database . ' -3 month'));
	
		
	
    echo "<h2 style='text-align: center'>Forecast Bulan : " . $bulan . "</h2>";

    /* ini untuk mencari apakah triwulan ini sudah ada di database, jika sudah maka dilarang masuk */
   // $sql_block = "SELECT TRIWULAN FROM kj GROUP BY TRIWULAN ORDER BY ID DESC";
    $sql_block = "SELECT TRIWULAN,NAMA_DIST FROM kj WHERE NAMA_DIST = '$_SESSION[USER]' GROUP BY TRIWULAN ORDER BY ID DESC";

    $hasil_block = mysqli_query($mysqli, $sql_block);

    while($data_block = mysqli_fetch_assoc($hasil_block)){
		if($data_block['TRIWULAN'] == $_SESSION['TRIWULAN']){
		?>		
		<script>
		alert('<?php echo "Anda sudah pernah membuat Forecast triwulan $_SESSION[TRIWULAN], anda hannya bisa me Revisinya";?>');
		window.location='dist.php';		
		</script>		
		<?php
		}
    }//end while
    ?>
    <div data-role="page" class="type-interior" data-theme="a" id="index">
        <div data-role="header">
            <h1>Forcast FORM </h1>
            <h2>Kokola Distributor 2.5</h2>
        </div><!--end header-->
        
        <div data-role="content">
		
            <form id="formx" method="post" action="dist_forcast.php" data-ajax="false">
                <table>
                    <tr>
                        <td align="center" colspan="9">
                            <h3>Forecast : <?php echo $_SESSION['TRIWULAN']; ?></h3>
                            <input type="hidden" value="<?php echo $_SESSION['TRIWULAN']; ?>" name="TRIWULAN">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="9" align="center">Nama Distributor : <?php echo $_SESSION['NAMA']; ?></th>
                    </tr>
                </table>

                <!--table border="1" cellpadding="1" cellspacing="0" align="center"-->
                <table id="example"  class="order-column display stripe" cellspacing="0" width="100%">
                    <thead>
                        <tr bgcolor="#7fffd4">
                            <th width="100">Nama Produk</th>
                            <th width="30">Harga</th>
                            <th width="50">Last 3 Month</th>
                            <th width="50">Forecast 3 Month</th>
                            <th width="50"> % </th>
                            <th width="100"><?php echo $pecah[0];?></th>
                            <th width="100"><?php echo $pecah[1];?></th>
                            <th width="100"><?php echo $pecah[2];?></th>
                            <th width="100" class="TOTAL_VALUE">Total Value</th>
                            <!--th-- width="100">ID PRODUK</th-->
                            <!--th>Growth</th-->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr bgcolor="#7fffd4">
                            <th width="100">&nbsp;</th>
                            <th width="30">&nbsp;</th>
                            <th width="50">&nbsp;</th>
                            <th width="50">&nbsp;</th>
                            <th width="50">&nbsp;</th>
                            <th width="100" class="header-bulan1"><div id="total1"></div></th>
                            <th width="100" class="header-bulan2"><div id="total2"></div></th>
                            <th width="100" class="header-bulan3"><div id="total3"></div></th>
                            <th width="100"><div id="total"></div></th>
                            <!--th-- width="100">ID PRODUK</th-->
                            <!--th>Growth</th-->
                        </tr>
                    </tfoot>
                    
                    <tbody>
                    <?php
                    $sql_produk = "SELECT * FROM m_produk WHERE HARGA <> 0 ORDER BY NAMA_PRODUK ASC";
                    $hasil_produk = mysqli_query($mysqli, $sql_produk);

                    while ($data_produk = mysqli_fetch_assoc($hasil_produk)) {
					
					     $item_code = $data_produk[ITEM_CODE];
						 
						 /*Cari Forecast 3 bulan yang lalu*/
						 
						 
						 $sql_forcastx = "SELECT SUM(qty) AS total_last_month FROM order_kirim WHERE periode1 IN ('$bulan_lalu','$bulan_lalu2','$bulan_lalu3')
                						 AND FLAG = 1  AND item_code = '$item_code' 
                                         AND periode2 IN (LAST_DAY('$bulan_lalu'),LAST_DAY('$bulan_lalu2'),LAST_DAY('$bulan_lalu3')) AND  account_id = '$_SESSION[ACCOUNT_ID]'";
										   

//echo $sql_forcastx;										   
										   
										   
						  $hasil_forcastx = mysqli_query($mysqli, $sql_forcastx);
						  $data_forcastx = mysqli_fetch_assoc($hasil_forcastx);
						  $total_last_month = $data_forcastx['total_last_month'];
											
					
                        echo "<tr>";
                        echo "<td align='left'> $data_produk[NAMA_PRODUK] <input type='hidden' value='$data_produk[NAMA_PRODUK]' name='PRODUK[]'></td>";
                        echo "<td><div class='HARGA' align='center'>$data_produk[HARGA]</div>
						             <input type='hidden' value='$data_produk[HARGA]' name='HARGA[]'>
									 <input type='hidden' value='$data_produk[ITEM_CODE]' name='ITEM_CODE[]'>
									  <input type='hidden' value='$data_produk[ID]'  name='ID[]'>
									
                                   <!--input type='hidden' name='ID_JOS[]' style='min-width: 100px' id='ID_JOS' class='ID_JOS' value='$data_produk[ID]'-->
                             </td>";
                        echo "<td align='center'><input type='text' name='bln_akhir[]' id='bln_akhir' class='bln_akhir' value='$total_last_month'></td>";
                        echo "<td align='center'><input type='text' name='FORECAST[]' id='FORECAST_ID' class='FORECAST' placeholder='...'></td>";
                        echo "<td align='center'><input type='text' name='PERSEN[]' style='min-width: 30px' class='PERSEN' readonly placeholder='...' ></td>";
                        echo "<td align='center'><input type='text' name='BULAN1[]' style='min-width: 100px' class='BULAN1' placeholder='...'  ></td>";
                        echo "<td align='center'><input type='text' name='BULAN2[]' style='min-width: 100px' class='BULAN2' placeholder='...'  ></td>";
                        echo "<td align='center'><input type='text' name='BULAN3[]' style='min-width: 100px' class='BULAN3' placeholder='...'  ></td>";
                        echo "<td align='center'><input type='text' name='TOTAL_VALUE[]' style='min-width: 100px' class='TOTAL_VALUE' placeholder='...' ></td>";
                        //echo "<td class='center'><input type='text' name='ID_JOS[]' style='min-width: 100px' id='ID_JOS' class='ID_JOS' value='$data_produk[ID]'></td>";
                        //echo "<td align='center'><input type='text' name='GROWTH[]' id='GROWTH' class='GROWTH' readonly></td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
                
                <table align="center" width="300">
                    <tr>
                        <td colspan="5" align="center">
                        <input type="submit" value="SAVE" name="SAVE" id="SAVE">
                        <!--a-- href="syarat.php" class="ui-shadow ui-btn ui-corner-all ui-btn-inline" data-transition="pop" id="SYARAT">SYARAT</a-->
                        <a href="dist.php" data-ajax="false" data-role="button">Back</a>
                        </td>            
                    </tr>
                </table>
            </form>
        </div>
        <!--end content-->
        <br><br>
        <div data-role="footer">
            <h2>Kokola Web Developer Department, 2016</h2>
        </div><!--end of content-->
        <script>
           $(document).ready(function(){
				$("tr td .TOTAL_VALUE").prop('readOnly', true);
				$(".TOTAL_VALUE").addClass('input-disabled');
						
			
           });
		   
		  
		   
		   
			
            /*ini untuk menhitungn Total value*/
            $("tr td .FORECAST").on("keyup", function () {
			    var forcast = Number($(this).val());
				var harga = Number($(this).parents('tr').find('.HARGA').html());
				//alert(forcast);
				//alert(harga);
							
				
                var hasil = forcast * harga;
                $(this).parents('tr').find('.TOTAL_VALUE').val(hasil);
            });
			
			/*untuk suggest forcast*/
			/*$("tr td .bln_akhir").on("change", function () {
			  
				var bln_akhir   = Number($(this).val());
				//alert(bln_akhir);
                
                var hitung_persen = Math.round((bln_akhir * 10) / 100);
				var suggest = bln_akhir + hitung_persen;
				
				
				 $(this).parents('tr').find('.FORECAST').val(suggest);				
		
			
			});*/
			
			
             /*untuk hitung persen*/
            $("tr td #FORECAST_ID").on("change", function () {
                var forcast   = Number($(this).val());
                var bln_akhir = Number($(this).parents('tr').find('.bln_akhir').val());
			   /* var hasil = Number($(this).val()) * Number($(this).parents('tr').find('.HARGA').html());
                $(this).parents('tr').find('.TOTAL_VALUE').val(hasil);*/
				
				//alert(forcast);
                //var bulan1    = Number($(this).parents('tr').find('.BULAN1').val());
                //var bulan1    = 0;
                var bulan2    = 0;
                var bulan3    = 0;
                var persen = Math.round((forcast - bln_akhir) / bln_akhir * 100);
             
                $(this).parents('tr').find('.PERSEN').val(persen);
                if(persen < 10){
                    alert('Prosentase tidak boleh kurang dari 10%');
                    $(this).parents('tr').find('.FORECAST').focus();
					$(this).parents("tr").find(".BULAN1").attr("readonly","readonly");
					$(this).parents("tr").find(".BULAN2").attr("readonly","readonly");
					$(this).parents("tr").find(".BULAN3").attr("readonly","readonly");
					$(this).parents("tr").find(".BULAN1").val(0);
					$(this).parents("tr").find(".BULAN2").val(0);
					$(this).parents("tr").find(".BULAN3").val(0);
                }
				else {
					$(this).parents("tr").find(".BULAN1").removeAttr("readonly");
					$(this).parents("tr").find(".BULAN2").removeAttr("readonly");
					$(this).parents("tr").find(".BULAN3").removeAttr("readonly");
					$(this).parents('tr').find('.BULAN1').val(forcast);
					$(this).parents('tr').find('.BULAN2').val(bulan2);
					$(this).parents('tr').find('.BULAN3').val(bulan3);
				}
                /*if((bulan1 == "0") && (bulan2 == "0") && (bulan3 == "0")){
                    var bagi_3 = Math.round(Number(forcast / 3));
                }*/
								
				hitung_total();
                /*alert(bulan1);
                alert(bulan2);
                alert(bulan3);*/
            });

            $("tr td .BULAN1").on("keyup", function(){
                var forcast   = Number($(this).parents('tr').find('.FORECAST').val());
                var bulan1    = Number($(this).val());
                //var kolom_lain =  Math.round(Number((forcast - bulan1) / 2));
                var kolom_lain =  Math.round(Number((forcast - bulan1) ));
                //alert(kolom_lain);
                $(this).parents('tr').find('.BULAN2').val(kolom_lain);
                //$(this).parents('tr').find('.BULAN3').val(kolom_lain);
				hitung_total();
            });

            $("tr td .BULAN2").on("keyup", function(){
                var forcast   = Number($(this).parents('tr').find('.FORECAST').val());
                var bulan1    = Number($(this).parents('tr').find('.BULAN1').val());
                var bulan2    = Number($(this).val());
                var kolom_lain =  Math.round(Number((forcast - bulan1) - bulan2));
                //alert(kolom_lain);
                $(this).parents('tr').find('.BULAN3').val(kolom_lain);
				hitung_total();
            });

            $("tr td .BULAN3").on("change", function(){
                var forcast   = Number($(this).parents('tr').find('.FORECAST').val());
                var bulan1    = Number($(this).parents('tr').find('.BULAN1').val());
                var bulan2    = Number($(this).parents('tr').find('.BULAN1').val());
                var bulan3    = Number($(this).val());

                //var kolom_lain =  Math.round(Number((bulan2 - bulan3)));
                //var kolom_lain =  Math.round(Number((forcast - bulan3)/ 2));
                var kolom_lain =  Math.round(Number(forcast-(bulan1 + bulan3)));
                $(this).parents('tr').find('.BULAN2').val(kolom_lain);
               // $(this).parents('tr').find('.BULAN1').val(kolom_lain);

                //alert(kolom_lain);
                //$(this).parents('tr').find('.BULAN3').val(kolom_lain);
                hitung_total();
            });
			
			function hitung_total() {
				var total = 0;
				var total_1 = 0;
				var total_2 = 0;
				var total_3 = 0;
				$(".TOTAL_VALUE").each(function(index, element) {
                    total = (Number($(element).val()) + total);
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
				return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			};
			
			$('#formx').submit(function( event ) {
				var bol = false;
				
				$(".PERSEN").each(function(index, element) {
					if ($(this).val() != "") {						
						bol = true;
						if ($(this).val() < 10) {
							alert( "Harus diatas 10%" );
							event.preventDefault();
							return false;
						}
					}
                });
				if (bol == false) {
					alert( "Data harus diisi" );
					event.preventDefault();
					return false;
				}
			});
        </script>
    </div>
    </body>
    </html>
<?php
}
else{
    echo "Anda tidak Berhak";
}
?>