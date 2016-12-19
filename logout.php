<?php
session_start();
//include "koneksi.php";
$_COOKIE['cookieName'] = "";
unset($_COOKIE['cookieName']);
session_destroy();
echo "<script>
	alert('Anda sudah keluar. terima kasih');
	window.location='index.php';
	location.assign('index.php');

</script>";
 
 
?>