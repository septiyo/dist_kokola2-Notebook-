<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="themes/blitzer/jquery-ui.css" />
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script>
var array = Array();
var disableddates = ["11-01-2016", "12-01-2016", "16-01-2016", "17-01-2016"];
var tgl = "";
$(document).ready(function(e) {
	$('#tanggal').datepicker({
		dateFormat:"dd",
		beforeShowDay: function(date){
			var arr = $("#temp").val().slice(0,$("#temp").val().length-1).split(",");
			var string = jQuery.datepicker.formatDate('dd', date);
			return [ arr.indexOf(string) == -1 ]
		},
		onSelect: function(dateText, inst) {
			
			tgl = tgl + dateText + ",";
			$("#temp").val(tgl);
		}
	});
});
</script>
</head>

<body>
<input id="tanggal" type="text" />
<input id="temp" type="text" />
</body>
</html>