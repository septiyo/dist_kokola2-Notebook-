<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="themes/pelangi.min.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="css/jquery.mobile.structure-1.4.5.min.css" />

<link rel="stylesheet" href="themes/blitzer/jquery-ui.min.css" />
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css"/>
<link rel="stylesheet" href="css/dataTables.jqueryui.css" type="text/css"/>

<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.mobile-1.4.5.min.js"></script>

<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.jqueryui.min.js"></script>
<script>
$(document).ready(function(e) {
	var oTable = $('#example').DataTable( {
		"footerCallback": function ( row, data, start, end, display ) {
			var api = this.api(), data;
 
			// Remove the formatting to get integer data for summation
			var intVal = function ( i ) {
				return typeof i === 'string' ?
					i.replace(/[\$,]/g, '')*1 :
					typeof i === 'number' ?
						i : 0;
			};	
 
			// Total over this page
			var x1 = 0;
			pageTotal1 = api.column( 1, { page: 'current'} ).data()
				.reduce( function (a, b) {
					return x1 = x1 + Number($(b).text());
					//return intVal(a) + intVal(b);
				}, 0 );
			
 
			// Update footer
			$( api.column( 1 ).footer() ).html(pageTotal1);
		}
	} );
	
	/*$('#example tbody').on( 'click', 'td', function () {
		var columnData = oTable
        .column( $(this).index()+':visIdx' )
        .data();
		alert( $(this).index() );
	} );*/
});


</script>
</head>

<body>
<div data-role="page" data-theme="o">
	<div data-role="header" data-position="fixed" data-tap-toggle="false">
		<h1 style="width:170px;margin:auto;">
            Form Distributor
        </h1>
	</div>

	<div data-role="content">
    	<div data-role="popup" id="myPop" class="ui-content" data-overlay-theme="o" data-corners="false">
        	uadhuahda	
        </div>
        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <td>Nama</td>
                    <td>2</td>
                    <td>5</td>
                    <td>8</td>
                    <td>9</td>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td>Nama</td>
                    <td>harga</td>
                    <td>QTY1</td>
                    <td>QTY2</td>
                    <td>QTY3</td>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>ANJAS</td>
                    <td><a href="#">10</a></td>
                    <td><a href="#">4</a></td>
                    <td><a href="#">6</a></td>
                    <td><a href="#">5</a></td>
                </tr>
                <tr>
                    <td>ANJOS</td>
                    <td><a href="#">5</a></td>
                    <td><a href="#">8</a></td>
                    <td><a href="#">1</a></td>
                    <td><a href="#">1</a></td>
                </tr>
                <tr>
                    <td>BANTEN</td>
                    <td><a href="#">4</a></td>
                    <td><a href="#">10</a></td>
                    <td><a href="#">5</a></td>
                    <td><a href="#">5</a></td>
                </tr>
                <tr>
                    <td>CANCEL</td>
                    <td><a href="#">2</a></td>
                    <td><a href="#">5</a></td>
                    <td><a href="#">5</a></td>
                    <td><a href="#">1</a></td>
                </tr>
            </tbody>
        </table>
	</div>
</div>
<script>
$("#example tbody tr td a").click(function(e) {		
	$("#myPop").popup({
		positionTo: 'window',
		transition: "slideup",
	});
	
	$('#myPop').popup("open");
	$("#myPop").html("Tgl : " +$(this).parents('table').find('thead tr td:eq(' +
		$(this).parent().index() + ')').text() +
		"<br />Nilai :" + $(this).text());
});


</script>
</body>
</html>
