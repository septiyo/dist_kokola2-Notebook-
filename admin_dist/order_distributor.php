<?php
if(session_id() == '') {
    session_start();
}
if (!isset($_SESSION["USER"])){
	header('Location: ../index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order Distriibutor</title>
<link rel="stylesheet" href="order_admin/themes/pelangi.min.css" />
<link rel="stylesheet" href="order_admin/themes/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="order_admin/css/jquery.mobile.structure-1.4.5.min.css" />

<link rel="stylesheet" href="order_admin/themes/overcast/jquery-ui.min.css" />
<link rel="stylesheet" href="order_admin/css/jquery.dataTables.css" type="text/css"/>
<link rel="stylesheet" href="order_admin/css/dataTables.jqueryui.css" type="text/css"/>
<!--<link rel="stylesheet" href="css/responsive.dataTables.css" type="text/css"/>
<link rel="stylesheet" href="css/responsive.jqueryui.css" type="text/css"/>-->
<link rel="stylesheet" href="order_admin/css/alertify.css" type="text/css"/>
<link rel="stylesheet" href="order_admin/css/default.css" type="text/css"/>
<style type="text/javascript">
.dataTables_filter {
	display: none; 
}
td.details-control {
    background: url('../resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('../resources/details_close.png') no-repeat center center;
}
#tb_distributor {
	color: #C63 !important;
}
</style>
<script type="text/javascript" src="order_admin/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="order_admin/js/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript" src="order_admin/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="order_admin/js/dataTables.jqueryui.min.js"></script>
<!--<script type="text/javascript" src="js/dataTables.responsive.js"></script>
<script type="text/javascript" src="js/responsive.jqueryui.js"></script>-->
<script type="text/javascript" src="order_admin/js/jquery.dataTables.rowGrouping.js"></script>
<script type="text/javascript" src="order_admin/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="order_admin/js/alertify.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	var t_minus = $("div[data-role=header]").height() + $("div[data-role=footer]").height();
	//alert($(window).height() + " : " + t_minus);
	var tinggi = $(window).height() - t_minus - t_minus - t_minus;
	
    var oTable = $("#tb_distributor").dataTable({
		"language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Data yang dicari tidak ditemukan",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
			"emptyTable": "Belum ada data dari KJ",
			"sLoadingRecords": "Please wait - loading...",
        },
		"bPaginate": false,
		"scrollX": true,
		"scrollY": tinggi,
		"scrollCollapse": true,
		"bJQueryUI": true,
		"bInfo": false
	});
	
});
</script>
</head>

<body>
<div data-role="page" data-theme="a">
	<div data-role="header" data-position="fixed" data-tap-toggle="false">
        <a href="home_admin.php" data-icon="arrow-l" data-role="button" data-ajax="false">&nbsp;</a>
    	<h1 style="width:170px;margin:auto;">Order Distributor</h1>
    </div>
    <div data-role="content" class="ui-content">
    	<table id="tb_distributor" class="display cell-border compact" cellspacing="0" width="100%">
			<thead>
            	<tr>
                	<th>No</th>
                    <th>Distributor</th>
                    <th>Alamat</th>
                    <th width="125">Kota</th>
                    <th width="125">Regional</th>
                </tr>
            </thead>
            <tfoot>
                	<th>No</th>
                    <th>Distributor</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Regional</th>
                </tr>
            </tfoot>
			<tbody>
			<?php
            require_once("order_admin/koneksi.php");
			
			$nomor = 1;
            $sqlDist = "select BB.ACCOUNT_ID, BB.ACCOUNT_NAME, BB.ACCOUNT_ADDRESS1, BB.ACCOUNT_CITY_ID1, AA.REGIONAL
				from user AA, push_distributor BB
				where AA.ACCOUNT_ID = BB.ACCOUNT_ID
				order by AA.REGIONAL desc, BB.ACCOUNT_CITY_ID1, BB.ACCOUNT_NAME";
			$myDist = mysql_query($sqlDist);
			while ($dataDist = mysql_fetch_assoc($myDist)) {
				$acc_id = $dataDist['ACCOUNT_ID'];
				?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><a href="order_admin/form_distributor.php?acc_id=<?php echo $acc_id;?>" style="text-decoration:none;" data-ajax="false">
							<?php echo $dataDist['ACCOUNT_NAME']; ?></a></td>
                        <td><?php echo $dataDist['ACCOUNT_ADDRESS1']; ?></td>
						<td><?php echo $dataDist['ACCOUNT_CITY_ID1']; ?></td>
						<td><?php echo $dataDist['REGIONAL']; ?></td>
					</tr>
				<?php
				$nomor++;
			}
            ?>
            </tbody>
        </table>
    </div>
    <div data-role="footer" data-position="fixed" data-tap-toggle="false">
    	<h4>Copyright<!-- © --> &#169; 2016 Kokola Group</h4>
	</div>
</div>
</body>
</html>