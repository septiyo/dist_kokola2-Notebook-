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


                    $('#tabel1').DataTable({
                        "dom": '<"toolbar">frtip',
                        "scrollY": 450,
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



                    $('#tabel2').DataTable({
                        "dom": '<"toolbar2">frtip',
                        "scrollY": 450,
                        "scrollX": true,
                        /*fixedColumns:   {
                         leftColumns: 1
                         },*/

                        "scrollCollapse": true,
                        "ordering": false,
                        "paging": false,
                        "filter":false,
                    });

                    $("div.toolbar2").html('<b><input type="text" id="cari2" placeholder="Cari"></b>');
                    $("#cari2").keyup(function(e) {
                        cari_table2();
                    });


                    /*load ajax jquery json*/
                    $.post("get_konfirmasi_order.php",function(response){

                        //alert(JSON.stringify(response));

                        var arr = $.parseJSON(response);
                        var trHTML = '';

                        $.each(arr, function (i, item) {

                            trHTML += '<tr>' +
                                         '<td align="center"><b>' + item.ID_ORDER +  '</b></td>' +
                                         '<td align="center">' + item.TGL +  '</td>' +
                                         '<td align="center">' + item.NAMA + '</td>' +
                                         '<td align="center">' + item.KOTA + '</td>' +
                                         '<td align="center">' + item.SBG +  '</td>' +
                                         '<td align="center">' + item.CATATAN2 + '</td>' +
                                         '<td align=center><a href="detail_konfirmasi.php?IDORDER='+ item.ID_ORDER +'&ID='+ item.ACC_ID +'&NAMA='+item.NAMA+'&KOTA='+item.KOTA+'&USERID='+item.USERID+'&TGL_D='+item.TGL_D+'&JOS=1" data-ajax="false" target="_parent" style="text-decoration:none" class="JML_1">' + item.total + '</a></td></tr>';
                        });
                        $('#tabel1 tbody').append(trHTML);



                        var jml_1 = 0;
                        $(".JML_1").each(function(index){
                           // alert($(this).text());
                           jml_1 = jml_1 + Number($(this).text());


                        });

                        $("#tabel1 tbody tr:eq(0)").remove();

                        $(".JUMLAH_1").html(format_digit(jml_1));
                    });



//?IDORDER=$data[ID_ORDER]&ID=$data[ACCOUNT_ID]&NAMA=$data[NAMA]&KOTA=$data[KOTA]&USERID=$data[USERID]&JOS=1&TGL_D=$data[TGL_D]


                    /*load ajax jquery json*/
                    $.post("get_sudah_konfirm.php",function(response){

                       // alert(JSON.stringify(response));

                        var arr = $.parseJSON(response);
                        var trHTML = '';

                        $.each(arr, function (i, item) {

                            trHTML += '<tr>' +
                            '<td align="center"><b>' + item.ID_ORDER +  '</b></td>' +
                            '<td align="center">' + item.TGL_CONFIRM +  '</td>' +
                            '<td align="center">' + item.NAMA + '</td>' +
                            '<td align="center">' + item.KOTA + '</td>' +
                            '<td align="center">' + item.SBG +  '</td>' +
                            '<td align="center">' + item.CATATAN2 + '</td>' +
                            '<td align=center><a href="detail_konfirmasi.php?IDORDER='+ item.ID_ORDER +'&ID='+ item.ACC_ID +'&NAMA='+item.NAMA+'&KOTA='+item.KOTA+'&USERID='+item.USERID+'&TGL_D='+item.TGL_D+'&JOS=4" data-ajax="false" target="_parent" style="text-decoration:none" class="JML_2">' + item.jml_confirm + '</a></td></tr>';
                        });
                        $('#tabel2').append(trHTML);

                        var jml_2 = 0;
                        $(".JML_2").each(function(index){
                             //alert($(this).text());
                            jml_2 = jml_2 + Number($(this).text());


                        });

						$("#tabel2 tbody tr:eq(0)").remove();
                        $(".JUMLAH_2").html(format_digit(jml_2));



//detail_konfirmasi.php?ID=$data3[ACCOUNT_ID]&NAMA=$data3[NAMA]&KOTA=$data3[KOTA]&USERID=$data3[ID]&JOS=4&TGL_D=$data3[TGL_D]'

                    });


					
				setInterval(function() {
                  window.location.reload();
                }, 300000);

                    /*utnuk block enter*/
                    $(window).keydown(function(event){
                        if(event.keyCode == 13) {
                            event.preventDefault();
                            return false;
                        }
                    });
					
					/*untuk auto refresh*/
					
			       /*setInterval(function() {
                       $.ajax({
                           url: 'konfirmasi_order.php',
                           success: function(res) {
                           $('#PAGENYA').html(res.data);   
                           }
						    
                      });
							  
					  
                    }, 5000); */


					
				   /*$('#example3').DataTable({
                        "scrollY": 350,
                        "scrollX": true,


                         "scrollCollapse": true,
                        "ordering": false,
                        "paging": false
                    });*/
					
					
                });//end ready function

                function format_digit( toFormat ) {
                    return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                };

                function cari_table() {
                    var value = $("#cari").val();
                    $("#tabel1 tbody tr").each(function(index, element) {
                        //var $row = '';

                        //alert($(this).text());
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


                function cari_table2() {
                    var value = $("#cari2").val();
                    $("#tabel2 tbody tr").each(function(index, element) {
                        //var $row = '';

                        //alert($(this).text());
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
                <table id="tabel1" class="stripe row-border order-column" cellspacing="0" width="100%">
                    <thead>
                    <tr>
					    <th align="center">ID Order</th>
					    <th align="center">Tgl Order</th>
                        <th align="center">Distributor</th>
                        <th align="center">Kota</th>
						<th align="center">SBG</th>
						<th align="center">Catatan</th>
					    <th align="center">Jumlah Kirim Hari Ini</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>

                        <th align="center" colspan="6">Total</th>
                        <th align="RIGHT"><div class="JUMLAH_1"></div> </th>
                        
                    </tr>
                    </tfoot>

                </table>
					
				
				
				</table>

				
				
			<br><br>              
<div style="text-align:center"><h2>SUDAH TERKONFIRMASI</h2></div>
 <table id="tabel2" class="stripe row-border order-column" cellspacing="0" width="100%">
                    <thead>
                    <tr>
					    <th align="center">ID Order</th>
						<th align="center">Tgl Konfirmasi</th>
                        <th align="center">Distributor</th>
                        <th align="center">Kota</th>
						<th align="center">SBG</th>
						<th align="center">Catatan</th>
                        <th align="center">Jumlah TERKONFIRMASI </th>
                        
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                    <tr>                        
                        <th align="center" colspan="6">Total</th>
                        <th align="RIGHT" class="JUMLAH_2"></th>
                        
                    </tr>
                    </tfoot>
                </table>
				
		
				
				
				

 <br><br>              
<!--div style="text-align:center"><h2>SISA ORDER</h2></div-->
 <!--table id="example3" class="stripe row-border order-column" cellspacing="0" width="100%">
                    <thead>
                    <tr>
				
                        <th align="center">Distributor</th>
                        <th align="center">Kota</th>
                        <th align="center">Jumlah Kirim Hari Ini</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                  
									   
					/*$sql2 = "SELECT user.NAMA,
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
        GROUP BY order_kirim_wd.ACCOUNT_ID,order_kirim_wd.flag";*/
//AND order_kirim_wd.flag = '1'

//keterangan 1 jadwal baru dan 7 adalah sisa

                   /* $hasil2 = mysqli_query($mysqli, $sql2);
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
           
							
							
							echo "<td align='right'><a 
					href='detail_konfirmasi.php?ID=$data2[ACCOUNT_ID]&NAMA=$data2[NAMA]&KOTA=$data2[KOTA]&USERID=$data2[ID]&JOS=3'
							style='text-decoration:none;' data-ajax='false' target='_parent'>(Sisa PO) $total_groping</a></td>";
                        }
                        echo "</tr>";						
						$kunam = $kunam + $data2['total_order'];
						$kunam2 = number_format($kunam);
					}*/
                        
                    ?>

                    </tbody>
                    <tfoot>
                    <tr>                        
                        <th align="center" colspan="2">Total</th>
                        <th align="RIGHT"><?php echo $kunam2;?></th>
                        
                    </tr>
                    </tfoot>
                </table-->
				
			
			
			
			
			
				
				
				
				
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
