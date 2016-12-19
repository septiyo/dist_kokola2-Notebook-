<?php
error_reporting(0);
session_start();

if($_SESSION['USER']) {
	include "koneksi.php";
$accid = $_SESSION['ACCOUNT_ID'];	
date_default_timezone_set("Asia/Jakarta");
	   		    $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				$bulanku = date('m');
				$wkt = date('H:i:s'); 

    ?>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="themeku/themes/themeku.css" />
	<link rel="stylesheet" href="themeku/themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="themeku/jquery.mobile.structure-1.4.5.css" />
   <!-- <link rel="stylesheet" href="themeku/prettify.css" />-->
   <!--<link rel="stylesheet" href="themeku/mdp.css" />-->
   <link rel="stylesheet" href="jqtable/themes/start/jquery-ui.css">
    
	<script src="themeku/jquery.js"></script>
	<script src="themeku/jquery.mobile-1.4.5.js"></script>
        
        <script type="text/javascript" src="themeku/jquery-ui.js"></script> 
        
         <script type="text/javascript"  src="themeku/jquery-ui.multidatespicker.js"></script>


        <script src="validation/jquery.validate.js"></script>
       <!-- <link rel="stylesheet" href="themes/9septi_season.min.css"/>
        <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css"/>-->
        <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
       <!-- <link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>-->
        <!--<link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">-->
       
      
        <style>
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
        $(document).ready(function(e) {
			
			$("#mn").hide();
	//$("#datepicker").focusin(function(e) {
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
   // });
});
  $(function() {
    $( "#dtk" )
      .button()
      
  });
        </script>
    </head>

    <body>

    <div data-role="page" class="type-interior" data-theme="a">
        <div data-role="header">
            <h1>JADWAL KIRIM</h1>

            <h2>Kokola Distributor</h2>&nbsp;&nbsp;&nbsp;<a href="home.php" target="_parent" class="ui-btn ui-btn-inline ui-icon-back ui-btn-icon-notext ui-corner-all">No text</a>
        </div>

        <div align="center" data-role="content">
<form id="formx" method="post" action="real_pengiriman.php" data-ajax="false">
    
<h3>Silahkan pilih tanggal :</h3>
<textarea name="JADWAL" id="mn"  value="" ></textarea>
<!--<input type="text" name="JADWAL" id="mn"  value="" >-->
<!--<input id="datepicker"  type="text" placeholder='Pilih Tanggal'  value="Pilih Tanggal" />-->  
 <div id="datepicker"  ></div>   <br>  
<input type="submit" value="SAVE" name="SAVE" id="SAVE" ><a href="report_kirim_now.php" target="_parent" id="dtk" class="ui-btn ui-btn-inline" >Detail</a>
</form>
        </div>
        <!--emnd role-content-->

        <div data-role="footer">
         <!--   <table align="center">
                <tr>
                    <td align="center">
                        <a href="logout.php" style="text-align: center" data-role="button" data-icon="power"
                           target="_parent" data-ajax="false">Sign Out</a>
                    </td>
                </tr>
            </table>-->
            <h2>Kokola Web Developer Department, 2016</h2>
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