<?php
error_reporting(0);
session_start();

if($_SESSION['USER']) {
	include "koneksi.php";
$accid = $_SESSION['ACCOUNT_ID'];	
//date_default_timezone_set("Asia/Jakarta");
	   		    $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				//$bulanku = date('m');
				$bulanku = $_GET['BLN'];
				$wkt = date('H:i:s'); 
$jumHari = cal_days_in_month(CAL_GREGORIAN, $bulanku, $yearku);
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
	   
	   ////////////////bulan
	   if ($bulanku == '01')
	   {
		   $blank = 'JANUARI';
	   }
	   elseif ($bulanku == '02')
	   {
		   $blank = 'FEBRUARI';
	   }
	    elseif ($bulanku == '03')
	   {
		   $blank = 'MARET';
	   }
	    elseif ($bulanku == '04')
	   {
		   $blank = 'APRIL';
	   }
	    elseif ($bulanku == '05')
	   {
		   $blank = 'MEI';
	   }
	    elseif ($bulanku == '06')
	   {
		   $blank = 'JUNI';
	   }
	    elseif ($bulanku == '07')
	   {
		   $blank = 'JULI';
	   }
	    elseif ($bulanku == '08')
	   {
		   $blank = 'AGUSTUS';
	   }
	    elseif ($bulanku == '09')
	   {
		   $blank = 'SEPTEMBER';
	   }
	    elseif ($bulanku == '10')
	   {
		   $blank = 'OKTOBER';
	   }
	    elseif ($bulanku == '11')
	   {
		   $blank = 'NOVEMBER';
	   }
	    elseif ($bulanku == '12')
	   {
		   $blank = 'DESEMBER';
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
			 /////////////////////date
			// total_larik();
			$("#HG").hide();
	     	//$("#liop").hide();
			var kilo = $('#blnx').val();
			var kiso = $('#thnx').val();
			 $('#datepicker').multiDatesPicker({
			changeMonth: false,
		    stepMonths: 0,
			/*dateFormat: "y-m-d", */
			defaultDate:''+kilo+'/9/'+kiso+'',
			//defaultDate: "+1w",
			//firstDay: 1,
			//dateFormat: "dd.mm.yy",
			//numberOfMonths: 1,
			//addDisabledDates: getSelectedExceptionDates(callback),
			onSelect: function () {
				var dates = $("#datepicker").multiDatesPicker('getDates');
				var html = '';
				$.each(dates, function (i, val)	{
			    var resi = val;
			    var arr = resi.split('/');
	      // var $kul = $("#mn");
	      //  $kul.val($kul.val()+arr[1]+',');
					html +=''+arr[1]+',';
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
	function total_larik() {
		//var totalv = 0;
    var $dataRows=$("#example tr:not('.titelku, .totalku')");
    
    $dataRows.each(function() {
        $(this).find('.rowDataSd').each(function(i){   
            // var totalv = 		
            //totalv = totalv + $(this).val()).toString().replace(",","").toString().replace(",","").toString().replace(",","");
			totals[i]+=parseInt( ($(this).val()).toString().replace(",","").toString().replace(",","").toString().replace(",",""));
        });
    });
    $("#example th.totalCol").each(function(i){  
       
		$(this).html(totals[i]);
		
		
   });
   //$("")
	}
	
	
               ////////////////////////////batas total column
				
$('#example').on( 'draw', function () {
   //alert( 'Table redrawn' );
   //myFunction();
  // total_larik();

   
   
   
} ); ///////akhir func cari dttbles
							
                $('#example').DataTable({
					
					 //"dom": '<"toolbar">frtip',
					 fixedColumns:   {
            leftColumns: 2,
            //rightColumns: 1
        },
		
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: false,
	ordering: false,
                  
					filter: true,
        paging:         false,
		
		
		////////cari baru
		"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
 
            // Total over this page
            var pageTotal = api.column(1).data().reduce( function (a, b) {
				//alert(a + " : " + b);	
                    return Number(a) + Number(b);
                }, 0 );
			var pageTotal2 = api.column(3).data().reduce( function (a, b) {
				//alert(Number($(a).text()) + " : " + Number($(b).text()));	
				
                    return (Number($(a).text())) + (Number($(b).text()));
                }, 0 );
		
				
 
            // Update footer
            $( api.column( 1 ).footer() ).html(pageTotal);
			$( api.column( 3 ).footer() ).html(pageTotal2);
        }
		
		///////batas cari baru
		
		
		
               //"scrollY": 300,
                   // "scrollX": true,
                    /*"scrollY":        "400px",
                     "scrollCollapse": true,*/
                    //"ordering": false,
                   // "paging": false,
					//"filter": false
                });
				$("div.toolbar").html('<b><input type="text" id="cari" placeholder="Cari data"></b>');
				$("#cari").keyup(function(e) {
					//alert('kkkk')
                    cari_table();
					
					//$('#KOST').hide();
					//total_larik();
                });
				
				////////batas cari
				
				
				
            });

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
   var buil = $("#blnx").val();
   aksi= 'edit';
			$.ajax({
					type:"post",
					url:"edit_tgl_next.php",
					data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi,"blnx": buil},
					success: function(php_script_response){
						//$("#hasil").html(data);
						alert(php_script_response);
						$( "#popup-tgl" ).popup( "close" );
						window.location = "report_kirim_next.php?BLN="+buil+"";
						
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
   var buil = $("#blnx").val();
   aksi= 'delete';
			$.ajax({
					type:"post",
					url:"edit_tgl_next.php",
					data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi,"blnx": buil},
					success: function(php_script_response){
						//$("#hasil").html(data);
						alert(php_script_response);
						$( "#popup-tgl" ).popup( "close" );
						window.location = "report_kirim_next.php?BLN="+buil+"";
						
					}
				});
	  }
        }); 
	
	
	
	/////////////popo up qty
   $("td .update-data").on('click', function(){
      var id = $(this).attr("id");
	   var sil =  $(this).parents('td').find('#sol').val();
	    var kil =  $(this).parents('td').find('#tol').val();
		var acc =  $(this).parents('td').find('#accidku').val();
		var tng =  $(this).parents('td').find('#tng').val();
	 // alert (id);
          id = id.split('');
      
     var htm= '<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a><div style="padding:10px 30px;" data-theme="a" class="ui-corner-all">';
	   htm += '<div >Tanggal: <input type="text" id="tng98" maxlength="2" onkeypress="return isNumberKey(event)" value ="' + tng +'"></div>';
	   htm += '<div >';
       htm += 'Qty : <input type="text" id="qtyku98" value ="' + sil +'"><input type="hidden" id="accid98" value ="' + acc +'">';
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
			var buil = $("#blnx").val();
			$.ajax({
					type:"post",
					url:"editku_next.php",
					data:{"q":strcari,"qty":qty,"accid":acci,"aksi":aksi,"blnx": buil},
					success: function(php_script_response){
						//$("#hasil").html(data);
						alert(php_script_response);
						$( "#data-popup" ).popup( "close" );
						window.location = "report_kirim_next.php?BLN="+buil+"";
						
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
			var buil = $("#blnx").val();
			$.ajax({
					type:"post",
					url:"editku_next.php",
					data:{"q":strcari,"qty":qty,"accid":acci,"aksi":aksi,"blnx": buil},
					success: function(php_script_response){
						//$("#hasil").html(data);
						alert(php_script_response);
						$( "#data-popup" ).popup( "close" );
						window.location = "report_kirim_next.php?BLN="+buil+"";
						
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

// $(function() {
//	 $('#datepicker').datepicker({
   // defaultDate: '-2m'
   //efaultDate: new Date(2010, 7, 1)
 //  defaultDate: '2/9/2010'
//});
  //  $( "#datepicker" ).datepicker();
	//defaultDate: new Date(2010, 8, 1)
  //});

        </script>
    </head>

    <body>

    <div data-role="page" id="page1" data-theme="a">
        <div data-role="header">
            <h1>ORDER KIRIM BULAN : <?php echo $blank;?></h1>

            <h2>Kokola Distributor 2.5</h2><a href="report_kirim_now.php" target="_parent" class="ui-btn ui-btn-inline ui-icon-back ui-btn-icon-notext ui-corner-all">No text</a>
        </div>
<!-- dialog so-->
<div id="data-popup" data-role="popup" data-theme="a" > </div>
<div id="popup-tgl" data-role="popup" data-theme="a" ></div>

        <div data-role="content">
        <input type="hidden" id="blnx" value="<?php echo $bulanku?>">
        <input type="hidden" id="thnx" value="<?php echo $yearku?>">
        <button class="ui-btn ui-btn-inline" id="tmb">Tambah Data</button>
        
        <?php
		
		?>
        
<form id="formx" method="post" action="save_pengiriman.php" data-ajax="false">
<!--<b><input type="text" id="cari" placeholder="Cari data"></b> -->
       <table id="example" class="cell-border"   cellspacing="0" width="100%">
  		<thead>
        <tr class='titelku'>
    		<th style='min-width:250px'>Nama Produk</th>
    		<th style='min-width:70px'>Jumlah</th>
            
	        <?php
		//select ACCOUNT_ID, day(periode2) as tglx from order_kirim_wd where  ACCOUNT_ID =
	$sql9 = "select ACCOUNT_ID, day(periode2) as tglx,date(periode2) as dateku,month(periode2) as bulanku, 
 year(periode2) as thn from order_kirim_wd where  
 ACCOUNT_ID = '$accid' and month(periode2) ='$bulanku' and year(periode2) = '$yearku' group by tglx;";
		$query9=mysqli_query($mysqli, $sql9);
		$hj = 3;
  		while ($data9=mysqli_fetch_array($query9)) {
		$smk = $data9['tglx'];
		$dateku = $data9['dateku'];
			//for($i=0; $i<$jumHari; $i++){
				//$k = $i+1 ;
				//<a href='#data-popup' class='update-data' style='text-decoration:none' id='b1' data-rel='popup' data-position-to='window' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a' data-transition='slideup' data-mini ='true'>
				echo "<th style='min-width:50px' ><u><a href='#popup-tgl' data-rel='popup' class='SIMKU' data-position-to='window' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a' data-transition='slideup' data-mini ='true' mana='$hj' lion='$smk' mios='$dateku'> $smk</a></u></th>";
				$hj++;
				}
				?>
  		</tr>
        </thead>
		<?php
						 echo "<tfoot>
                        <tr class='totalku' id='KOST' >
                        <th width='50' class='kost'>&nbsp;</th>
                        <th width='50' align='right'  class='kost'>Total</th>";
						 
						 
						 
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
 $sql2 = "Select * from (select AA.ITEM_CODE,AA.ID,AA.NAMA_PRODUK, BB.ID_PRODUK, BB.BULAN1, BB.BULAN2,BB.ACCOUNT_ID,
   BB.BULAN3,BB.NAMA_DIST, BB.TGL,BB.THN, BB.BULAN_INPUT as BLI, BB.KU, BB.TRIWULAN
 from (select ID, NAMA_PRODUK, ITEM_CODE from m_produk)as AA right 
 join (select ACCOUNT_ID, ID as KU, BULAN_INPUT,Month(TGL) as TGL,
 YEAR(TGL) as THN,ID_PRODUK, BULAN1,BULAN2,BULAN3, NAMA_DIST, TRIWULAN, ITEM_CODE  from kj) as BB on AA.ITEM_CODE = BB.ITEM_CODE) as MM 
where MM.ACCOUNT_ID = '$accid' and MM.THN = '$yearku'  and MM.TRIWULAN ='$triwulan' and MM.ITEM_CODE = '$nmb3'  ";
//and MM.TGL = '$bulanku'        = kurangan query
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
				<td align='center'>$bulanku9</td>
				";
				
		$sql9 = "select ACCOUNT_ID, day(periode2) as tglx from order_kirim_wd where  ACCOUNT_ID = '$accid' 
		and month(periode2) ='$bulanku' and year(periode2) = '$yearku' group by tglx";
		$query9=mysqli_query($mysqli, $sql9);
  		while ($data9=mysqli_fetch_array($query9)) {
		$smk = $data9['tglx'];
				//for($i=0; $i<$jumHari; $i++)
					//{
						//$k = $i+1 ;
					
$sql_absen = "	select id, ACCOUNT_ID, item_code,qty, tgl_upload, DAY(periode2) as tglku from order_kirim_wd where  ACCOUNT_ID = '$accid'
and DAY(periode2) = '$smk' and month(periode2) ='$bulanku' and year(periode2) = '$yearku' 
and item_code = '".$data['item_code']."';";
					$queryabsen=mysqli_query($mysqli, $sql_absen);
					$jml_absen = mysqli_num_rows($queryabsen);
					if ($dataabsen=mysqli_fetch_array($queryabsen))	{
						$coba = $dataabsen['qty'];
						$uup = number_format($coba);
						$idku = $dataabsen['id'];
						$tng = $dataabsen['tglku'];
						echo "<td  style='min-width:30px' align='center' >
						<a href='#data-popup' class='update-data' style='text-decoration:none' id='b1' data-rel='popup' 
						data-position-to='window' class='ui-btn ui-corner-all ui-shadow ui-btn-inline 
						ui-icon-check ui-btn-icon-left ui-btn-a' data-transition='slideup' data-mini ='true'><input type='hidden'  
						id='sol' value='$coba'>
						<input type='hidden' id='tol' class='MINS' value='$idku'>
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
						 /*echo "<tfoot>
                        <tr class='totalku' id='KOST' >
                        <th width='50' class='kost'>&nbsp;</th>
                        <th width='50' align='right'  class='kost'>Total</th>";
						 
						 
						 
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
				
				echo "</tr>  </tfoot>"; */
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
<div>Pilih Tanggal: <input type="text" id="datepicker"></div>
<button class="ui-btn ui-btn-inline" id="SVD">Tampilkan Form Input</button>

<div id="tampil_input"></div>
 
</div>
<!-- akhir input tanggal-->	
<script>
           
			$("#SVD").click(function(e) <!-- jika value strcari tidak kosong-->
			{
				var buil = $("#blnx").val();
				 var tyu = $("#mn").val();
				  var sjk = $("#liop").val();
				//alert (tyu);
				
				$.ajax({
					type:"post",
					url:"tampil_data_satu_next.php?BLN="+buil+"",
					data:{"q": tyu,"klm":sjk, "BLN":buil},
					//data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi},
					success: function(data){
						$("#tampil_input").html(data);
						$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
						//$('body').append('<div id="test-element">Click mee</div>');
					}
				});
			});
			
			
	$(document).on("click","#woke",function() {
		
		var arr = [];
		var i = 0;
		var accid = $("#liop").val();
		var buil = $("#blnx").val();
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
					url:"tampil_data_all_next.php",
					data:{"q": arr,"idku": accid,"blnx": buil},
					dataType:"html",
					//data:{"q":tgl_satu,"qty":array_id,"accid":date_satu,"aksi":aksi},
					success: function(php_script_response){
						//$("#tampil_input").html(data);
						alert(php_script_response);
						window.location = "report_kirim_next.php?BLN="+buil+"";
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