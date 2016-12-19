<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=0;">
<title>Data Order</title>
<link rel="stylesheet" href="themes/pelangi.min.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="css/jquery.mobile.structure-1.4.5.min.css" />

<!--<link rel="stylesheet" href="themes/redmond/jquery-ui.min.css" />-->
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css"/>
<link rel="stylesheet" href="css/dataTables.jqueryui.css" type="text/css"/>
<style>
#tb_data {
	color:rgba(0,102,153,1);
}
</style>
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.mobile-1.4.5.min.js"></script>

<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/dataTables.jqueryui.js"></script>
<script>
$(document).on("pagebeforecreate", function() {
	window.location = "form_distributor.php";
});
</script>
</head>

<body>
<div id="halaman" data-role="page" data-theme="b">
	<div data-role="header" data-position="fixed" data-tap-toggle="false">
    	<a href="#" data-icon="arrow-l" class="ui-corner-all ui-btn-left" data-rel="back">Back</a>
		<h1 style="width:170px;margin:auto;">
        	Order Bulan ini
        </h1>
	</div>

	<div data-role="content">
    	<table id="tb_data" class="display cell-border compact" cellspacing="0" width="100%">
        	<thead>
                <tr>
                	<th>Tanggal</th>
                    <th>Produk</th>
                    <th>KJ</th>
                    <th>Real</th>
                    <th>Sisa</th>
                    <th>Order</th>
                </tr>
            </thead>
            <tfoot>
				<tr>
                	<th>Tanggal</th>
                    <th>Produk</th>
                    <th>KJ</th>
                    <th>Real</th>
                    <th>Sisa</th>
                    <th>Order</th>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <div data-role="footer" data-position="fixed" data-tap-toggle="false">
		<h4>Copyright<!-- © --> &#169; 2016 Kokola Group</h4>
	</div>
</div>
</body>
</html>