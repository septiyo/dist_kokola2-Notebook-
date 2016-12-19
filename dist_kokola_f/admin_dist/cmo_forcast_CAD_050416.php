<?php
session_start();
/*if (session_status() == PHP_SESSION_NONE) { //PHP >= 5.4.0
    session_start();
}*/
/*if(session_id() == '') {
    session_start();
}*/
ini_set('display_errors', 0);
/*error_reporting(E_ALL|E_STRICT);*/
ini_set('max_execution_time', 600);
include "../koneksi.php";
//include "bantuan.class.php";

//$bantuan = new bantuan();
//$tanggal = $bantuan->tgl_indo("datetime");

echo "Bulan ".$_SESSION['BULAN_NOW'];
//$bantuan = new bantuan();
//  $tanggal = $bantuan->tgl_indo("datetime");
//if($_GET[ACC_ID]) {
	
	$acon_id = $_GET[ACC_ID];
	//echo $acon_id;
	//exit;
	
	
    ?>
    <html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../themes/9septi_season.min.css"/>
    <link rel="stylesheet" href="../themes/jquery.mobile.icons.min.css"/>
    
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
    
    
    #overlay {
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 999;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    display: none;
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

	/*langsung simpan*/
	
	$(document).ready(function(){
		
	  $('#SAVE').click(function(e){
		 e.preventDefault(); 

		
		$.ajax({
			type: "POST",
			url: "langsung_simpan_kj.php",
			data:$(".COBA").serialize(),
			//dataType: "html",
			dataType: "json",
			success: function(data) {
				
				//alert(data);
		       // alert(JSON.stringify(data));
				
				
			      if(data.status == "sukses"){
                       alert('Input Berhasil');
                       window.location='order_distributor.php';
                  }
                     else if(data.status == "gagal"){
                       alert('Input Gagal');
                  }
						
				
			},
			error: function() {
				alert('Koneksi Terputus, Cek koneksi anda..!');
			},
		});
		return false;
	  
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

	
	<script>
  $(document).ready(function(){
	 
	 $('#UBAH_TRIWULAN').on('change', function(event) {
        //alert(this.value);
		
		 var bulan_jq = this.value;
		 //alert(bulan_jq);
		 
		 document.cookie = "cookieName=" + bulan_jq;
		 location.reload();
 

		 
    });
	
  });		
	</script>
	<style>
	.blink {
      animation: blink-animation 1s steps(5, start) infinite;
      -webkit-animation: blink-animation 1s steps(5, start) infinite;
	  color:red;
    }
    @keyframes blink-animation {
    to {
    visibility: hidden;
    }
   }
  @-webkit-keyframes blink-animation {
   to {
    visibility: hidden;
   }
  }
	</style>
	
    </head>    
    
    <body>
        <!--div id="overlay"-->
    <?php
	//$bulan = $_GET['BULAN'];
	$bulan =  $_COOKIE['cookieName'];
	echo $bulan;
	$pecah = explode("-", $bulan);
	echo $pecah[0] . "" . $pecah[1] . "" . $pecah[2];
	$_SESSION['TRIWULAN'] = $bulan;
	echo $_SESSION['TRIWULAN'];
	
	$triwulan_terpecah = explode("-", $_SESSION['TRIWULAN']);
	
	
	//date_default_timezone_set("Asia/Jakarta");
	
	//$today          = date('d')."-".date('m')."-".date('Y');
	$today_database = date('Y')."-".date('m')."-1";
	//$time = date('H:i:s');
	
	/** cari 3 bulan yang lalu setelah hari ini **/
		   
	$bulan_lalu  = date( 'Y-m-d', strtotime( $today_database . ' -1 month'));
	$bulan_lalu2 = date( 'Y-m-d', strtotime( $today_database . ' -2 month'));
	$bulan_lalu3 = date( 'Y-m-d', strtotime( $today_database . ' -2 month'));
	
		
	
    echo "<h2 style='text-align: center'>Forecast Bulan : " . $bulan . "</h2>";

    /* ini untuk mencari apakah tahun ini sudah ada di database, jika sudah maka dilarang masuk */
   // $sql_block = "SELECT TRIWULAN FROM kj GROUP BY TRIWULAN ORDER BY ID DESC";
    $sql_block = "SELECT DATE(TGL),ACCOUNT_ID FROM kj_f WHERE ACCOUNT_ID = '$_SESSION[USER]' GROUP BY TRIWULAN ORDER BY ID DESC";

    $hasil_block = mysqli_query($mysqli, $sql_block);

    /*while($data_block = mysqli_fetch_assoc($hasil_block)){
		if($data_block['TRIWULAN'] == $_SESSION['TRIWULAN']){
		?>		
		<script>
		alert('<?php echo "Anda sudah pernah membuat Forecast triwulan $_SESSION[TRIWULAN], anda hannya bisa me Revisinya";?>');
		window.location='dist.php';		
		</script>		
		<?php
		}
    }*/
    ?>
    <div data-role="page" class="type-interior" data-theme="a" id="index">
        <div data-role="header">
            <h1>Forecast FORM </h1>
            <h2>Kokola Distributor 2.5</h2>
        </div><!--end header-->
		
 
        <div data-role="content">
        
                      <form class='COBA' method='post'>
                <!--table border="1" cellpadding="1" cellspacing="0" align="center"-->
                <table id="example"  class="display order-column display stripe" cellspacing="0" width="100%">
                    <thead>
                        <tr bgcolor="#7fffd4">
                            <th width="100">Nama Produk</th>
                            <th width="100">QTY TARGET</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr bgcolor="#7fffd4">
                            <th width="100">&nbsp;</th>
                            <th width="100"><div id="TARGET">0</div></th>
                        
                        </tr>
                    </tfoot>
                    
                    <tbody>
                    <?php
					$total_last_month = "";
											 
												 
						$sql_produk = "SELECT * FROM(SELECT  c.item_code AS ITEM_CODE,
                       c.item_name AS NAMA_PRODUK,
                       m_produk.`KATEGORI` AS KATEGORI,
                       m_produk.KET  
                             
                                                 FROM push_distributor a,
                                                 push_harga b,
                                                 push_item c
                                              
                                                 LEFT JOIN m_produk ON m_produk.`ITEM_CODE` = c.item_code
                                                 
                                                 WHERE
                                                 a.PRICEGROUP_CODE = b.PRICEGROUP_CODE
                                                 AND b.ITEM_CODE = c.item_code
                                                 AND a.ACCOUNT_ID = '$acon_id' 
                                                
                                                
                                                 ORDER BY m_produk.`KATEGORI` DESC) AS asline
                                                 WHERE asline.ITEM_CODE  IN (SELECT ITEM_CODE FROM m_produk WHERE UPPER(KET) LIKE '%FESTIVE%')";						 
												 
							
					
					
                    $hasil_produk = mysqli_query($mysqli, $sql_produk);

                    while($data_produk = mysqli_fetch_assoc($hasil_produk)) {
							  
						
					
                        echo "<tr>";
                        echo "<td align='left'>$data_produk[NAMA_PRODUK]<br><br>
						<b>$data_produk[ITEM_CODE]</b>
						<input type='hidden' value='$data_produk[ITEM_CODE]' name='ITEM_CODE[]' size='50' class='ITEM_CODE' readOnly>
					    <input type='hidden' name='ACON_ID[]' value='$acon_id' style='min-width: 70px' class='ACON_ID'>
						<input type='hidden' name='ITEM_NAME[]' value='$data_produk[NAMA_PRODUK]' style='min-width: 70px' class='ITEM_NAME'></td>";
                        echo "<td align='center'><input type='text' name='KOPLAK[]' class='KOPLAK'></td>";
                        echo "</tr>";
						
						
                    }
                    ?>
                    </tbody>
                </table>
                
                <table id='SIMPAN' align="center" width="300">
                    <tr>
                        <td colspan="5" align="center">
			<!--input type="submit" value="Save to Draft" title="Ini untuk simpan sementara sebelum inputan fix. (mencegah jika sewaktu-waktu terjadi crash/hang/koneksi terputus)" name="DRAFT" id="DRAFT"-->
                        <input type="submit" value="SAVE" title="Ini untuk simpan data KJ jika sudah Fix." name="SAVE" id="SAVE" data-ajax='false'>
						
						
                        <a href="order_distributor.php" data-ajax="false" data-role="button">Back</a>
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
					
			
			 $("tr td .KOPLAK").on("change", function(){
				 
				 hitung_total();
				 
			 });
			
			
			
			function hitung_total() {
				
				var target = 0;
				
				$(".KOPLAK").each(function(index, element) {
                    target = (Number($(element).val()) + target);
					//alert(target);
                });
				
				
				$("#TARGET").html(format_digit(target));
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
        <!--/div--><!--end overlay-->
    </body>
    </html>
<?php
//}
/*else{
    echo "Anda tidak Berhak";
}*/
?>