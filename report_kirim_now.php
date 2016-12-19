<?php
error_reporting(0);
session_start();

if($_SESSION['USER']) {
	include "koneksi.php";
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
        </style>
        <script>

		
var totals=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
			  
$(document).ready(function () {
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
			changeMonth: false,
		    stepMonths: 0,
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
					$('#datepicker').val('');
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
		  $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
        });
		
		
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});
			
			
	///////////////////////////////totals	
	
   // return p1 * p2;              // The function returns the product of p1 and p2
	
   /* var $dataRows=$("#example tr:not('.titelku, .totalku')");
    
    $dataRows.each(function() {
        $(this).find('.rowDataSd').each(function(i){        
            totals[i]+=parseInt( ($(this).val()).toString().replace(",","").toString().replace(",","").toString().replace(",",""));
        });
    });
    $("#example th.totalCol").each(function(i){  
        $(this).html(totals[i]);
    });*/
	
	
               ////////////////////////////batas total column
				
$('#example').on( 'draw.dt', function () {
   // alert( 'Table redrawn' );
   //myFunction();

   
   
   
} ); ///////akhir func cari dttbles
							
                $('#example').DataTable({
					// "dom": '<"toolbar">frtip',
					 fixedColumns:   {
            leftColumns: 2,
            //rightColumns: 1
        },
		
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: false,
	    ordering: false,
        filter: true,
        paging:  false,
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

function cari_table() {
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
}
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
   $("td .update-data").on('click', function(){
	    var thisRow = $(this).closest('tr');
		var rowtot = thisRow.find('td .rowtot').val();
		var totkj = thisRow.find('td.totkj').text();	
		
      var id = $(this).attr("id");
	   var sil =  $(this).parents('td').find('#sol').val();
	    var kil =  $(this).parents('td').find('#tol').val();
		var acc =  $(this).parents('td').find('#accidku').val();
		var tng =  $(this).parents('td').find('#tng').val();
		
		var rowtotnow = Number(rowtot) - Number(sil);
	 // alert (id);
          id = id.split('');
      
     var htm= '<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a><div style="padding:10px 30px;" data-theme="a" class="ui-corner-all">';
	   htm += '<div >Tanggal: <input type="text" id="tng98" maxlength="2" onkeypress="return isNumberKey(event)" value ="' + tng +'"></div>';
	   htm += '<div >';
	  /* htm += 'total row 2<input type="text" id="rowtot" value="'+rowtotnow+'">';
	   htm += 'total kj<input type="text" id="totkj"value="'+totkj+'">';
	   htm += 'change<input type="text" id="change"value="">';*/
       htm += 'Qty : <input type="text" id="qtyku98" value ="' +sil+'"><input type="hidden" id="accid98" value ="' + acc +'">';
	   htm += '<a href="#"  class="ui-btn ui-btn-inline" data-rel="back">Kembali</a><button type="submit" class="ui-btn ui-btn-inline" id="feedback_send" value="'+kil+'" >Edit</button><button type="submit" class="ui-btn ui-btn-inline" id="hapus" value="'+kil+'" >Hapus</button>';
             //htm += '<p>Name: ' + $('#p' + id[1] + '_name').val()  +'<p>';
           //htm += '<p>DOB: ' + $('#p' + id[1] + '_dob').val()  +'<p>';
           htm +=  '</div>';
		   htm +=  '</div>';

       $("#data-popup").html(htm).enhanceWithin().popup("refresh");       
   }); 
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


        </script>
    </head>

    <body>

    <div data-role="page" id="page1" data-theme="a">
        <div data-role="header">
            <h1>ORDER KIRIM HARI INI<?php //echo "<i>".$thn_dpn."</i>";?></h1>

            <h2><?php echo " ( ".$_SESSION[USER]." ) ";
		   echo $_SESSION[NAMA];?></h2><a href="pilih_pengiriman.php" target="_parent" class="ui-btn ui-btn-inline ui-icon-back ui-btn-icon-notext ui-corner-all">No text</a>
        </div>
<!-- dialog so-->
<div id="data-popup" data-role="popup" data-theme="a" > </div>
<div id="popup-tgl" data-role="popup" data-theme="a" ></div>

        <div data-role="content">
        
        <button class="ui-btn ui-btn-inline" id="tmb">Tambah Data</button>
        
        <?php
/*$sql9x2 = "select SUM(BULAN2) as  BLN from kj where NAMA_DIST = '$accid' and TRIWULAN = 'Jan-Feb-Mar' and YEAR(TGL) = '$yearku' and publish='1';";
		$query9x2=mysqli_query($mysqli, $sql9x2);
  		$data9x2=mysqli_fetch_array($query9x2);//) {
        $mi2 = $data9x2 ['BLN'];
		
$sql9x3 = "select SUM(BULAN3) as  BLN from kj where NAMA_DIST = '$accid' and TRIWULAN = 'Jan-Feb-Mar' and YEAR(TGL) = '$yearku' and publish='1';";
		$query9x3=mysqli_query($mysqli, $sql9x3);
  		$data9x3=mysqli_fetch_array($query9x3);//) {
        $mi3 = $data9x3 ['BLN'];
		
$sql9x4 = "select SUM(BULAN1) as  BLN from kj where NAMA_DIST = '$accid' and TRIWULAN = 'Apr-May-Jun' and YEAR(TGL) = '$yearku' and publish='1';";
		$query9x4=mysqli_query($mysqli, $sql9x4);
  		$data9x4=mysqli_fetch_array($query9x4);//) {
        $mi4 = $data9x4 ['BLN'];
		
$sql9x5 = "select SUM(BULAN2) as  BLN from kj where NAMA_DIST = '$accid' and TRIWULAN = 'Apr-May-Jun' and YEAR(TGL) = '$yearku' and publish='1';";
		$query9x5=mysqli_query($mysqli, $sql9x5);
  		$data9x5=mysqli_fetch_array($query9x5);//) {
        $mi5 = $data9x5 ['BLN'];
		
$sql9x6 = "select SUM(BULAN3) as  BLN from kj where NAMA_DIST = '$accid' and TRIWULAN = 'Apr-May-Jun' and YEAR(TGL) = '$yearku' and publish='1';";
		$query9x6=mysqli_query($mysqli, $sql9x6);
  		$data9x6=mysqli_fetch_array($query9x6);//) {
        $mi6 = $data9x6 ['BLN'];
		
$sql9x7 = "select SUM(BULAN1) as  BLN from kj where NAMA_DIST = '$accid' and TRIWULAN = 'Jul-Aug-Sep' and YEAR(TGL) = '$yearku' and publish='1';";
		$query9x7=mysqli_query($mysqli, $sql9x7);
  		$data9x7=mysqli_fetch_array($query9x7);//) {
        $mi7 = $data9x7 ['BLN'];
		
$sql9x8 = "select SUM(BULAN2) as  BLN from kj where NAMA_DIST = '$accid' and TRIWULAN = 'Jul-Aug-Sep' and YEAR(TGL) = '$yearku' and publish='1';";
		$query9x8=mysqli_query($mysqli, $sql9x8);
  		$data9x8=mysqli_fetch_array($query9x8);//) {
        $mi8 = $data9x8 ['BLN'];
		
$sql9x9 = "select SUM(BULAN3) as  BLN from kj where NAMA_DIST = '$accid' and TRIWULAN = 'Jul-Aug-Sep' and YEAR(TGL) = '$yearku' and publish='1';";
		$query9x9=mysqli_query($mysqli, $sql9x9);
  		$data9x9=mysqli_fetch_array($query9x9);//) {
        $mi9 = $data9x9 ['BLN'];	
		
$sql9x10 = "select SUM(BULAN1) as  BLN from kj where NAMA_DIST = '$accid' and TRIWULAN = 'Oct-Nov-Dec' and YEAR(TGL) = '$yearku' and publish='1';";
		$query9x10=mysqli_query($mysqli, $sql9x10);
  		$data9x10=mysqli_fetch_array($query9x10);//) {
        $mi10 = $data9x10 ['BLN'];
		
$sql9x11 = "select SUM(BULAN2) as  BLN from kj where NAMA_DIST = '$accid' and TRIWULAN = 'Oct-Nov-Dec' and YEAR(TGL) = '$yearku' and publish='1';";
		$query9x11=mysqli_query($mysqli, $sql9x11);
  		$data9x11=mysqli_fetch_array($query9x11);//) {
        $mi11 = $data9x11 ['BLN'];
		
$sql9x12 = "select SUM(BULAN3) as  BLN from kj where NAMA_DIST = '$accid' and TRIWULAN = 'Oct-Nov-Dec' and YEAR(TGL) = '$yearku' and publish='1';";
		$query9x12=mysqli_query($mysqli, $sql9x12);
  		$data9x12=mysqli_fetch_array($query9x12);//) {
        $mi12 = $data9x12 ['BLN'];						
		
		if ($mi2 > 0)
		{ $zo2 = "<a href='report_kirim_next.php?BLN=02' target='_parent' data-role='button' class='ui-btn ui-btn-inline'>Feb</a>";}
		if ($mi3 > 0)
		{ $zo3 = "<a href='report_kirim_next.php?BLN=03' target='_parent' data-role='button' class='ui-btn ui-btn-inline'>Mar</a>";}
		if ($mi4 > 0)
		{ $zo4 = "<a href='report_kirim_next.php?BLN=04' target='_parent' data-role='button' class='ui-btn ui-btn-inline'>Apr</a>";}
		if ($mi5 > 0)
		{ $zo5 = "<a href='report_kirim_next.php?BLN=05' target='_parent' data-role='button' class='ui-btn ui-btn-inline'>May</a>";}
		if ($mi6 > 0)
		{ $zo6 = "<a href='report_kirim_next.php?BLN=06' target='_parent' data-role='button' class='ui-btn ui-btn-inline'>Jun</a>";}
		if ($mi7 > 0)
		{ $zo7 = "<a href='report_kirim_next.php?BLN=07' target='_parent' data-role='button' class='ui-btn ui-btn-inline'>Jul</a>";}
		if ($mi8 > 0)
		{ $zo8 = "<a href='report_kirim_next.php?BLN=08' target='_parent' data-role='button' class='ui-btn ui-btn-inline'>Aug</a>";}
		if ($mi9 > 0)
		{ $zo9 = "<a href='report_kirim_next.php?BLN=09' target='_parent' data-role='button' class='ui-btn ui-btn-inline'>Sep</a>";}
		if ($mi10 > 0)
		{ $zo10 = "<a href='report_kirim_next.php?BLN=10' target='_parent' data-role='button' class='ui-btn ui-btn-inline'>Oct</a>";}
		if ($mi11 > 0)
		{ $zo11 = "<a href='report_kirim_next.php?BLN=11' target='_parent' data-role='button' class='ui-btn ui-btn-inline'>Nov</a>";}
		if ($mi12 > 0)
		{ $zo12 = "<a href='report_kirim_next.php?BLN=12' target='_parent' data-role='button' class='ui-btn ui-btn-inline'>Dec</a>";}
		
		
		if ($bulanku == 1)
		{
		echo "$zo2 $zo3 $zo4 $zo5 $zo6 $zo7 $zo8 $zo9 $zo10 $zo11 $zo12";	
		}
		if ($bulanku == 2)
		{
		echo "$zo3 $zo4 $zo5 $zo6 $zo7 $zo8 $zo9 $zo10 $zo11 $zo12";	
		}
		if ($bulanku == 3)
		{
		echo "$zo4 $zo5 $zo6 $zo7 $zo8 $zo9 $zo10 $zo11 $zo12";	
		}
		if ($bulanku == 4)
		{
		echo "$zo5 $zo6 $zo7 $zo8 $zo9 $zo10 $zo11 $zo12";	
		}
		if ($bulanku == 5)
		{
		echo "$zo6 $zo7 $zo8 $zo9 $zo10 $zo11 $zo12";	
		}
		if ($bulanku == 6)
		{
		echo "$zo7 $zo8 $zo9 $zo10 $zo11 $zo12";	
		}
		if ($bulanku == 7)
		{
		echo "$zo8 $zo9 $zo10 $zo11 $zo12";	
		}
		if ($bulanku == 8)
		{
		echo "$zo9 $zo10 $zo11 $zo12";	
		}
		if ($bulanku == 9)
		{
		echo "$zo10 $zo11 $zo12";	
		}
		if ($bulanku == 10)
		{
		echo "$zo11 $zo12";	
		}
		if ($bulanku == 11)
		{
		echo "$zo12";	
		}
		if ($bulanku == 12)
		{
		echo "";	
		}
		*/
		
		
		?>
       <b><font color="#BC0CBB">Note : Jika total kirim berwarna merah berarti jadwal kirim kurang dari KJ , Jadwal kirim harus ditambah!</font></b> 
<form id="formx" method="post" action="save_pengiriman.php" data-ajax="false">
       <table id="example" class="cell-border"   cellspacing="0" width="100%">
  		<thead>
        <tr class='titelku'>
    		<th style='min-width:250px' man='0'>Nama Produk</th>
            
    		<th style='min-width:70px' man='1'>Jumlah KJ</th>
            <th style='min-width:70px' man='2'>Total Kirim</th>
            
	        <?php
		//select ACCOUNT_ID, day(periode2) as tglx from order_kirim_wd where  ACCOUNT_ID =
	$sql9 = "select ACCOUNT_ID, day(periode2) as tglx,date(periode2) as dateku,month(periode2) as bulanku, 
 year(periode2) as thn from order_kirim_wd where  
 ACCOUNT_ID = '$accid' and month(periode2) ='$bulanku' and year(periode2) = '$yearku' group by tglx;";
		$query9=mysqli_query($mysqli, $sql9);
		$hj = 4;
		$gk = 3;
  		while ($data9=mysqli_fetch_array($query9)) {
		$smk = $data9['tglx'];
		$dateku = $data9['dateku'];
			//for($i=0; $i<$jumHari; $i++){
				//$k = $i+1 ;
				//<a href='#data-popup' class='update-data' style='text-decoration:none' id='b1' data-rel='popup' data-position-to='window' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a' data-transition='slideup' data-mini ='true'>
				echo "<th style='min-width:50px' man='$gk'><u><a href='#popup-tgl' data-rel='popup' class='SIMKU' data-position-to='window' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a' data-transition='slideup' data-mini ='true' mana='$hj' lion='$smk' mios='$dateku'> $smk</a></u></th>";
				$hj++;
				$gk++;
				}
				?>
  		</tr>
        </thead>
        <tbody>
        <?php
				
//$sql = "select * from order_kirim_wd where  ACCOUNT_ID = '$accid' group by item_code";

$sql = "select * from ( select * from  (select ITEM_CODE as ICOD,ID as ID_PROD from m_produk)as ZZ right join 
  order_kirim_wd  on order_kirim_wd.item_code = ZZ.ICOD) as LL where LL.ACCOUNT_ID = '$accid' group by item_code;";
//$sql = "SELECT KK.THN, KK.TGL,KK.KU, KK.ID_PRODUK, KK.BULAN_INPUT as BLI, 
//KK.BULAN1,KK.BULAN2,KK.BULAN3, KK.NAMA_DIST,KK.ACCOUNT_ID,  ID, NAMA_PRODUK, ITEM_CODE FROM m_produk as CC 
// inner join (select ACCOUNT_ID, ID as KU, BULAN_INPUT,Month(TGL) as TGL,
// YEAR(TGL) as THN,ID_PRODUK, BULAN1,BULAN2,BULAN3, NAMA_DIST  from kj) as KK on CC.ID = KK.KU
// AND NAMA_DIST = 'cmsferitangerang' and THN = '$yearku' and TGL = '$bulanku'";

  		$query=mysqli_query($mysqli, $sql);
  		$no = 1;
		
  		while ($data=mysqli_fetch_array($query))
  		{
			$nmb3 = $data['ICOD'];
			//$sql2 = "select * from m_produk where ITEM_CODE = '$nmb3'";
			//$sql2="SELECT KK.THN, KK.TGL,KK.KU, KK.ID_PRODUK, KK.BULAN_INPUT as BLI, 
//KK.BULAN1,KK.BULAN2,KK.BULAN3, KK.NAMA_DIST,KK.ACCOUNT_ID,  ID, NAMA_PRODUK, ITEM_CODE FROM m_produk as CC 
 //inner join (select ACCOUNT_ID, ID as KU, BULAN_INPUT,Month(TGL) as TGL,
 //YEAR(TGL) as THN,ID_PRODUK, BULAN1,BULAN2,BULAN3, NAMA_DIST  from kj) as KK on CC.ID = KK.KU
 //AND KK.ACCOUNT_ID = '$accid' and THN = '$yearku' and TGL = '$bulanku' and item_code = '$nmb3'";
 /*$sql2 = "Select * from (select AA.ITEM_CODE,AA.ID,AA.NAMA_PRODUK, BB.ID_PRODUK, BB.BULAN1, BB.BULAN2,BB.ACCOUNT_ID, BB.BULAN3,BB.NAMA_DIST, BB.TGL,BB.THN, BB.BULAN_INPUT as BLI, BB.KU, BB.TRIWULAN
 from (select ID, NAMA_PRODUK, ITEM_CODE from m_produk)as AA right 
 join (select ACCOUNT_ID, ID as KU, BULAN_INPUT,Month(TGL) as TGL,
 YEAR(TGL) as THN,ID_PRODUK, BULAN1,BULAN2,BULAN3, NAMA_DIST, TRIWULAN, ITEM_CODE  from kj) as BB on AA.ITEM_CODE = BB.ITEM_CODE) as MM 
where MM.ACCOUNT_ID = '$accid' and MM.THN = '$yearku'  and MM.TRIWULAN ='$triwulan' and MM.ID = '$nmb3';   ";*/
$sql2 = "Select * from (select AA.ITEM_CODE,AA.ID,AA.NAMA_PRODUK, BB.ID_PRODUK, BB.BULAN1, BB.BULAN2,BB.ACCOUNT_ID,
   BB.BULAN3,BB.NAMA_DIST, BB.TGL,BB.THN, BB.BULAN_INPUT as BLI, BB.KU, BB.TRIWULAN
 from (select ID, NAMA_PRODUK, ITEM_CODE from m_produk)as AA right 
 join (select ACCOUNT_ID, ID as KU, BULAN_INPUT,Month(TGL) as TGL,
 YEAR(TGL) as THN,ID_PRODUK, BULAN1,BULAN2,BULAN3, NAMA_DIST, TRIWULAN, ITEM_CODE  from forecast 
 where publish='1') as BB on AA.ITEM_CODE = BB.ITEM_CODE) as MM 
where MM.ACCOUNT_ID = '$accid' and MM.THN = '$yearku'  and MM.TRIWULAN ='$triwulan' and MM.ITEM_CODE = '$nmb3'";
////and MM.TGL = '$bulanku'                    = penggalan query
  		$query2=mysqli_query($mysqli, $sql2);
		while ($data2=mysqli_fetch_array($query2))
  		{
			$bli = $data2['BLI'];
			//////detect bulan
					if ($bulanku == "01")
					{  $bulanku9 = $data2['BULAN1']; }
					elseif ($bulanku == "02")
					{  $bulanku9 = $data2['BULAN2']; }
					elseif ($bulanku == "03")
					{  $bulanku9 = $data2['BULAN3']; }
					elseif ($bulanku == "04")
					{  $bulanku9 = $data2['BULAN1']; }
					elseif ($bulanku == "05")
					{  $bulanku9 = $data2['BULAN2']; }
					elseif ($bulanku == "06")
					{  $bulanku9 = $data2['BULAN3']; }
					elseif ($bulanku == "07")
					{  $bulanku9 = $data2['BULAN1']; }
					elseif ($bulanku == "08")
					{  $bulanku9 = $data2['BULAN2']; }
					elseif ($bulanku == "09")
					{  $bulanku9 = $data2['BULAN3']; }
					elseif ($bulanku == "10")
					{  $bulanku9 = $data2['BULAN1']; }
					elseif ($bulanku == "11")
					{  $bulanku9 = $data2['BULAN2']; }
					elseif ($bulanku == "12")
					{  $bulanku9 = $data2['BULAN3']; }
					
					$uu = $data2['ID'];
					$bulanj = '899';
					
			
		echo "<tr>
				
				<td>
				$data2[NAMA_PRODUK]  		
				</td>
				<td align='center' class='totkj'>$bulanku9</td>
				<td align='center' class='rowtot'></td>
				";
				
		$sql9 = "select ACCOUNT_ID, day(periode2) as tglx from order_kirim_wd where  ACCOUNT_ID = '$accid' 
		and month(periode2) ='$bulanku' and year(periode2) = '$yearku' group by tglx";
		$query9=mysqli_query($mysqli, $sql9);
  		while ($data9=mysqli_fetch_array($query9)) {
		$smk = $data9['tglx'];
				//for($i=0; $i<$jumHari; $i++)
					//{
						//$k = $i+1 ;
					
/*$sql_absen = "	select id, ACCOUNT_ID, item_code,qty, tgl_upload, DAY(periode2) as tglku from order_kirim_wd where  ACCOUNT_ID = '$accid' 
and DAY(periode2) = '$smk' and month(periode2) ='$bulanku' and year(periode2) = '$yearku' and item_code = '".$data['item_code']."';";*/
$sql_absen = "	select * from(select max(id) as maxs from order_kirim_wd where  ACCOUNT_ID = '$accid' 
and DAY(periode2) = '$smk' and month(periode2) ='$bulanku' and year(periode2) = '$yearku' and item_code 
= '".$data['item_code']."')
as AA
left join
(select id, ACCOUNT_ID, item_code,qty, tgl_upload, DAY(periode2) as tglku from order_kirim_wd where  ACCOUNT_ID = '$accid' 
and DAY(periode2) = '$smk' and month(periode2) ='$bulanku' and year(periode2) = '$yearku' and item_code
 = '".$data['item_code']."')
as BB
on AA.maxs = BB.id ";
					$queryabsen=mysqli_query($mysqli, $sql_absen);
					$jml_absen = mysqli_num_rows($queryabsen);
					if ($dataabsen=mysqli_fetch_array($queryabsen))	{
						$coba = $dataabsen['qty'];
						$uup = number_format($coba);
						$idku = $dataabsen['id'];
						$tng = $dataabsen['tglku'];
						echo "<td  style='min-width:30px' align='center' >
						<a href='#data-popup' class='update-data' style='text-decoration:none' id='b1' data-rel='popup' data-position-to='window' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a' data-transition='slideup' data-mini ='true'><input type='hidden'  id='sol' value='$coba'><input type='hidden'  
						id='tol' class='MINS' value='$idku'>
<input type='hidden'  id='accidku' value='$accid'><input type='hidden'  id='tng' value='$tng'>
<input type='hidden' class='rowDataSd' value='$uup'>$uup</a>
						</td>";
						
					}
					else {
						echo "<td ><input type='hidden' class='rowDataSd' value='0'></td> 
                      ";
						
					}
					
					} //end for
				echo "</tr>";
				
		}/////akhir queery nm barang
$no++;
		}

?>
			
                </tbody>
                 
                         <?php
						 echo "<tfoot>
                        <tr class='totalku' >
                        <th width='50' class='kost'>&nbsp;</th>
                        <th width='50' align='center'  class='kost'>Total</th>
						 <th width='50' align='center' class='seiko'>Min</th>";
						 
						 
						 
		//select ACCOUNT_ID, day(periode2) as tglx from order_kirim_wd where  ACCOUNT_ID =
$sql9 = "select ACCOUNT_ID, day(periode2) as tglx from order_kirim_wd where  ACCOUNT_ID = '$accid' 
and month(periode2) ='$bulanku' and year(periode2) = '$yearku' group by tglx";
		$query9=mysqli_query($mysqli, $sql9);
		$c = 1;
  		while ($data9=mysqli_fetch_array($query9)) {
		$smk = $data9['tglx'];
			//for($i=0; $i<$jumHari; $i++){
				//$k = $i+1 ;
				echo "<th class='totalCol' style='min-width:50px' ><input type='hidden'  name='parade[]' value='0'></th>";
				$c++;
				}
				
				echo "</tr>  </tfoot>";
				?>
                           
                      
                            
                        
   
               
        </table>
<!--<input type="submit" value="SAVE" name="SAVE" id="SAVE">-->

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
<?php //echo $sql2 ?>
<div id="tambah_data" >
<div id='HG' >
<input type="text" id="liop" value="<?php echo $accid ?>">
<textarea name="JDW" id="mn"  value="" ></textarea> </div>
<div>Pilih Tanggal: <input type="text" id="datepicker" ></div>
<button class="ui-btn ui-btn-inline" id="SVD">Tampilkan Form Input</button>

<div id="tampil_input"></div>
 
</div>
<!-- akhir input tanggal-->	
<script>

var bukaken = function() {
    $('#woke').removeAttr("disabled");
	
     }
           
			$("#SVD").click(function(e) <!-- jika value strcari tidak kosong-->
			{
				 var tyu = $("#mn").val();
				  var sjk = $("#liop").val();
				//alert (tyu);
				if (tyu == "") { 
				alert ("Tanggal belum dipilih, silahkan pilih tanggal !"); 
				}
				else {
				$.ajax({
					type:"post",
					url:"tampil_data_satu.php",
					data:{"q": tyu,"klm":sjk},
					//data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi},
					success: function(data){
						$("#tampil_input").html(data);
						$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
						//$('body').append('<div id="test-element">Click mee</div>');
					}
				});
				}
			});
			
			
	$(document).on("click","#woke",function() {
		
		$(this).attr('disabled','disabled');
		setTimeout(function() { 
		alert('save gagal, silahkan ulangi kembali!');
		$('#woke').removeAttr("disabled"); 
		}, 60000);
		
		var arr = [];
		var i = 0;
		var accid = $("#liop").val();
		//alert($("#tb_order tbody tr:hidden").length);
		$(".produk2").each(function(index, element) {
            if ($(element).val()!=="") {				
				arr.push({
					produk:$(element).parents("td").find(".sipo").val(),
					//kj: Number($(element).parents("tr").find(".kj").text().replace(".","")),
					//real: Number($(element).parents("tr").find(".real").text().replace(".","")),
					//sisa: Number($(element).parents("tr").find(".sisa").text().replace(".","")),
					
					order:$(element).val(),
					tgld:$(element).parents("td").find(".sipi").val(),
					//kubik: Number($(element).parents("tr").find(".jml_kubik").text()),
					//item_code:$(element).parents("tr").find(".item_code").text(),
				});
				i++;
			}
		});
		
		$.ajax({
					type:"post",
					url:"tampil_data_all.php",
					data:{"q": arr,"idku": accid},
					dataType:"html",
					timeout: 60000,
					//data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi},
					success: function(php_script_response){
						$('#woke').removeAttr("disabled");
						//$("#tampil_input").html(data);
						alert(php_script_response);
						window.location = "report_kirim_now.php";
						//$('body').append('<div id="test-element">Click mee</div>');
					}
				});
		
	//	var jjj = $(".produk2, .sipo")
		//     .map(function() 
		//	  {return $(this).val();
		//	 }).get().join( "&" );
		// console.log(arr);
		//var ckk = $('<div>').append(arr).html();
     // alert (JSON.stringify(arr));
	  // console.log(arr) 
	 

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