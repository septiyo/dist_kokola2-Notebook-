<?php
session_start();
error_reporting(0);
/*ini_set('display_errors', 1);*/
/*error_reporting(E_ALL|E_STRICT);*/
include "../koneksi.php";
include "../bantuan.class.php";

$bantuan = new bantuan();
$tanggal = $bantuan->tgl_indo("datetime");

if($_SESSION['HAK'] == "ADMIN") {
    ?>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">        
        <link rel="stylesheet" href="../themes/9septi_season.min.css" />
        <link rel="stylesheet" href="../themes/jquery.mobile.icons.min.css" />
        <link rel="stylesheet" href="../jqm2/jqmobile.structure-1.4.5.min.css"/>
        <link rel="stylesheet" href="../jqtable/jquery.dataTables.min.css">
        <link rel="stylesheet" href="../jqtable/fixedColumns.dataTables.min.css">
        <style type="text/css">
		#id_dist th span {
			color:#F63;
		}
		.ui-corner-all{
			border-radius:0 !important;
		}
		.input-disabled{
			background-color:#EBEBE4 !important;
			border:1px solid #ABADB3;
			padding:2px 1px;
		}
		#cari {
			padding:5px;
			margin:5px 15px 10px 0px;
			float:right;
		}
		</style>
        <!--link rel="stylesheet" href="../jqtable/themes/smoothness/jquery-ui.css"-->
        
        <script src="../jqm2/jquery-2.1.4.min.js"></script>
        <script src="../jqm2/jquery.mobile-1.4.5.min.js"></script>
        <script src="../jqtable/jquery.dataTables.min.js"></script>
        <script src="../jqtable/dataTables.fixedColumns.min.js"></script>
        <script src="../jqtable/dataTables.jqueryui.min.js"></script>
        <script src="../validation/jquery.validate.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			hitung_total();
			
			$('#example').DataTable( {
				"dom": '<"toolbar">frtip',
				"scrollY": 300,
				"scrollX": true,
				"paging": false,
				"filter": false,
				"processing": true,
				"bJQueryUI": true,
				"bSort": false,
				/*"fixedColumns": {
					leftColumns: 2
				},*/
				"rowCallback": function( row, data, index ) {
					/*$('td:eq(0)', row).html( format_digit(data[1]) );
					$('td:eq(1)', row).html( format_digit(data[2]) );
					$('td:eq(2)', row).html( format_digit(data[3]) );
					$('td:eq(3)', row).html( format_digit(data[4]) );
					$('td:eq(4)', row).html( format_digit(data[5]) );
					$('td:eq(5)', row).html( format_digit(data[6]) );
					$('td:eq(6)', row).html( format_digit(data[7]) );
					$('td:eq(7)', row).html( format_digit(data[8]) );*/
				},
			});
		
			$("div.toolbar").html('<b><input type="text" id="cari" placeholder="Cari Produk..."></b>');
				$("#cari").keyup(function(e) {
					cari_table();
			});
			
			$('#EDIT').on('click',function(){
				//alert('x');
				$.ajax({
					type:"POST",
					url:"edit_kj_action.php",
					dataType:"json",
					data:$('.EDIT_ACTION').serialize(),
					success:function(data){
						//alert(data);
						 //alert(JSON.stringify(data));
						if(data.status == "sukses"){
							alert('Input data berhasil !!!');
							window.location='admin_kj.php';
						}
						else if(data.status == "gagal"){
							alert('Maaf, input data gagal !!!');
						}
					},
					error: function() {
						alert('Maaf, proses gagal, koneksi terputus, cek koneksi anda..!!!');
					},						
				});
				return false;
			});
		});
		
		/*cari table*/
		function cari_table() {
			var value = $("#cari").val();	
			$("#example tbody tr").each(function(index, element) {
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
    $month = date('M');

    $_SESSION['BULAN_NOW'] = $month;

    $tgl = $_GET['TGL'];
    $dist = $_GET['DIST'];
	$today = date('Y')."-".date('m')."-".date('d');
	
	$namaDist = "";
	$sqlDist = "select ACCOUNT_NAME, ACCOUNT_ADDRESS1
		from push_distributor where ACCOUNT_ID = '".$dist."'";
	$myDist = mysqli_query($mysqli, $sqlDist);
	if($dataDist = mysqli_fetch_assoc($myDist)) {
		$namaDist = $dataDist['ACCOUNT_NAME'];
	}
	//$pecah = explode("-", $tri);
	//echo $pecah[0] . "<br>" . $pecah[1] . "<br>" . $pecah[2];

   	// date_default_timezone_set("Asia/Jakarta");

    /*$sql_cari_isi = "SELECT SET_BLN1, SET_BLN2, SET_BLN2 FROM kj WHERE TRIWULAN = '$tri'
		AND NAMA_DIST= 			'$_SESSION[USER]' ";*/
    //$sql_cari_isi = "SELECT * FROM kj_f WHERE DATE(TGL) = '$tri' AND ACCOUNT_ID= '$dist'";
    //echo $sql_cari_isi;

    /*$hasil_isi = mysqli_query($mysqli, $sql_cari_isi);
    $data_isi = mysqli_fetch_assoc($hasil_isi);*/


    //echo "<h2 style='text-align: center'>Forecast Bulan : " . $tri . "</h2>";
    // echo "<h1>KUNAM  ".$_SESSION[TRIWULAN]."   ".$_SESSION[BULAN_NOW]."</h1>";

    ?>
    <div data-role="page" class="type-interior" data-theme="a">
        <div data-role="header">
            <h1>Admin View Forcast FORM </h1>

            <h2>Kokola Distributor 2.5</h2>
        </div>
        <!--end header-->

        <div data-role="content">


            <!--form method="post" action="edit_forcast.php" data-ajax="false"-->
			<form class="EDIT_ACTION">
                <table id="id_dist">
                    <tr>
                        <th colspan="9" align="center">
                        	Nama Distributor : <?php echo $namaDist." <span>[".$dist."]</span>"; ?></th>
                    </tr>
                </table>
				
				<table id="example" class="display order-column display stripe" cellspacing="0" width="100%">
                    <thead>
                        <tr bgcolor="#7fffd4">
                            <th width="90">Nama Produk</th>
                            <th width="50">QTY TARGET</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr bgcolor="#7fffd4">
                            <th width="90">&nbsp;</th>
                            <th width="50"><div id="TARGET">0</div></th>
                        
                        </tr>
                    </tfoot>
                    
                    <tbody>
                    <?php
					$total_last_month = "";
					$sql_produk = "SELECT * FROM
						(SELECT  c.item_code AS ITEM_CODE,
							c.item_name AS NAMA_PRODUK,
							m_produk.`KATEGORI` AS KATEGORI,
							m_produk.KET                             
							FROM push_distributor a,
								push_harga b,
								push_item c
							LEFT JOIN m_produk ON m_produk.`ITEM_CODE` = c.item_code
								WHERE a.PRICEGROUP_CODE = b.PRICEGROUP_CODE
								AND b.ITEM_CODE = c.item_code
								AND a.ACCOUNT_ID = '".$dist."' 
							ORDER BY m_produk.`KATEGORI` DESC) AS asline
						WHERE asline.ITEM_CODE IN
							(SELECT ITEM_CODE FROM m_produk WHERE UPPER(KET) LIKE '%FESTIVE%')";			
					
					$hasil_produk = mysqli_query($mysqli, $sql_produk);

                    while($data_produk = mysqli_fetch_assoc($hasil_produk)) {
						
						$item_codex = $data_produk['ITEM_CODE'];
						
						if(!empty($item_codex)){						 
						     $sql_load_data = "SELECT DATE(TGL) AS tgl,
								NAMA_PRODUK,
								ITEM_CODE,
								SUM(TARGET)AS TARGET
								FROM kj_f WHERE DATE(TGL) = '".$tgl."' 
								AND ACCOUNT_ID= '$dist'
								AND ITEM_CODE = '".$item_codex."'													  
								GROUP BY ITEM_CODE";
														
							$hasil_load = mysqli_query($mysqli, $sql_load_data);
							
							$data_load = mysqli_fetch_assoc($hasil_load); 
						
							echo "<tr>";
							echo "<td align='left' width='90'>".$data_produk['NAMA_PRODUK']."<br><br>
									<b style='color:#699;'>".$data_produk['ITEM_CODE']."</b>
									<input type='hidden' value='".$data_produk['ITEM_CODE']."' name='ITEM_CODE[]'
										size='50' class='ITEM_CODE' readOnly>
									<input type='hidden' name='ITEM_NAME[]' value='".$data_produk['NAMA_PRODUK']."'
										style='min-width: 70px' class='ITEM_NAME'></td>";
							echo "<td align='center' width='50'><input type='text' name='KOPLAK[]'
									class='KOPLAK' value='".$data_load['TARGET']."'></td>";
							echo "</tr>";
						}
                    }
                    ?>
                    </tbody>
                </table>
                
                <table align="center" width="300">
                    <tr>
                        <td colspan="5" align="center">
						    <input type="hidden" value="<?php echo $dist ?>" name="ACON_ID" class="ACON_ID">
                            <input type="submit" value="EDIT" name="EDIT" id="EDIT">
                            <!--a-- href="dist_forcest_next.php" data-ajax="false" data-role="button">Next</a-->
                            <a href="admin_kj.php" data-ajax="false" data-role="button">Back</a>
                        </td>

                    </tr>
                </table>

            </form>
        </div>
        <!--end content-->
        <br><br>


        <div data-role="footer">
            <h2>Kokola Web Developer Department, 2016</h2>
        </div>
        <!--end of content-->
          <script>

            
					
			
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
			
			function hitung_total2() {
				
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

    </body>
    </html>
    <?php
}
else{

    echo "Anda tidak Berhak";
}


?>