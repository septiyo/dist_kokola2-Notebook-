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
                    $('#gozaimas').DataTable({
                        "scrollY": 450,
                        "scrollX": false,

                         "scrollCollapse": true,
                        "ordering": false,
                        "paging": false,
						"bFilter": false
                    });
					
					
					
					$("#SUBMIT").on("click", function(e){
						
						e.preventDefault();
						
						var bulan = $( "#BULAN option:selected" ).val();
						
						localStorage.setItem("bulanx", bulan);
						
						//alert(bulan);
						
						
						//alert('x');
						
	$.getJSON("action_list_kj.php", {DATA: bulan}, function(res){
		
		/*  alert(res);*/
		 //alert(JSON.stringify(res));  
		     var no = 1;
			 var trHTML = '';
			   $.each(res, function (i, item) {
				trHTML += '<tr><td align=center><a href="list_kj_detail.php?ACC='+item.ACCOUNT_ID+'&BULAN='+bulan+'" data-ajax="false">' + item.ACCOUNT_ID + '</a></td><td align=center>' + item.ACCOUNT_NAME + '</td><td align=center>' + item.BULAN1 + '</td><td align=center>' + item.BULAN2 + '</td><td align=center>' + item.BULAN3 + '</td></tr>';
				
				no=no + 1;
			 });
			
			$('#gozaimas tbody').append(trHTML);
		 
		
		
		
		
	});//end ajax
	
						
					});//end onclick
					
					
					
					
					
					
					
					
					
					
					
                });

			/* 	 $(function() {
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
				}); */

		
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

                <h2 align="center">Total KJ Bulanan<br></h2>
				
			<form id='GENJOT'>	
				<fieldset data-role="controlgroup" data-type="horizontal">

				<select name='BULAN' id='BULAN'>
				  <option value=''>Pilih Bulan</option>
				  <option value='1'>Januari</option>
				  <option value='2'>Februari</option>
				  <option value='3'>Maret</option>
				  <option value='4'>April</option>
				  <option value='5'>Mei</option>
				  <option value='6'>Juni</option>
				  <option value='7'>Juli</option>
				  <option value='8'>Agustus</option>
				  <option value='9'>September</option>
				  <option value='10'>Oktober</option>
				  <option value='11'>November</option>
				  <option value='12'>Desember</option>
				</select>
				
				</fieldset>
				
				<input type='submit' value='SUBMIT' name='SUBMIT' id='SUBMIT'>
				
			</form>		
			
			
			<table id='gozaimas'>
			   <thead>
			      <th>Account ID</th>
			      <th>Nama Distributor</th>
			      <th>Bulan 1</th>
			      <th>Bulan 2</th>
			      <th>Bulan 3</th>
			     
			   </thead>
			   
			   <tbody>
			   
			   
			   </tbody>
			
			</table>
			
			
			
			
			
				
			
			
               
				
               
            </div><!--end of data role page content-->

            <a href="home_admin.php" data-role="button" data-ajax="false" target="_parent">Back</a>
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