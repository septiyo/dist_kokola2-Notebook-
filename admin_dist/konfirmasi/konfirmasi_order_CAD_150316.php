    <?php
    session_start();
    ini_set('display_errors', 0);


    if($_SESSION['HAK'] == "ADMIN") {

        ?>
        <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
            <script src="../../jqm2/jquery-2.1.4.min.js"></script>
            <script src="../../jqm2/jquery.mobile-1.4.5.min.js"></script>
            <script src="../../jqtable/jquery.dataTables.min.js"></script>
            <script src="../../jqtable/dataTables.fixedColumns.min.js"></script>
            <script src="../../jqtable/dataTables.jqueryui.min.js"></script>


            <script src="../validation/jquery.validate.js"></script>
            <link rel="stylesheet" href="../../themes/9septi_season.min.css" />
            <link rel="stylesheet" href="../../themes/jquery.mobile.icons.min.css" />
            <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
            <link rel="stylesheet" href="../../jqm2/jqmobile.structure-1.4.5.min.css"/>
            <link rel="stylesheet" href="../../jqtable/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../jqtable/fixedColumns.dataTables.min.css">
            <link rel="stylesheet" href="../../jqtable/themes/smoothness/jquery-ui.css">

            <script>
                $(document).ready(function () {

                    /*utnuk block enter*/
                    $(window).keydown(function(event){
                        if(event.keyCode == 13) {
                            event.preventDefault();
                            return false;
                        }
                    });
					
					/*untuk auto refresh*/
					
			       setInterval(function() {
                       $.ajax({
                           url: 'konfirmasi_order.php',
                           success: function(res) {
                           $('#PAGENYA').html(res.data);   
                           }
						    
                      });
							  
					  
                    }, 5000); 

				

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
					
					$('#example2').DataTable({
                        "scrollY": 450,
                        "scrollX": true,
                        /*fixedColumns:   {
                            leftColumns: 1
                        },*/

                         "scrollCollapse": true,
                        "ordering": false,
                        "paging": false
                    });
					
					
				   $('#example3').DataTable({
                        "scrollY": 350,
                        "scrollX": true,
                        /*fixedColumns:   {
                            leftColumns: 1
                        },*/

                         "scrollCollapse": true,
                        "ordering": false,
                        "paging": false
                    });
					
					
                });

            </script>

            <!--style>
                /*th, td { white-space: nowrap; }
                div.dataTables_wrapper {
                    width: "80vh";
                    margin: 0 auto;
                }*/

            <!--/style-->

        </head>

        <body>

        <div data-role="page" class="type-interior" data-theme="f" id="PAGENYA">
            <div data-role="header">
                <h1>Forecast FORM </h1>

                <h2>Kokola Admin 2.5</h2>
				<div id="responsecontainer">
                </div>
            </div>

            <div data-role="content">

                <h2 align="center">BELUM KONFIRMASI</h2>

                <?php
               // error_reporting(0);
                include "../../koneksi.php";


                date_default_timezone_set("Asia/Jakarta");

                $today = date('d') . "-" . date('m') . "-" . date('Y');
                $today_database = date('Y') . "-" . date('m') . "-" . date('d');
                $time = date('H:i:s');


                $month = date('M');

                $_SESSION['BULAN_NOW'] = $month;

                if ($month == "Jan" || $month == "Feb" || $month == "Mar") {

                    $bulan_mini = "JFM";
                    $bulan_big = "Jan-Feb-Mar";

                }
                if ($month == "Apr" || $month == "May" || $month == "Jun") {

                    $bulan_mini = "AMJ";
                    $bulan_big = "Apr-May-Jun";
                }
                if ($month == "Jul" || $month == "Aug" || $month == "Sep") {

                    $bulan_mini = "JAS";
                    $bulan_big = "Jul-Aug-Sep";

                }
                if ($month == "Oct" || $month == "Nov" || $month == "Dec") {

                    $bulan_mini = "OND";
                    $bulan_big = "Oct-Nov-Dec";
                }

                /*
                 * PUENTTING OJO SAMPE LALI OPO KEHAPUS
                 * */

                $_SESSION['TRIWULAN'] = $bulan_big;

                /***************************************/

                // echo $_SESSION[TRIWULANX];


                ?>

                <table border="0" cellpadding="1" cellspacing="0" align="left" width="100%">
                    <!--tr>
                        <td><?php echo "<a href='dist_forcast.php?BULAN=$_SESSION[TRIWULAN]' data-role='button' data-ajax='false' target='_parent'>Add Forecast</a>"; ?></td>


                    </tr-->

                </table>
                <br><br>
                <table id="example" class="stripe row-border order-column" cellspacing="0" width="100%">
                    <thead>
                    <tr>
					    <th align="center">Tgl Order</th>
                        <th align="center">Distributor</th>
                        <th align="center">Kota</th>
						<th align="center">SBG</th>
						<th align="center">Catatan</th>
					    <th align="center">Jumlah Kirim Hari Ini</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    /*$sql = "SELECT user.NAMA, user.`KOTA`, user.USER, order_kirim_wd.ACCOUNT_ID, SUM(`order_kirim_wd`.`qty`)AS total,
					                order_distributor.TGL
                                       FROM USER,`order_kirim_wd`WHERE `order_kirim_wd`.`periode2` = '$today_database' AND `order_kirim_wd`.`ACCOUNT_ID` = user.`ACCOUNT_ID`
                                       GROUP BY `order_kirim_wd`.`ACCOUNT_ID` ORDER BY `user`.NAMA ASC";*/
									   



                   /* $sql = "SELECT order_distributor.TGL,
					order_distributor.FLAG,
					order_distributor.USERID,
                    order_distributor.ID_ORDER,
					user.KOTA,
					user.NAMA,

					order_distributor.ACCOUNT_ID,
					SUM(order_detail.JML_ORDER) AS total
					FROM user,order_distributor,order_detail
					WHERE order_distributor.ACCOUNT_ID = user.ACCOUNT_ID
			        AND DATE(order_distributor.TGL) <= '$today_database'
					AND order_distributor.ID_ORDER = order_detail.ID_ORDER
					AND order_detail.FLAG <> 5

					GROUP BY order_distributor.ACCOUNT_ID,order_distributor.FLAG,order_distributor.ID_ORDER
					ORDER BY order_distributor.ID_ORDER ASC";*/
					
					
					$sql = "SELECT order_distributor.TGL,
					order_distributor.FLAG,
					order_distributor.USERID,
                    order_distributor.ID_ORDER,
					user.KOTA,
					user.NAMA,
					order_distributor.CATATAN2,
                    order_distributor.SBG,

					order_distributor.ACCOUNT_ID,
					SUM(order_detail.JML_ORDER) AS total
					FROM user,order_distributor,order_detail
					WHERE order_distributor.ACCOUNT_ID = user.ACCOUNT_ID
			        AND DATE(order_distributor.TGL) <= '$today_database'
					AND order_distributor.ID_ORDER = order_detail.ID_ORDER
					AND order_detail.FLAG = 1
					AND order_distributor.FLAG = 1

					GROUP BY order_distributor.ACCOUNT_ID,order_distributor.FLAG,order_distributor.ID_ORDER
					ORDER BY order_distributor.TGL DESC";



                    $hasil = mysqli_query($mysqli, $sql);
					$jumlah_total = 0;
					$jumlah_total2 = 0;
                    while($data = mysqli_fetch_assoc($hasil)){						
						$total2 = number_format($data['total']);
                        echo "<tr>";
						echo "<td align='center'>$data[TGL]</td>";
                        echo "<td align='center'>$data[NAMA]</td>";
                        echo "<td align='center'>$data[KOTA]</td>";
						echo "<td align='center'>$data[SBG]</td>";
						echo "<td align='center'>$data[CATATAN2]</td>";
                        if($data['FLAG'] == '3'){
                            echo "<td align='right'>$total2</td>";
                        }
                        else{
                            echo "<td align='right'>
								<a href='detail_konfirmasi.php?IDORDER=$data[ID_ORDER]&ID=$data[ACCOUNT_ID]&NAMA=$data[NAMA]&KOTA=$data[KOTA]&USERID=$data[USERID]&JOS=1' style='text-decoration:none;' data-ajax='false' target='_parent'>$total2</a></td>";
						}
                        echo "</tr>";						
						$jumlah_total = $jumlah_total + $data['total'];
						$jumlah_total2 = number_format($jumlah_total);
                    }


                    ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <!--th colspan="3">Total</th>
                        <th><?php echo $jumlah_total2;?></th>
                        <th></th-->
                        <th align="center" colspan="5">Total</th>
                        <th align="RIGHT"><?php echo $jumlah_total2;?></th>
                        
                    </tr>
                    </tfoot>

                </table>
					
				
				
				</table>

				
				
			<br><br>              
<div style="text-align:center"><h2>SUDAH TERKONFIRMASI</h2></div>
 <table id="example2" class="stripe row-border order-column" cellspacing="0" width="100%">
                    <thead>
                    <tr>
					    <th align="center">Tgl Konfirmasi</th>
                        <th align="center">Distributor</th>
                        <th align="center">Kota</th>
						<th align="center">SBG</th>
						<th align="center">Catatan</th>
                        <th align="center">Jumlah TERKONFIRMASI </th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php

									   
					/*$sql3 = "SELECT order_confirm.TGL_CONFIRM,
                             user.NAMA,
                             user.KOTA,
		                     order_confirm.ACCOUNT_ID,
							 order_confirm.CATATAN2,
                             order_confirm.SBG,
                             SUM(order_confirm.JML_ORDER) as jml_confirm
                             FROM order_confirm,user 
                             WHERE DATE(order_confirm.TGL_CONFIRM) <= '$today_database'
                             AND order_confirm.ACCOUNT_ID = user.ACCOUNT_ID
							 GROUP BY order_confirm.ACCOUNT_ID
							 ORDER BY order_confirm.id DESC";*/
							 
							 
							 $sql3 = "SELECT order_confirm.TGL_CONFIRM,
                             user.NAMA,
                             user.KOTA,
		                     order_confirm.ACCOUNT_ID,
							 order_confirm.CATATAN2,
                             order_confirm.SBG,
                             SUM(order_confirm.JML_ORDER) AS jml_confirm
                             FROM order_confirm,`user` 
                             WHERE DATE(order_confirm.TGL_CONFIRM) <= '$today_database'
                             AND order_confirm.ACCOUNT_ID = user.ACCOUNT_ID
							 GROUP BY order_confirm.ACCOUNT_ID,order_confirm.CATATAN2
							 ORDER BY order_confirm.TGL_CONFIRM DESC";
							 

                    $hasil3 = mysqli_query($mysqli, $sql3);
					$jumlah_total2 = 0;
					$kunam = 0;
					$kunam2 = 0;
                    while($data3 = mysqli_fetch_assoc($hasil3)){
						
						$total_groping = number_format($data3['jml_confirm']);
											
						

                        echo "<tr>";
						echo "<td align='center'>$data3[TGL_CONFIRM]</td>";
						echo "<td align='center'>$data3[NAMA]</td>";
                        echo "<td align='center'>$data3[KOTA]</td>";
						echo "<td align='center'>$data3[SBG]</td>";
						echo "<td align='center'>$data3[CATATAN2]</td>";
                                      
					
					    
                            echo "<td align='right'><a 
					href='detail_konfirmasi.php?ID=$data3[ACCOUNT_ID]&NAMA=$data3[NAMA]&KOTA=$data3[KOTA]&USERID=$data3[ID]&JOS=4'
							style='text-decoration:none;' data-ajax='false' target='_parent'>$total_groping</a></td>";
                        
                        echo "</tr>";						
						$kunam = $kunam + $data3['jml_confirm'];
						$kunam2 = number_format($kunam);
					}
                        
                    ?>

                    </tbody>
                    <tfoot>
                    <tr>                        
                        <th align="center" colspan="5">Total</th>
                        <th align="RIGHT"><?php echo $kunam2;?></th>
                        
                    </tr>
                    </tfoot>
                </table>
				
		
				
				
				

 <br><br>              
<div style="text-align:center"><h2>SISA ORDER</h2></div>
 <table id="example3" class="stripe row-border order-column" cellspacing="0" width="100%">
                    <thead>
                    <tr>
					    <!--th align="center">Date Time</th-->
                        <th align="center">Distributor</th>
                        <th align="center">Kota</th>
                        <th align="center">Jumlah Kirim Hari Ini</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    /*$sql = "SELECT user.NAMA, user.`KOTA`, user.USER, order_kirim_wd.ACCOUNT_ID, SUM(`order_kirim_wd`.`qty`)AS total,
					                order_distributor.TGL
                                       FROM USER,`order_kirim_wd`WHERE `order_kirim_wd`.`periode2` = '$today_database' AND `order_kirim_wd`.`ACCOUNT_ID` = user.`ACCOUNT_ID`
                                       GROUP BY `order_kirim_wd`.`ACCOUNT_ID` ORDER BY `user`.NAMA ASC";*/
									   
					$sql2 = "SELECT user.NAMA,
        user.KOTA,
        user.ACCOUNT_ID,
		user.ID,
        order_kirim_wd.ACCOUNT_ID,
        order_kirim_wd.periode2,
        SUM(qty) AS total_order,
		order_kirim_wd.flag
        
        FROM user,order_kirim_wd
        WHERE user.ACCOUNT_ID = order_kirim_wd.ACCOUNT_ID
        AND order_kirim_wd.periode2 <= '$today_database'
        AND order_kirim_wd.flag IN ('1','3','4','5','6')
        GROUP BY order_kirim_wd.ACCOUNT_ID,order_kirim_wd.flag";
//AND order_kirim_wd.flag = '1'

//keterangan 1 jadwal baru dan 7 adalah sisa

                    $hasil2 = mysqli_query($mysqli, $sql2);
					$jumlah_total2 = 0;
					$kunam = 0;
					$kunam2 = 0;
                    while($data2 = mysqli_fetch_assoc($hasil2)){
						
						$total_groping = number_format($data2['total_order']);
											
						

                        echo "<tr>";
						echo "<td align='center'>$data2[NAMA]</td>";
                        echo "<td align='center'>$data2[KOTA]</td>";
                        //echo "<td align='right'>$total_groping</td>";
                        if($data2['flag'] == '3'){

                            echo "<td align='right'>(Konfirm Order) $total_groping</td>";

                        }
                        if($data2['flag'] == '4'){

                            //echo "<td align='right'>(Konfirm Order Tanpa PO) $total_groping</td>";
							echo "<td align='right'>(Konfirm Order) $total_groping</td>";

                        }
						if($data2['flag'] == '5'){
                            //echo "<td align='right'>(Konfirm Order Sisa PO) $total_groping</td>";
							echo "<td align='right'>(Konfirm Order) $total_groping</td>";
                        }
                        if($data2['flag'] == '1'){
                            echo "<td align='right'><a 
					href='detail_konfirmasi.php?ID=$data2[ACCOUNT_ID]&NAMA=$data2[NAMA]&KOTA=$data2[KOTA]&USERID=$data2[ID]&JOS=2'
							style='text-decoration:none;' data-ajax='false' target='_parent'>(Sesuai Jadwal) $total_groping</a></td>";
                        }
					
					    if($data2['flag'] == '6'){
                          /*  echo "<td align='right'><a 
					href='detail_konfirmasi.php?ID=$data2[ACCOUNT_ID]&NAMA=$data2[NAMA]&KOTA=$data2[KOTA]&USERID=$data2[ID]&JOS=3'
							style='text-decoration:none;' data-ajax='false' target='_parent'>(Sisa PO) $total_groping</a></td>";*/
							
							
							echo "<td align='right'><a 
					href='detail_konfirmasi.php?ID=$data2[ACCOUNT_ID]&NAMA=$data2[NAMA]&KOTA=$data2[KOTA]&USERID=$data2[ID]&JOS=3'
							style='text-decoration:none;' data-ajax='false' target='_parent'>(Sisa PO) $total_groping</a></td>";
                        }
                        echo "</tr>";						
						$kunam = $kunam + $data2['total_order'];
						$kunam2 = number_format($kunam);
					}
                        
                    ?>

                    </tbody>
                    <tfoot>
                    <tr>                        
                        <th align="center" colspan="2">Total</th>
                        <th align="RIGHT"><?php echo $kunam2;?></th>
                        
                    </tr>
                    </tfoot>
                </table>
				
			
			
			
			
			
				
				
				
				
            </div><!--end of data role page-->

            <a href="../home_admin.php" data-role="button" data-ajax="false" target="_parent">Back</a>

            <!--emnd role-content-->

            <div data-role="footer">
                <table align="center">
                    <tr>
                        <td align="center">
                            <a href="../../logout.php" style="text-align: center" data-role="button" data-icon="power"
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
