<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
  <script src="jqm2/jquery-2.1.4.min.js"></script>
</head>

<body>
<table width="200" border="1">
  <tr>
    <td>JOse</td>
    <td><input type="text" class="A" value="10" /></td>
    <td><input type="text" class="B" /></td>
    <td><input type="text" class="C" /></td>
  </tr>
  <tr>
    <td>MADE</td>
    <td><input type="text" class="A" value="15" /></td>
    <td><input type="text" class="B" /></td>
    <td><input type="text" class="C" /></td>
  </tr>
  <tr>
    <td>ROY</td>
    <td><input type="text" class="A" value="20" /></td>
    <td><input type="text" class="B" /></td>
    <td><input type="text" class="C" /></td>
  </tr>
</table>
<script>
$("tr td .B").on("keyup",function() {
	var hasil = $(this).val() * $(this).parents('tr').find('.A').val();
	$(this).parents('tr').find('.C').val(hasil);
});
</script>
</body>
</html>