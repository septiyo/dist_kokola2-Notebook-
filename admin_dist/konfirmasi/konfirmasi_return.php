<?php
ini_set('display_errors','0');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
    
	<link rel="stylesheet" type="text/css" href="jqtable/jquery.dataTables.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<!--/*	<link rel="stylesheet" type="text/css" href="jqtable/demo.css">*/-->
	<style type="text/css">
	
	body {
		font-family: 'Open Sans', sans-serif;
		font-size:12px;
		}
	
/*    a.btn {	
    text-align: center;
    color: buttontext;
    padding: 2px 4px;
	margin:2px;
	font-size:8px;
	width: 100%;
    -webkit-appearance: button;}
	a:hover.btn{
		text-decoration: none;
		color:#3B06BC;
		background-color:#23A6DD;}*/
    </style>
    
	<script type="text/javascript" language="javascript" src="jqtable/jquery-1.12.3.js"></script>
	<script type="text/javascript" language="javascript" src="jqtable/jquery.dataTables.min.js"></script>
<!--	<script type="text/javascript" language="javascript" src="jqtable/demo.js"></script>-->
	<script type="text/javascript">



$(document).ready(function() {
	var table = $('#example').DataTable( {
		"processing": true,
		"serverSide": true,
		//"order":[[0,"desc"]],
		"ajax": "action_konfir_return.php",
		"createdRow": function ( row, data, index ) {
    		
		      $('td', row).eq(5).html('<a class="btn" href="return.php?ID_ORDER='+ data[0] +'">RETURN</a>');
				
		}
				
		   
		
	});
});

	</script>
</head>

<body class="dt-example">
	<div class="container">
    <b><h3>RETURN KONFIRMASI</b>
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>ID ORDER</th>
						<th>TGL ORDER</th>
						<th>TGL KONFIRM</th>
						<th>ACC ID</th>
						<th>DISTRIBUTOR</th>
					    <th>Action</th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<th>ID ORDER</th>
						<th>TGL ORDER</th>
						<th>TGL KONFIRM</th>
						<th>ACC ID</th>
						<th>DISTRIBUTOR</th>
					    <th>Action</th>
					</tr>
				</tfoot>
			</table>
</div>
<a href="../home_admin.php">Back</a>
</body>
</html>