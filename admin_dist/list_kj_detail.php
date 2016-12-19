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
                $(document).ready(function (){
					
					  //location.reload();
                 
					
					//alert('jos');
						var bulan = $('#BULAN').val();
						var acc   = $('#ACC').val();
						
						//alert(bulan);
						
						if(bulan){
							
							load_data(bulan,acc);
												
						}
											

					$('#gozaimas').DataTable({
                        "scrollY": 450,
                        "scrollX": false,

                         "scrollCollapse": true,
                        "ordering": false,
                        "paging": false,
						"bFilter": false
                    });	
	
					
                });//end ready


				function load_data(a,b){
					
		$.getJSON("action_list_kj_detail.php", {bulan: a, acc: b}, function(res){
								
								  /*  alert(res);*/
								 //alert(JSON.stringify(res));  
								
			 var trHTML = '';
			   $.each(res, function (i, item) {
				trHTML += '<tr><td align=center>' + item.KATEGORI + '</td><td align=center>' + item.BULAN1 + '</td><td align=center>' + item.BULAN2 + '</td><td align=center>' + item.BULAN3 + '</td></tr>';
				
				
				});//end each
			
			$('#gozaimas tbody').append(trHTML);
	
		
		
		});//end ajax
				
				};
				
				
		
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

                <h2 align="center">KJ Detail / KATEGORI<br></h2>
		
	<?php
	include "../koneksi.php";
	
	   $sql_sum = "SELECT m_produk.NAMA_PRODUK,
       m_produk.ITEM_CODE,
       m_produk.KATEGORI,
       SUM(kj.BULAN1)AS BULAN1,
       SUM(kj.BULAN2)AS BULAN2,
       SUM(kj.BULAN3)AS BULAN3
       
       FROM kj
       INNER JOIN m_produk
       ON m_produk.ITEM_CODE=kj.ITEM_CODE
       
       WHERE MONTH(kj.TGL) = '".$_GET['BULAN']."' 
       AND kj.ACCOUNT_ID = '".$_GET['ACC']."';";
	   
	   $hasil_sum = mysqli_query($mysqli, $sql_sum);
	   
	   $datax=mysqli_fetch_assoc($hasil_sum);
	   
	   $bulanx1 = $datax['BULAN1'];
	   $bulanx2 = $datax['BULAN2'];
	   $bulanx3 = $datax['BULAN3'];
	
	
	
	
	
	?>
	
			<input type='hidden' value="<?php echo $_GET['BULAN'];?>" id="BULAN">
			<input type='hidden' value="<?php echo $_GET['ACC'];?>" id="ACC">
			
			<table id='gozaimas'>
			   <thead>
			     
			      <th>KATEGORI</th>
			      <th>Total Bulan 1</th>
			      <th>Total Bulan 2</th>
			      <th>Total Bulan 3</th>
			     
			   </thead>
			   
			   <tbody>
			   
			   
			   </tbody>
			   
			   <tfoot>
			       <th>&nbsp;</th>
			      <th><?php echo $bulanx1;?></th>
			      <th><?php echo $bulanx2;?></th>
			      <th><?php echo $bulanx3;?></th>
			   
			   </tfoot>
			
			</table>
			
			
			
			
			
				
			
			
               
				
               
            </div><!--end of data role page content-->

            <a href="list_total_kj.php" data-role="button" data-ajax="false" target="_parent">Back</a>
            <!--emnd role-content-->
            <!-- div footer -->
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