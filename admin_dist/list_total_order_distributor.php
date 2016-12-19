<?php
session_start();
//ini_set('display_errors', 1);
if($_SESSION['HAK'] == "ADMIN") {
	?>
	<html>
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    
    <script src="../jqm2/jquery-2.1.4.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="../jqm2/jquery.mobile-1.4.5.min.js"></script>
    <script src="../jqtable/jquery.dataTables.min.js"></script>
    <script src="../jqtable/dataTables.fixedColumns.min.js"></script>
    <script src="../jqtable/dataTables.jqueryui.min.js"></script>


    <script src="../validation/jquery.validate.js"></script>
    <link rel="stylesheet" href="../themes/9septi_season.min.css" />
    <link rel="stylesheet" href="../themes/jquery.mobile.icons.min.css" />
    <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
    <link rel="stylesheet" href="../jqm2/jqmobile.structure-1.4.5.min.css"/>
    <link rel="stylesheet" href="../jqtable/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../jqtable/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="../jqtable/themes/smoothness/jquery-ui.css">
    
    <!--link rel="stylesheet" href="https://rawgithub.com/arschmitz/jquery-mobile-datepicker-wrapper/v0.1.1/jquery.mobile.datepicker.css" />
    <script src="https://rawgithub.com/jquery/jquery-ui/1.10.4/ui/jquery.ui.datepicker.js"></script>
    <script id="mobile-datepicker" src="https://rawgithub.com/arschmitz/jquery-mobile-datepicker-wrapper/v0.1.1/jquery.mobile.datepicker.js"></script-->
    
    <script type="text/javascript">
	$(document).ready(function () {
		$('#example').DataTable({
			"scrollY": 450,
			"scrollX": true,
			/*fixedColumns:   {
				leftColumns: 1
			},*/
	
			 "scrollCollapse": true,
			"ordering": false,
			"paging": false
		});
	});
	
	$(function() {
		$( "#from, #to" ).datepicker({
			 dateFormat: "yy-mm-dd",
			
			changeMonth: true,
			numberOfMonths: 1,
			onSelect: function( selectedDate ) {
				if(this.id == 'from'){
				  var dateMin = $('#from').datepicker("getDate");
				  var rMin = new Date(dateMin.getFullYear(), dateMin.getMonth(),dateMin.getDate() + 1); 
				  var rMax = new Date(dateMin.getFullYear(), dateMin.getMonth(),dateMin.getDate() + 7); 
				  $('#to').datepicker("option","minDate",rMin);
				  $('#to').datepicker("option","maxDate",rMax);                    
				}
				
			}
		});
	});
    </script>
	<style type="text/css">		   
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
	#myPopup-popup{
		width: 80%;
		height:360px auto;
	}
	</style>
	</head>

	<body>
	<div data-role="page" class="type-interior" data-theme="f">
		<div data-role="header">
			<h1>Forecast FORM </h1>

			<h2>Kokola Admin 2.5</h2>
		</div>

		<div data-role="content">
			<h2 align="center">Total Order Distributor<br><!--?php echo "<i>".$_SESSION[USER]."</i>";?--></h2>		   
			<?php
		   	#error_reporting(0);
			include "../koneksi.php";
			date_default_timezone_set("Asia/Jakarta");

			$today = date('Y') . "-" . date('m') . "-" . date('d');
			$today_database = date('Y') . "-" . date('m') . "-" . date('d');
			$time = date('H:i:s');

			$thn	= date ('Y');
			$month = date('m');
			#echo $month;
			
			$totalhari = cal_days_in_month(CAL_GREGORIAN, $month, $thn);
			

			#$_SESSION['TRIWULAN'] = $bulan_big;
			
			#echo $totalhari."<br>";
			
			echo "<form action='list_total_order_distributor.php' method='post' data-ajax='false'>
			<table border='0' align='center'>
				<tr>
					<td align='center'>
						
							<input style='text-transform:none;'  class='button_date'  type='text' placeholder='From date' size='15'  id='from' name='from' readonly />
					</td>
					
					<td width='10%'>
					&nbsp;
					</td>
					
					<td align='center'>
						
							<input style='text-transform:none;'  class='button_date'  size='15' type='text' placeholder='To Date' id='to' name='to' readonly />
					</td>
				</tr>
				<tr>
					<td align='center'><button type='reset' name='reset'>RESET</button></td>
					<td align='center'>&nbsp;</td>
					<td align='center'><button type='submit' name='SAVE'>SUBMIT</button></td>
				</tr>
			</table>	
			</form>
			";

			/***************************************/

			// echo $_SESSION[TRIWULANX];

				#echo $today;
			?>    
			<?php
            if(isset($_POST['SAVE'])) {		
                $tgl1    = $_POST['from'];
                $tgl2 	 = $_POST['to'];
                
                $data1 = explode("-", $tgl1);
                $tanggal1 = $data1[2];
                $bulan1 = $data1[1];
                $tahun1 = $data1[0];
                
                $data2 = explode("-", $tgl2);
                $tanggal2 = $data2[2];
                $bulan2 = $data2[1];
                $tahun2 = $data2[0];
                
                $dari = GregorianToJD($bulan1,$tanggal1,$tahun1);
                $ke = GregorianToJD($bulan2,$tanggal2,$tahun2);
                $selisih = $ke-$dari;
                
                $rangeDay=$selisih;
                $jmlKolom = 0;
                #$i=1;
                #for($c=$tgl1;$c<=$tgl2;$c++)
                echo "<table id='example' class='display stripe row-border order-column' cellspacing='0' width='100%'>
                <thead>
                    <tr>
                        <th align='center'>No</th>
                        <th align='center'>Distributor</th>
                        <th align='center'>Kota</th>";
                $sqlku = "select XXX.ACCOUNT_ID, YYY.ACCOUNT_NAME,";
				
                for($i=0; $i<=$rangeDay; $i++) {
                    #$nextDay = mktime(0,0,0,  date("$bulan2"),date("$tanggal2")-$i,date("$tahun2")); 
                    #$nextDay = date("Y-m", $nextDay);
                    #echo "tgl 1 = ".$tgl1."<br>";
                    #$tgl1 = "2013-01-23";// pendefinisian tanggal awal
                    $tgljadi = date('Y-m-d', strtotime("+$i days", strtotime($tgl1)));
                    //operasi penjumlahan tanggal sebanyak 6 hari
                    #echo $tgl2; //print tanggal
                    
                    #$nextDay = date('$tgl1', strtotime('-$i days', strtotime( $tgl2 )));
                    //echo "$tgljadi";
                    $sqlku = $sqlku." MAX(IF(TGL = '".$tgljadi."', JML_ORDER, 0)) as '".$tgljadi."', ";
                    echo "<th align='center'>".$tgljadi."</th>";
                    #echo "<th align='center'>Total Order Tgl $thnn-$monthn-$c </th>";
                  
					$jmlKolom++;
					
                }
                echo "</tr>
                    </thead>";
                $sqlku = $sqlku." MMM.KOTA from (
                       select ACCOUNT_ID, date_format(TGL_CONFIRM,'%Y-%m%-%d') as TGL,
                              sum(JML_ORDER) as JML_ORDER
                              from order_confirm
                              group by ACCOUNT_ID, date_format(TGL_CONFIRM,'%Y-%m%-%d')
                       ) XXX, push_distributor YYY, user MMM
                where XXX.ACCOUNT_ID = YYY.ACCOUNT_ID and XXX.ACCOUNT_ID = MMM.ACCOUNT_ID
                group by ACCOUNT_ID
                order by MMM.KOTA, MMM.REGIONAL;";
                
                $myData = mysqli_query($mysqli, $sqlku);
                
                echo "<tbody>";
                $nomor = 1;
                while ($datanya = mysqli_fetch_array($myData)) {
                    echo "<tr>";
                    echo "<td>".$nomor."</td>";
                    echo "<td>".$datanya['ACCOUNT_NAME']."</td>";
                    echo "<td>".$datanya['KOTA']."</td>";
                    for ($x=1;$x<=$jmlKolom;$x++) {
                        if ($datanya[$x+1] > 0) {
                            echo "<td align='center'><a class='detail_konfirm' href='#' data-mini='true' data-position-to='window'
                                data-transition='flow'>".$datanya[$x+1]."</a>
								<input type='hidden' value='".$datanya['ACCOUNT_ID']."' /></td>";
                        }
                        else {
                            echo "<td align='center'>".$datanya[$x+1]."</td>";
                        }
                    }
                    echo "</tr>";
                    $nomor++;
                }
                echo "</tbody>";
				echo "<tfoot>
			<tr>
				<th align='center' colspan='3'>Total</th>";							
				$rangeDay=$selisih;
				#$i=1;
				#for($c=$tgl1;$c<=$tgl2;$c++)
				for($i=0; $i<=$rangeDay; $i++) {							
					$tgljadi = date('Y-m-d', strtotime("+$i days", strtotime($tgl1)));
					//operasi penjumlahan tanggal sebanyak 6 hari
					$sqltotal = mysqli_query($mysqli, "
					SELECT 
						
						SUM(JML_ORDER) AS TOTALAN																	
					FROM 
						order_confirm 
						INNER JOIN 
							(
								SELECT 
									pt.item_code AS ii, 
									pt.item_name AS NAMA_PRODUK, 
									MP.KATEGORI
								FROM 
								push_item pt 
								LEFT JOIN m_produk MP ON pt.item_code = MP.ITEM_CODE
							)AS PTM ON PTM.ii = order_confirm.ITEM_CODE
																				
						WHERE TGL_CONFIRM LIKE '$tgljadi%';");	
					$datatotal=mysqli_fetch_array($sqltotal);
					if($datatotal['TOTALAN']=='')
					{
					echo "<td align='right'><b>0</b></td>";									
					}
					else
					{								
					echo "<td align='right'><b>$datatotal[TOTALAN]</b></td>";								
					}
				}	
		echo "</tr>
		</tfoot>
				
				
				
                </table>";
				  #echo $sqlku."<b>-".$i."</b><br>";
				#echo $sqlku."<br>";
               	// echo "<div data-role='popup' id='myPopup' class='ui-content' data-theme='a'>";
			   	echo "<div data-role='popup' id='myPopup' class='ui-content' data-theme='a' data-overlay-theme='a'>";
                /*echo "<a href='#' data-rel='back' class='ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete
                    ui-btn-icon-notext ui-btn-right'>Close</a>";*/
				echo "<a href='#' data-rel='back' class='ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete 
					ui-btn-icon-notext ui-btn-right'>Close</a>";
				echo "<div></div>";
                echo "</div>";
            }
            ?> 
            <script type="text/javascript">
			$(document).ready(function(e) {
                $(".detail_konfirm").click(function(e) {
					var $this = $(this);
					var kolom = ($this.parent().index());
					$('#myPopup a').next().html('<img src="244.gif" width="128px" />');
					$('#myPopup').popup({
						history: false,
						//positionTo: 'window',
						y: 20,
						transition: "slideup",
						beforeposition: function( event, ui ) {
							var param = {
								NAMA: $this.parents('tr').find('td:eq(1)').text(),
								ACC_ID: $this.next().val(),
								TGL: $this.parents('table').find('thead tr th:eq(' + kolom + ')').text() };
							$('#myPopup a').next().load("popup_detil_konfirm.php", param, function() {
								$('#myPopup a').next().find('img').remove();
							});
						},
						afterclose: function () {
							$('#myPopup a').next().html("");
						}
						//overlayTheme: "a"
					});
					$('#myPopup').popup("open");
                });
            });
			</script>
        </div><!--end of data role page-->
		
        <a href="home_admin.php" data-role="button" data-ajax="false" target="_parent">Back</a>

        <!--emnd role-content-->

        <div data-role="footer">
            <table align="center">
                <tr>
                    <td align="center">
                        <a href="../logout.php" style="text-align: center" data-role="button" data-icon="power"
                           target="_parent" data-ajax="false">Sign Out</a>
                    </td>
                </tr>
            </table>
            <h2>Kokola Web Developer Department, 2016</h2>
        </div>


    </div>
    <!--end role page-->
    </body>
    </html>
    <?php
}
else{
    echo "Anda tidak berhak..!";
}
?>