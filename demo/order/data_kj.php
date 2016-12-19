<?php
if(session_id() == '') {
    session_start();
}
if (!isset($_SESSION["USER"])){
	header('Location: index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=0;">
<title>Data KJ</title>
<link rel="stylesheet" href="themes/pelangi.min.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="css/jquery.mobile.structure-1.4.5.min.css" />

<link rel="stylesheet" href="themes/blitzer/jquery-ui.min.css" />
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css"/>
<link rel="stylesheet" href="css/dataTables.jqueryui.css" type="text/css"/>
<style type="text/css">
.angka {
	text-align:right;
	width:80px;
}
.batas {
	border-right:3px solid #ccc;
	color:#F00;
}
.sesuai_kj {
	color:#069;
}
.tanpa_kj {
	color:#063;
}
</style>

<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.jqueryui.min.js"></script>
<script type="text/javascript" src="js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
    var oTable = $("#tb_kj").DataTable({		
		"bPaginate": false,
		"scrollX": true,
		"scrollY": "50vh",
		"scrollCollapse": true,
		"bJQueryUI": true,
		"fixedColumns": {
			"leftColumns": 1
		},
		"language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Data yang dicari tidak ada",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
			"emptyTable": "Belum ada data KJ",
			"sLoadingRecords": "<img src='images/47.gif' />",
			"sSearch": "Cari: "
        },
		"info":     false,
		"ajax": {
            "url": "get_data_kj.php",
            "dataSrc": "data"
        },
		"columns": [
            { "data": "produk" },
			{ "data": "KJ1" },
			{ "data": "real1"},	
            { "data": "sisa1"},					
			{ "data": "KJ2" },
			{ "data": "real2" },
            { "data": "sisa2" },            
			{ "data": "KJ3" },
			{ "data": "real3" },
			{ "data": "sisa3" },            
        ],
		/*"initComplete": function () {
            var api = this.api();
            api.$('tr').each(function(index, element){
				//$('td', element).eq(2).addClass("angka");
			});
        },*/
		"createdRow": function ( row, data, index ) {
            /*if ( data[4].replace(/[\$,]/g, '') * 1 > 150000 ) {
                $('td', row).eq(5).addClass('highlight');
            }*/
			if ($('td', row).eq(4).text() > 0) {
				$('td', row).eq(4).parents('tr').addClass('sesuai_kj');
			}
			else {
				$('td', row).eq(4).parents('tr').addClass('tanpa_kj');;
			}
			$('td', row).eq(0).css("border-right","2px solid #999");
			$('td', row).eq(3).css("border-right","2px solid #999");
			$('td', row).eq(6).css("border-right","2px solid #999");
			for(i=1;i<$('td', row).length;i++) {
				$('td', row).eq(i).addClass("angka").html(format_digit($('td', row).eq(i).text()));
			}
        },
		"rowCallback": function( row, data, index ) {
			//$('td', row).eq(1).addClass("angka").html(format_digit($('td', row).eq(1).text()));
			//$('td:eq(1)', row).html(format_digit($('td', row).eq(1).text()));
        },
		"footerCallback": function ( row, data, start, end, display ) {
			var api = this.api(), data;
			var kj_1 = api.column( 1 ).data().reduce( function (a, b) {
				return Number(a) + Number(b);
			}, 0 );
			var kj_2 = api.column( 4 ).data().reduce( function (a, b) {
				return Number(a) + Number(b);
			}, 0 );
			var kj_3 = api.column( 7 ).data().reduce( function (a, b) {
				return Number(a) + Number(b);
			}, 0 );
			
			var real_1 = api.column( 2 ).data().reduce( function (a, b) {
				return Number(a) + Number(b);
			}, 0 );
			var real_2 = api.column( 5 ).data().reduce( function (a, b) {
				return Number(a) + Number(b);
			}, 0 );
			var real_3 = api.column( 8 ).data().reduce( function (a, b) {
				return Number(a) + Number(b);
			}, 0 );
			
			var sisa_1 = api.column( 3 ).data().reduce( function (a, b) {
				return Number(a) + Number(b);
			}, 0 );
			var sisa_2 = api.column( 6 ).data().reduce( function (a, b) {
				return Number(a) + Number(b);
			}, 0 );
			var sisa_3 = api.column( 9 ).data().reduce( function (a, b) {
				return Number(a) + Number(b);
			}, 0 );
			
			$(api.column(1).footer()).addClass("angka").html(format_digit(kj_1));
			$(api.column(4).footer()).addClass("angka").html(format_digit(kj_2));
			$(api.column(7).footer()).addClass("angka").html(format_digit(kj_3));
			
			$(api.column(2).footer()).addClass("angka").html(format_digit(real_1));
			$(api.column(5).footer()).addClass("angka").html(format_digit(real_2));
			$(api.column(8).footer()).addClass("angka").html(format_digit(real_3));
			
			$(api.column(3).footer()).addClass("angka").html(format_digit(sisa_1));
			$(api.column(6).footer()).addClass("angka").html(format_digit(sisa_2));
			$(api.column(9).footer()).addClass("angka").html(format_digit(sisa_3));
		}
	});
});

function format_digit( toFormat ) {
	return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};
</script>
</head>

<body>
<div data-role="page" data-theme="o">
	<div data-role="header" data-position="fixed" data-tap-toggle="false">
    	<a href="#" data-icon="arrow-l" data-role="button" data-rel="back">Back</a>
		<h1 style="width:170px;margin:auto;">
            Data Distributor
        </h1>
	</div>
    
  <div data-role="content">
   	<div id="lebar"></div>
   	  <table id="tb_kj" class="display cell-border compact" cellspacing="0" width="100%">
       	  <thead>
           	  <tr>
               	  <th rowspan="2">Nama Produk</th>
                  <th colspan="3">Bulan 1</th>
                  <th colspan="3">Bulan 2</th>
                  <th colspan="3">Bulan 3</th>
              </tr>
           	  <tr>
               	  <th style="min-width:70px;">KJ</th>
                  <th style="min-width:70px;">Real</th>
                  <th style="min-width:70px;">Sisa</th>
                  <th style="min-width:70px;">KJ</th>
                  <th style="min-width:70px;">Real</th>
                  <th style="min-width:70px;">Sisa</th>
                  <th style="min-width:70px;">KJ</th>
                  <th style="min-width:70px;">Real</th>
                  <th style="min-width:70px;">Sisa</th>
              </tr>
          </thead>
          <tfoot>
           	  <tr>
               	  <th>&nbsp;</th>
                  <th>KJ</th>
                  <th>Real</th>
                  <th>Sisa</th>
                  <th>KJ</th>
                  <th>Real</th>
                  <th>Sisa</th>
                  <th>KJ</th>
                  <th>Real</th>
                  <th>Sisa</th>
              </tr>
          </tfoot>
      </table>
    </div>
    
    <div data-role="footer" data-position="fixed" data-tap-toggle="false">
    <!--<div data-role="footer" data-position="fixed">-->
		<h4>Copyright<!-- © --> &#169; 2016 Kokola Group</h4>
	</div>
</div>
</body>
</html>