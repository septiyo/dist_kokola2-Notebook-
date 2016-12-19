<?php
//session_start();
/*if (session_status() == PHP_SESSION_NONE) { //PHP >= 5.4.0
    session_start();
}*/
if(session_id() == '') { //PHP < 5.4.0
    session_start();
}
/*ini_set('display_errors', 1);*/
/*error_reporting(E_ALL|E_STRICT);*/
ini_set('max_execution_time', 600);
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
    <link rel="stylesheet" href="themes/9septi_season.min.css"/>
    <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css"/>
    
    <link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>
    <link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">
    <link rel="stylesheet" href="jqtable/fixedColumns.dataTables.min.css">
    <style>
		p.speech {
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
	.ui-corner-all{
    	border-radius: 0!important;
    }
    
    .input-disabled{
		 background-color:#EBEBE4;
		 border:1px solid #ABADB3;
		 padding:2px 1px;
	}
	#exampe th, td {
		white-space: nowrap;
	}
    div.dataTables_wrapper {
        /*width: 800px;*/
        margin: 0 auto;
    }
	</style>
    <script src="jqm2/jquery-2.1.4.min.js"></script>
    <script src="jqm2/jquery.mobile-1.4.5.min.js"></script>
	
    <script src="jqtable/jquery.dataTables.min.js"></script>
    
	<!--script src="jqtable/dataTables.fixedColumns.min.js"></script-->
    <!--script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script-->
    
    <script src="validation/jquery.validate.js"></script>
	
	<!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
	
	
	
	
	
	<script>
  $(document).on("click","#DRAFT",function() {
		
		var arr = [];
		var i = 0;
		$(".item_code").each(function(index, element) {
               if ($(element).val()!=="") {				
				arr.push({
					item_code:$(element).val(),
					bln_akhir:$(element).parents("tr").find(".bln_akhir").val(),
					FORECAST:$(element).parents("tr").find(".FORECAST").val(),
					PERSEN:$(element).parents("tr").find(".PERSEN").val(),
					BULAN1:$(element).parents("tr").find(".BULAN1").val(),
					BULAN2:$(element).parents("tr").find(".BULAN2").val(),
					BULAN3:$(element).parents("tr").find(".BULAN3").val(),
					
					
				});
				i++;
			}
		});
		
		$.ajax({
					type:"post",
					url:"langsung_simpan_draft.php",
					data:{"q": arr},
					dataType:"html",
					//data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi},
					success: function(php_script_response){
						//$("#tes").html(JSON.stringify(arr));
						//alert (JSON.stringify(arr));
						alert(php_script_response);
						
						/*if(php_script_response == "sukses"){
							
							alert('Input Berhasil');
							window.location='dist.php';
						}
						else{
							alert('Input Gagal');
							//window.location='dist.php';
							
						}*/
						
						
					},
					
				});
		
	 

    });
	
	
	/*langsung simpan*/
	
	  $(document).on("click","#SAVE",function() {
		
		var arr = [];
		var i = 0;
		$(".item_code").each(function(index, element) {
               if ($(element).val()!=="") {				
				arr.push({
					item_code:$(element).val(),
					bln_akhir:$(element).parents("tr").find(".bln_akhir").val(),
					FORECAST:$(element).parents("tr").find(".FORECAST").val(),
					PERSEN:$(element).parents("tr").find(".PERSEN").val(),
					BULAN1:$(element).parents("tr").find(".BULAN1").val(),
					BULAN2:$(element).parents("tr").find(".BULAN2").val(),
					BULAN3:$(element).parents("tr").find(".BULAN3").val(),
					
					
				});
				i++;
			}
		});
		
		$.ajax({
					type:"post",
					url:"langsung_simpan_kj.php",
					data:{"q": arr},
					dataType:"html",
					//data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi},
					success: function(php_script_response){
						//$("#tes").html(JSON.stringify(arr));
						//alert (JSON.stringify(arr));
						//alert(php_script_response);
						if(php_script_response == "sukses"){
							
							alert('Input Berhasil');
							window.location='dist.php';
						}
						else{
							alert('Input Gagal');
							//window.location='dist.php';
							
						}
						
						
					},
					
				});
	  });
	
	
	
	
	
	
	
</script>
	
	
	
	
	<script>
		$(document).ready(function() {
			
			$(window).keydown(function(event){
               if(event.keyCode == 13) {
               event.preventDefault();
               return false;
            }
           });
			
			
			
			
			var oTable = $('#example').DataTable( {
				"dom": '<"toolbar">frtip',
				"scrollY": 300,
				"scrollX": true,
				"paging": false,
				"filter": false,
				"processing": true,
				"bJQueryUI": true,
				"bSort": false,
				//fixedColumns: true
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

	
    </head>    
    
    <body>
    <?php
	$bulan = $_GET['BULAN'];
	$pecah = explode("-", $bulan);
	echo $pecah[0] . "" . $pecah[1] . "" . $pecah[2];
	echo $_SESSION['TRIWULAN'];
	
	$triwulan_terpecah = explode("-", $_SESSION['TRIWULAN']);
	
	
	date_default_timezone_set("Asia/Jakarta");
	
	//$today          = date('d')."-".date('m')."-".date('Y');
	$today_database = date('Y')."-".date('m')."-1";
	//$time = date('H:i:s');
	
	/** cari 3 bulan yang lalu setelah hari ini **/
		   
	$bulan_lalu  = date( 'Y-m-d', strtotime( $today_database . ' -1 month'));
	$bulan_lalu2 = date( 'Y-m-d', strtotime( $today_database . ' -2 month'));
	$bulan_lalu3 = date( 'Y-m-d', strtotime( $today_database . ' -2 month'));
	
		
	
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
            <h1>Forecast FORM </h1>
            <h2>Kokola Distributor 2.5</h2>
        </div><!--end header-->
        
        <div data-role="content">
            <!--form id="formx" method="post" action="simpan_kj.php" data-ajax="false"-->
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
                <table id="example"  class="display order-column display stripe" cellspacing="0" width="100%">
                    <thead>
                        <tr bgcolor="#7fffd4">
                            <th width="75">Nama Produk</th>
                            <!--th width="30">Harga</th-->
                            <th width="50">Last 3 Month</th>
                            <th width="50">Forecast 3 Month</th>
                            <th width="100"> % </th>
                            <th width="100"><?php if($pecah[0] != ""){
								                       echo $pecah[0];
													  }else{
													   echo $triwulan_terpecah[0];
													  }?></th>
                            <th width="100"><?php if($pecah[1] != ""){
								                       echo $pecah[1];
													  }else{
													   echo $triwulan_terpecah[1];
													  }?></th>
						    <th width="100"><?php if($pecah[2] != ""){
								                       echo $pecah[2];
													  }else{
													   echo $triwulan_terpecah[2];
													  }?></th>
				  
                            <!--th width="100"><?php echo $pecah[1].$triwulan_terpecah[1];?></th>
                            <th width="100"><?php echo $pecah[2].$triwulan_terpecah[2];?></th-->
                            <!--th width="100" class="TOTAL_VALUE">Total Value</th-->
                            <!--th-- width="100">ID PRODUK</th-->
                            <!--th>Growth</th-->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr bgcolor="#7fffd4">
                            <th width="100">&nbsp;</th>
                            <!--th width="30">&nbsp;</th-->
                            <th width="50">&nbsp;</th>
                            <th width="50">&nbsp;</th>
                            <th width="100">&nbsp;</th>
                            <th width="100" class="header-bulan1"><div id="total1"></div></th>
                            <th width="100" class="header-bulan2"><div id="total2"></div></th>
                            <th width="100" class="header-bulan3"><div id="total3"></div></th>
                            <!--th width="100"><div id="total"></div></th-->
                            <!--th-- width="100">ID PRODUK</th-->
                            <!--th>Growth</th-->
                        </tr>
                    </tfoot>
                    
                    <tbody>
                    <?php
					$total_last_month = "";
                    /*$sql_produk = "SELECT * FROM m_produk WHERE HARGA <> 0 AND ITEM_CODE <> 0 ORDER BY ID";*/
					
					$sql_produk = "SELECT DISTINCT m_produk.ID,push_item.item_code AS ITEM_CODE, 
                                         push_item.item_name AS NAMA_PRODUK,
                                           m_produk.KATEGORI AS KATEGORI										 
                 						FROM push_item,push_harga 
					                LEFT JOIN m_produk ON push_harga.`ITEM_CODE` = `m_produk`.`ITEM_CODE`
                                      WHERE push_item.`item_code` = push_harga.`ITEM_CODE`
                                         GROUP BY push_item.`item_code`
                                          ORDER BY m_produk.`KATEGORI` DESC";
										  
										  
							/*$sql_produk = "SELECT DISTINCT push_item.item_code AS ITEM_CODE, 
                                                     m_produk.NAMA_PRODUK AS NAMA_PRODUK
                                          			FROM push_item,push_harga,m_produk 
					                               WHERE push_item.`item_code` = push_harga.`ITEM_CODE`
                             AND push_item.`item_code` = m_produk.`ITEM_CODE`
                                          ORDER BY m_produk.`KATEGORI` DESC";*/		  
										  
										  /*$sql_produk = "SELECT push_item.item_code AS ITEM_CODE,
                                                             push_item.item_name AS NAMA_PRODUK
										  FROM push_item";*/
					
					
					
					
					
					
                    $hasil_produk = mysqli_query($mysqli, $sql_produk);

                    while ($data_produk = mysqli_fetch_assoc($hasil_produk)) {
						
					     $item_code = $data_produk['ITEM_CODE'];
						
						/*Select dari kj_draft*/
	                        
						 $sql_kj_draft = "SELECT * FROM kj_draft WHERE `ACCOUNT_ID` = '$_SESSION[ACCOUNT_ID]' AND
                                            `ITEM_CODE` = '$data_produk[ITEM_CODE]'";
  
											 
						$hasil_kj_draft = mysqli_query($mysqli, $sql_kj_draft);
						$data_kj_draft = mysqli_fetch_assoc($hasil_kj_draft);
						
						
								
			
						 
						 
						 /*Cari Forecast 3 bulan yang lalu*/
													 
							$sql_forcastx = "SELECT SUM(qty) AS total_last_month FROM order_kirim 
				             WHERE periode1 IN ('$bulan_lalu','$bulan_lalu2','$bulan_lalu3')
                			 AND FLAG = 1  AND item_code = '$item_code' 
                                         AND periode2 IN (LAST_DAY('$bulan_lalu'),LAST_DAY('$bulan_lalu2'),LAST_DAY('$bulan_lalu3')) AND  ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";			 
										   
						  $hasil_forcastx = mysqli_query($mysqli, $sql_forcastx);
						  $data_forcastx = mysqli_fetch_assoc($hasil_forcastx);
						  $total_last_month = $data_forcastx['total_last_month'];		
						  
						  //<input type='hidden' value='$data_produk[HARGA]' class='HARGA' name='HARGA[]'>
					
                        echo "<tr>";
                        echo "<td align='left'>$data_produk[NAMA_PRODUK]
						<input type='hidden' value='$data_produk[ITEM_CODE]' name='ITEM_CODE[]' class='item_code' ></td>";
                        if($total_last_month != ""){
						
                            echo "<td align='center'><input type='text' name='bln_akhir[]' class='bln_akhir' value='$total_last_month'></td>";
							
						}
						else{
							 echo "<td align='center'><input type='text' name='bln_akhir[]' class='bln_akhir' value='$data_kj_draft[BLN_AKHIR]'></td>";				
							
						}
						
                        		
                        echo "<td align='center'><input type='text' name='FORECAST[]' class='FORECAST' placeholder='...' value='$data_kj_draft[FORECAST]'></td>";
                        echo "<td align='center'><input type='text' name='PERSEN[]' value='$data_kj_draft[PERSEN]' style='min-width: 70px' class='PERSEN' readonly placeholder='...' ></td>";
                        echo "<td align='center'><input type='text' name='BULAN1[]' value='$data_kj_draft[BULAN1]' style='min-width: 100px' class='BULAN1' placeholder='...'  ></td>";
                        echo "<td align='center'><input type='text' name='BULAN2[]' value='$data_kj_draft[BULAN2]' style='min-width: 100px' class='BULAN2' placeholder='...'  ></td>";
                        echo "<td align='center'><input type='text' name='BULAN3[]' value='$data_kj_draft[BULAN3]' style='min-width: 100px' class='BULAN3' placeholder='...'>
						</td>";
                        //echo "<td align='center'><input type='text' name='TOTAL_VALUE[]' value='$data_kj_draft[TOTAL_VALUE]' style='min-width: 100px' class='TOTAL_VALUE' placeholder='...' ></td>";
							
						
             
                        echo "</tr>";
						
						
                    }
                    ?>
                    </tbody>
                </table>
                
                <table align="center" width="300">
                    <tr>
                        <td colspan="5" align="center">
						<input type="submit" value="Save to Draft" title="Ini untuk simpan sementara sebelum inputan fix. (mencegah jika sewaktu-waktu terjadi crash/hang/koneksi terputus)" name="DRAFT" id="DRAFT">
                        <input type="submit" value="Publish" title="Ini untuk simpan data KJ jika sudah Fix." name="SAVE" id="SAVE">
                        <a href="dist.php" data-ajax="false" data-role="button">Back</a>
                        </td>            
                    </tr>
                </table>
				
              <div id="tes"></div>
            <!--/form-->
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
			
			$(".bln_akhir").on("change", function() {
				var hasil = Number($(this).val()) + $(this).val() * 10/100;
				$(this).parents('tr').find('.FORECAST').val(Math.round(hasil));
				//alert(hasil);
				//Number($(this).parents('tr').find('.FORECAST').val());
				
				//$(this).parents('tr').find('td:eq(3) input').val(Math.round(hasil));
				
				//var forcast   = Number($(this).parents('tr').find("td:eq(3) input").val());
				var forcast   = Number($(this).parents('tr').find('.FORECAST').val());
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
				
				$(this).parents('tr').find('.BULAN1').val($(this).val());
				
				
				$(this).parents("tr").find(".BULAN2").val(0);
				$(this).parents("tr").find(".BULAN3").val(0);
				
				
                /*if(persen < 10){
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
				}*/
                /*if((bulan1 == "0") && (bulan2 == "0") && (bulan3 == "0")){
                    var bagi_3 = Math.round(Number(forcast / 3));
                }*/
				hitung_total();
				
				//var forcast = Number($(this).parents("tr").find("td:eq(3) input").val());
				var harga = Number($(this).parents('tr').find('.HARGA').html());
				//alert(forcast);
				//alert(harga);
							
				
				var hasil = forcast * harga;
				$(this).parents('tr').find('.TOTAL_VALUE').val(hasil);
			});
			
			/*ini untuk menhitungn Total value*/
			$("tr td .FORECAST").on("keyup", function () {
				var forcast = Number($(this).val());
				var harga = Number($(this).parents('tr').find('.HARGA').val());
							
				
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
            $("tr td .FORECAST").on("change", function () {
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
				
				
				
				$(this).parents('tr').find('.BULAN1').val($(this).val());
				$(this).parents("tr").find(".BULAN2").val(0);
				$(this).parents("tr").find(".BULAN3").val(0);
				
				
				
    								
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
						/*if ($(this).val() < 10) {
							alert( "Harus diatas 10%" );
							event.preventDefault();
							return false;
						}*/
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