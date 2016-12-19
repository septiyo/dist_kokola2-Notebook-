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
<title>Set Banner</title>
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
    $("#FORM_BANNER").submit(function(event) {
        if ($("#ISI_BANNER").val() == "") {
			alertify.dialog('alert').set({transition:'zoom',
				message: "Ups.. Isi Text Banner dahulu !!!",
				title: "Pesan Simpan",
			}).show();
			return false;
		}
		var data_post = {
			ISI_BANNER: $("#ISI_BANNER").val(),		
		};
		
		$.post("simpan_banner.php", data_post, function(result) {
			if (result == "sukses") {
				alertify.dialog('alert').set({transition:'zoom',
					message: "Banner telah disimpan",
					title: "Pesan Simpan",
				}).show();
				
			}
			else {
				alertify.dialog('alert').set({transition:'zoom',
					message: "Gagal menyimpan !!!",
					title: "Pesan Simpan",
				}).show();
			}
		});
		return false;
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
    	<form id="FORM_BANNER" name="FORM_BANNER"  method="post">
        	<label for="ISI_BANNER"><b>Isi Text Banner</b></label>
            <?php
			require_once("order_admin/koneksi.php");
			
			$sqlBanner = "select * from kata_sakti order by ID desc";
			$myBanner = mysql_query($sqlBanner);
			if ($dataBanner = mysql_fetch_assoc($myBanner)) {
				$banner = $dataBanner['KALIMAT'];
			}
			else {
				$banner = "";
			}
			?>
        	<input id="ISI_BANNER" name="ISI_BANNER" type="text" placeholder="Text Banner..." value="<?php echo $banner;?>" />
            <br />
            <input id="btn_set" type="submit" value="Set Banner" data-icon="check" data-iconpos="left" data-inline="true" />
        </form>
    </div>
    <div data-role="footer" data-position="fixed" data-tap-toggle="false">
    	<h4>Copyright<!-- © --> &#169; 2016 Kokola Group</h4>
	</div>
</div>
</body>
</html>