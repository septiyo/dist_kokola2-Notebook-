<?php
if(session_id() == '') {
    session_start();
}

$host="10.1.13.54:2272";  
$userDB="rambo";  
$passwordDB="rogerthat";  
$database="distributor_kokola";
/*$host="localhost";  
$userDB="root";  
$passwordDB="";  
$database="distributor_kokola";*/

$conn = mysql_connect($host, $userDB, $passwordDB) or die("cannot connect server ");
$db = mysql_select_db($database)  or die('Gagal membuat koneksi database '.mysql_error);

//date_default_timezone_set("Asia/Jakarta");

if (isset($_SESSION["ACCOUNT_ID"])){
	$userLog = $_SESSION["ACCOUNT_ID"];
}

$sqlAcc = "select ACCOUNT_ID, NAMA, account_address1, KOTA from user where ACCOUNT_ID = '".$userLog."'";

$myAcc = mysql_query($sqlAcc);
$jmlAcc = mysql_num_rows($myAcc);
if ($dataAcc = mysql_fetch_assoc($myAcc)) {
	$account_id = $dataAcc['ACCOUNT_ID'];
	$nama = $dataAcc['NAMA'];
	$kota = $dataAcc['KOTA'];
	$alamat_dist = $dataAcc['account_address1'];
}

$bulan = date('m');
$nm_bulan = konversi(angka_bulan($bulan));

function konversi($bln) {
	$nm_bulan = "";
	if ($bln == "01") {
		$nm_bulan = "Jan";
	}
	elseif ($bln == "02") {
		$nm_bulan = "Feb";
	}
	elseif ($bln == "03") {
		$nm_bulan = "Mar";
	}
	elseif ($bln == "04") {
		$nm_bulan = "Apr";
	}
	elseif ($bln == "05") {
		$nm_bulan = "Mei";
	}
	elseif ($bln == "06") {
		$nm_bulan = "Jun";
	}
	elseif ($bln == "07") {
		$nm_bulan = "Jul";
	}
	elseif ($bln == "08") {
		$nm_bulan = "Ags";
	}
	elseif ($bln == "09") {
		$nm_bulan = "Sep";
	}
	elseif ($bln == "10") {
		$nm_bulan = "Okt";
	}
	elseif ($bln == "11") {
		$nm_bulan = "Nov";
	}
	elseif ($bln == "12") {
		$nm_bulan = "Des";
	}
	return $nm_bulan;
}

function angka_bulan($bln) {
	if ($bln < 10 ) {
		return "0".$bln;
	}
	else {
		return $bln;
	}
}
?>