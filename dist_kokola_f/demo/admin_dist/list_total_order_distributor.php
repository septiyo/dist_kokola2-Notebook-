    <?php
    session_start();
    //ini_set('display_errors', 1);


    if($_SESSION['HAK'] == "ADMIN") 
	{
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
            
			<script>
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
            
    

            <style>
               
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
				
				$totalhari=cal_days_in_month(CAL_GREGORIAN, $month, $thn);
				

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
	if(isset($_POST['SAVE']))
	{
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
		
	
		#echo $tgl1."<br>".$tgl2."<br>".$selisih;
		
		#echo "tgl fix 1 =".$tgl1fix;
		
		echo "<table id='example' class='stripe row-border order-column' cellspacing='0' width='100%'>
		<thead>
			<tr>
				<th align='center'>No</th>
				<th align='center'>Distributor</th>
				<th align='center'>Kota</th>";
				
				$rangeDay=$selisih;
				#$i=1;
				#for($c=$tgl1;$c<=$tgl2;$c++)
				for($i=0; $i<=$rangeDay; $i++) {
					#$nextDay = mktime(0,0,0,  date("$bulan2"),date("$tanggal2")-$i,date("$tahun2")); 
					#$nextDay = date("Y-m", $nextDay);
					#echo "tgl 1 = ".$tgl1."<br>";
					#$tgl1 = "2013-01-23";// pendefinisian tanggal awal
					$tgljadi = date('Y-m-d', strtotime("+$i days", strtotime($tgl1)));
					//operasi penjumlahan tanggal sebanyak 6 hari
					#echo $tgl2; //print tanggal
					
					#$nextDay = date('$tgl1', strtotime('-$i days', strtotime( $tgl2 )));
					echo "<th>$tgljadi</th>";
					#echo "<th align='center'>Total Order Tgl $thnn-$monthn-$c </th>";
				}	
		echo "</tr>";
		echo "</thead>";
		
		echo "<tbody>";
		$sqldistributor= "
			 SELECT 
			a.ACCOUNT_ID,
			c.NAMA,
			c.KOTA												
			
			FROM
			order_confirm a,
			user c
																		
			WHERE 
			a.ACCOUNT_ID = c.ACCOUNT_ID 														
			GROUP BY  a.ACCOUNT_ID
			ORDER BY c.KOTA;";
		#echo $sqldistributor;
		#exit();	
		$query = mysqli_query($mysqli, $sqldistributor);	
		$no = 1;
		while ($datadistributor = mysqli_fetch_array($query)) {
			echo "<tr>
				<td align='center'>
					$no
				</td>
				<td>
					$datadistributor[NAMA]
				</td>
				<td>
					$datadistributor[KOTA]
				</td>";
				for($e=0;$e<=$rangeDay;$e++) {
					echo "<td align='right'>";
						$tgljadi = date('Y-m-d', strtotime("+$e days", strtotime($tgl1)));
						//operasi penjumlahan tanggal sebanyak 6 hari
						$sqljmlorder = "
																			
										 SELECT 
										
										a.ACCOUNT_ID, 
										SUM(a.JML_ORDER) AS TOTAL_ORDER,
										c.NAMA
										
										FROM
										order_confirm a,
										user c
										
										WHERE
										a.TGL_CONFIRM LIKE '$tgljadi%' AND
										
										a.ACCOUNT_ID = c.ACCOUNT_ID AND
										a.ACCOUNT_ID = '$datadistributor[ACCOUNT_ID]'
										
										GROUP BY  a.ACCOUNT_ID;
										
										;
						";
						#echo $sqljmlorder."<br>";
						$queryjmlorder = mysqli_query($mysqli, $sqljmlorder); 
						$datajmlorder= mysqli_fetch_array($queryjmlorder);
						$idacc=$datajmlorder['ACCOUNT_ID'];
						$namadistributor = $datajmlorder['NAMA'];
					if($datajmlorder['TOTAL_ORDER']=='') {
						echo "0</td>";
					}
					else {
						echo"<a href='#popup$idacc$tgljadi'data-mini='true'
							data-position-to='window' data-rel='popup'  data-transition='flow'>
							$datajmlorder[TOTAL_ORDER]</a>";
						echo "<div data-role='popup' id='popup$idacc$tgljadi' class='ui-content' data-theme='a'>
							<a href='#' data-rel='back' class='ui-btn ui-corner-all ui-shadow 
								ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right'>Close</a>									
							<div class='header' data-role='header'>
								<h1>$namadistributor</h1>
							</div>									
							<div class='rTable' >										
								<div class='rTableRow'>
									<div class='rTableHead'><strong>Produk</strong></div>
									 <div class='rTableHead'><span style='font-weight: bold;'>Qty</span></div>
									
								</div>";
							
						#$id = $_GET['idacc'];
						#$tgl = $_GET['tgl'];
						$id = isset($_POST['idacc']) ? $_POST['idacc'] : '';
						$tgl = isset($_POST['tgl']) ? $_POST['tgl'] : '';
						/*$sql_total_produk = " 					
				select GG.account_id, GG.NAMA_PRODUK,GG.qty as hasil, GG.KATEGORI, GG.TARGET from
(select * from
 (select KK.ACCOUNT_ID as account_id, KK.ITEM_CODE as item_code , KK.JML_ORDER as qty, DATE(KK.TGL_CONFIRM) as periode2,
 LL.REGIONAL from order_confirm KK, user LL
 where KK.ACCOUNT_ID = LL.ACCOUNT_ID ) as CC 
left join (select MP.ITEM_CODE as ii, MP.NAMA_PRODUK, MP.KATEGORI, MP.GRAMATUR, KPF.KATEGORI as MN, KPF.TARGET
 from m_produk MP, kategori_produk_fix KPF
where MP.KATEGORI = KPF.KATEGORI) as XX
 on XX.ii = CC.item_code) as GG where GG.account_id = '$idacc'  and GG.periode2 LIKE '$tgljadi%'";*/
 
 					$sql_total_produk = "SELECT 
									GG.account_id, 
									GG.NAMA_PRODUK,GG.qty AS hasil, 
									GG.KATEGORI
									FROM
									(
									SELECT * FROM
										(SELECT 
											KK.ACCOUNT_ID AS account_id, 
											KK.ITEM_CODE AS item_code , 
											KK.JML_ORDER AS qty, DATE(KK.TGL_CONFIRM) AS periode2,
											LL.REGIONAL 
										FROM 
											order_confirm KK, user LL
										WHERE 
											KK.ACCOUNT_ID = LL.ACCOUNT_ID 
										) AS CC 
										LEFT JOIN 
										(
											SELECT 
												pt.item_code AS ii, 
												pt.item_name AS NAMA_PRODUK, 
												MP.KATEGORI
											
											FROM 
											push_item pt 
											LEFT JOIN m_produk MP ON pt.item_code = MP.ITEM_CODE
										) AS XX
									ON XX.ii = CC.item_code
									) AS GG 
									WHERE GG.account_id = '$idacc'  AND GG.periode2 LIKE '$tgljadi%';";
					
							#echo $sql_total_produk;
							
							$hasil_total_produk = mysqli_query($mysqli, $sql_total_produk);
							$nx = 1;
							while ($data_total_produk = mysqli_fetch_array($hasil_total_produk))  {
							$produk = $data_total_produk['NAMA_PRODUK'];
							$qty = $data_total_produk['hasil'];
							$kategori = $data_total_produk['KATEGORI'];
							//$target = $data_total_produk['TARGET'];
					       // $sisa_target = $data_total_produk['SH'];
							echo "	
							 <div class='rTableRow'>
								 <div class='rTableCell'>$produk</div>
								 <div class='rTableCell' align='right'>$qty</div>
								 
							</div>";
							
							
						}
						$sql_kj21 =" SELECT 
										a.ACCOUNT_ID, 
										SUM(a.JML_ORDER) AS TOTAL_ORDER,
										c.NAMA, c.KOTA
										
										FROM
										order_confirm a,
										user c
										
										WHERE
										a.TGL_CONFIRM LIKE '$tgljadi%' AND
										
										a.ACCOUNT_ID = c.ACCOUNT_ID 
										and  a.ACCOUNT_ID = '$idacc'
								
										GROUP BY  a.ACCOUNT_ID ";
					$hasil_kj21 = mysqli_query($mysqli, $sql_kj21);
                $data_kj21 = mysqli_fetch_array($hasil_kj21);
					$totalku = $data_kj21['TOTAL_ORDER'];
					$toool =  number_format($totalku);
						
						echo"<div class='rTableRow'>
				 <div class='rTableCell' align='right'><strong>Total</strong></div>
				 <div class='rTableCell' align='right'><strong>$toool</strong></div>				 
				 
				 </div>";				
						echo "</td>";	
					}							
				}							
			echo"</tr>";
							
		$no++;
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
		</tfoot>";		
	echo "</table>";
	}

?>                
               

			

              <!--  <table id="example" class="stripe row-border order-column" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                    	<th align="center">Account Id</th>
                        <th align="center">Distributor</th>
                        <th align="center">Kota</th>
                        <th align="center">Total Kirim</th>
                        <th align="center">ACTION</th>
                    </tr>
                    </thead>
                    <tbody>-->
                         <?php
								
                            /* $sql = "SELECT
										b.NAMA,
										b.KOTA, 
										a.account_id, 
										SUM(a.qty)AS total

									FROM
										order_kirim_wd a,
										USER b

									WHERE
										a.flag= 1 AND
										a.periode2 = '$today' AND
										a.ACCOUNT_ID = b.ACCOUNT_ID

									GROUP BY account_id
									ORDER BY account_id;";


                         $hasil = mysqli_query($mysqli, $sql);

                         while($data = mysqli_fetch_assoc($hasil)){

                             echo "<tr>";
								echo "<td align='center'>$data[account_id]</td>";
                                echo "<td align='center'>$data[NAMA]</td>";
                                echo "<td align='center'>$data[KOTA]</td>";
                                echo "<td align='center'>$data[total]</td>";
                                echo "<td align='right'><!--a href='detail_recordkirim.php?ID=$data[account_id]&NAMA=$data[NAMA]&KOTA=$data[KOTA]' data-role='button' data-ajax='false' target='_parent'>DETAIL</a--> 
											 <form action='detail_recordkirim.php?account=<?php echo $account_id; ?>' method='post'>
                                               <table>
											   <tr>
											   <td> 
												<!--input type='hidden' name='ACCOUNTID' value='$data[account_id]'> 
                                                 <input type='text' id='datepicker' class='ui-datepicker-trigger' name='frmDateFilter' placeholder='Pilih Tgl Bln Thn' value=''/>
												</td>
												<td>
                                                <input type='submit' value='submit' name='SUBMIT'-->
												<a href='detail_recordkirim.php?ACCOUNTID=$data[account_id]&NAMA=$data[NAMA]&KOTA=$data[KOTA]' data-role='button' data-ajax='false' target='_parent'>DETAIL</a>
                                             	</td>
												</tr>
												</table>
											 </form>
										</td>";
                             echo "</tr>";

                         }*/


                         ?>

                  <!--  </tbody>
                    <tfoot>
                    <tr>
                    	<th align="center">Account Id</th>
                        <th align="center">Distributor</th>
                        <th align="center">Kota</th>
                        <th align="center">Jumlah Kirim Hari Ini</th>
                        <th align="center">ACTION</th>
                        
                        
                    </tr>
                    </tfoot>

                </table>-->


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