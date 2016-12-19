<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Multidate</title>
<!--<link rel="stylesheet" type="text/css" href="themes/ui-lightness/jquery-ui.css">-->
<link rel="stylesheet" type="text/css" href="css/mdp.css">
<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery-ui.multidatespicker.js"></script>
<script>
$(document).ready(function(e) {
	$("#custom-date-format").focusin(function(e) {
		$('#custom-date-format').multiDatesPicker({
			/*dateFormat: "y-m-d", 
			defaultDate:"85-2-19"*/
			defaultDate: "+1w",
			firstDay: 1,
			dateFormat: "dd.mm.yy",
			numberOfMonths: 1,
			//addDisabledDates: getSelectedExceptionDates(callback),
			onSelect: function () {
				var dates = $("#custom-date-format").multiDatesPicker('getDates');
				var html = '';
				$.each(dates, function (i, val)	{
					html += '<input type="text" name="Dates" value="' + val + '" />';
				});
				$("#SelectedDates").html(html);
			}
		}); 
    });
});
</script>

<!--<link rel="stylesheet" type="text/css" href="css/prettify.css">-->
</head>

<body>
<!--<div id="custom-date-format"></div>-->
<input id="custom-date-format" type="text" />
<div id="SelectedDates"></div>
</body>
</html>