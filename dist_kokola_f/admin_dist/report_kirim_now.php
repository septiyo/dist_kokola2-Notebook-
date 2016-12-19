<?php
error_reporting(0);
session_start();

if($_SESSION['USER']) {
	include "../koneksi.php";
$accid = $_SESSION['ACCOUNT_ID'];	
//date_default_timezone_set("Asia/Jakarta");
	   		    $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				$bulanku = date('m');
				$wkt = date('H:i:s'); 
				$thn_dpn= date('Y', strtotime('+1 years', strtotime( $tgl ))); 
				
$jumHari = cal_days_in_month(CAL_GREGORIAN, $bulanku, 2016);
if ($bulanku == '01' or $bulanku == '02' or $bulanku == '03')
   {
	   $triwulan = 'Jan-Feb-Mar';
   }
   elseif  ($bulanku == '04' or $bulanku == '05' or $bulanku == '06')
   {
	   $triwulan = 'Apr-May-Jun';
	   }
	    elseif  ($bulanku == '07' or $bulanku == '08' or $bulanku == '09')
   {
	   $triwulan = 'Jul-Aug-Sep';
	   }
	    elseif  ($bulanku == '10' or $bulanku == '11' or $bulanku == '12')
   {
	   $triwulan = 'Oct-Nov-Dec';
	   }
    ?>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="themeku/themes/themeku.css" />
	<link rel="stylesheet" href="themeku/themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="themeku/jquery.mobile.structure-1.4.5.css" />
    <link rel="stylesheet" href="themeku/jquery.dataTables.css" />
     <link rel="stylesheet" href="themeku/fixedColumns.dataTables.min.css" />
  <link rel="stylesheet" href="jqtable/themes/smoothness/jquery-ui.css">
     <link rel="stylesheet" href="jqtable/dataTables.jqueryui.min.css">

       
	    <script src="themeku/jquery.js"></script>
	    <script src="themeku/jquery.mobile-1.4.5.js"></script>
        <script src="themeku/jquery.dataTables.js"></script>
        <script src="jqtable/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="themeku/jquery-ui.js"></script> 
     <script src="jqtable/dataTables.jqueryui.min.js"></script>
         <script type="text/javascript"  src="themeku/jquery-ui.multidatespicker.js"></script>
        
        
         <script src="themeku/dataTables.fixedColumns.min.js"></script>


        <script src="validation/jquery.validate.js"></script>
       <!-- <link rel="stylesheet" href="themes/9septi_season.min.css"/>
        <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css"/>-->
        <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
       <!-- <link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>-->
        <!--<link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">-->
       
        <style>
		
		.toolbar{
			margin:8;
		}
		div.toolbar {
   width: 50%;
   float: right;
   text-align: right;
}
u {
    text-decoration: underline;
} 
#merah {
     background-color: #72F0E2;
} 
kl {
     text-color:#ED0E11;
}
       
	  
		.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
	background: #A6A5F3 url('images/ui-bg_fine-grain_10_f8f7f6_60x60.png') 50% 50% repeat;
}

/* begin: jQuery UI Datepicker moving pixels fix */
table.ui-datepicker-calendar {border-collapse: separate;}
.ui-datepicker-calendar td {border: 1px solid transparent;}
/* end: jQuery UI Datepicker moving pixels fix */

/* begin: jQuery UI Datepicker emphasis on selected dates */
.ui-datepicker .ui-datepicker-calendar .ui-state-highlight a {
	background: #743620 none;
	color: white;
}


.ui-page .ui-content .ui-btn.my-btn .ui-btn-inner {
    color      : green;
    background : red;
}
        </style>
<script>

		
var totals=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
			  
$(document).ready(function () {
	
        $("td .std").click(function() {
	//alert ('dfdg');
	var PO_KU = $(this).attr('POKU')
	var DIST = $(this).attr('man')
            window.open ( "detail_cf.php?INK="+DIST+"&POKU="+PO_KU, "MyWindow", 'width=800, height=500, top=80, left=200')	
	
        });
	
	
	$("#TUJUAN").autocomplete({
				// source:  availableTags
		//minLength: 1,
		source:  "sourceket_s.php",
		select: function(event, ui){
           
			  $("#ID_TUJUAN").val(ui.item.ACCOUNT_ID);
    
            }
	});	 

	
	
	
			 ///total row
			 //alert('sum');
	 $("#example td.rowtot").each(function() {
 
	var sum = 0;
    var thisRow = $(this).closest('tr');

      thisRow.find('td .rowDataSd').each( function(){
             sum += parseFloat((this.value).toString().replace(",","").replace(",","")); // or parseInt(this.value,10) if appropriate
      });

    // alert(sum);
	var totkj = thisRow.find('td.totkj').text();
	if (sum < totkj){
     thisRow.find('td.rowtot').text(sum).css( "background", "pink" );
	}
	else
	{  thisRow.find('td.rowtot').text(sum); }
	 
    });////////end function total row
			 
			 
			 /////////////////////date
	
			$("#HG").hide();
	     	//$("#liop").hide();
			 $('#datepicker').multiDatesPicker({
			changeMonth: true,
		    stepMonths: 0,
			maxPicks: 1,
			/*dateFormat: "y-m-d", 
			defaultDate:"85-2-19"*/
			//defaultDate: "+1w",
			//firstDay: 1,
			dateFormat: "dd.mm.yy",
			//numberOfMonths: 1,
			//addDisabledDates: getSelectedExceptionDates(callback),
			onSelect: function () {
				var dates = $("#datepicker").multiDatesPicker('getDates');
				var html = '';
				$.each(dates, function (i, val)	{
			    var resi = val;
			    var arr = resi.split('.');
	      // var $kul = $("#mn");
	      //  $kul.val($kul.val()+arr[1]+',');
					html +=''+arr[0]+',';
					//$('#datepicker').val('');
				});
				//$("#SelectedDates").html(html);
				$("#mn").html(html);
			}
		}); 
			 
			 //////akhir date
	
		$('#tambah_data').hide();
		$('#tmb').click(function(e) {
          $("#tambah_data").toggle();
          $(this).toggleClass('class45')
		  $("#SVDM").hide();
		  $("#SVD").show();
		  $("#tampil_input").hide();
		  $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
        });
		
		$('#tmm').click(function(e) {
          $("#tambah_data").toggle();
          $(this).toggleClass('class45')
		  $("#SVD").hide();
		  $("#SVDM").show();
		  $("#tampil_input").hide();
		  $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
        });
		
		
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});
			
			
	
	
               ////////////////////////////batas total column
				

							
      $('#example').DataTable({
					// "dom": '<"toolbar">frtip',
					 fixedColumns:   {
            leftColumns: 2,
            //rightColumns: 1
        },
		
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: true,
	    ordering: false,
        filter: true,
        paging:  true,
            "footerCallback": function ( row, data, start, end, display ) {
			var api = this.api(), data;
			
			var obj = [];
			
			
				
		$('th').map(function(){
              obj.push($(this).attr('man'));
                   });
				//alert ();
            $.each( obj, function(key, value ) {
 //alert( value );
					//var x1 = 0;
					if (Number(value) == 1) {
						var totalHarga = api.column( 1, { page: 'current'} ).data().reduce( function (a, b) {
							//alert (a + " : " + b);
							//alert (x1 + Number($(b).text()));
							//return x1 = x1 + Number($(b).text());
							return Number(a) + Number(b);
						}, 0 );
						// Update footer
						//$("#ini").html(totalHarga);
						$(".kost:last").html(totalHarga);
						///$( api.column( 1 ).footer() ).html(totalHarga);
						
						///alert(totalHarga);
					}
					if (Number(value) == 2) {
						var totalHarga2 = api.column( 2, { page: 'current'} ).data().reduce( function (a, b) {
							//alert (a + " : " + b);
							//alert (x1 + Number($(b).text()));
							//return x1 = x1 + Number($(b).text());
							return Number(a) + Number(b);
						}, 0 );
						// Update footer
						//$("#ini").html(totalHarga);
						$(".seiko").html(totalHarga2);
						///$( api.column( 1 ).footer() ).html(totalHarga);
						
						///alert(totalHarga);
					}
					
					
					if (value > 2) {
						var x1 = 0;
						pageTotal1 = api.column( value, { page: 'current'} ).data().reduce( function (a, b) {
							
							//alert (x1 + Number($(b).text()));
							return x1 = x1 + Number($(b).text().toString().replace(",","").replace(",",""));
							//return intVal(a) + intVal(b);
						}, 0 );
						// Update footer
						$( api.column( value ).footer() ).html(pageTotal1);
					}
				});
				
				
				
				
				}/////////akhir sum array datatable
                });///////datatable
				
				
				
				$("div.toolbar").html('<b><input type="text" id="cari" placeholder="Cari data"></b>');
				$("#cari").keyup(function(e) {
                    //cari_table();
                });
            });//////doc ready

/*function cari_table() {
	var value = $("#cari").val();	
	$("table tbody tr").each(function(index, element) {
		if (index >= 0) {	
			$row = $(this);	
			var id = $row.find("td:eq(0)").text().toLowerCase();
			if (id.indexOf(value) < 0) {							
				$row.hide();
				//$('.kost').hide();									
			}
			else {			
				$row.show();
			}
		}
	});
}*/
/////////////////////dialog funct
$(document).on("pagecreate", "#page1", function(){
			
		 $('th .SIMKU').click(function(){
		var smik = $(this).attr("mana");
		var vvv = $('#example td:nth-child('+smik+') .MINS')
		      .map(function() 
			  {return $(this).val();
			 }).get();

         
		 var id_tgl = $(this).attr("lion");
		 var date_tgl = $(this).attr("mios");
		// alert(vvv);
		 var htmk= '<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a><div style="padding:10px 30px;" data-theme="b" class="ui-corner-all" id="merah">';
		
	       htmk +=  '<div>EDIT TANGGAL KOLOM | Tgl = '+id_tgl+'</div>';
 htmk +=  '<div><input type="text" id="tgl_update" value="'+id_tgl+'" onkeypress="return isNumberKey(event)"><input type="hidden" id="array_id" value="'+vvv+'"><input type="hidden" id="date_satu" value="'+date_tgl+'"></div>';
			 htmk += '<a href="#"  class="ui-btn ui-btn-inline" data-rel="back">Kembali</a><button type="submit" class="ui-btn ui-btn-inline" id="edit_tgl" value="" >Edit</button><button type="submit" class="ui-btn ui-btn-inline" id="hapus_tgl" value="" >Hapus</button>';
            htmk +=  '</div>';
		  
//alert (htmk);
       $("#popup-tgl").html(htmk).enhanceWithin().popup("refresh");   
		//alert (vvv); 
         })
	///////edit tgl kolom
	
   $(document .body).on('click', '#edit_tgl', function(){ 
      if (confirm('Apakah anda ingin edit tanggal ini ?')) {
   tgl_satu = $(document .body).find('#tgl_update').val();
   array_id = $(document .body).find('#array_id').val();
   date_satu = $(document .body).find('#date_satu').val();
   aksi= 'edit';
			$.ajax({
					type:"post",
					url:"edit_tgl.php",
					data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi},
					success: function(php_script_response){
						//$("#hasil").html(data);
						alert(php_script_response);
						$( "#popup-tgl" ).popup( "close" );
						window.location = "report_kirim_now.php";
						
					}
				});
	  }
        }); 
	/////////delete kolom tanggal	
	
   $(document .body).on('click', '#hapus_tgl', function(){ 
      if (confirm('Apakah anda ingin menghapus semua tanggal pada kolom ini ?')) {
   tgl_satu = $(document .body).find('#tgl_update').val();
   array_id = $(document .body).find('#array_id').val();
   date_satu = $(document .body).find('#date_satu').val();
   aksi= 'delete';
			$.ajax({
					type:"post",
					url:"edit_tgl.php",
					data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi},
					success: function(php_script_response){
						//$("#hasil").html(data);
						alert(php_script_response);
						$( "#popup-tgl" ).popup( "close" );
						window.location = "report_kirim_now.php";
						
					}
				});
	  }
        }); 
	
	
	
	/////////////popo up qty
   
   /////////batas 2
   
//function RefreshTable() {
       //$( "#sur" ).load( "report_kirim_now.php #sur" );
	//   window.location.reload(1);
  // }
   /////////////end  
   $(document .body).on('click', '#feedback_send', function(){ 
      if (confirm('Apakah anda ingin edit data ini ?')) {
  // var qty = $("input#qtyku9").val();
  acci = $(document .body).find('#tng98').val();
   qty = $(document .body).find('#qtyku98').val();
  // acci = $(document .body).find('#accid98').val();
   aksi= 'edit';
   
//alert (acci);
			var strcari = $(this).val();
			//alert (strcari);
			$.ajax({
					type:"post",
					url:"editku.php",
					data:{"q":strcari,"qty":qty,"accid":acci,"aksi":aksi},
					success: function(php_script_response){
						//$("#hasil").html(data);
						alert(php_script_response);
						$( "#data-popup" ).popup( "close" );
						window.location = "report_kirim_now.php";
						
					}
				});
	  }
        }); 
	////delete	
$(document .body).on('click', '#hapus', function(){ 
   if (confirm('Apakah anda ingin menghapus data ?')) {
	//alert ('Akan dihapus'); 
	qty = $(document .body).find('#qtyku98').val();
    acci = $(document .body).find('#accid98').val();
    aksi= 'delete';
            var strcari = $(this).val();
			//alert (strcari);
			$.ajax({
					type:"post",
					url:"editku.php",
					data:{"q":strcari,"qty":qty,"accid":acci,"aksi":aksi},
					success: function(php_script_response){
						//$("#hasil").html(data);
						alert(php_script_response);
						$( "#data-popup" ).popup( "close" );
						window.location = "report_kirim_now.php";
						
					}
				});
 };
        });
		////////////////////////////popup datepicker
		
		 
});////akhir pagecreate

//////////dialog funt
 function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}   

/////////////////////total row bos


function myPopup() {
	

//  window.open ( "newindow.php?INK=90", "MyWindow", "status = 1, height = 300, width = 300, resizable = 0")
 };
        </script>
    </head>

    <body>
    <?php  

$AAA = $_GET['DIST'];
$BBB = $_GET['TGL'];


$sqlshow9 = "select * from push_distributor where ACCOUNT_ID = '$AAA';";
		$queryshow9=mysqli_query($mysqli, $sqlshow9);
$datashow9=mysqli_fetch_array($queryshow9);
        $namaae = $datashow9 ['ACCOUNT_NAME'];

?>
    <div data-role="page" id="page1" data-theme="a">
        <div data-role="header">
            <h1>ORDER KIRIM FESTIVE</h1>
            <h2><?php echo " ( ".$AAA." )  ".$namaae."";?></h2>
            
  <a href="admin_kj.php" target="_parent" class="ui-btn ui-btn-inline ui-icon-back ui-btn-icon-notext ui-corner-all">No text</a>
        </div>
<!-- dialog so-->
<div id="data-popup" data-role="popup" data-theme="a" > </div>
<div id="popup-tgl" data-role="popup" data-theme="a" ></div>

        <div data-role="content">
         <table>
         
        <button class="ui-btn ui-btn-inline" style="background:#F5BD8D;" id="tmb">Tambah Data</button>
         <button class="ui-btn ui-btn-inline" style="background:#8BE8F0;" id="tmm">Data Manual</button>
      
      <!-- <b><font color="#BC0CBB">Note : Jika total kirim berwarna merah berarti jadwal kirim kurang dari KJ , Jadwal kirim harus ditambah!</font></b>--> 
<form id="formx" method="post" action="save_pengiriman.php" data-ajax="false">
       <table id="example" class="cell-border"   cellspacing="0" width="100%">
  		<thead>
        <tr>
    		<th >NO. PO</th>
            <th  >TGL KIRIM</th>
            
    		<th  >TUJUAN</th>
            <th  >QTY</th>
             <th  >KUBIKASI</th>
             <th  >DETAIL</th>	       
  		<!--style='min-width:150px'-->
        </tr>
        </thead>
        <tbody>
        <?php $sqlshow = "select AA.Id, AA.ID_CONFIRM, AA.TGL_ORDER, AA.ACCOUNT_ID,
  AA.ITEM_CODE, AA.JML_ORDER, SUM(JML_ORDER) as ORD, AA.KUBIKASI,
   ROUND(SUM(AA.KUBIKASI),3) as KUBIK, AA.NO_PO, AA.TUJUAN,
  BB.item_name, CC.ACCOUNT_NAME
   from  order_confirm as AA, push_item as BB, push_distributor as CC 
   where AA.TUJUAN = CC.ACCOUNT_ID and AA.ITEM_CODE = BB.item_code 
   and AA.FESTIVE = '1' and AA.ACCOUNT_ID = '$AAA' group by AA.NO_PO order by AA.Id DESC";
   
   /*select AA.Id, AA.ID_CONFIRM, AA.TGL_ORDER, AA.ACCOUNT_ID,
  AA.ITEM_CODE, AA.JML_ORDER, SUM(JML_ORDER) as ORD, AA.KUBIKASI,
   ROUND(SUM(AA.KUBIKASI),3) as KUBIK, AA.NO_PO, AA.TUJUAN,
  BB.item_name, CC.ACCOUNT_NAME
   from  order_confirm as AA, push_item as BB, push_distributor as CC 
   where AA.TUJUAN = CC.ACCOUNT_ID and AA.ITEM_CODE = BB.item_code 
   and AA.FESTIVE = '1' and AA.ACCOUNT_ID = '$AAA' 
   and YEAR(AA.TGL_ORDER) = '$yearku' group by AA.NO_PO order by AA.Id DESC*/
   
		$queryshow=mysqli_query($mysqli, $sqlshow);
while  	($datashow=mysqli_fetch_array($queryshow)){
        $acid = $datashow ['ACCOUNT_ID']; 
		 $itcod = $datashow ['ITEM_CODE']; 
		  $tuj = $datashow ['TUJUAN']; 
		 
		  $po87 = $datashow ['NO_PO']; 
		 $accnm = $datashow ['ACCOUNT_NAME'];
		  $itcod = $datashow ['item_name'];  
		 $tglod = $datashow ['TGL_ORDER']; 
		  $kbk8 = $datashow ['KUBIK']; 
		   $ord45 = $datashow ['ORD']; 
		 		 
		echo "<tr>
		<td>$po87</td>
		<td>$tglod</td>
		
		<td>$accnm</td>
		<td align='right'>$ord45</td>
		<td align='right'>$kbk8</td>
		<td align='center'><a href='#'  class='std' man='$tuj' poku='$po87' >View</a> </td>
		</tr>";
		
      }
		?>
			
        </tbody>
       
        </table>
<!--<input type="submit" value="SAVE" name="SAVE" id="SAVE">          onClick= 'myPopup()'-->

</form>
 <!-- Dialog only page -->
<!--<div data-role="popup" id="dialog" data-theme="a" class="ui-corner-all">
    <form>
        <div style="padding:10px 30px;">
            <h3>Edit</h3>
            <label for="un" class="ui-hidden-accessible">Username:</label>
            <input name="user" id="un" value=""  data-theme="a" type="text">
            <label for="pw" class="ui-hidden-accessible">Password:</label>
            <input name="pass" id="pw" value=""  data-theme="a" type="password">
        <a href="#"  class="ui-btn ui-btn-inline" data-rel="back">Cancel</a>
       <button type="submit" class="ui-btn ui-btn-inline" >Edit</button>
        </div>
    </form>
</div>-->

<!-- eakhir dialog-->

<div id="tambah_data" >
<div id='HG' >
<input type="text" id="liop" value="<?php echo $AAA ?>">
<input type="text" id="liops" value="<?php echo $BBB ?>">
<textarea name="JDW" id="mn"  value="" ></textarea> </div>

<div data-role="fieldcontain">
<label for="ok">No. PO :</label>
<input type="text" id="NO_PO" >
</div>
<div data-role="fieldcontain">
<label for="ok">Tujuan <font color="red">(*Auto Complete)</font></label>
<input type="text" id="TUJUAN" ><input type="hidden" id="ID_TUJUAN" >
</div>
<div data-role="fieldcontain">
<label for="ok">Pilih Tanggal: </label>
<input type="text" id="datepicker" >
</div>

<button class="ui-btn ui-btn-inline" id="SVD" style="background:#F5BD8D;">Tampilkan Form Input</button>
<button class="ui-btn ui-btn-inline" id="SVDM"  style="background:#8BE8F0;">Tampilkan Form Manual</button>

<div id="tampil_input"></div>
 
</div>
<!-- akhir input tanggal-->	
<script>
           
			$("#SVD").click(function(e) <!-- jika value strcari tidak kosong-->
			{
				 $("#tampil_input").show();
				var NOMORPO = $("#NO_PO").val();
				var TUJUANE = $("#TUJUAN").val();
				var MN = $("#mn").val();
				
				if ($.trim(NOMORPO) == ''){
                    alert('No. PO masih kosong!');
                    }
				else if ($.trim(TUJUANE) == ''){
                    alert('Tujuan masih kosong!');
                    }
				else if ($.trim(MN) == ''){
                    alert('Tanggal belum dipilih!');
                    }
				
				
				else {
				 var tyu = $("#mn").val();
				  var sjk = $("#liop").val();
				  var bulan = $("#datepicker").val();
				//alert (tyu);
				
				$.ajax({
					type:"post",
					url:"tampil_data_satu.php",
					data:{"q": tyu,"klm":sjk, "bulan":bulan},
					//data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi},
					success: function(data){
						$("#tampil_input").html(data);
						$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
						//$('body').append('<div id="test-element">Click mee</div>');
					}
				});
				
				} //end else
			});
			
			$("#SVDM").click(function(e) <!-- jika value strcari tidak kosong-->
			{
				 $("#tampil_input").show();
				var NOMORPO = $("#NO_PO").val();
				var TUJUANE = $("#TUJUAN").val();
				var MN = $("#mn").val();
				
				if ($.trim(NOMORPO) == ''){
                    alert('No. PO masih kosong!');
                    }
				else if ($.trim(TUJUANE) == ''){
                    alert('Tujuan masih kosong!');
                    }
				else if ($.trim(MN) == ''){
                    alert('Tanggal belum dipilih!');
                    }
				
				
				else {
				 var tyu = $("#mn").val();
				  var sjk = $("#liop").val();
				  var bulan = $("#datepicker").val();
				//alert (tyu);
				
				$.ajax({
					type:"post",
					url:"tampil_data_satu_manual.php",
					data:{"q": tyu,"klm":sjk, "bulan":bulan},
					//data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi},
					success: function(data){
						$("#tampil_input").html(data);
						$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
						//$('body').append('<div id="test-element">Click mee</div>');
					}
				});
				
				} //end else
			});
			
			
	$(document).on("click","#woke",function() {
		
		var arr = [];
		var i = 0;
		var accid = $("#liop").val();
		var tgl9 = $("#liops").val();
		var no_po = $("#NO_PO").val();
		var tujuan = $("#ID_TUJUAN").val();
		//alert($("#tb_order tbody tr:hidden").length);
		$(".inp").each(function(index, element) {
            if ($(element).val()!=="") {				
				arr.push({
					icod:$(element).parents("td").find(".sopo").val(),
					order:$(element).val(),
					tgl_order:$(element).parents("td").find(".sipi").val(),
					kbk:$(element).parents("td").find(".hsl").val(),
					//kj: Number($(element).parents("tr").find(".kj").text().replace(".","")),
					//sisa: Number($(element).parents("tr").find(".sisa").text().replace(".","")),
					//kubik: Number($(element).parents("tr").find(".jml_kubik").text()),
					//item_code:$(element).parents("tr").find(".item_code").text(),
				});
				i++;
			}
		});
		
		$.ajax({
					type:"post",
					url:"tampil_data_all.php",
					data:{"q": arr,"idku": accid,"no_po": no_po,"tujuan": tujuan},
					dataType:"html",
					//data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi},
					success: function(php_script_response){
						//$("#tampil_input").html(data);
						alert(php_script_response);
						window.location = "report_kirim_now.php?DIST="+accid+"&TGL="+tgl9;
						//$('body').append('<div id="test-element">Click mee</div>');
					}
				});

    });
	
	$(document).on("click","#woke_manual",function() {
		
		var arr = [];
		var i = 0;
		var accid = $("#liop").val();
		var tgl9 = $("#liops").val();
		var no_po = $("#NO_PO").val();
		var tujuan = $("#ID_TUJUAN").val();
		//alert($("#tb_order tbody tr:hidden").length);
		$(".inp").each(function(index, element) {
            if ($(element).val()!=="") {				
				arr.push({
					icod:$(element).parents("td").find(".sopo").val(),
					order:$(element).val(),
					tgl_order:$(element).parents("td").find(".sipi").val(),
					kbk:$(element).parents("td").find(".hsl").val(),
					//kj: Number($(element).parents("tr").find(".kj").text().replace(".","")),
					//sisa: Number($(element).parents("tr").find(".sisa").text().replace(".","")),
					//kubik: Number($(element).parents("tr").find(".jml_kubik").text()),
					//item_code:$(element).parents("tr").find(".item_code").text(),
				});
				i++;
			}
		});
		
		$.ajax({
					type:"post",
					url:"tampil_data_all_manual.php",
					data:{"q": arr,"idku": accid,"no_po": no_po,"tujuan": tujuan},
					dataType:"html",
					//data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi},
					success: function(php_script_response){
						//$("#tampil_input").html(data);
						alert(php_script_response);
						window.location = "report_kirim_now.php?DIST="+accid+"&TGL="+tgl9;
						//$('body').append('<div id="test-element">Click mee</div>');
					}
				});
				
    });


</script>
        </div>
        <!--emnd role-content-->
        

        <div data-role="footer">
            <!--<table align="center">
                <tr>
                    <td align="center">
                        <a href="logout.php" style="text-align: center" data-role="button" data-icon="power"
                           target="_parent" data-ajax="false">Sign Out</a>
                    </td>
                </tr>
            </table>-->
            <h2>Kokola Web Developer Department, 2016 </h2>
        </div>


    </div>
    <!--end role page-->
   
    </body>
    </html>
    <?php
}
else{
}
?>