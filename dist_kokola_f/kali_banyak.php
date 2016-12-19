<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!--script-- type="text/javascript" src="js/jquery-2.1.4.min.js"></script-->
    <script src="jqm2/jquery-2.1.4.min.js"></script>
</head>

<body>
<?php
for ($i=1;$i<=5;$i++) {
?>
<div>
    <input id="A1" type="text" class="A" placeholder="A"/>
    <input id="B1" type="text" class="B" placeholder="B" />
    <input id="C1" type="text" class="C" />
    <br /><br />
</div>
<?php
}
?>
<script>
$(".A").on("keyup", function() {
	var hasil = $(this).val() * $(this).siblings('.B').val();
	$(this).siblings('.C').val(hasil);
});

$(".B").on("keyup", function() {
	var hasil = $(this).val() * $(this).siblings('.A').val();
	$(this).siblings('.C').val(hasil);
});
</script>
</body>

</html>