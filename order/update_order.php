<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Perbaru Data</title>
<link rel="stylesheet" href="themes/pelangi.min.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="css/jquery.mobile.structure-1.4.5.min.css" />

<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
<div data-role="page" data-theme="o">
	<div data-role="header" data-position="fixed" data-tap-toggle="false">
    	<a id="btn_order" href="<?php echo $url.'dist.php';?>" data-role="button" data-icon="home" data-ajax="false" data-iconpos="notext">Home</a>
		<h1 style="width:170px;margin:auto;">
            Perbaru Order
        </h1>
	</div>
    
    <div data-role="content">
    	<table id="tb_kj" class="display cell-border compact" cellspacing="0" width="100%">
        	<thead>
            	<tr>
                	<th>Nama Produk</th>
                    <th>Kubik</th>
                    <th>KJ</th>
                    <th>Real</th>
                    <th>Order</th>
                </tr>
            </thead>
            <tfoot>
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