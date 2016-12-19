<?php
if(session_id() == '') {
    session_start();
}

require_once("order_admin/koneksi.php");

$isi_banner = isset($_REQUEST['ISI_BANNER']) ? $_REQUEST['ISI_BANNER'] : '';

$sqlCek = "select * from kata_sakti";
$myCek = mysql_query($sqlCek);
$jml = mysql_num_rows($myCek);
if ($jml > 0) {
	$sqlBanner = "update kata_sakti set KALIMAT = '".$isi_banner."',
		USER_MODIFIED = '".$userLog."', TIME_MODIFIED = now()
		where ID = 1;";
}
else {
	$sqlBanner = "insert into kata_sakti set KALIMAT = '".$isi_banner."',
		USER_MODIFIED = '".$userLog."', TIME_MODIFIED = now();";
}
if ($myBanner = mysql_query($sqlBanner)) {
	echo "sukses";
}
else {
	echo "failed";
}

?>