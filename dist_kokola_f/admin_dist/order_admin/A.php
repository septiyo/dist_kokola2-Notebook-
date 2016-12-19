<?php
if(session_id() == '') {
    session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
</head>

<body>
<?php
if (isset($_SESSION["SES"])) {
	header("location: B.php");
}

if (isset($_POST['txt'])){
	$_SESSION["SES"] = $_POST['txt'];
	header("location: B.php");
}
?>
<form method="post" action="">
<input id="txt" name="txt" type="text" />
<input type="submit" value="yo" />
</form>
</body>
</html>