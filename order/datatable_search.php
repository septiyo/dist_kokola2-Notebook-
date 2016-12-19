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
<style type="text/css">
.toolbar {
    float: left;
}
</style>
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/dataTables.jqueryui.js"></script>
<script>
$(document).ready(function(e) {
    oTable = $("#tb_order").DataTable({
		"bSort" : false,
		"bPaginate": false,
		"scrollX": true,
		//"scrollY": "100vh",
		"scrollY": 400,
		"scrollCollapse": true,
		"bJQueryUI": true,
		"bInfo": false,
		//"bFilter": false,		
		//"dom": '<"top"i>rt<"bottom"flp><"clear">',
		"dom": '<"toolbar">frtip'
		//"orderCellsTop": true ,
	});
	
	$("div.toolbar").html('<b>Custom tool bar! Text/images etc.</b>');
	
	$("#cari").on("keyup", function() {
		var value = $(this).val();
	
		$("table tr").each(function(index) {
			if (index !== 0) {	
				$row = $(this);	
				var id = $row.find("td:first").text().toLowerCase();							
				if (id.indexOf(value) !== 0) {	
					alert(id);								
					$row.hide();									
				}
				else {					
					$row.show();
				}
			}
		});
	});
});
</script>
</head>

<body>
<div data-role="page" data-theme="o">
	<div data-role="header" data-position="fixed" data-tap-toggle="false">
    <!--<div data-role="header">-->
		<h1 style="width:170px;margin:auto;">
        	Form Distributor
        </h1>
        <a id="btn_order" href="data_order.php" data-transition="slide" class="ui-btn-right">Data</a>
	</div>

	<div data-role="content">
        <table id="tb_order" class="display cell-border compact" cellspacing="0" width="100%">
            <thead>
            	<tr>
            	<th colspan="2">Cari <input id="cari" type="text" data-role="none" /></th>
                </tr>
            	<tr>
                <th>Nama</th>
                <th>Kota</th>
                </tr>
            </thead>
            <tfoot>
            	<tr>
                <th>Nama</th>
                <th>Kota</th>
                </tr>
            </tfoot>
            <tbody>
                
                <?php
                require_once("koneksi.php");
                $sql = "select * from coba";
                $mysql = mysql_query($sql);
                while ($row = mysql_fetch_assoc($mysql)) {
                ?>
                <tr>
                    <td><?php echo $row['nama'] ?></td>
                    <td><?php echo $row['kota'] ?></td>
                </tr>
                <?php
                }
                ?>
                
            </tbody>
        </table>
	</div>
    
    <div data-role="footer" data-position="fixed" data-tap-toggle="false">
    <!--<div data-role="footer" data-position="fixed">-->
		<h4>Copyright<!-- © --> &#169; 2016 Kokola Group</h4>
	</div>
</div>
</body>
</html>