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

                     
            
			<script>

              var NILAI="";

                $(document).ready(function () {
                    $('#gozaimas').DataTable({
                        "scrollY": 450,
                        "scrollX": false,

                         "scrollCollapse": true,
                        "ordering": true,
                        "paging": false,
						"bFilter": false,
						"oLanguage": {
                        "sEmptyTable": '',
                        "sInfoEmpty": ''
                       },
                    });
					
					
					
					//$("#SUBMIT").on("click", function(e){

					 $("#BULAN").on("change", function(e){



						e.preventDefault();
						
						var bulan = $( "#BULAN option:selected" ).val();
						
						localStorage.setItem("bulanx", bulan);
						
						//alert(bulan);

						$('#oke').val(bulan);

						NILAI = bulan;



						
						//alert('x');
						
	$.getJSON("action_list_kj2.php", {DATA: bulan}, function(res){
		
		  /*alert(res);
		  alert(JSON.stringify(res));*/


		     //var no = 1;
			 //alert(res[0].TRIWULAN);
			 
			 var tri = res[0].TRIWULAN;
			 var bulan_input = res[0].BULAN_INPUT;

			// alert(tri);

			 $(".tri").text(tri);
			 $(".buli").text(bulan_input);
			 
			 
			 
			 var trHTML = '';
			   $.each(res, function (i, item) {
				trHTML += '<tr><td align=center>' + item.NAMA + '</td><td align=center><!--a href="detail_barang.php?KATE='+ item.KATEGORI +'&TRI='+ bulan +'" target="_parent"-->' + item.KATEGORI + '<!--/a--></td><td align=center>' + item.NAMA_PRODUK + '</td><td align=center>' + item.BULAN1 + '</td><td align=center>' + item.BULAN2 + '</td><td align=center>' + item.BULAN3 + '</td></tr>';
				
				//no=no + 1;
			 });

			$('#gozaimas tbody').append(trHTML);
		 
		
		
		
		
	});//end ajax




	    
	    //cari total
		
					$.getJSON("cari_total.php", {DATA: bulan}, function(dor){
				
							   //alert(dor);
							 // alert(JSON.stringify(dor)); 
							  
							  //var oke = JSON.parse(dor);
							  
							/*   alert(dor[0].BULAN1);
							  alert(dor[0].BULAN2);
							  alert(dor[0].BULAN3); */
							  
							  var bulanx1 = dor[0].BULAN1;
							  var bulanx2 = dor[0].BULAN2;
							  var bulanx3 = dor[0].BULAN3;
							  
							  $('.bulan1').text(bulanx1);
							  $('.bulan2').text(bulanx2);
							  $('.bulan3').text(bulanx3);
							  
							 /*  alert(bulanx1);
							  alert(bulanx2);
							  alert(bulanx3); */
							  
				
				
				
					});//end ajax
						
			});//end onclick


			$('#REFRESH').click(function() {
                location.reload();
            });

            $('#JOS').click(function() {

              // alert(NILAI);

              if(NILAI == ""){

                alert('Anda belum pilih Bulan..!');

              }
              else{

                   window.location='print.php?DATANE=' + NILAI;

              }


            });

							
        });//ready function




		
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

                <h2>Kokola Admin 3.5</h2>
            </div>

            <div data-role="content">


<!--                <div id="detail" data-role="popup">-->
<!---->
<!--                </div>-->

       <h2 align="center">Total Forecast Bulanan ALL DISTRIBUTOR<br></h2>

			<button id="REFRESH" data-role="button">Refresh</button>
			<form id='GENJOT'>	
				<fieldset data-role="controlgroup" data-type="horizontal">

				<select name='BULAN' id='BULAN'>
				  <option value=''>Pilih Bulan</option>
				  <option value='Jan-Feb-Mar'>Jan-Feb-Mar</option>
				  <option value='Feb-Mar-Apr'>Feb-Mar-Apr</option>
				  <option value='Mar-Apr-May'>Mar-Apr-May</option>
				  <option value='Apr-May-Jun'>Apr-May-Jun</option>
				  <option value='May-Jun-Jul'>May-Jun-Jul</option>
				  <option value='Jun-Jul-Aug'>Jun-Jul-Aug</option>
				  <option value='Jul-Aug-Sep'>Jul-Aug-Sep</option>
				  <option value='Aug-Sep-Oct'>Aug-Sep-Oct</option>
				  <option value='Sep-Oct-Nov'>Sep-Oct-Nov</option>
				  <option value='Oct-Nov-Dec'>Oct-Nov-Dec</option>
				  <option value='Nov-Dec-Jan'>Nov-Dec-Jan</option>
				  <option value='Dec-Jan-Feb'>Dec-Jan-Feb</option>
				</select>
				
				</fieldset>

                <b>[Note: Jika ingin melihat Inputan Bulan yang lain tekan Refresh Agar data tidak Tercampu..!]</b>
				
                <!--<input type='submit' value='SUBMIT' name='SUBMIT' id='SUBMIT'>-->
				
			</form>		
			
	
			<!-- TRIWULAN :<b><div class='tri'></div></b><br>
			Bulan Input :<b><div class='buli'></div></b> -->
			
			<table id='gozaimas'>
			   <thead>
			      <th>Distributor</th>
         	      <th>KATEGORI</th>
         	      <th>Nama Item</th>
			      <th>Bulan 1<br>(KJ)</th>
			      <th>Bulan 2</th>
			      <th>Bulan 3</th>
			     
			   </thead>
			   
			   <tbody>
			   
			   
			   </tbody>
			   
			   <tfoot>
			      <th >&nbsp;</th>
                   <th >&nbsp;</th>
                   <th >&nbsp;</th>
     		      <th><div class='bulan1'></div></th>
			      <th><div class='bulan2'></div></th>
			      <th><div class='bulan3'></div></th>
			   
			   </tfoot>
			
			</table>
			
			 <tr><tr>


<!--                    <form action='print.php'>-->
<!--                        <input type='text' id='oke' name='DATANE'>-->
<!--                        <input type="submit" value="SEND" name="SEND" onclick="SEND()">-->
<!---->
<!--                    </form>-->

<!--                    <a href="print.php"  id="JOS" target="_parent" data-role="button">Print</a>-->
                    <button id="JOS">Print</button>

<!--<script>-->
<!--   function SEND(){-->
<!---->
<!--       location.reload(print.php);-->
<!---->
<!--   }-->
<!---->
<!---->
<!---->
<!---->
<!--</script>-->


<?php
//
//
//
//
//             echo "<a href='print.php?TRI=<div id-oke></div>' data-role='button' target='_parent'>Print</a>";
//
//
//?>

               
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