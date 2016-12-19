<?php

 session_start();
include "koneksi.php"; 
 	$email = $_SESSION['EMAIL'];
	
	$sql_offline = "DELETE FROM userr_online WHERE email = '$email'"; 
	$hasil_offline = mysqli_query($mysqli, $sql_offline);
	
 
 
 session_destroy();
 
    echo "<script>
	        alert('Anda sudah keluar. terima kasih');
			window.location='index.php';
			location.assign('index.php');
	
	    </script>";
 
 
?>