<?php
require_once("koneksi.php");

$sqlData = "select AA.TGL, AA.ID_ORDER, AA.TGL, AA.USERID, BB.ID_PRODUK,
	CC.NAMA_PRODUK, BB.JML_KJ, BB.JML_REAL, BB.JML_SISA, BB.JML_ORDER
	from order_distributor AA, order_detail BB, m_produk CC
	where AA.ID_ORDER = BB.ID_ORDER
	and BB.ID_PRODUK = CC.ID
	and date_format(AA.TGL, '%Y %m') =  date_format(now(), '%Y %m')
	and USERID = '".$userLog."'
	order by AA.TGL desc";
$myData = mysql_query($sqlData);
$jml = mysql_num_rows($myData);
$arr = array();
if ($jml > 0) {
	while ($rowData = mysql_fetch_assoc($myData)) {
		$d = date("d", strtotime($rowData['TGL']));
		$m = date("m", strtotime($rowData['TGL']));
		$Y = date("Y", strtotime($rowData['TGL']));
		$arr[] = array($d." ".konversi($m)." ".$Y,
			$rowData['NAMA_PRODUK'], $rowData['JML_KJ'],
			$rowData['JML_REAL'], $rowData['JML_SISA'], $rowData['JML_ORDER']
		);
	}
	/*$data = '{"data": '.json_encode($arr).'}';
	echo ($data);*/
}
/*else {
	$arr[] = array("", "", "", "", "");
	$data = '{"data": '.json_encode($arr).'}';
	echo ($data);
}*/
$data = '{"data": '.json_encode($arr).'}';
echo ($data);
?>