<?php
session_start();
//include "koneksi.php";
session_destroy();
echo "<script>
	alert('Anda sudah keluar. terima kasih');
	window.location='index.php';
	location.assign('index.php');

</script>";
 
 
?>